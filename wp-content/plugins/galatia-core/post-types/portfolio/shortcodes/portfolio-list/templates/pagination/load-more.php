<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="edgtf-pl-loading">
        <div class="edgtf-pl-loading-text">
            <?php echo esc_html__('Loading...', 'galatia'); ?>
        </div>
	</div>
	<div class="edgtf-pl-load-more-holder">
		<div class="edgtf-pl-load-more" <?php galatia_edge_inline_style($holder_styles); ?>>
			<?php 
				echo galatia_edge_get_button_html(array(
					'link' => 'javascript: void(0)',
					'type' => 'simple',
					'size' => 'large',
					'text' => esc_html__('LOAD MORE', 'galatia-core')
				));
			?>
		</div>
	</div>
<?php }