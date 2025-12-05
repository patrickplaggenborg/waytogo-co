<?php $part_params['show_same_image'] = true; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-heading">
            <?php galatia_edge_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-info-top">
                    <?php galatia_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php galatia_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php
                    if(galatia_edge_options()->getOptionValue('show_tags_area_blog') === 'yes') {
                            galatia_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params);
                    } ?>
                    <?php galatia_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                </div>
                <div class="edgtf-post-text-main">
                    <?php galatia_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <div class="edgtf-post-text-content">
                        <?php galatia_edge_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                        <?php do_action('galatia_edge_action_single_link_pages'); ?>
                        <?php galatia_edge_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>