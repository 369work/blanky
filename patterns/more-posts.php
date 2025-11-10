<?php

/**
 * Title: More posts
 * Slug: blanky/more-posts
 * Categories: blanky_patterns
 */
?>
<!-- wp:group {"layout":{"type":"constrained","wideSize":"","contentSize":"100%"}} -->
<div class="wp-block-group">
    <!-- wp:spacer {"height":"50px"} -->
    <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
    <!-- wp:heading {"fontSize":"2x-large"} -->
    <h2 class="wp-block-heading has-2-x-large-font-size"><?php esc_html_e('More Posts', 'blanky'); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:spacer {"height":"50px"} -->
    <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:query {"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"metadata":{"categories":["posts"],"patternName":"core/query-grid-posts","name":"グリッド"},"layout":{"type":"constrained","contentSize":"100%"}} -->
    <div class="wp-block-query">
        <!-- wp:post-template {"style":{"spacing":{"blockGap":"1.5rem"}},"layout":{"type":"grid","columnCount":3}} -->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"30px","right":"30px","bottom":"30px","left":"30px"},"blockGap":"1.5rem"},"border":{"width":"1px","color":"#cbd5e1","radius":"0.5rem"},"dimensions":{"minHeight":"240px"}},"backgroundColor":"white","layout":{"inherit":false}} -->
        <div class="wp-block-group has-border-color has-white-background-color has-background" style="border-color:#cbd5e1;border-width:1px;border-radius:0.5rem;min-height:240px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
            <!-- wp:post-title {"isLink":true,"fontSize":"2x-large"} /-->
            <!-- wp:spacer {"height":"1rem"} -->
            <div style="height:1rem;" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->
            <!-- wp:post-excerpt {"style":{"typography":{"fontSize":"1rem"}}} /-->
            <!-- wp:spacer {"height":"1rem"} -->
            <div style="height:1rem;" aria-hidden="true" class="wp-block-spacer"></div>
            <!-- /wp:spacer -->
            <!-- wp:post-date {"style":{"typography":{"fontSize":"0.9rem"}}} /-->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->

    <!-- wp:spacer {"height":"50px"} -->
    <div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
</div>
<!-- /wp:group -->