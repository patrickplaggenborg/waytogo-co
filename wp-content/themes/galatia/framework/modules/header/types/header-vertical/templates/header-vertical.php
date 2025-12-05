<?php do_action('galatia_edge_action_before_page_header'); ?>

<aside class="edgtf-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
    <div class="edgtf-vertical-area-background"></div>
	<div class="edgtf-vertical-menu-area-inner">
		<?php if(!$hide_logo) {
			galatia_edge_get_logo();
		} ?>
		<?php galatia_edge_get_header_vertical_main_menu(); ?>
		<div class="edgtf-vertical-area-widget-holder">
			<?php galatia_edge_get_header_widget_area_one(); ?>
		</div>
	</div>
</aside>

<?php do_action('galatia_edge_action_after_page_header'); ?>