<?php
/**
 * HeroCS Theme Functions
 *
 * @package HeroCS
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Theme version
define('CS_THEME_VERSION', '1.2.0'); 
define('CS_THEME_DIR', get_template_directory());
define('CS_THEME_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function cs_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain('cs-communication', CS_THEME_DIR . '/languages');
    
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 675, true); // 16:9 ratio
    add_image_size('cs-portfolio-thumb', 800, 600, true);
    add_image_size('cs-team-thumb', 400, 400, true);
    add_image_size('cs-hero', 1920, 1080, true);
    add_image_size('cs-press-thumb', 600, 400, true); // 3:2 ratio for press images
 // Aggiungi srcset per responsive images
    add_image_size('cs-portfolio-thumb-sm', 400, 300, true);
    add_image_size('cs-hero-sm', 960, 540, true);

    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'cs-communication'),
        'mobile' => esc_html__('Mobile Menu', 'cs-communication'),
        'footer' => esc_html__('Footer Menu', 'cs-communication'),
        'footer-links' => esc_html__('Footer Links', 'herocs'),
        'footer-services' => esc_html__('Footer Services', 'herocs'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 100,
        'width' => 300,
        'flex-height' => true,
        'flex-width' => true,
    ));
    
    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for wide and full alignment
    add_theme_support('align-wide');
    
    // Add support for block patterns
    add_theme_support('core-block-patterns');
}
add_action('after_setup_theme', 'cs_theme_setup');

/**
 * Set the content width in pixels
 */
function cs_content_width() {
    $GLOBALS['content_width'] = apply_filters('cs_content_width', 1200);
}
add_action('after_setup_theme', 'cs_content_width', 0);

/**
 * Register widget areas
 */
function cs_widgets_init() {
    // Sidebar
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'cs-communication'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here to appear in your sidebar.', 'cs-communication'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    // Footer Widget Areas (3 columns)
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar(array(
            'name' => sprintf(esc_html__('Footer %d', 'cs-communication'), $i),
            'id' => 'footer-' . $i,
            'description' => sprintf(esc_html__('Footer widget area %d', 'cs-communication'), $i),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ));
    }
}
add_action('widgets_init', 'cs_widgets_init');

// Enqueue scripts and styles
function cs_scripts() {
    // Main stylesheet
    wp_enqueue_style('cs-style', get_stylesheet_uri(), array(), CS_THEME_VERSION);
    
    // Responsive styles
    wp_enqueue_style('cs-responsive', CS_THEME_URI . '/assets/css/responsive.css', array('cs-style'), CS_THEME_VERSION);
    
   // Dark mode styles - Always load (used via .dark-mode class)
    wp_enqueue_style('cs-darkmode', CS_THEME_URI . '/assets/css/dark-mode.css', array('cs-style'), CS_THEME_VERSION);
    
   // Google Fonts - Ottimizzato con display=swap
    wp_enqueue_style(
        'cs-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&family=Fahkwang:wght@700;800;900&display=swap',
        array(),
        null
    );
    
   // Swiper JS - Per sliders
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', array(), '10.0.0');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), '10.0.0', true);
   
    // Main scripts - Caricati nel footer per non bloccare rendering
    wp_enqueue_script('cs-main', CS_THEME_URI . '/assets/js/main.js', array(), CS_THEME_VERSION, true);
    
    // Animations script - defer loading
    wp_enqueue_script('cs-animations', CS_THEME_URI . '/assets/js/animations.js', array(), CS_THEME_VERSION, true);
    
    // Localize script for AJAX
    wp_localize_script('cs-main', 'csTheme', array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('cs-nonce'),
        'darkMode' => get_theme_mod('cs_enable_dark_mode', false),
    ));
    
    // Comment reply script - Only if needed
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'cs_scripts');

/**
 * Include required files
 */
require_once CS_THEME_DIR . '/inc/custom-post-types.php';
require_once CS_THEME_DIR . '/inc/custom-fields.php';
require_once CS_THEME_DIR . '/inc/theme-options.php';
require_once CS_THEME_DIR . '/inc/helpers.php';
require_once CS_THEME_DIR . '/inc/color-helpers.php';

// Optional includes (se i file esistono)
if (file_exists(CS_THEME_DIR . '/inc/customizer.php')) {
    require_once CS_THEME_DIR . '/inc/customizer.php';
}

if (file_exists(CS_THEME_DIR . '/inc/block-patterns.php')) {
    require_once CS_THEME_DIR . '/inc/block-patterns.php';
}

/**
 * Add preconnect for Google Fonts
 */
function cs_resource_hints($urls, $relation_type) {
    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    
    if ('dns-prefetch' === $relation_type) {
        $urls[] = array('href' => 'https://cdnjs.cloudflare.com');
        $urls[] = array('href' => 'https://cdn.jsdelivr.net');
    }
    
    return $urls;
}

/**
 * Add body classes
 */
function cs_body_classes($classes) {
    // Dark mode class
    if (get_theme_mod('cs_enable_dark_mode', false)) {
        $classes[] = 'dark-mode';
    }
    
    // Sidebar class
    if (is_active_sidebar('sidebar-1') && !is_page_template('page-templates/page-full-width.php')) {
        $classes[] = 'has-sidebar';
    }
    
    // Page layout
    $layout = get_theme_mod('cs_page_layout', 'wide');
    $classes[] = 'layout-' . $layout;
    
    return $classes;
}
add_filter('body_class', 'cs_body_classes');

/**
 * Add async/defer attributes to scripts
 */
function cs_script_loader_tag($tag, $handle, $src) {
    // Scripts to defer
    $defer_scripts = array('cs-animations');
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'cs_script_loader_tag', 10, 3);

/**
 * Optimize WordPress emoji script
 */
function cs_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'cs_disable_emojis');

/**
 * Excerpt length
 */
function cs_excerpt_length($length) {
    return get_theme_mod('cs_excerpt_length', 25);
}
add_filter('excerpt_length', 'cs_excerpt_length');

/**
 * Excerpt more
 */
function cs_excerpt_more($more) {
    return '... <a class="read-more" href="' . get_permalink() . '">' . esc_html__('Read More', 'cs-communication') . '</a>';
}
add_filter('excerpt_more', 'cs_excerpt_more');

/**
 * Add WebP support
 */
function cs_mime_types($mimes) {
    $mimes['webp'] = 'image/webp';
    $mimes['avif'] = 'image/avif';
    return $mimes;
}
add_filter('upload_mimes', 'cs_mime_types');

/**
 * Security: Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Performance: Remove query strings from static resources
 */
function cs_remove_query_strings($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'cs_remove_query_strings', 15, 1);
add_filter('style_loader_src', 'cs_remove_query_strings', 15, 1);

/**
 * Add schema.org markup
 */
function cs_schema_markup() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
        'logo' => get_theme_mod('custom_logo') ? wp_get_attachment_url(get_theme_mod('custom_logo')) : '',
        'description' => get_bloginfo('description'),
    );
    
    // Add social profiles if set
    $social_profiles = array();
    if ($facebook = get_theme_mod('cs_facebook_url')) {
        $social_profiles[] = $facebook;
    }
    if ($twitter = get_theme_mod('cs_twitter_url')) {
        $social_profiles[] = $twitter;
    }
    if ($linkedin = get_theme_mod('cs_linkedin_url')) {
        $social_profiles[] = $linkedin;
    }
    if ($instagram = get_theme_mod('cs_instagram_url')) {
        $social_profiles[] = $instagram;
    }
    
    if (!empty($social_profiles)) {
        $schema['sameAs'] = $social_profiles;
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'cs_schema_markup');

/**
 * Lazy load images - Native loading attribute
 */
function cs_add_lazy_loading($content) {
    if (is_admin()) {
        return $content;
    }
    
    // Aggiungi loading="lazy" ma evita header/logo
    $content = preg_replace(
        '/<img((?!class=["\'].*custom-logo.*["\']).*?)src=/i',
        '<img$1loading="lazy" src=',
        $content
    );
    
    return $content;
}
add_filter('the_content', 'cs_add_lazy_loading');
add_filter('post_thumbnail_html', 'cs_add_lazy_loading');