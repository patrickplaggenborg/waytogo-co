<?php do_action( 'galatia_edge_action_before_footer_content' ); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="edgtf-page-footer <?php echo esc_attr($holder_classes); ?>">
                <div class="edgtf-footer-inner">
                    <?php
                        if($display_footer_top) {
                            galatia_edge_get_footer_top();
                        }
                        if($display_footer_bottom) {
                            galatia_edge_get_footer_bottom();
                        }
                    ?>
                </div>
			</footer>
		<?php } ?>
	</div> <!-- close div.edgtf-wrapper-inner  -->
</div> <!-- close div.edgtf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>