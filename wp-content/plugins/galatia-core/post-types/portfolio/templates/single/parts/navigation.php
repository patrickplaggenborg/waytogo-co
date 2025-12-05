<?php if ( galatia_edge_options()->getOptionValue( 'portfolio_single_hide_pagination' ) !== 'yes' ) : ?>
	<?php
	$nav_same_category = galatia_edge_options()->getOptionValue( 'portfolio_single_nav_same_category' ) == 'yes';
	?>
    <div class="edgtf-ps-navigation">
		<?php if ( get_previous_post() !== '' ) : ?>
            <h1 class="edgtf-ps-prev">
				<?php if ( $nav_same_category ) {
					previous_post_link( '%link', '<span class="edgtf-ps-nav-mark edgtf-ps-nav-prev">' . esc_html__( 'Prev', 'galatia' ) . '</span>', true, '', 'portfolio-category' );
				} else {
					previous_post_link( '%link', '<span class="edgtf-ps-nav-mark edgtf-ps-nav-prev">' . esc_html__( 'Prev', 'galatia' ) . '</span>' );
				} ?>
            </h1>
		<?php else: ?>
            <h1 class="edgtf-ps-prev edgtf-ps-nav-inactive">
                <span class="edgtf-ps-nav-mark edgtf-ps-nav-prev"><?php esc_html_e( 'Prev', 'galatia' ); ?></span>
            </h1>
		<?php endif; ?>

        <span class="edgtf-ps-nav-line"></span>

		<?php if ( get_next_post() !== '' ) : ?>
            <h1 class="edgtf-ps-next">
				<?php if ( $nav_same_category ) {
					next_post_link( '%link', '<span class="edgtf-ps-nav-mark edgtf-ps-nav-next">' . esc_html__( 'Next', 'galatia' ) . '</span>', true, '', 'portfolio-category' );
				} else {
					next_post_link( '%link', '<span class="edgtf-ps-nav-mark edgtf-ps-nav-next">' . esc_html__( 'Next', 'galatia' ) . '</span>' );
				} ?>
            </h1>
		<?php else: ?>
            <h1 class="edgtf-ps-next edgtf-ps-nav-inactive">
                <span class="edgtf-ps-nav-mark edgtf-ps-nav-next"><?php esc_html_e( 'Next', 'galatia' ); ?></span>
            </h1>
		<?php endif; ?>
    </div>
<?php endif; ?>