<div class="edgtf-social-share-holder edgtf-text">
	<?php if ( ! empty( $title ) ) { ?>
		<h6 class="edgtf-social-title"><?php echo esc_html( $title ); ?></h6>
	<?php } ?>
	<ul>
		<?php foreach ( $networks as $net ) {
			echo wp_kses( $net, array(
				'li'   => array(
					'class' => true
				),
				'a'    => array(
					'itemprop' => true,
					'class'    => true,
					'href'     => true,
					'target'   => true,
					'onclick'  => true
				),
				'span' => array(
					'class' => true
				)
			) );
		} ?>
	</ul>
</div>