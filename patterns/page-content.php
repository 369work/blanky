<?php
/**
 * Title: Page Content
 * Slug: blanky/page-content
 * Categories: blanky_patterns
 * Inserter: no
 *
 * @package blanky
 * @since 1.4
 */
?>
<!-- wp:group {"tagName":"article","className":"alignwide blanky-single-article","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<article class="wp-block-group alignwide blanky-single-article">

    <!-- wp:post-title {"level":1,"style":{"typography":{"fontWeight":"700","lineHeight":"1.2"}},"fontSize":"5xl"} /-->

    <!-- wp:spacer {"height":"var:preset|spacing|60"} -->
    <div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-featured-image {"align":"wide","aspectRatio":"16/9","className":"blanky-monotone"} /-->

    <!-- wp:spacer {"height":"var:preset|spacing|60"} -->
    <div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-content {"className":"blanky-post-content","layout":{"type":"constrained"}} /-->

</article>
<!-- /wp:group -->
