<?php
$item_id = $is_featured ? $featured_project : get_the_ID();
$thumb_size = $this_object->getImageSize($params);
?>
<div class="edgtf-hspli-image">
	<?php if ( has_post_thumbnail( $item_id ) || ! empty(get_post_meta(get_the_ID(), 'edgtf_portfolio_featured_image_for_lists_meta', true)) ) {
        $is_feat_image_changed = false;
        $image_src = get_the_post_thumbnail_url( get_the_ID() );
        $image_for_list_src = esc_url( get_post_meta(get_the_ID(), 'edgtf_portfolio_featured_image_for_lists_meta', true) );

        if(!empty($image_for_list_src)){
            $image_src = $image_for_list_src;
            $is_feat_image_changed = true;
        }
		
		if ( strpos( $image_src, '.gif' ) !== false ) {
			echo get_the_post_thumbnail( $item_id, 'full' );
		} else {
			?>

            <div class="edgtf-hspli-image-holder" style="background-image: url(<?php echo esc_attr($image_src)?>)">

            </div>

            <?php
		}
	} else { ?>
		<img itemprop="image" class="edgtf-hspli-original-image" width="800" height="600" src="<?php echo GALATIA_CORE_CPT_URL_PATH.'/portfolio/assets/img/portfolio_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Portfolio Featured Image', 'galatia-core'); ?>" />
	<?php } ?>
</div>