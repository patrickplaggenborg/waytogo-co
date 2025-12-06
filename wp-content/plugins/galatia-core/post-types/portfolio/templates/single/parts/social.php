<?php if ( galatia_edge_options()->getOptionValue( 'enable_social_share' ) == 'yes' && galatia_edge_options()->getOptionValue( 'enable_social_share_on_portfolio_item' ) == 'yes' ) : ?>
	<div class="edgtf-ps-info-item edgtf-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo galatia_edge_get_social_share_html( array( 'type'  => 'list', 'icon_type' => 'ion-icons', 'title' => esc_attr__( 'Share', 'galatia-core' ) ) ); ?>
	</div>
<?php endif; ?>