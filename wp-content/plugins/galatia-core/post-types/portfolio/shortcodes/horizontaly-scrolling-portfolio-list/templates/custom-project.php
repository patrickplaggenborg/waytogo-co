<div class="edgtf-hspl-custom-item edgtf-hspl-custom">
	<div class="edgtf-hspl-item-inner">
        <div class="edgtf-hspl-item-holder-inner" <?php galatia_edge_inline_style($custom_element_style); ?>>
            <div class="edgtf-hspl-custom-content">
                <?php
                if(!empty($custom_project_subtitle)){
                    ?>
                        <div class="edgtf-hspli-item-subtitle">
                            <h6 class="edgtf-hspli-item-subtitle-text"><?php echo esc_html($custom_project_subtitle)?></h6>
                        </div>
                    <?php
                }
                ?>

                <?php
                if(!empty($custom_project_title)){
                    ?>
                        <div class="edgtf-hspli-item-title">
                            <h2 class="edgtf-hspli-item-title-text"><?php echo esc_html($custom_project_title)?></h2>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
	</div>
</div>