<?php if(galatia_edge_core_plugin_installed()) { ?>
    <div class="edgtf-blog-like">
        <?php if( function_exists('galatia_edge_get_like') ) galatia_edge_get_like(); ?>
    </div>
<?php } ?>