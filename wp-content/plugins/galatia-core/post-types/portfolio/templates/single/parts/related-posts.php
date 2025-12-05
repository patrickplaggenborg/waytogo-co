<?php
$show_related_posts = galatia_edge_options()->getOptionValue( 'portfolio_single_related_posts' ) == 'yes' ? true : false;

$post_id       = get_the_ID();
$related_posts = galatia_core_get_portfolio_single_related_posts( $post_id );
?>
<?php if ( $show_related_posts && $related_posts && $related_posts->have_posts() ) { ?>
    <div class="edgtf-ps-related-posts-holder">
        <div class="edgtf-ps-realted-title-holder">
            <h2 class="edgtf-ps-rp-title-first"><?php echo esc_html__( 'Projects that may', 'galatia-core' ) ?></h2>
            <h2 class="edgtf-ps-rp-title-second"><?php echo esc_html__( 'interest you', 'galatia-core' ) ?></h2>
        </div>
        <div class="edgtf-ps-related-posts">
			<?php
			while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                <div class="edgtf-ps-related-post">
					<?php if ( has_post_thumbnail() ) { ?>
                        <div class="edgtf-ps-related-image">
                            <div class="edgtf-ps-related-text">
                                <div class="edgtf-ps-realted-text-table">
                                    <div class="edgtf-ps-realted-text-table-cell">
                                        <h4 itemprop="name" class="edgtf-ps-related-title entry-title">
                                            <a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <a itemprop="url" class="edgtf-related-overlay-link" href="<?php the_permalink(); ?>"></a>
                            <a itemprop="url" href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'galatia_edge_image_square' ); ?>
                            </a>
                        </div>
					<?php } ?>
                </div>
			<?php
			endwhile;

			wp_reset_postdata();
			?>
        </div>
    </div>
<?php } ?>
