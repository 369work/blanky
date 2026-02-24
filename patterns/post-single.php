<?php
/**
 * Title: Single Post
 * Slug: blanky/post-single
 * Categories: blanky_patterns
 *
 * @package blanky
 * @since 1.0
 */
?>
<!-- wp:group {"tagName":"article","metadata":{"patternName":"blanky/post-single","name":"Single Post","categories":["blanky_patterns"]},"className":"alignwide blanky-single-article","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<article class="wp-block-group alignwide blanky-single-article">

    <!-- wp:post-terms {"term":"category","className":"blanky-category-badge","fontSize":"xs"} /-->

    <!-- wp:post-title {"level":1, "style":{"typography":{"fontWeight":"700","lineHeight":"1.2"}},"fontSize":"5xl"} /-->

    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"textColor":"muted"} -->
    <div class="wp-block-group has-muted-color has-text-color">
        <!-- wp:post-date {"fontSize":"sm","style":{"typography":{"fontWeight":"600"}}} /-->
        <!-- wp:paragraph {"fontSize":"sm"} --><p class="has-sm-font-size">·</p><!-- /wp:paragraph -->
        <!-- wp:post-author {"showAvatar":false,"fontSize":"sm","style":{"typography":{"fontWeight":"600"}}} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"var:preset|spacing|60"} -->
    <div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-featured-image {"aspectRatio":"16/9","className":"blanky-monotone"} /-->

    <!-- wp:spacer {"height":"var:preset|spacing|60"} -->
    <div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-content {"className":"blanky-post-content","layout":{"type":"constrained"}} /-->

    <!-- wp:spacer {"height":"var:preset|spacing|50"} -->
    <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-terms {"term":"post_tag","separator":"  ","textColor":"muted","fontSize":"sm"} /-->

    <!-- wp:spacer {"height":"var:preset|spacing|60"} -->
    <div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:post-author {"showAvatar":true,"showBio":true} /-->

    <!-- wp:spacer {"height":"var:preset|spacing|60"} -->
    <div style="height:var(--wp--preset--spacing--60)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"style":{"border":{"top":{"color":"#e8e4de","width":"1px","style":"solid"}},"spacing":{"padding":{"top":"var:preset|spacing|60"},"blockGap":"0"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group">
        <!-- wp:post-navigation-link {"type":"previous","label":"<?php esc_attr_e( 'Previous Article', 'blanky' ); ?>","showTitle":true,"className":"blanky-post-nav"} /-->
        <!-- wp:post-navigation-link {"type":"next","label":"<?php esc_attr_e( 'Next Article', 'blanky' ); ?>","showTitle":true,"textAlign":"right","className":"blanky-post-nav"} /-->
    </div>
    <!-- /wp:group -->

</article>
<!-- /wp:group -->
