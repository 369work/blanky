<?php

/**
 * Title: Comments
 * Slug: blanky/comments
 * Categories: blanky_patterns
 */
?>
<!-- wp:comments {"className":"wp-block-comments-query-loop"} -->
<div class="wp-block-comments wp-block-comments-query-loop" >
    <!-- wp:heading  -->
    <h2 class="wp-block-heading"><?php esc_html_e('Comments', 'blanky'); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:comments-title {"level":3} /-->

    <!-- wp:comment-template -->
    <!-- wp:group  -->
    <div class="wp-block-group" >
        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
        <div class="wp-block-group">
            <!-- wp:avatar {"size":50} /-->

            <!-- wp:group -->
            <div class="wp-block-group">
                <!-- wp:comment-date /-->
                <!-- wp:comment-author-name /-->
                <!-- wp:spacer {"height":"1rem"} -->
                <div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:comment-content /-->
                <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group">
                    <!-- wp:comment-edit-link /-->
                    <!-- wp:comment-reply-link /-->
                </div>
                <!-- /wp:group -->
                <!-- wp:spacer {"height":"1rem"} -->
                <div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
    <!-- /wp:comment-template -->

    <!-- wp:comments-pagination {"layout":{"type":"flex","justifyContent":"space-between"}} -->
    <!-- wp:comments-pagination-previous /-->
    <!-- wp:comments-pagination-next /-->
    <!-- /wp:comments-pagination -->

    <!-- wp:post-comments-form /-->
</div>
<!-- /wp:comments -->