<?php if ($enable_title === 'yes') {
	$title_tag = !empty($title_tag) ? $title_tag : 'h4';
	$title_styles = $this_object->getTitleStyles($params);
	?>
	<<?php echo esc_attr($title_tag); ?> itemprop="name" class="edgtf-pli-title entry-title" <?php galatia_edge_inline_style($title_styles); ?>>
        <?php if($advanced_hover == 'yes'){ ?>
            <a itemprop="url" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
        <?php } ?>
		    <?php echo esc_attr(get_the_title()); ?>
        <?php if($advanced_hover == 'yes'){ ?>
            </a>
        <?php } ?>
	</<?php echo esc_attr($title_tag); ?>>
<?php } ?>