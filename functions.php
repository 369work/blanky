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

/**
 * Add a Blanky info page under Appearance.
 */
function blanky_add_theme_info_page() {
	add_theme_page(
		__( 'About Blanky', 'blanky' ),
		__( 'About Blanky', 'blanky' ),
		'manage_options',
		'blanky-theme-link',
		'blanky_render_theme_info_page'
	);
}
add_action( 'admin_menu', 'blanky_add_theme_info_page' );

/**
 * Render the Blanky info page.
 */
function blanky_render_theme_info_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$theme_url = 'https://blanky.369theme.com/';

	$features = array(
		array( 'icon' => '◻', 'text' => __( 'CSS reset based on modern best practices', 'blanky' ) ),
		array( 'icon' => '◻', 'text' => __( 'theme.json v3 — spacing scale, fluid typography, base color palette', 'blanky' ) ),
		array( 'icon' => '◻', 'text' => __( 'Essential templates: index, front-page, home, single, page, archive, search, 404', 'blanky' ) ),
		array( 'icon' => '◻', 'text' => __( 'Header and footer template parts', 'blanky' ) ),
		array( 'icon' => '◻', 'text' => __( 'Block patterns for common page sections', 'blanky' ) ),
		array( 'icon' => '◻', 'text' => __( 'WooCommerce support', 'blanky' ) ),
		array( 'icon' => '◻', 'text' => __( 'Translation-ready (POT file included)', 'blanky' ) ),
	);

	$child_themes = array(
		array(
			'name'    => 'Blanky Studio',
			'tagline' => __( 'Monochrome portfolio for creators & photographers', 'blanky' ),
			'items'   => array(
				__( 'Portfolio / project archive layout', 'blanky' ),
				__( 'Custom post type "Works" ready', 'blanky' ),
				__( 'Smooth CSS transitions & hover effects', 'blanky' ),
				__( 'Hero section with full-height cover image', 'blanky' ),
				__( 'About, Contact, and project navigation patterns', 'blanky' ),
				__( 'Dark mode support', 'blanky' ),
			),
		),
		array(
			'name'    => 'Blanky Nordic',
			'tagline' => __( 'Nordic magazine aesthetic with amber gold accents', 'blanky' ),
			'items'   => array(
				__( 'Mosaic grid front page', 'blanky' ),
				__( 'Amber gold (#D4AF37) accent color palette', 'blanky' ),
				__( 'Full-height hero with latest post', 'blanky' ),
				__( '3-column archive card grid', 'blanky' ),
				__( 'Related posts & sticky header patterns', 'blanky' ),
				__( 'Mega menu navigation', 'blanky' ),
			),
		),
	);
	?>
	<style>
		#blanky-about {
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
			color: #1d2327;
		}

		/* ── Hero ── */
		#blanky-about .bk-hero {
			background: #0e0e0e;
			border-radius: 14px;
			padding: 3.5em 3.5em 3em;
			margin-bottom: 3.5em;
			position: relative;
			overflow: hidden;
		}
		#blanky-about .bk-hero::after {
			content: "";
			position: absolute;
			inset: 0;
			background: radial-gradient(ellipse at 90% 0%, rgba(255,255,255,.04) 0%, transparent 60%);
			pointer-events: none;
		}
		#blanky-about .bk-hero-badge {
			display: inline-block;
			font-size: .65em;
			font-weight: 600;
			letter-spacing: .1em;
			text-transform: uppercase;
			color: #888;
			border: 1px solid #333;
			border-radius: 20px;
			padding: .25em .9em;
			margin-bottom: 1.2em;
		}
		#blanky-about .bk-hero h1 {
			color: #fff;
			font-size: 2.6em;
			font-weight: 700;
			letter-spacing: -.03em;
			line-height: 1.1;
			margin: 0 0 .6em;
			padding: 0;
			border: none;
		}
		#blanky-about .bk-hero p {
			color: #9aa0a6;
			font-size: 1em;
			line-height: 1.8;
			margin: 0;
			max-width: 500px;
		}

		/* ── Section label ── */
		#blanky-about .bk-label {
			font-size: .68em;
			font-weight: 700;
			letter-spacing: .14em;
			text-transform: uppercase;
			color: #a0a5aa;
			margin: 0 0 1.5em;
			display: flex;
			align-items: center;
			gap: .6em;
		}
		#blanky-about .bk-label::after {
			content: "";
			flex: 1;
			height: 1px;
			background: #ebebeb;
		}

		/* ── Feature badges ── */
		#blanky-about .bk-badges {
			display: flex;
			flex-wrap: wrap;
			gap: .6em;
			margin-bottom: 3.5em;
			padding: 0;
			list-style: none;
		}
		#blanky-about .bk-badges li {
			display: inline-flex;
			align-items: center;
			gap: .4em;
			background: #f6f7f7;
			border: 1px solid #e5e5e5;
			border-radius: 30px;
			padding: .45em 1em;
			font-size: .875em;
			color: #3c434a;
			line-height: 1;
		}
		#blanky-about .bk-badges li::before {
			content: "✓";
			color: #2271b1;
			font-size: .85em;
			font-weight: 700;
		}

		/* ── Child theme cards ── */
		#blanky-about .bk-cards {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 1.5em;
			margin-bottom: 3.5em;
		}
		#blanky-about .bk-card {
			background: #fff;
			border: 1px solid #e5e5e5;
			border-radius: 14px;
			overflow: hidden;
		}
		#blanky-about .bk-card-head {
			background: #0e0e0e;
			padding: 1.6em 1.8em 1.4em;
		}
		#blanky-about .bk-card-head-top {
			display: flex;
			align-items: center;
			justify-content: space-between;
			margin-bottom: .55em;
		}
		#blanky-about .bk-card-name {
			color: #fff;
			font-size: 1.05em;
			font-weight: 600;
			letter-spacing: .01em;
		}
		#blanky-about .bk-premium-badge {
			font-size: .6em;
			font-weight: 700;
			letter-spacing: .1em;
			text-transform: uppercase;
			color: #c8a84b;
			border: 1px solid #4a3c18;
			border-radius: 20px;
			padding: .3em .85em;
		}
		#blanky-about .bk-card-tagline {
			color: #6b7280;
			font-size: .8em;
			line-height: 1.5;
			margin: 0;
		}
		#blanky-about .bk-card-body {
			padding: 1.6em 1.8em;
		}
		#blanky-about .bk-card-items {
			margin: 0;
			padding: 0;
			list-style: none;
			display: flex;
			flex-direction: column;
			gap: .55em;
		}
		#blanky-about .bk-card-items li {
			display: flex;
			align-items: center;
			gap: .6em;
			font-size: .875em;
			color: #50575e;
		}
		#blanky-about .bk-card-items li::before {
			content: "";
			width: 5px;
			height: 5px;
			border-radius: 50%;
			background: #c3c4c7;
			flex-shrink: 0;
		}

		/* ── CTA ── */
		#blanky-about .bk-cta {
			background: #0e0e0e;
			border-radius: 14px;
			padding: 2.8em 3em;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 2.5em;
		}
		#blanky-about .bk-cta-text p.bk-cta-eyebrow {
			font-size: .68em;
			font-weight: 700;
			letter-spacing: .12em;
			text-transform: uppercase;
			color: #5a6370;
			margin: 0 0 .4em;
		}
		#blanky-about .bk-cta-text h3 {
			color: #fff;
			font-size: 1.2em;
			font-weight: 600;
			margin: 0 0 .5em;
			letter-spacing: -.01em;
		}
		#blanky-about .bk-cta-text p.bk-cta-desc {
			color: #7a8490;
			font-size: .88em;
			line-height: 1.7;
			margin: 0;
		}
		#blanky-about .bk-cta-btn {
			display: inline-block;
			background: #fff;
			color: #0e0e0e !important;
			font-size: .9em;
			font-weight: 600;
			letter-spacing: .01em;
			padding: .75em 1.8em;
			border-radius: 8px;
			text-decoration: none;
			white-space: nowrap;
			flex-shrink: 0;
			border: none;
			transition: opacity .15s;
		}
		#blanky-about .bk-cta-btn:hover { opacity: .85; }
	</style>

	<div class="wrap" id="blanky-about" style="max-width:820px;">

		<!-- Hero -->
		<div class="bk-hero">
			<div class="bk-hero-badge"><?php esc_html_e( 'Lightweight Block Theme', 'blanky' ); ?></div>
			<h1>Blanky</h1>
			<p><?php esc_html_e( 'A lightweight, minimal block theme built on the idea of "blank." No unnecessary styles, no bloat — just a clean, empty canvas with sensible defaults. Start from nothing and build exactly what you need.', 'blanky' ); ?></p>
		</div>

		<!-- Features -->
		<p class="bk-label"><?php esc_html_e( 'What you get', 'blanky' ); ?></p>
		<ul class="bk-badges">
			<?php foreach ( $features as $f ) : ?>
				<li><?php echo esc_html( $f['text'] ); ?></li>
			<?php endforeach; ?>
		</ul>

		<!-- Child themes -->
		<p class="bk-label"><?php esc_html_e( 'Premium Child Themes', 'blanky' ); ?></p>
		<div class="bk-cards">
			<?php foreach ( $child_themes as $ct ) : ?>
				<div class="bk-card">
					<div class="bk-card-head">
						<div class="bk-card-head-top">
							<span class="bk-card-name"><?php echo esc_html( $ct['name'] ); ?></span>
							<span class="bk-premium-badge">Premium</span>
						</div>
						<p class="bk-card-tagline"><?php echo esc_html( $ct['tagline'] ); ?></p>
					</div>
					<div class="bk-card-body">
						<ul class="bk-card-items">
							<?php foreach ( $ct['items'] as $item ) : ?>
								<li><?php echo esc_html( $item ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- CTA -->
		<div class="bk-cta">
			<div class="bk-cta-text">
				<p class="bk-cta-eyebrow"><?php esc_html_e( 'Official Website', 'blanky' ); ?></p>
				<h3>blanky.369theme.com</h3>
				<p class="bk-cta-desc"><?php esc_html_e( 'Documentation, demo sites, support, and updates are all available on the official website.', 'blanky' ); ?></p>
			</div>
			<a class="bk-cta-btn"
				href="<?php echo esc_url( $theme_url ); ?>"
				target="_blank"
				rel="noopener noreferrer">
				<?php esc_html_e( 'Visit Website', 'blanky' ); ?>
			</a>
		</div>

	</div>
	<?php
}
