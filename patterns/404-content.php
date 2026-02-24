<?php
/**
 * Title: 404 Content
 * Slug: blanky/404-content
 * Categories: blanky_patterns
 *
 * @package blanky
 * @since 1.0
 */

$label       = esc_attr__( 'Search', 'blanky' );
$button_text = esc_attr__( 'Search', 'blanky' );
?>

<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Page Not Found', 'blanky' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Sorry, but the page you were looking for could not be found.', 'blanky' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo $label; ?>","showLabel":false,"buttonText":"<?php echo $button_text; ?>"} /-->
