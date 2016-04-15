<div class="wrap">	<h2>Login Screen</h2>		<h3>Customization</h3>		<?php	global $mayo_login_screen_option;	if(isset($_POST)){			if(isset($_POST['mayo_login_screen_submit'])){			if(check_admin_referer( 'mayo_login_screen_setting' )){				unset($_POST['_wpnonce']);				unset($_POST['_wp_http_referer']);				unset($_POST['mayo_login_screen_submit']);								foreach($_POST as $k => $v){					$mayo_login_screen_option[$k] = $v;				}								update_option('mayo_login_screen_option', $mayo_login_screen_option);			}		}		elseif(isset($_FILES['mayo_login_screen_import_file']) && !empty($_FILES['mayo_login_screen_import_file']['tmp_name'])){
			$import_option_obj = json_decode ( file_get_contents ( $_FILES['mayo_login_screen_import_file']['tmp_name'] ) );			foreach( $import_option_obj as $k => $v ){				$mayo_login_screen_option[ $k ] = $v;			}
			update_option('mayo_login_screen_option', $mayo_login_screen_option);		}		elseif(isset($_POST['mayo_login_screen_reset'])){			if(check_admin_referer( 'mayo_login_screen_setting' )){				delete_option('mayo_login_screen_option');				echo '<script>location.reload();</script>';			}		}			}		?>		<form method="post" enctype="multipart/form-data">		<div class="input_option">			<label class="label-block">Logo </label>			<input type="text" id="login_screen_logo" name="login_screen_logo" class="live_style" value="<?php echo $mayo_login_screen_option['login_screen_logo']; ?>"><span class="remove" title="Remove image">&times;</span><input title="Select website logo" type="button" class="button open_media_button" data-media_type="image" data-target="#login_screen_logo" value="Browse" />			<span class="smaller text-muted">If no logo is used, your website name will be displayed.</span>		</div>		<div class="input_option">			<label class="label-block">Logo Link</label>			<input type="text" id="login_screen_logo_link" name="login_screen_logo_link" value="<?php echo isset( $mayo_login_screen_option['login_screen_logo_link'] ) ? $mayo_login_screen_option['login_screen_logo_link'] : ''; ?>">			<span class="smaller text-muted">If no logo link is define, default link will be used.</span> <a class="btn-subtle"title="Available code: @front : Link to your website front page.@posts : Link to your website post page.Leave blank to disable link.">?</a>		</div>		<div class="input_option">			<label class="label-block">Website Name Color </label>			<input type="text" id="login_screen_h1_color" name="login_screen_h1_color" class="color_field live_style" value="<?php echo $mayo_login_screen_option['login_screen_h1_color']; ?>">		</div>				<br>				<div class="input_option">			<label class="label-block">Form color </label>			<input type="text" id="login_screen_form_bg_color" name="login_screen_form_bg_color" class="color_field live_style" value="<?php echo $mayo_login_screen_option['login_screen_form_bg_color']; ?>">		</div>		<div class="input_option">			<label class="label-block">Button color </label>			<input type="text" id="login_screen_form_button_bg_color" name="login_screen_form_button_bg_color" class="color_field live_style" value="<?php echo $mayo_login_screen_option['login_screen_form_button_bg_color']; ?>">		</div>		<div class="input_option">			<label class="label-block">Small text color </label>			<input type="text" id="login_screen_smalltext_color" name="login_screen_smalltext_color" class="color_field live_style" value="<?php echo $mayo_login_screen_option['login_screen_smalltext_color']; ?>">		</div>				<br>				<div class="input_option">			<label class="label-block">Background color </label>			<input type="text" id="login_screen_bg_color" name="login_screen_bg_color" class="color_field live_style" value="<?php echo $mayo_login_screen_option['login_screen_bg_color']; ?>"/>		</div>				<div class="input_option">			<label class="label-block">Background image </label>			<input type="text" id="login_screen_bg_image" name="login_screen_bg_image" value="<?php echo $mayo_login_screen_option['login_screen_bg_image']; ?>"><span class="remove">&times;</span><input title="Select website logo" type="button" class="button open_media_button" data-media_type="image" data-target="#login_screen_bg_image" value="Browse" />		</div>		<div class="input_option">			<label class="label-block">Background image size </label>			<select id="login_screen_bg_size" name="login_screen_bg_size" class="live_style">				<option value="auto" <?php selected($mayo_login_screen_option['login_screen_bg_size'], 'auto'); ?>>Original size</option>				<option value="cover" <?php selected($mayo_login_screen_option['login_screen_bg_size'], '100% auto'); ?>>Stretch to match screen size</option>				<option value="100% auto" <?php selected($mayo_login_screen_option['login_screen_bg_size'], 'auto 100%'); ?>>Stretch to match screen width</option>				<option value="auto 100%" <?php selected($mayo_login_screen_option['login_screen_bg_size'], 'cover'); ?>>Stretch to match screen height</option>			</select>		</div>		<div class="input_option">			<label class="label-block">Background image start from </label>			<select id="login_screen_bg_position_y" name="login_screen_bg_position_y" class="live_style">				<option value="center" <?php selected($mayo_login_screen_option['login_screen_bg_position_y'], 'center'); ?>>Center</option>				<option value="top" <?php selected($mayo_login_screen_option['login_screen_bg_position_y'], 'top'); ?>>Top</option>				<option value="bottom" <?php selected($mayo_login_screen_option['login_screen_bg_position_y'], 'bottom'); ?>>Bottom</option>			</select>			<select id="login_screen_bg_position_x" name="login_screen_bg_position_x" class="live_style">				<option value="center" <?php selected($mayo_login_screen_option['login_screen_bg_position_x'], 'center'); ?>>Center</option>				<option value="left" <?php selected($mayo_login_screen_option['login_screen_bg_position_x'], 'left'); ?>>Left</option>				<option value="right" <?php selected($mayo_login_screen_option['login_screen_bg_position_x'], 'right'); ?>>Rgiht</option>			</select>		</div>		<div class="input_option">			<label class="label-block">Background image repeat </label>			<select id="login_screen_bg_repeat" name="login_screen_bg_repeat" class="live_style">				<option value="no-repeat" <?php selected($mayo_login_screen_option['login_screen_bg_repeat'], 'no-repeat'); ?>>No repeat</option>				<option value="repeat" <?php selected($mayo_login_screen_option['login_screen_bg_repeat'], 'repeat'); ?>>Repeat</option>				<option value="repeat-x" <?php selected($mayo_login_screen_option['login_screen_bg_repeat'], 'repeat-x'); ?>>Repeat Horizontally</option>				<option value="repeat-y" <?php selected($mayo_login_screen_option['login_screen_bg_repeat'], 'repeat-y'); ?>>Repeat Vertically</option>			</select>		</div>				<br>				<input type="hidden" id="login_screen_form_button_border_color" name="login_screen_form_button_border_color" class="live_style">		<input type="hidden" id="login_screen_form_button_text_color" name="login_screen_form_button_text_color" class="live_style">		<input type="hidden" id="login_screen_label_text_color" name="login_screen_label_text_color" class="live_style">				<input type="hidden" id="login_screen_css" name="login_screen_css">				<?php wp_nonce_field( 'mayo_login_screen_setting' ); ?>				<div class="label-block">			<input type="submit" id="mayo_login_screen_reset" name="mayo_login_screen_reset" class="btn-muted warning" value="Reset"> 			<small class="text-muted">|</small> 			<input type="submit" id="mayo_login_screen_export" name="mayo_login_screen_export" value="Export" class="btn-muted"> 			<small class="text-muted">|</small> 			<input type="file" id="mayo_login_screen_import_file" name="mayo_login_screen_import_file" class="hide">			<input type="submit" id="mayo_login_screen_import" name="mayo_login_screen_import" value="Import" class="btn-muted">		</div>		<input type="submit" id="mayo_login_screen_submit" name="mayo_login_screen_submit" class="button button-primary button-submit button-large" value="Save Changes">			</form>	<br>	<hr>	<!-- The Preview -->	<h3>Preview</h3>		<div id="login_screen_preview">		<div class="login login-action- wp-core-ui">			<div id="login">			<h1><a href="" title="Back to Passion In Design"><?php echo get_bloginfo('name'); ?></a></h1>						<form name="loginform" id="loginform">					<p>						<label for="user_login">Username<br />						<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>					</p>					<p>						<label for="user_pass">Password<br />						<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>					</p>						<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> Remember Me</label></p>					<p class="submit">						<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" />					</p>				</form>				<p id="nav">				<a rel="nofollow" href=" ">Register</a> | 	<a href="" title="Password Lost and Found">Lost your password?</a>				</p>				<p id="backtoblog"><a href="" title="Are you lost?">&larr; Back to Your Website</a></p>					</div>			<div class="clear"></div>		</div>		<style id="mayo_login_screen_live_style">			<?php echo stripslashes($mayo_login_screen_option['login_screen_css']); ?>		</style>		<div id="mayo_login_screen_live_style_template">.login { background-color: %%login_screen_bg_color%%; background-repeat: %%login_screen_bg_repeat%%; background-position: %%login_screen_bg_position_y%% %%login_screen_bg_position_x%%; background-size: %%login_screen_bg_size%%; }.login #login h1 a { background: transparent; text-indent: 0; color: %%login_screen_h1_color%%;line-height: 1.3em;margin: 0px auto 25px;padding: 0px;text-decoration: none;outline: 0px none;overflow: hidden;display: block;width: auto;height: auto;font-weight: bold;text-indent: 0px;background: none repeat scroll 0% 0% transparent;font-size: 28px;}.login #login h1 a:hover { color: %%login_screen_h1_color%%; }#loginform { background-color: %%login_screen_form_bg_color%%; }#loginform #wp-submit { background-color: %%login_screen_form_button_bg_color%%; border-color: %%login_screen_form_button_border_color%%; color: %%login_screen_form_button_text_color%%; box-shadow: inset 0 1px 0 rgba(255,255,255,.25),0 1px 0 rgba(0,0,0,.15); }#loginform label { color: %%login_screen_label_text_color%%; }.login #login #backtoblog a, .login #login #nav a { color: %%login_screen_smalltext_color%%; }		</div>	</div></div>