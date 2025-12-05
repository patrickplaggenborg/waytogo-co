<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-heading">
            <?php galatia_edge_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-info-top">
                    <?php galatia_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php galatia_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                    <?php galatia_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
                </div>
                <div class="edgtf-post-text-main">
                    <?php galatia_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <div class="edgtf-post-text-content">

                        <?php the_content(); ?>

                        <div class="edgtf-post-info-bottom clearfix">
                            <div class="edgtf-post-info-bottom-left">
                                <?php galatia_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                                <?php galatia_edge_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
                                <?php galatia_edge_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
                            </div>
                            <div class="edgtf-post-info-bottom-right">
                                <?php galatia_edge_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                            </div>
                        </div>

                    </div>
                    <?php do_action('galatia_edge_action_single_link_pages'); ?>
                </div>
            </div>
        </div>
    </div>
</article>