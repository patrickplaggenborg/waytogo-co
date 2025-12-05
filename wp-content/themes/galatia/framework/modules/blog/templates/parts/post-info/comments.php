<?php if(comments_open()) { ?>
	<div class="edgtf-post-info-comments-holder">
		<a itemprop="url" class="edgtf-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0 ' . esc_html__('Comments','galatia'), '1 '.esc_html__('Comment','galatia'), '% '.esc_html__('Comments','galatia') ); ?>
		</a>
	</div>
<?php } ?>