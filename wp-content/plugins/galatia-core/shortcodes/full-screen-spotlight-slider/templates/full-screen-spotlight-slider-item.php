<div class="edgtf-fss-item <?php echo esc_attr( $holder_classes ); ?>" <?php echo galatia_edge_get_inline_attrs( $holder_data ); ?>>
    <div class="edgtf-fsss-image-holder">
        <div class="edgtf-fsss-item-image">
            <a class="fsss-link" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_html( $link_target ); ?>">
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
            </a>
        </div>
    </div>
    <div class="edgtf-fss-item-inner">
		<?php
		$title             = ! empty( $title ) ? $title : '';
		$caption           = ! empty( $caption ) ? $caption : '';
		$title_break_words = ! empty( $title_break_words ) ? $title_break_words : '';
		$title_color       = ! empty( $title_color ) ? $title_color : '';
		$caption_color     = ! empty( $caption_color ) ? $caption_color : '';
		$link              = ! empty( $link ) ? $link : '';
		?>
        <div class="edgtf-fsss-content-holder edgtf-container-inner">
            <div class="edgtf-fsss-content-inner">
                <div class="edgtf-fsss-item-content">
                    <a class="fsss-link" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_html( $link_target ); ?>">
						<?php echo do_shortcode( '[edgtf_section_title 
                                                          text                 = "' . esc_html( $title ) . '"                                                          
                                                          text_break_words     = "' . $title_break_words . '"                                                          
                                                          text_tag              = "h2"  
                                                          target                = "' . esc_html( $link_target ) . '"
                                                          link                  = "' . esc_html( $link ) . '"
                                                          title_color           = "' . esc_html( $title_color ) . '"
                                                          text_color            = "' . esc_html( $caption_color ) . '" 
                                                          title                  = "' . esc_html( $caption ) . '"
                                                          title_tag              = "h6"                                                         
                                                          ]'
						); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="edgtf-fsss-item-bg-placeholder" <?php galatia_edge_inline_style( $holder_styles ); ?>>

    </div>
</div>