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
    add_editor_style(get_parent_theme_file_uri('assets/css/editor-style.css'));
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

    // Enqueue editor styles
    wp_enqueue_style('blanky-editor-style', get_template_directory_uri() . '/assets/css/editor-style.css', array('blanky-style'), BLANKY_VERSION);

    // Enqueue block styles
    wp_enqueue_style('blanky-block-style', get_template_directory_uri() . '/assets/css/block-style.css', array('blanky-editor-style'), BLANKY_VERSION);

    // Enqueue custom styles
    wp_enqueue_style('blanky-custom-style', get_template_directory_uri() . '/assets/css/custom-style.css', array('blanky-block-style'), BLANKY_VERSION);

    // Enqueue scripts
    wp_enqueue_script('blanky-script', get_template_directory_uri() . '/assets/js/blanky.js', array('jquery'), BLANKY_VERSION, true);
}
add_action('wp_enqueue_scripts', 'blanky_enqueue_scripts' );


/*********** add custom ************** */


// Include Google Analytics 4 IP tracking functionality
//require get_stylesheet_directory() . '/inc/google.php';
require get_template_directory() . '/inc/google.php';


// Childに移動
// header tag add code
/*
function blanky_child_custom_header_tag()
{
    //description
    if (is_single() || is_page()) {
        global $post;
        echo '<meta name="description" content="' . esc_attr(get_the_excerpt($post->ID)) . '" />' . "\n";
    } else {
        echo '<meta name="description" content="369Themeは、WordPressの無料テーマとプラグインを提供するサイトです。美しく機能的なデザインで、あなたのWebサイトを次のレベルへ。" />' . "\n";
    }

    // ogg
    if (is_single() || is_page()) {
        global $post;
        if (has_post_thumbnail($post->ID)) {
            $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');
            echo '    <meta property="og:image" content="' . esc_url($thumbnail_url) . '" />' . "\n";
        }
        echo '    <meta property="og:title" content="' . esc_attr(get_the_title($post->ID)) . '" />' . "\n";
        echo '    <meta property="og:description" content="' . esc_attr(get_the_excerpt($post->ID)) . '" />' . "\n";
    } else {
        echo '    <meta property="og:title" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
        echo '    <meta property="og:description" content="' . esc_attr(get_bloginfo('description')) . '" />' . "\n";
    }

    //canonical
    if (is_single() || is_page()) {
        global $post;
        echo '    <link rel="canonical" href="' . esc_url(get_permalink($post->ID)) . '" />' . "\n";
    } else {
        echo '    <link rel="canonical" href="' . esc_url(home_url('/')) . '" />' . "\n";
    }
}
add_action('wp_head', 'blanky_child_custom_header_tag', 1);


// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');
// EditURIを非表示にする
remove_action('wp_head', 'rsd_link');
// Windows Live Writerを非表示にする
remove_action('wp_head', 'wlwmanifest_link');
// 投稿の RSS フィードリンクを非表示にする
remove_action('wp_head', 'feed_links', 2);
// コメントフィードを非表示にする
remove_action('wp_head', 'feed_links_extra', 3);
// wp versionを非表示にする
remove_action('wp_head', 'rest_output_link_wp_head');
//rel="next" rel="prev" を非表示にする
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

*/