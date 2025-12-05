<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
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
        </div>
        <a class="edgtf-post-link-overlay" itemprop="url" href="<?php echo get_the_permalink(); ?>" title="<?php the_title_attribute(); ?>" target="_blank"></a>
    </div>
</article>