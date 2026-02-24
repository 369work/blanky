<?php
/**
 * Title: Front Page Query Loop
 * Slug: blanky/front-page-query
 * Categories: blanky_patterns
 *
 * @package blanky
 * @since 1.3
 */
?>
<!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"constrained"}} -->
<div class="wp-block-query">

    <!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|80"}},"layout":{"type":"default"}} -->

        <!-- wp:group {"className":"blanky-article","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group blanky-article">

            <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","className":"blanky-monotone"} /-->

            <!-- wp:group {"textAlign":"center","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group has-text-align-center">

                <!-- wp:group {"className":"blanky-article-meta","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"textColor":"muted"} -->
                <div class="wp-block-group blanky-article-meta has-muted-color has-text-color">
                    <!-- wp:post-date {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"700"}},"fontSize":"xs"} /-->
                    <!-- wp:post-terms {"term":"category","className":"blanky-article-meta-term","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"700"}},"textColor":"primary","fontSize":"xs"} /-->
                </div>
                <!-- /wp:group -->

                <!-- wp:post-title {"isLink":true,"textAlign":"center","style":{"typography":{"fontWeight":"700","lineHeight":"1.2"}},"fontSize":"4xl"} /-->

                <!-- wp:post-excerpt {"excerptLength":100,"className":"blanky-post-excerpt","textAlign":"center","fontSize":"base"} /-->

                <!-- wp:read-more {"className":"blanky-read-more","fontSize":"xs"} /-->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

    <!-- /wp:post-template -->

    <!-- wp:query-no-results -->
    <!-- wp:paragraph {"textAlign":"center"} -->
    <p class="has-text-align-center"><?php esc_html_e( 'No posts found. Check back soon!', 'blanky' ); ?></p>
    <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->

    <!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
    <!-- wp:query-pagination-previous /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next /-->
    <!-- /wp:query-pagination -->

</div>
<!-- /wp:query -->
