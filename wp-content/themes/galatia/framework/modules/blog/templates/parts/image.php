 <?php
$image_size          = isset( $image_size ) ? $image_size : 'full';
$image_meta          = get_post_meta( get_the_ID(), 'edgtf_blog_list_featured_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
if(isset($show_same_image) && $show_same_image === true){
    $blog_list_image_id = '';
} else{
    $blog_list_image_id  = ! empty( $image_meta ) && galatia_edge_blog_item_has_link() ? galatia_edge_get_attachment_id_from_url( $image_meta ) : '';
}
?>

<?php if ( $has_featured ) { ?>
	<div class="edgtf-post-image">
		<?php if ( galatia_edge_blog_item_has_link() ) { ?>
			<a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php } ?>
			<?php if ( ! empty( $blog_list_image_id ) ) {
				echo wp_get_attachment_image( $blog_list_image_id, $image_size );
			} else {
				the_post_thumbnail( $image_size );
			} ?>
		<?php if ( galatia_edge_blog_item_has_link() ) { ?>
			</a>
		<?php } ?>
        
		<?php do_action('galatia_edge_action_blog_inside_image_tag')?>
	</div>
<?php } ?>