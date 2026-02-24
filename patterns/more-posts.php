<?php
/**
 * Title: More Posts
 * Slug: blanky/more-posts
 * Categories: blanky_patterns
 *
 * @package blanky
 * @since 1.0
 */
?>
<!-- wp:group {"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group">

    <!-- wp:heading {"fontSize":"3xl"} -->
    <h2 class="wp-block-heading has-3-xl-font-size"><?php esc_html_e( 'More Posts', 'blanky' ); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:query {"queryId":2,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"layout":{"type":"constrained","contentSize":"100%"}, "className":"blanky-more-posts"} -->
    <div class="wp-block-query blanky-more-posts">

        <!-- wp:post-template {"style":{"spacing":{"blockGap":"1.5rem"}},"layout":{"type":"grid","columnCount":3}} -->
        <!-- wp:group {"backgroundColor":"surface","layout":{"inherit":false}} -->
        <div class="wp-block-group has-surface-background-color has-background blanky-more-post" >
            <!-- wp:post-title {"isLink":true,"fontSize":"xl"} /-->
            <!-- wp:post-excerpt {"excerptLength":40, "fontSize":"base"} /-->
            <!-- wp:post-date {"fontSize":"sm"} /-->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->

    </div>
    <!-- /wp:query -->

</div>
<!-- /wp:group -->
