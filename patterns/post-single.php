<?php

/**
 * Title: Single Post
 * Slug: blanky/post-single
 * Categories: blanky_patterns
 */
?>

<!-- wp:group {"tagName":"article","layout":{"type":"constrained"}} -->
<article class="wp-block-group">
    <!-- wp:post-title {"level":1,"align":"wide"} /-->

    <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:post-date {"displayType":"modified"} /-->

        <!-- wp:post-terms {"term":"category"} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"3rem"} -->
    <div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-featured-image {"aspectRatio":"3/2","align":"wide"} /-->

    <!-- wp:spacer {"height":"3rem"} -->
    <div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-content {"align":"wide","layout":{"type":"constrained"}} /-->

    <!-- wp:spacer {"height":"3rem"} -->
    <div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"align":"wide","layout":{"type":"constrained","wideSize":"","contentSize":"100%"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:post-terms {"term":"post_tag","separator":"  ","className":"is-style-post-terms-1"} /-->
        <!-- wp:spacer {"height":"3rem"} -->
        <div style="height:3rem" aria-hidden="true" class="wp-block-spacer"></div>
        <!-- /wp:spacer -->
        <!-- wp:post-author {"style":""} /-->
    </div>
    <!-- /wp:group -->
</article>
<!-- /wp:group -->