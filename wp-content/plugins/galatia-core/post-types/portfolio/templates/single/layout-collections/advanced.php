<?php
$id = galatia_edge_get_page_id();
$feat_img_src = get_the_post_thumbnail_url($id, 'full');
$categories   = wp_get_post_terms(get_the_ID(), 'portfolio-category');
$title_area_skin = get_post_meta(get_the_ID(), 'edgtf_portfolio_single_title_skin_meta', true);
$title = get_the_title($id);
$title_line_break_position = get_post_meta(get_the_ID(), 'edgtf_portfolio_single_title_break_words_meta', true);


$title_words_array = explode(' ', $title);
$title_words_array_length = count($title_words_array);

if(!empty($title_line_break_position) && $title_line_break_position > 0 && $title_line_break_position < $title_words_array_length){

    $array1 = array_slice($title_words_array, 0, $title_line_break_position);
    $array2 = array_slice($title_words_array, $title_line_break_position, $title_words_array_length);

    $title1 = implode(' ', $array1);
    $title2 = implode(' ', $array2);

    $title = '<span class="edgtf-ps-advanced-title-fragments">' . $title1 . '</span><span class="edgtf-ps-advanced-title-fragments">' . $title2 . '</span>';

}

?>

<div class="edgtf-ps-single-intro-section edgtf-parallax-row-holder edgtf-ps-intro-<?php echo esc_attr($title_area_skin); ?>" data-parallax-bg-image="<?php echo esc_attr($feat_img_src); ?>" style="background-image: url(<?php echo esc_attr($feat_img_src); ?>);">
    <div class="edgtf-ps-single-intro-section-inner">
        <div class="edgtf-container-inner">
            <div class="edgtf-ps-single-intro-title-holder">
                <?php if(is_array($categories) && count($categories)) { ?>
                    <h6 class="edgtf-ps-single-category-holder">
                        <?php foreach($categories as $cat) { ?>
                            <a itemprop="url" class="edgtf-ps-info-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                        <?php } ?>
                    </h6>
                <?php } ?>
                <div class="edgtf-ps-single-title-holder">
                    <h1 class="edgtf-ps-title"> <?php echo wp_kses($title, array('span' => array(
                            'class' => array()
                        ))); ?> </h1>
                </div>
            </div>
        </div>
        <div class="edgtf-ps-intro-scroll-link">
            <div class="edgtf-ps-intro-scroll-link-trigger">
                <h6 class="edgtf-ps-scroll-text"><?php echo esc_html__('scroll', 'galatia-core')?></h6>
                <span class="edgtf-ps-scroll-shape"></span>
            </div>
        </div>
    </div>

    <div class="edgtf-ps-single-additional-info">
        <div class="edgtf-ps-single-additional-info-inner">
            <div class="edgtf-container-inner">
                <div class="edgtf-ps-single-additional-info-section">
                    <div class="edgtf-grid-row">
                        <div class="edgtf-grid-col-4">
                            <?php galatia_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout); ?>

                            <?php galatia_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout); ?>

                            <?php

                            //get portfolio date section
                            galatia_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);

                            //get portfolio tags section
                            galatia_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);

                            ?>

                            <?php galatia_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout); ?>
                        </div>
                        <div class="edgtf-grid-col-8">
                            <?php galatia_core_get_cpt_single_module_template_part('templates/single/parts/info-content', 'portfolio', $item_layout); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="edgtf-ps-single-main-content">
    <div class="edgtf-ps-single-content">
        <?php galatia_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
    </div>

    <div class="edgtf-ps-image-holder">
        <div class="edgtf-ps-image-inner">
            <?php
            $media = galatia_core_get_portfolio_single_media();

            if(is_array($media) && count($media)) : ?>
                <?php foreach($media as $single_media) : ?>
                    <div class="edgtf-ps-image">
                        <?php galatia_core_get_portfolio_single_media_html($single_media); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div>