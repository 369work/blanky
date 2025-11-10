<?php
/*
    * Theme functions and definitions
    *
    * @package blanky
    * @since 1.0
*/

defined( 'ABSPATH' ) || exit;

define( 'BLANKY_VERSION', wp_get_theme()->get( 'Version' ) );

// Load theme setup
function blanky_theme_setup() {
    // Load text domain for translations
    load_theme_textdomain( 'blanky', get_template_directory() . '/languages' );

    // Add theme support for various features
    add_theme_support('wp-block-styles');
    add_theme_support('block-patterns');
    add_theme_support('block-templates');
    add_theme_support('block-template-parts');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    add_theme_support('appearance-tools');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');

}
add_action( 'after_setup_theme', 'blanky_theme_setup' );

// Register block patterns
function blanky_register_block_patterns()
{

    register_block_pattern_category(
        'blanky_patterns',
        array(
            'label' => __('Blanky Patterns', 'blanky'),
            'description' => __('Patterns provided by the Blanky theme.', 'blanky'),
            'icon'  => 'layout',
        )
    );
}
add_action('init', 'blanky_register_block_patterns');

// Enqueue theme styles and scripts
function blanky_enqueue_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('blanky-style', get_stylesheet_uri(), array(), BLANKY_VERSION);
}
add_action('wp_enqueue_scripts', 'blanky_enqueue_scripts' );




