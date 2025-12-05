<?php $i = 0; ?>
<div class="edgtf-frame-slider-holder">
    <div class="edgtf-fs-phone">
        <img src="<?php echo GALATIA_CORE_SHORTCODES_URL_PATH ?>/frame-slider/assets/img/frame-slider.png" alt="<?php esc_attr_e( 'Frame slider phone', 'galatia-core' ); ?>">
    </div>
    <div class="edgtf-fs-slides edgtf-owl-slider" <?php echo galatia_edge_get_inline_attrs( $slider_data ); ?>>
		<?php foreach ( $images as $image ) { ?>
            <div class="edgtf-fs-slide">
				<?php if ( ! empty( $links ) ){ ?>
                <a class="edgtf-ig-link" href="<?php echo esc_url( $links[ $i ++ ] ) ?>" title="<?php echo esc_attr( $image['alt'] ); ?>" target="<?php echo esc_attr( $target ); ?>">
					<?php } ?>
					<?php echo wp_get_attachment_image( $image['image_id'], 'full' ); ?>
					<?php if ( ! empty( $links ) ){ ?>
                </a>
			<?php } ?>
            </div>
		<?php } ?>
    </div>
</div>
