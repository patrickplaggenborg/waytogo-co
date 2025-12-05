<li class="edgtf-bl-item edgtf-item-space">
	<div class="edgtf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			galatia_edge_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="edgtf-bli-content" <?php if($type == 'boxed' && !empty($box_styles)){ galatia_edge_inline_style($box_styles); } ?>>
            <?php if ($post_info_section == 'yes') { ?>
                <div class="edgtf-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                galatia_edge_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                galatia_edge_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                galatia_edge_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                galatia_edge_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                galatia_edge_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                galatia_edge_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php galatia_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="edgtf-bli-excerpt">
		        <?php galatia_edge_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
                <?php
                if ( $post_info_read_more == 'yes' ) {
                galatia_edge_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params );
                }
                ?>
	        </div>
        </div>
	</div>
</li>