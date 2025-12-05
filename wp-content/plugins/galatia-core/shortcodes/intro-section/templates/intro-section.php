<div id="edgtf-intro-section" class="<?php echo esc_attr($holder_classes); ?>">
    <div class="edgtf-is-content-wrapper">
        <div class="edgtf-is-content" <?php galatia_edge_inline_style($styles); ?> >
            <h6 class="edgtf-is-subtitle"><?php echo esc_attr($subtitle) ?></h6>
            <h1 class="edgtf-is-title"><?php echo esc_attr($title) ?></h1>
            <div class="edgtf-is-content-btm">
            <?php if (!empty($text)) { ?>
                <p class="edgtf-is-text"><?php echo esc_attr($text); ?></p>
            <?php } if (!empty($link)) { ?>
                <?php echo galatia_edge_get_button_html(array(
                    'custom_class' => 'edgtf-button-light edgtf-btn-custom-border-hover edgtf-btn-custom-hover-color edgtf-btn-custom-hover-bg',
                    'link' => $link,
                    'target' => $link_target,
                    'text' => $btn_txt,
                    'size' => 'large',
                    'background_color' => '#fff',
                    'color' => '#000'
                )); } ?>
            </div>
        </div>
    </div>
    <div class="edgtf-is-bg-wrapper">
        <?php if (!empty($bg_image)) { ?>
            <div class="edgtf-is-bg-image" style="background-image: url(<?php echo wp_get_attachment_url($bg_image); ?>)"></div>
        <?php } ?>
    </div>
</div>