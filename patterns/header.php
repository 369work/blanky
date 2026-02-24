<?php
/**
 * Title: Header
 * Slug: blanky/header
 * Categories: blanky_patterns
 * Inserter: no
 *
 * @package blanky
 * @since 1.0
 */
?>
<!-- wp:group {"className":"blanky-header","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group blanky-header">

	<!-- wp:group {"layout":{"type":"flex","justifyContent":"center","verticalAlignment":"center","flexWrap":"nowrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
	<div class="wp-block-group">

		<!-- wp:group {"style":{"spacing":{"blockGap":"0px"}}} -->
		<div class="wp-block-group">
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group">
				<!-- wp:site-logo {"width":36,"shouldSyncIcon":false} /-->
				<!-- wp:site-title {"level":0,"textAlign":"center","style":{"typography":{"fontWeight":"800","textTransform":"uppercase","letterSpacing":"0.05em"}},"fontSize":"4xl"} /-->
			</div>
			<!-- /wp:group -->
			<!-- wp:site-tagline {"textAlign":"center","fontSize":"xs"} /-->
		</div>
		<!-- /wp:group -->

	</div>
	<!-- /wp:group -->

	<!-- wp:navigation {"overlayMenu":"mobile","layout":{"type":"flex","justifyContent":"center","flexWrap":"wrap"},"style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.1em","fontWeight":"600"},"spacing":{"blockGap":"var:preset|spacing|60"}},"fontSize":"xs"} /-->

</div>
<!-- /wp:group -->
