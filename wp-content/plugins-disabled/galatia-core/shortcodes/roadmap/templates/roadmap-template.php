<div class="edgtf-roadmap <?php echo esc_attr($holder_classes); ?>">
    <div class="edgtf-roadmap-line">

        <span class="edgtf-rl-arrow-left">
            <i class="edgtf-icon-font-awesome fa fa-angle-left"></i>
        </span>

        <span class="edgtf-rl-arrow-right">
            <i class="edgtf-icon-font-awesome fa fa-angle-right"></i>
        </span>
    </div>
<!--    <div class="edgtf-roadmap-holder">-->
        <?php if (is_array($stage) && count($stage)) { ?>
            <div class="edgtf-roadmap-inner-holder clearfix">
            <?php foreach($stage as $key => $stage_item) {
                $stage_item['number'] = $key;
                $additional = $this_object->getItemAdditional($stage_item);
                $item_classes = $additional['classes'];
                $item_style = $additional['style'];
                ?>
                <div <?php galatia_edge_class_attribute($item_classes);?>>
                    <div class="edgtf-roadmap-item-circle-holder">
                        <div class="edgtf-roadmap-item-before-circle"></div>
                        <div class="edgtf-roadmap-item-circle"></div>
                        <div class="edgtf-roadmap-item-after-circle"></div>
                    </div>
                    <div class="edgtf-roadmap-item-stage-title-holder">
                        <span class="edgtf-ris-title">
                            <?php echo esc_html($stage_item['stage_title'])?>
                        </span>
                    </div>
                    <div class="edgtf-roadmap-item-content-holder" <?php galatia_edge_inline_style($item_style);?>>
                        <h5 class="edgtf-ric-title">
                            <?php echo esc_html($stage_item['info_title'])?>
                        </h5>
                        <div class="edgtf-ric-content">
                            <?php echo esc_html($stage_item['info_text'])?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
<!--    </div>-->
</div>