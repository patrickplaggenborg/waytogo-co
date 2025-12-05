<?php
$share_type = isset( $share_type ) ? $share_type : 'list';
?>
<?php if ( galatia_edge_core_plugin_installed() && galatia_edge_options()->getOptionValue( 'enable_social_share' ) === 'yes' && galatia_edge_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="edgtf-blog-share">
		<?php echo galatia_edge_get_social_share_html( array( 'type' => $share_type, 'icon_type' => 'ion-icons' , 'title' => esc_html__('Share', 'galatia') ) ); ?>
	</div>
<?php } ?>