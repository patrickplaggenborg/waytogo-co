<?php
    $holder_classes = galatia_edge_get_side_area_background_styles();
?>
<section class="edgtf-side-menu" <?php echo galatia_edge_get_inline_style($holder_classes); ?>>
	<a <?php galatia_edge_class_attribute( $close_icon_classes ); ?> href="#">
		<?php echo galatia_edge_get_icon_sources_html( 'side_area', true ); ?>
	</a>
	<?php if ( is_active_sidebar( 'sidearea' ) ) {
		dynamic_sidebar( 'sidearea' );
	} ?>
</section>