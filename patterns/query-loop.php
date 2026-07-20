<?php
/**
 * Title: Query Loop
 * Slug: blanky/query-loop
 * Categories: blanky_patterns
 *
 * @package blanky
 * @since 1.0
 */

?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]},"layout":{"type":"constrained"}} -->
<div class="wp-block-query">

	<!-- wp:post-template {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->

	<!-- wp:group {"className":"blanky-list-item","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|30"},"border":{"bottom":{"color":"var:preset|color|border","width":"1px","style":"solid"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group blanky-list-item">

		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"textColor":"muted"} -->
		<div class="wp-block-group has-muted-color has-text-color">
			<!-- wp:post-date {"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"700"}},"fontSize":"xs"} /-->
			<!-- wp:post-terms {"term":"category","className":"blanky-article-meta-term","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"700"}},"textColor":"primary","fontSize":"xs"} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:post-title {"isLink":true,"style":{"typography":{"fontWeight":"700","lineHeight":"1.3"}},"fontSize":"2xl"} /-->

		<!-- wp:post-excerpt {"excerptLength":80,"className":"blanky-list-excerpt","fontSize":"sm"} /-->

	</div>
	<!-- /wp:group -->

	<!-- /wp:post-template -->

	<!-- wp:query-no-results -->
	<!-- wp:paragraph -->
	<p><?php esc_html_e( 'Sorry, we could not find anything. Try searching with different keywords.', 'blanky' ); ?></p>
	<!-- /wp:paragraph -->
	<!-- /wp:query-no-results -->

	<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
	<!-- wp:query-pagination-previous /-->
	<!-- wp:query-pagination-numbers /-->
	<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->

</div>
<!-- /wp:query -->