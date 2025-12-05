<?php

$post_link = get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-info-top">
                    <div class="edgtf-quote-label">
                        <h6><?php echo esc_html__('Link', 'galatia') ?></h6>
                    </div>
                </div>
                <div class="edgtf-post-text-main">
                    <?php galatia_edge_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
            <?php if(isset($post_link) && $post_link != '') { ?>
                <a class="edgtf-post-link-overlay" itemprop="url" href="<?php echo esc_url($post_link); ?>" title="<?php the_title_attribute(); ?>" target="_blank">
            <?php } ?>

            <?php if(isset($post_link) && $post_link != '') { ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="edgtf-post-additional-content">
        <div class="edgtf-post-additional-top">
            <div class="edgtf-post-info-top">
                <?php galatia_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                <?php galatia_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                <?php galatia_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
            </div>
        </div>
        <div class="edgtf-post-text-content">
            <?php the_content(); ?>
            <div class="edgtf-post-additional-bottom">
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
        </div>
    </div>
</article>