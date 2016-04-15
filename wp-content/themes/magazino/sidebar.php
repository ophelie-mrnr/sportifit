<?php
/**
 * The Sidebar containing the main widget areas.
 */
?>
		<div class="clearfix"></div>
		<div id="sidebar" class="widget-area clearfix" role="complementary">

			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="categories" class="widget">
					<div class="widget-title"><?php _e( 'Categories', 'magazino' ); ?></div>
					<ul>
						<?php wp_list_categories( array( 
							'title_li' => '',
							'hierarchical' => 0
						) ); ?>
					</ul>
				</aside>
                
                <aside id="recent-posts" class="widget">
					<div class="widget-title"><?php _e( 'Recent Posts', 'magazino' ); ?></div>
					<ul>
						<?php
							$args = array( 'numberposts' => '10' );
							$recent_posts = wp_get_recent_posts( $args );
							
							foreach( $recent_posts as $recent ){
								if ($recent["post_title"] == '') {
									 $recent["post_title"] = __('View Post', 'magazino');
								}
								echo '<li><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' . $recent["post_title"] .'</a> </li> ';
							}
						?>
                    </ul>
				</aside>
                
                <aside id="popular-posts" class="widget">
					<div class="widget-title"><?php _e( 'Popular Posts', 'magazino' ); ?></div>
					<ul>
						<?php $pc = new WP_Query( array(
							'orderby' => 'comment_count',
							'posts_per_page' => 10,
							'ignore_sticky_posts' => 1
						) ); ?>
						 
						<?php while ($pc->have_posts()) : $pc->the_post(); ?>
                        
                        <li>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php if(the_title( '', '', false ) !='') the_title(); else _e( 'View Post', 'magazino' ); ?></a>
                        </li>
 
						<?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                    </ul>
				</aside>
                
                <aside id="archives" class="widget">
					<div class="widget-title"><?php _e( 'Archives', 'magazino' ); ?></div>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #sidebar .widget-area -->
