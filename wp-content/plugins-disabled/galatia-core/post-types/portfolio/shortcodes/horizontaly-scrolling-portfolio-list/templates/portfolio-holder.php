<div class="edgtf-horizontaly-scrolling-portfolio-holder-outer">
    <div class="edgtf-horizontaly-scrolling-portfolio-holder <?php echo esc_attr($holder_classes); ?>">
        <?php
        if(!empty($custom_project) && $custom_project == 'yes'){
            echo galatia_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'custom-project', '', $params);
        }
        ?>
        <div class="edgtf-hspl-inner">
            <?php
                if($query_results->have_posts()):
                    while ( $query_results->have_posts() ) : $query_results->the_post();
                        $params['is_featured'] = false;
                        echo galatia_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'portfolio-item', '', $params);
                    endwhile;
                else:
                    echo galatia_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/posts-not-found');
                endif;

                wp_reset_postdata();
            ?>
        </div>
    </div>
</div>