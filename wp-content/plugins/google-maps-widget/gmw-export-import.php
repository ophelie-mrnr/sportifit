<?php
/*
 * Google Maps Widget
 * (c) Web factory Ltd, 2013 - 2016
 *
 * Parts of code are based on Widget Importer & Exporter
 * (c) Steven Gliebe, http://stevengliebe.com/
 * https://wordpress.org/plugins/widget-importer-exporter/
 */


// this is an include only WP file
if (!defined('ABSPATH')) {
  die;
}


class GMW_export_import {
  // pack all GMW widget instances in an array
  static function generate_export_data() {
    $widget_instances = $instances = $sidebars_widget_instances = array();
    
    $instances = get_option('widget_googlemapswidget', array());
    foreach ($instances as $instance_id => $instance_data) {
      if ( is_numeric( $instance_id ) ) {
        $unique_instance_id = 'googlemapswidget' . '-' . $instance_id;
        $widget_instances[$unique_instance_id] = $instance_data;
      }
    } // foreach

    // get sidebars with their widget instances
    $sidebars_widgets = get_option('sidebars_widgets');
    foreach ($sidebars_widgets as $sidebar_id => $widget_ids ) {
      if ('_wp_inactive_widgets' == $sidebar_id ) {
        continue;
      }
      if (!is_array($widget_ids) || empty($widget_ids)) {
        continue;
      }

      // loop widget IDs for this sidebar
      foreach ($widget_ids as $widget_id ) {
        if (isset($widget_instances[$widget_id])) {
          $sidebars_widget_instances[$sidebar_id][$widget_id] = $widget_instances[$widget_id];
        }
      }
    } // sidebar widgets

    return $sidebars_widget_instances;
  } // generate_export_data

  
  // creates a file with GMW export
  static function send_export_file() {
    $filename = str_replace(array('http://', 'https://'), '', home_url());
    $filename = str_replace(array('/', '\\', '.'), '-', $filename);
    $filename .= '-' . date('Y-m-d') . '-googlemapswidgets.txt';

    $out = array('type' => 'GMW export', 'version' => GMW::$version, 'data' => self::generate_export_data());
    $out = json_encode($out);

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($out));

    @ob_end_clean();
    flush();

    echo $out;
    exit;
  } // send_export_file
  
  
  // validate import file after upload
  static function validate_import_file() {
    if (empty($_POST) || empty($_FILES['gmw_widgets_import'])) {
      return new WP_Error('0', 'No import file uploaded.');
    }

    $uploaded_file = $_FILES['gmw_widgets_import'];
    $wp_filetype = wp_check_filetype_and_ext($uploaded_file['tmp_name'], $uploaded_file['name'], false);
    if ($wp_filetype['ext'] != 'txt' && !wp_match_mime_types('txt', $wp_filetype['type'])) {
      return new WP_Error(1, 'Please upload a <i>TXT</i> file generated by Google Maps Widget.');  
    }

    if ($uploaded_file['size'] < 500) {
      return new WP_Error(1, 'Uploaded file is too small. Please verify that you have uploaded the right file.');  
    }
    
    if ($uploaded_file['size'] > 100000) {
      return new WP_Error(1, 'Uploaded file is too large to process. Please verify that you have uploaded the right file.');  
    }
    
    $content = file_get_contents($uploaded_file['tmp_name']);
    $content = json_decode($content, true);
    if (!isset($content['type']) || !isset($content['version']) || !isset($content['data']) || 
        $content['type'] != 'GMW export' || !is_array($content['data'])) {
      return new WP_Error(1, 'Uploaded file is not a GMW export file. Please verify that you have uploaded the right file.');
    }
    
    return $content;
  } // validate_import_file
  
  
  // process uploaded import file
  static function process_import_file($import_data) {
    global $wp_registered_sidebars;
    $results = array('total' => 0);

    $data = $import_data['data'];
    $widget_instances = array('googlemapswidget' => get_option('widget_googlemapswidget', array()));

    // loop import data's sidebars
    foreach ($data as $sidebar_id => $widgets) {
      // check if sidebar is available on this site; or add to inactive
      if (isset($wp_registered_sidebars[$sidebar_id])) {
        $sidebar_available = true;
        $use_sidebar_id = $sidebar_id;
        $sidebar_message_type = 'success';
        $sidebar_message = '';
      } else {
        $sidebar_available = false;
        $use_sidebar_id = 'wp_inactive_widgets';
        $sidebar_message_type = 'error';
        $sidebar_message = __('Sidebar does not exist in theme (using Inactive)', 'google-maps-widget');
      }

      $results[$sidebar_id]['name'] = ! empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name']: $sidebar_id;
      $results[$sidebar_id]['message_type'] = $sidebar_message_type;
      $results[$sidebar_id]['message'] = $sidebar_message;
      $results[$sidebar_id]['widgets'] = array();

      // loop widgets
      foreach ( $widgets as $widget_instance_id => $widget ) {
        $fail = false;

        $id_base = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
        $instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);

        // Does widget with identical settings already exist in same sidebar?
        if (!$fail && isset($widget_instances[$id_base])) {

          // Get existing widgets in this sidebar
          $sidebars_widgets = get_option('sidebars_widgets');
          $sidebar_widgets = isset($sidebars_widgets[$use_sidebar_id])? $sidebars_widgets[$use_sidebar_id]: array();

          // Loop widgets with ID base
          $single_widget_instances = !empty($widget_instances[$id_base])? $widget_instances[$id_base]: array();
          foreach ($single_widget_instances as $check_id => $check_widget) {
            // is widget in same sidebar and has identical settings?
            if (in_array("$id_base-$check_id", $sidebar_widgets) && (array) $widget == $check_widget) {
              $fail = true;
              $widget_message_type = 'warning';
              $widget_message = __('Widget already exists', 'google-maps-widget');
              break;
            }
          }
        }

        if (!$fail) {
          // Add widget instance
          $single_widget_instances = get_option('widget_' . $id_base);
          $single_widget_instances = !empty($single_widget_instances)? $single_widget_instances: array('_multiwidget' => 1);
          $single_widget_instances[] = $widget; // add it

            // Get the key it was given
            end($single_widget_instances);
            $new_instance_id_number = key($single_widget_instances);

            // If key is 0, make it 1
            // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
            if ('0' === strval($new_instance_id_number)) {
              $new_instance_id_number = 1;
              $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
              unset( $single_widget_instances[0] );
            }

            // Move _multiwidget to end of array for uniformity
            if (isset($single_widget_instances['_multiwidget'])) {
              $multiwidget = $single_widget_instances['_multiwidget'];
              unset($single_widget_instances['_multiwidget']);
              $single_widget_instances['_multiwidget'] = $multiwidget;
            }

            // Update option with new widget
            update_option('widget_' . $id_base, $single_widget_instances);

          // Assign widget instance to sidebar
          $sidebars_widgets = get_option('sidebars_widgets'); // which sidebars have which widgets, get fresh every time
          $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
          $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
          update_option('sidebars_widgets', $sidebars_widgets); // save the amended data

          // Success message
          if ( $sidebar_available ) {
            $widget_message_type = 'success';
            $widget_message = 'Imported';
          } else {
            $widget_message_type = 'warning';
            $widget_message = 'Imported to inactive';
          }
        }

        $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
        $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget['title'] ) ? $widget['title'] : __( 'No Title', 'google-maps-widget' ); // show "No Title" if widget instance is untitled
        $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
        $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
        $results['total']++;
      }
    }

    return $results;
  } // process_import_file
} // GMW_export_import