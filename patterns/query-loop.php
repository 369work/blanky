<?php

/**
 * Title: Archive Query loop
 * Slug: blanky/archive-query-loop
 * Categories: blanky_patterns
 *
 * @package WordPress
 * @subpackage blanky
 * @since 1.0
 **/
?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"align":"full","layout":{"type":"default"}} -->
<div class="wp-block-query alignfull">
    <!-- wp:post-template {"align":"full","layout":{"type":"default"}} -->
    <!-- wp:group {"align":"full"} -->
    <div class="wp-block-group alignfull" >
        <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/2"} /-->

        <!-- wp:post-title {"isLink":true,"fontSize":"2x-large"} /-->

        <!-- wp:post-content {"align":"full","fontSize":"medium","layout":{"type":"constrained"}} /-->

        <!-- wp:post-date {"isLink":true,"fontSize":"small"} /-->

    </div>
    <!-- /wp:group -->

    <!-- /wp:post-template -->

    <!-- wp:group {"layout":{"type":"constrained"}} -->
    <div class="wp-block-group" >
        <!-- wp:query-no-results -->
        <!-- wp:paragraph -->
        <p><?php esc_html_e('Sorry, we could not find anything. Try searching with different keywords.', 'blanky'); ?></p>
        <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:query-pagination {"paginationArrow":"arrow","align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
        <!-- wp:query-pagination-previous /-->

        <!-- wp:query-pagination-numbers /-->

        <!-- wp:query-pagination-next /-->
        <!-- /wp:query-pagination -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:query -->