<?php

$info_content = get_post_meta(get_the_ID(), 'edgtf_portfolio_single_info_content', true);

if( !empty($info_content) ){ ?>

    <div class="edgtf-ps-info-item edgtf-ps-info-content-item">
        <?php echo do_shortcode($info_content); ?>
    </div>

<?php } ?>