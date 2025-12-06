<?php
$thumb_size = $this_object->getImageSize( $params );
$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
if ( $image_data ) {
	$img_src    = $image_data[0];
	$img_width  = $image_data[1];
	$img_height = $image_data[2];
} else {
	$img_src    = ! empty( $feat_img_src ) ? $feat_img_src : GALATIA_CORE_CPT_URL_PATH . '/portfolio/assets/img/portfolio_featured_image.jpg';
	$img_width  = 800;
	$img_height = 600;
}

?>

<?php if ( has_post_thumbnail() || ! empty( get_post_meta( get_the_ID(), 'edgtf_portfolio_featured_image_for_lists_meta', true ) ) ) {
	$is_feat_image_changed = false;
	$image_src             = get_the_post_thumbnail_url( get_the_ID() );
	$image_for_list_src    = esc_url( get_post_meta( get_the_ID(), 'edgtf_portfolio_featured_image_for_lists_meta', true ) );

	if ( ! empty( $image_for_list_src ) ) {
		$image_src             = $image_for_list_src;
		$image_id              = galatia_edge_get_img_id_by_url( $image_src );
		$image_changed_data    = wp_get_attachment_image_src( $image_id, "full" );
		$img_width             = $image_changed_data[1];
		$img_height            = $image_changed_data[2];
		$is_feat_image_changed = true;

	}

	?>

	<?php if ( $advanced_hover == 'yes' ) { ?>
        <a itemprop="url" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
	<?php } ?>

    <div class="edgtf-pli-image" data-src="<?php echo esc_attr( $image_src ); ?>" data-height="<?php echo esc_attr( $img_height ); ?>" data-width="<?php echo esc_attr( $img_width ); ?>">

		<?php

		if ( strpos( $image_src, '.gif' ) !== false ) {
			if ( $is_feat_image_changed ) {
				echo '<img src="' . $image_src . '" alt="' . esc_attr__( 'Portfolio Gif Image', 'galatia-core' ) . '"/>';
			} else {
				echo get_the_post_thumbnail( get_the_ID(), 'full' );
			}
		} else {
			if ( $is_feat_image_changed ) {
				if ( $thumb_size == 'full' ) {
					?>

                    <img src="<?php echo esc_url( $image_for_list_src ) ?>" alt="<?php esc_attr_e( 'Portfolio Featured Image', 'galatia-core' ); ?>">

					<?php

				} else {
					if ( $thumb_size != 'predefined' ) {
						$thumb_image_size = galatia_edge_get_image_size( $thumb_size );
					} else {
						$thumb_image_size['width']  = '300';
						$thumb_image_size['height'] = '300';
					}
					echo galatia_edge_generate_thumbnail( null, $image_for_list_src, $thumb_image_size['width'], $thumb_image_size['height'] );
				}
			} else {
				if ( $thumb_size != 'predefined' ) {
					echo get_the_post_thumbnail( get_the_ID(), $thumb_size );
				} else {
					$img_src                    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$thumb_image_size['width']  = '300';
					$thumb_image_size['height'] = '300';
					echo galatia_edge_generate_thumbnail( null, $img_src, $thumb_image_size['width'], $thumb_image_size['height'] );
				}
			}
		}

		?>
    </div>
	<?php if ( $advanced_hover == 'yes' ) { ?>
        </a>
	<?php } ?>
	<?php

} else { ?>
    <img itemprop="image" class="edgtf-pl-original-image" width="800" height="600" src="<?php echo GALATIA_CORE_CPT_URL_PATH . '/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e( 'Portfolio Featured Image', 'galatia-core' ); ?>"/>
<?php } ?>

<?php
if ( $item_style == 'masonry-side-text' ) {
	echo galatia_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/title', $item_style, $params );
}
?>