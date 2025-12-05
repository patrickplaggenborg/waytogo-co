<?php $padding = $this_object->getArticlePadding($params); ?>
<article class="edgtf-pl-item edgtf-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>" <?php if(!empty($padding)){ echo galatia_edge_get_inline_style($padding); } ?>>
	<div class="edgtf-pl-item-inner">
        <div class="edgtf-pl-inner-content">
            <?php echo galatia_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>

            <a itemprop="url" class="edgtf-pli-link edgtf-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>"></a>

        </div>
    </div>
</article>