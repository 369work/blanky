<?php
/**
 * Theme functions and definitions
 *
 * @package blanky
 * @since 1.0
 */

defined( 'ABSPATH' ) || exit;

define( 'BLANKY_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Theme setup
 */
function blanky_theme_setup() {
	load_theme_textdomain( 'blanky', get_template_directory() . '/languages' );

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo' );

	// WooCommerce.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'blanky_theme_setup' );

/**
 * Register block pattern categories
 */
function blanky_register_block_patterns() {
	register_block_pattern_category(
		'blanky_patterns',
		array(
			'label'       => __( 'Blanky Patterns', 'blanky' ),
			'description' => __( 'Patterns provided by the Blanky theme.', 'blanky' ),
			'icon'        => 'layout',
		)
	);
}
add_action( 'init', 'blanky_register_block_patterns' );

/**
 * Enqueue theme styles
 */
function blanky_enqueue_scripts() {
	wp_enqueue_style( 'blanky-style', get_stylesheet_uri(), array(), BLANKY_VERSION );
}
add_action( 'wp_enqueue_scripts', 'blanky_enqueue_scripts' );

/**
 * Insert a fallback placeholder when no featured image is set.
 *
 * WordPress core/post-featured-image block returns an empty string
 * if no featured image is set,
 * so CSS :not(:has(img)) cannot handle it. Use the render_block filter
 * to insert alternative HTML.
 *
 * @param string $block_content Rendered HTML.
 * @param array  $parsed_block  Parsed block information.
 * @return string
 */
function blanky_featured_image_fallback( $block_content, $parsed_block ) {
	// Skip blocks other than the target.
	if ( 'core/post-featured-image' !== $parsed_block['blockName'] ) {
		return $block_content;
	}

	// If there is an eye-catcher, return it as is.
	if ( ! empty( $block_content ) ) {
		return $block_content;
	}

	// blanky-monotone.
	$extra_class = '';
	if ( ! empty( $parsed_block['attrs']['className'] ) ) {
		$extra_class = ' ' . esc_attr( $parsed_block['attrs']['className'] );
	}

	$placeholder_label = esc_attr__( 'No featured image', 'blanky' );

	// Image Icon SVG (Accessibility: aria-hidden).
	$svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"'
		. ' stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"'
		. ' aria-hidden="true" focusable="false">'
		. '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>'
		. '<circle cx="8.5" cy="8.5" r="1.5"/>'
		. '<polyline points="21 15 16 10 5 21"/>'
		. '</svg>';

	return sprintf(
		'<figure class="wp-block-post-featured-image blanky-no-thumbnail%1$s" aria-label="%2$s">'
			. '<div class="blanky-thumbnail-placeholder" aria-hidden="true">%3$s</div>'
			. '</figure>',
		$extra_class,
		$placeholder_label,
		$svg
	);
}
add_filter( 'render_block', 'blanky_featured_image_fallback', 10, 2 );


// -----------------------------------------------------------------------
// About page (Appearance > About Blanky)
// -----------------------------------------------------------------------

/**
 * Add the About Blanky page under Appearance.
 *
 * @since 2.2
 */
function blanky_add_about_page() {
	add_theme_page(
		__( 'About Blanky', 'blanky' ),
		__( 'About Blanky', 'blanky' ),
		'edit_theme_options',
		'blanky-about',
		'blanky_render_about_page'
	);
}
add_action( 'admin_menu', 'blanky_add_about_page' );

/**
 * Load the About Blanky page styles on that page only.
 *
 * @since 2.2
 *
 * @param string $hook_suffix The current admin page.
 */
function blanky_enqueue_about_page_styles( $hook_suffix ) {
	if ( 'appearance_page_blanky-about' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style(
		'blanky-admin',
		get_template_directory_uri() . '/assets/css/admin.css',
		array(),
		BLANKY_VERSION
	);
}
add_action( 'admin_enqueue_scripts', 'blanky_enqueue_about_page_styles' );

/**
 * Render the About Blanky page.
 *
 * @since 2.2
 */
function blanky_render_about_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	$new_tab = '<span class="screen-reader-text">' . esc_html__( '(opens in a new tab)', 'blanky' ) . '</span>';

	// 369Theme pages are in Japanese by default. Other languages get the English version.
	$theme_page_url = 'https://369theme.com/themes/blanky';
	$contact_url    = 'https://369theme.com/contact?product=blanky';
	$site_url       = 'https://369theme.com/';
	if ( 0 !== strpos( get_user_locale(), 'ja' ) ) {
		$theme_page_url = add_query_arg( 'lang', 'en', $theme_page_url );
		$contact_url    = add_query_arg( 'lang', 'en', $contact_url );
		$site_url       = add_query_arg( 'lang', 'en', $site_url );
	}
	?>
	<div class="wrap blanky-about">
		<h1><?php esc_html_e( 'About Blanky', 'blanky' ); ?></h1>
		<p class="blanky-about__lead"><?php esc_html_e( 'Blanky is a minimal, clean block theme — a simple blank canvas ready to make your own. You can edit the templates, patterns and styles from the Site Editor.', 'blanky' ); ?></p>

		<div class="card">
			<h2 class="title"><?php esc_html_e( 'Get Started', 'blanky' ); ?></h2>
			<p><?php esc_html_e( 'Open the Site Editor to change the templates, header, footer and colors.', 'blanky' ); ?></p>
			<p>
				<a class="button button-primary" href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>">
					<?php esc_html_e( 'Open the Site Editor', 'blanky' ); ?>
				</a>
			</p>
		</div>

		<div class="card">
			<h2 class="title"><?php esc_html_e( 'Theme Page', 'blanky' ); ?></h2>
			<p><?php esc_html_e( 'Learn more about Blanky on its page at 369Theme.', 'blanky' ); ?></p>
			<p>
				<a class="button" href="<?php echo esc_url( $theme_page_url ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Visit the Theme Page', 'blanky' ); ?>
					<?php echo $new_tab; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>
				</a>
			</p>
		</div>

		<div class="card">
			<h2 class="title"><?php esc_html_e( 'Review the Blanky Theme', 'blanky' ); ?></h2>
			<p><?php esc_html_e( 'Thank you for using the Blanky theme! We would love to hear your feedback. Please take a moment to leave a review.', 'blanky' ); ?></p>
			<p>
				<a class="button" href="https://wordpress.org/support/theme/blanky/reviews/" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Leave a Review', 'blanky' ); ?>
					<?php echo $new_tab; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>
				</a>
			</p>
		</div>

		<div class="card">
			<h2 class="title"><?php esc_html_e( 'Theme Support', 'blanky' ); ?></h2>
			<p><?php esc_html_e( 'Free support for the Blanky theme is provided on the WordPress.org support forum.', 'blanky' ); ?></p>
			<p>
				<a class="button" href="https://wordpress.org/support/theme/blanky/" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Support Forum', 'blanky' ); ?>
					<?php echo $new_tab; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>
				</a>
			</p>
			<p><?php esc_html_e( 'Paid customization and paid email support are also available. For details, please contact 369Theme.', 'blanky' ); ?></p>
			<p class="blanky-about__links">
				<a class="button" href="<?php echo esc_url( $contact_url ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Contact 369Theme', 'blanky' ); ?>
					<?php echo $new_tab; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>
				</a>
			</p>
		</div>

		<div class="card">
			<h2 class="title"><?php esc_html_e( 'Premium Themes', 'blanky' ); ?></h2>
			<p><?php esc_html_e( 'Premium themes built on the Blanky foundation are available from 369Theme.', 'blanky' ); ?></p>
			<ul class="blanky-about__list">
				<li>Blanky Beauty</li>
				<li>Blanky Link</li>
				<li>Blanky Nordic</li>
				<li>Blanky Studio</li>
				<li>Blanky Work</li>
			</ul>
			<p>
				<a class="button" href="<?php echo esc_url( $site_url ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Learn more at 369Theme', 'blanky' ); ?>
					<?php echo $new_tab; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?>
				</a>
			</p>
		</div>
	</div>
	<?php
}
