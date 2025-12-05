<article class="edgtf-hspl-item <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
    <div class="edgtf-hspl-item-inner">
        <div class="edgtf-hspl-item-holder-inner">
            <?php echo galatia_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/image', '', $params); ?>
            <div class="edgtf-hspl-item-title-holder">
                <?php echo galatia_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/title', '', $params); ?>
            </div>
            <a itemprop="url" class="edgtf-hspli-link" href="<?php echo esc_url( $this_object->getItemLink($params) ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget($params) ); ?>"></a>
        </div>
    </div>
</article>