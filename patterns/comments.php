<?php
/**
 * Title: Comments
 * Slug: blanky/comments
 * Categories: blanky_patterns
 *
 * @package blanky
 * @since 1.4
 */
?>
<!-- wp:comments {"className":"blanky-comments"} -->
<div class="wp-block-comments blanky-comments">

    <!-- wp:heading {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"fontSize":"3xl"} -->
    <h2 class="wp-block-heading has-3-xl-font-size"><?php esc_html_e( 'Comments', 'blanky' ); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:comments-title {"level":3,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|60"}}},"fontSize":"sm","textColor":"muted"} /-->

    <!-- wp:comment-template {"className":"blanky-comment-list"} -->

        <!-- wp:group {"className":"blanky-comment","style":{"spacing":{"blockGap":"var:preset|spacing|40"},"border":{"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group blanky-comment">

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
            <div class="wp-block-group">

                <!-- wp:avatar {"size":48,"className":"blanky-comment-avatar"} /-->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group">

                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
                    <div class="wp-block-group">
                        <!-- wp:comment-author-name {"style":{"typography":{"fontWeight":"700"}},"fontSize":"sm"} /-->
                        <!-- wp:comment-date {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.05em"}},"textColor":"muted","fontSize":"xs"} /-->
                    </div>
                    <!-- /wp:group -->

                    <!-- wp:comment-content {"fontSize":"sm"} /-->

                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"className":"blanky-comment-actions"} -->
                    <div class="wp-block-group blanky-comment-actions">
                        <!-- wp:comment-reply-link {"fontSize":"xs"} /-->
                        <!-- wp:comment-edit-link {"fontSize":"xs"} /-->
                    </div>
                    <!-- /wp:group -->

                </div>
                <!-- /wp:group -->

            </div>
            <!-- /wp:group -->

        </div>
        <!-- /wp:group -->

    <!-- /wp:comment-template -->

    <!-- wp:comments-pagination {"layout":{"type":"flex","justifyContent":"space-between"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
    <!-- wp:comments-pagination-previous /-->
    <!-- wp:comments-pagination-next /-->
    <!-- /wp:comments-pagination -->

    <!-- wp:post-comments-form {"className":"blanky-comment-form"} /-->

</div>
<!-- /wp:comments -->
