<div class="edgtf-fullscreen-search-holder">
	<a <?php galatia_edge_class_attribute( $search_close_icon_class ); ?> href="javascript:void(0)">
		<?php echo galatia_edge_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
	</a>
	<div class="edgtf-fullscreen-search-table">
		<div class="edgtf-fullscreen-search-cell">
			<div class="edgtf-fullscreen-search-inner">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="edgtf-fullscreen-search-form" method="get">
					<div class="edgtf-form-holder">
						<div class="edgtf-form-holder-inner">
							<h1 class="edgtf-field-holder">
								<input type="text" placeholder="<?php esc_attr_e( 'Search...', 'galatia' ); ?>" name="s" class="edgtf-search-field" autocomplete="off" required />
							</h1>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>