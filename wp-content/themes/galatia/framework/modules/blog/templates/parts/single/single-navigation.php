<?php
$blog_single_navigation = galatia_edge_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = galatia_edge_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
	<div class="edgtf-blog-single-navigation">
		<div class="edgtf-blog-single-navigation-inner clearfix">
			<?php
				/* Single navigation section - SETTING PARAMS */
				$post_navigation = array(
					'prev' => array(
						'mark' => galatia_edge_get_svg_left_arrow()
					),
					'next' => array(
						'mark' => galatia_edge_get_svg_right_arrow()
					)
				);
			
				if($blog_navigation_through_same_category){
					if(get_previous_post(true) !== ""){
						$post_navigation['prev']['post'] = get_previous_post(true);
					}
					if(get_next_post(true) !== ""){
						$post_navigation['next']['post'] = get_next_post(true);
					}
				} else {
					if(get_previous_post() !== ""){
						$post_navigation['prev']['post'] = get_previous_post();
					}
					if(get_next_post() !== ""){
						$post_navigation['next']['post'] = get_next_post();
					}
				}

				/* Single navigation section - RENDERING */
				foreach (array('prev', 'next') as $nav_type) {
					if (isset($post_navigation[$nav_type]['post'])) { ?>
						<a itemprop="url" class="edgtf-blog-single-<?php echo esc_attr($nav_type); ?>" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
							<?php /*echo wp_kses($post_navigation[$nav_type]['mark'], array('span' => array('class' => true))); */?>
                            <?php echo galatia_edge_get_formated_output($post_navigation[$nav_type]['mark']); ?>
						</a>
					<?php }
				}
			?>
		</div>
	</div>
<?php } ?>