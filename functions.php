<?php
/*
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

	// WooCommerce
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
	// Skip blocks other than the target
	if ( 'core/post-featured-image' !== $parsed_block['blockName'] ) {
		return $block_content;
	}

	// If there is an eye-catcher, return it as is
	if ( ! empty( $block_content ) ) {
		return $block_content;
	}

	// blanky-monotone
	$extra_class = '';
	if ( ! empty( $parsed_block['attrs']['className'] ) ) {
		$extra_class = ' ' . esc_attr( $parsed_block['attrs']['className'] );
	}

	$placeholder_label = esc_attr__( 'No featured image', 'blanky' );

	// Image Icon SVG (Accessibility: aria-hidden)
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
