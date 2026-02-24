<?php
/**
 * Title: Footer
 * Slug: blanky/footer
 * Categories: blanky_patterns
 * Inserter: no
 *
 * @package blanky
 * @since 1.0
 */
?>
<!-- wp:group {"className":"blanky-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group blanky-footer">

	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
	<div class="wp-block-group">

		<!-- wp:group {"className":"blanky-footer-copyright","layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"},"style":{"spacing":{"blockGap":"0.375rem"}}} -->
		<div class="wp-block-group blanky-footer-copyright">

			<!-- wp:paragraph {"fontSize":"xs"} -->
			<p class="has-xs-font-size">&copy; <?php echo gmdate( 'Y' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:site-title {"level":0,"isLink":false,"fontSize":"xs"} /-->

			<!-- wp:paragraph {"fontSize":"xs"} -->
			<p class="has-xs-font-size"><?php esc_html_e( 'All rights reserved.', 'blanky' ); ?></p>
			<!-- /wp:paragraph -->

		</div>
		<!-- /wp:group -->

		<!-- wp:social-links {"size":"has-normal-icon-size","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"className":"blanky-social-links is-style-logos-only"} -->
		<ul class="wp-block-social-links blanky-social-links has-normal-icon-size is-style-logos-only">
			<!-- wp:social-link {"url":"#","service":"x","label":"X"} /-->
			<!-- wp:social-link {"url":"#","service":"instagram","label":"Instagram"} /-->
			<!-- wp:social-link {"url":"#","service":"facebook","label":"Facebook"} /-->
		</ul>
		<!-- /wp:social-links -->

	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
