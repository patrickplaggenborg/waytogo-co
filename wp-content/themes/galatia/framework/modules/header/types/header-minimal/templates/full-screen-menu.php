<div class="edgtf-fullscreen-menu-holder-outer">
	<div class="edgtf-fullscreen-menu-holder">
        <?php $fullscreen_menu_icon_class = galatia_edge_get_fullscreen_menu_icon_class(); ?>
        <a href="javascript:void(0)" <?php galatia_edge_class_attribute( $fullscreen_menu_icon_class ); ?>>
            <span class="edgtf-fullscreen-menu-close-icon">
                <?php echo galatia_edge_get_icon_sources_html( 'fullscreen_menu', true ); ?>
            </span>
            <span class="edgtf-fullscreen-menu-opener-icon">
                <?php echo galatia_edge_get_icon_sources_html( 'fullscreen_menu' ); ?>
            </span>
        </a>
		<div class="edgtf-fullscreen-menu-holder-inner">
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="edgtf-container-inner">
			<?php endif; ?>

			<div class="edgtf-fullscreen-above-menu-widget-holder">
				<?php galatia_edge_get_header_widget_area_one(); ?>
			</div>
			
			<?php 
			//Navigation
			galatia_edge_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal');;

			?>

			<div class="edgtf-fullscreen-below-menu-widget-holder">
				<?php galatia_edge_get_header_widget_area_two(); ?>
			</div>
			
			<?php if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>