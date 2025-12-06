<?php
get_header();
galatia_edge_get_title();
do_action( 'galatia_edge_action_before_main_content' ); ?>
<div class="edgtf-container edgtf-default-page-template">
	<?php do_action( 'galatia_edge_action_after_container_open' ); ?>
	<div class="edgtf-container-inner clearfix">
		<?php
			$galatia_taxonomy_id   = get_queried_object_id();
			$galatia_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$galatia_taxonomy      = ! empty( $galatia_taxonomy_id ) ? get_term_by( 'id', $galatia_taxonomy_id, $galatia_taxonomy_type ) : '';
			$galatia_taxonomy_slug = ! empty( $galatia_taxonomy ) ? $galatia_taxonomy->slug : '';
			$galatia_taxonomy_name = ! empty( $galatia_taxonomy ) ? $galatia_taxonomy->taxonomy : '';
			
			galatia_core_get_archive_portfolio_list( $galatia_taxonomy_slug, $galatia_taxonomy_name );
		?>
	</div>
	<?php do_action( 'galatia_edge_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
