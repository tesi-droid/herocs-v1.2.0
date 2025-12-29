<?php
/**
 * Theme Customizer Options
 *
 * @package HeroCS
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Customizer Settings
 */
function cs_customize_register($wp_customize) {
    
    // ========== COLORS SECTION ==========
    $wp_customize->add_section('cs_colors_section', array(
        'title' => __('Theme Colors', 'herocs'),
        'priority' => 30,
    ));

    // Primary Color
    $wp_customize->add_setting('cs_primary_color', array(
        'default' => '#2563eb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cs_primary_color', array(
        'label' => __('Primary Color', 'herocs'),
        'section' => 'cs_colors_section',
        'settings' => 'cs_primary_color',
    )));

    // Secondary Color
    $wp_customize->add_setting('cs_secondary_color', array(
        'default' => '#7c3aed',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cs_secondary_color', array(
        'label' => __('Secondary Color', 'herocs'),
        'section' => 'cs_colors_section',
        'settings' => 'cs_secondary_color',
    )));

    // Accent Color
    $wp_customize->add_setting('cs_accent_color', array(
        'default' => '#f59e0b',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cs_accent_color', array(
        'label' => __('Accent Color', 'herocs'),
        'section' => 'cs_colors_section',
        'settings' => 'cs_accent_color',
    )));

    // ========== TYPOGRAPHY SECTION ==========
    $wp_customize->add_section('cs_typography_section', array(
        'title' => __('Typography', 'herocs'),
        'priority' => 35,
    ));

    // Body Font
    $wp_customize->add_setting('cs_body_font', array(
        'default' => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cs_body_font', array(
        'label' => __('Body Font', 'herocs'),
        'section' => 'cs_typography_section',
        'type' => 'select',
        'choices' => array(
            'Inter' => 'Inter',
            'Roboto' => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato' => 'Lato',
            'Montserrat' => 'Montserrat',
        ),
    ));

    // Heading Font
    $wp_customize->add_setting('cs_heading_font', array(
        'default' => 'Poppins',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cs_heading_font', array(
        'label' => __('Heading Font', 'herocs'),
        'section' => 'cs_typography_section',
        'type' => 'select',
        'choices' => array(
            'Poppins' => 'Poppins',
            'Montserrat' => 'Montserrat',
            'Raleway' => 'Raleway',
            'Playfair Display' => 'Playfair Display',
            'Merriweather' => 'Merriweather',
        ),
    ));

    // Font Size
    $wp_customize->add_setting('cs_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('cs_font_size', array(
        'label' => __('Base Font Size (px)', 'herocs'),
        'section' => 'cs_typography_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 14,
            'max' => 20,
            'step' => 1,
        ),
    ));

    // ========== LAYOUT SECTION ==========
    $wp_customize->add_section('cs_layout_section', array(
        'title' => __('Layout Options', 'herocs'),
        'priority' => 40,
    ));

    // Container Width
    $wp_customize->add_setting('cs_container_width', array(
        'default' => '1200',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('cs_container_width', array(
        'label' => __('Container Width (px)', 'herocs'),
        'section' => 'cs_layout_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 960,
            'max' => 1920,
            'step' => 10,
        ),
    ));

    // Page Layout
    $wp_customize->add_setting('cs_page_layout', array(
        'default' => 'wide',
        'sanitize_callback' => 'cs_sanitize_layout',
    ));
    $wp_customize->add_control('cs_page_layout', array(
        'label' => __('Default Page Layout', 'herocs'),
        'section' => 'cs_layout_section',
        'type' => 'select',
        'choices' => array(
            'wide' => __('Wide', 'herocs'),
            'boxed' => __('Boxed', 'herocs'),
            'full-width' => __('Full Width', 'herocs'),
        ),
    ));

    // Sidebar Position
    $wp_customize->add_setting('cs_sidebar_position', array(
        'default' => 'right',
        'sanitize_callback' => 'cs_sanitize_sidebar',
    ));
    $wp_customize->add_control('cs_sidebar_position', array(
        'label' => __('Sidebar Position', 'herocs'),
        'section' => 'cs_layout_section',
        'type' => 'select',
        'choices' => array(
            'left' => __('Left', 'herocs'),
            'right' => __('Right', 'herocs'),
            'none' => __('No Sidebar', 'herocs'),
        ),
    ));

    // ========== HEADER SECTION ==========
    $wp_customize->add_section('cs_header_section', array(
        'title' => __('Header Options', 'herocs'),
        'priority' => 45,
    ));

    // Sticky Header
    $wp_customize->add_setting('cs_sticky_header', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_sticky_header', array(
        'label' => __('Enable Sticky Header', 'herocs'),
        'section' => 'cs_header_section',
        'type' => 'checkbox',
    ));

    // Header Style
    $wp_customize->add_setting('cs_header_style', array(
        'default' => 'default',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cs_header_style', array(
        'label' => __('Header Style', 'herocs'),
        'section' => 'cs_header_section',
        'type' => 'select',
        'choices' => array(
            'default' => __('Default', 'herocs'),
            'transparent' => __('Transparent', 'herocs'),
            'minimal' => __('Minimal', 'herocs'),
        ),
    ));

    // ========== DARK MODE SECTION ==========
    $wp_customize->add_section('cs_dark_mode_section', array(
        'title' => __('Dark Mode', 'herocs'),
        'priority' => 50,
    ));

    // Enable Dark Mode
    $wp_customize->add_setting('cs_enable_dark_mode', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_enable_dark_mode', array(
        'label' => __('Enable Dark Mode Toggle', 'herocs'),
        'section' => 'cs_dark_mode_section',
        'type' => 'checkbox',
        'description' => __('Mostra il toggle dark mode nell\'header', 'herocs'),
    ));

   // Default Mode
    $wp_customize->add_setting('cs_default_mode', array(
        'default' => 'light',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cs_default_mode', array(
        'label' => __('Default Mode', 'herocs'),
        'section' => 'cs_dark_mode_section',
        'type' => 'select',
        'choices' => array(
            'light' => __('Light', 'herocs'),
            'dark' => __('Dark', 'herocs'),
            'auto' => __('Auto (System Preference)', 'herocs'),
        ),
    ));

    // ========== SOCIAL MEDIA SECTION ==========
    $wp_customize->add_section('cs_social_section', array(
        'title' => __('Social Media', 'herocs'),
        'priority' => 55,
    ));

    $social_networks = array(
        'facebook' => __('Facebook URL', 'herocs'),
        'twitter' => __('Twitter/X URL', 'herocs'),
        'linkedin' => __('LinkedIn URL', 'herocs'),
        'instagram' => __('Instagram URL', 'herocs'),
        'youtube' => __('YouTube URL', 'herocs'),
    );

    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('cs_' . $network . '_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control('cs_' . $network . '_url', array(
            'label' => $label,
            'section' => 'cs_social_section',
            'type' => 'url',
        ));
    }
// ========================================================================
    // HERO SLIDER SECTION
    // ========================================================================
    
    $wp_customize->add_section('cs_hero_slider_section', array(
        'title' => __('Hero Slider', 'herocs'),
        'priority' => 25,
        'description' => __('Configura lo slider della homepage. Puoi aggiungere fino a 5 slides con immagini o video caricati dalla Media Library o tramite URL esterno.', 'herocs'),
    ));

    // Enable/Disable Slider
    $wp_customize->add_setting('cs_hero_enable_slider', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_hero_enable_slider', array(
        'label' => __('Enable Hero Slider', 'herocs'),
        'section' => 'cs_hero_slider_section',
        'type' => 'checkbox',
        'description' => __('Attiva lo slider automatico in homepage', 'herocs'),
    ));

    // Slider Autoplay Speed
    $wp_customize->add_setting('cs_hero_slider_speed', array(
        'default' => 6000,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('cs_hero_slider_speed', array(
        'label' => __('Autoplay Speed (ms)', 'herocs'),
        'section' => 'cs_hero_slider_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 3000,
            'max' => 15000,
            'step' => 1000,
        ),
        'description' => __('Tempo tra uno slide e l\'altro (3000-15000ms)', 'herocs'),
    ));

    // Slider Effect
    $wp_customize->add_setting('cs_hero_slider_effect', array(
        'default' => 'fade',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cs_hero_slider_effect', array(
        'label' => __('Effetto Transizione', 'herocs'),
        'section' => 'cs_hero_slider_section',
        'type' => 'select',
        'choices' => array(
            'fade' => 'Fade',
            'slide' => 'Slide',
            'cube' => 'Cube',
            'coverflow' => 'Coverflow',
        ),
    ));

    // ========== OPZIONI VISIBILITÀ CONTENUTI SLIDER ==========
    
    // Mostra Titolo
    $wp_customize->add_setting('cs_hero_show_title', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_hero_show_title', array(
        'label' => __('Mostra Titolo', 'herocs'),
        'section' => 'cs_hero_slider_section',
        'type' => 'checkbox',
        'description' => __('Mostra il titolo principale sopra le slide', 'herocs'),
    ));
    
    // Mostra Sottotitolo
    $wp_customize->add_setting('cs_hero_show_subtitle', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_hero_show_subtitle', array(
        'label' => __('Mostra Sottotitolo', 'herocs'),
        'section' => 'cs_hero_slider_section',
        'type' => 'checkbox',
        'description' => __('Mostra il sottotitolo/descrizione sotto il titolo', 'herocs'),
    ));
    
    // Mostra Pulsante CTA
    $wp_customize->add_setting('cs_hero_show_button', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_hero_show_button', array(
        'label' => __('Mostra Pulsante', 'herocs'),
        'section' => 'cs_hero_slider_section',
        'type' => 'checkbox',
        'description' => __('Mostra il pulsante call-to-action', 'herocs'),
    ));

    // ========== SLIDES (1-5) ==========
    for ($i = 1; $i <= 5; $i++) {
        
        // --- Slide Enable ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_enable", array(
            'default' => ($i === 1) ? true : false,
            'sanitize_callback' => 'cs_sanitize_checkbox',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_enable", array(
            'label' => sprintf(__('â"ÂÃ¢"ÂÃ¢"Â Slide %d â"ÂÃ¢"ÂÃ¢"Â', 'herocs'), $i),
            'section' => 'cs_hero_slider_section',
            'type' => 'checkbox',
            'description' => sprintf(__('Abilita Slide %d', 'herocs'), $i),
        ));

        // --- Media Type ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_type", array(
            'default' => 'image',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_type", array(
            'label' => __('Tipo Media', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'select',
            'choices' => array(
                'image' => __('Immagine', 'herocs'),
                'video' => __('Video', 'herocs'),
            ),
        ));

        // --- Image Upload (Media Library) ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_image", array(
            'default' => '',
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "cs_hero_slide_{$i}_image", array(
            'label' => __('Immagine da Media Library', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'mime_type' => 'image',
            'description' => __('Seleziona un\'immagine dalla libreria (1920x1080 consigliato)', 'herocs'),
        )));

        // --- Image URL Direct (alternativa all'upload) ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_image_url", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_image_url", array(
            'label' => __('Oppure URL Immagine Esterna', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'url',
            'description' => __('URL diretto (.jpg, .png, .webp)', 'herocs'),
        ));

        // --- Video Upload (Media Library) ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_video_media", array(
            'default' => '',
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "cs_hero_slide_{$i}_video_media", array(
            'label' => __('Video da Media Library', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'mime_type' => 'video',
            'description' => __('Carica un video MP4/WebM dalla libreria', 'herocs'),
        )));

        // --- Video URL External ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_video", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_video", array(
            'label' => __('Oppure URL Video Esterno', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'url',
            'description' => __('YouTube, Vimeo o URL diretto MP4', 'herocs'),
        ));

        // --- Title ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_title", array(
            'default' => ($i === 1) ? 'Comunichiamo il Futuro' : '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_title", array(
            'label' => __('Titolo', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'text',
        ));

        // --- Subtitle ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_subtitle", array(
            'default' => ($i === 1) ? 'Strategie di comunicazione innovative' : '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_subtitle", array(
            'label' => __('Sottotitolo', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'textarea',
        ));

        // --- CTA Text ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_cta_text", array(
            'default' => ($i === 1) ? 'Scopri di più' : '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_cta_text", array(
            'label' => __('Testo Pulsante', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'text',
        ));

        // --- CTA Link ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_cta_link", array(
            'default' => ($i === 1) ? '/chi-siamo' : '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_cta_link", array(
            'label' => __('Link Pulsante', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'url',
        ));

        // --- Overlay Opacity ---
        $wp_customize->add_setting("cs_hero_slide_{$i}_overlay", array(
            'default' => 40,
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control("cs_hero_slide_{$i}_overlay", array(
            'label' => __('Opacità Overlay (%)', 'herocs'),
            'section' => 'cs_hero_slider_section',
            'type' => 'range',
            'input_attrs' => array(
                'min' => 0,
                'max' => 100,
                'step' => 10,
            ),
        ));
    }

    // ========== FOOTER SECTION ==========
    $wp_customize->add_section('cs_footer_section', array(
        'title' => __('Footer Options', 'herocs'),
        'priority' => 60,
    ));

    // Footer Description
    $wp_customize->add_setting('cs_footer_description', array(
        'default' => 'Agenzia di comunicazione specializzata in comunicazione politica, istituzionale e sociale. Costruiamo relazioni attraverso strategie innovative.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('cs_footer_description', array(
        'label' => __('Footer Description', 'herocs'),
        'section' => 'cs_footer_section',
        'type' => 'textarea',
        'description' => __('Breve descrizione mostrata nel footer', 'herocs'),
    ));

    // Copyright Text
    $wp_customize->add_setting('cs_copyright_text', array(
        'default' => sprintf(__('© %s. All rights reserved.', 'herocs'), date('Y')),
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('cs_copyright_text', array(
        'label' => __('Copyright Text', 'herocs'),
        'section' => 'cs_footer_section',
        'type' => 'textarea',
    ));

    // Footer Columns
    $wp_customize->add_setting('cs_footer_columns', array(
        'default' => '3',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('cs_footer_columns', array(
        'label' => __('Footer Columns', 'herocs'),
        'section' => 'cs_footer_section',
        'type' => 'select',
        'choices' => array(
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ));

    // ========== PERFORMANCE SECTION ==========
    $wp_customize->add_section('cs_performance_section', array(
        'title' => __('Performance', 'herocs'),
        'priority' => 65,
    ));

    // Preload Fonts
    $wp_customize->add_setting('cs_preload_fonts', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_preload_fonts', array(
        'label' => __('Preload Google Fonts', 'herocs'),
        'section' => 'cs_performance_section',
        'type' => 'checkbox',
        'description' => __('Improves font loading performance', 'herocs'),
    ));

    // Lazy Load Images
    $wp_customize->add_setting('cs_lazy_load', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_lazy_load', array(
        'label' => __('Enable Lazy Loading', 'herocs'),
        'section' => 'cs_performance_section',
        'type' => 'checkbox',
        'description' => __('Delays loading of images until they are in viewport', 'herocs'),
    ));

    // ========== BLOG SECTION ==========
    $wp_customize->add_section('cs_blog_section', array(
        'title' => __('Blog Options', 'herocs'),
        'priority' => 70,
    ));

    // Excerpt Length
    $wp_customize->add_setting('cs_excerpt_length', array(
        'default' => 25,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('cs_excerpt_length', array(
        'label' => __('Excerpt Length (words)', 'herocs'),
        'section' => 'cs_blog_section',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 10,
            'max' => 100,
            'step' => 5,
        ),
    ));

    // Show Author
    $wp_customize->add_setting('cs_show_author', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_show_author', array(
        'label' => __('Show Post Author', 'herocs'),
        'section' => 'cs_blog_section',
        'type' => 'checkbox',
    ));

    // Show Date
    $wp_customize->add_setting('cs_show_date', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_show_date', array(
        'label' => __('Show Post Date', 'herocs'),
        'section' => 'cs_blog_section',
        'type' => 'checkbox',
    ));

    // Show Categories
    $wp_customize->add_setting('cs_show_categories', array(
        'default' => true,
        'sanitize_callback' => 'cs_sanitize_checkbox',
    ));
    $wp_customize->add_control('cs_show_categories', array(
        'label' => __('Show Post Categories', 'herocs'),
        'section' => 'cs_blog_section',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'cs_customize_register');

/**
 * Sanitization Functions
 */

// Sanitize Checkbox
function cs_sanitize_checkbox($checked) {
    return ((isset($checked) && true === $checked) ? true : false);
}

// Sanitize Layout
function cs_sanitize_layout($input) {
    $valid = array('wide', 'boxed', 'full-width');
    return (in_array($input, $valid)) ? $input : 'wide';
}

// Sanitize Sidebar
function cs_sanitize_sidebar($input) {
    $valid = array('left', 'right', 'none');
    return (in_array($input, $valid)) ? $input : 'right';
}

/**
 * Output Custom CSS based on Customizer settings
 */
function cs_customizer_css() {
    $primary_color = get_theme_mod('cs_primary_color', '#2563eb');
    $secondary_color = get_theme_mod('cs_secondary_color', '#7c3aed');
    $accent_color = get_theme_mod('cs_accent_color', '#f59e0b');
    $font_size = get_theme_mod('cs_font_size', 16);
    $container_width = get_theme_mod('cs_container_width', 1200);
    ?>
    <style type="text/css">
        :root {
            --cs-primary: <?php echo esc_attr($primary_color); ?>;
            --cs-secondary: <?php echo esc_attr($secondary_color); ?>;
            --cs-accent: <?php echo esc_attr($accent_color); ?>;
            --cs-container-width: <?php echo esc_attr($container_width); ?>px;
        }
        html {
            font-size: <?php echo esc_attr($font_size); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'cs_customizer_css');

/**
 * Customizer Live Preview
 */
function cs_customizer_live_preview() {
    wp_enqueue_script(
        'cs-customizer',
        get_template_directory_uri() . '/assets/js/customizer.js',
        array('jquery', 'customize-preview'),
        CS_THEME_VERSION,
        true
    );
}
add_action('customize_preview_init', 'cs_customizer_live_preview');

// ============================================================================
// ACF OPTIONS PAGES - Tema Options
// ============================================================================

/**
 * Register ACF Options Pages
 */
function herocs_register_acf_options_pages() {
    
    // Verifica che ACF sia attivo
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    
    // Pagina principale: Tema Options
    acf_add_options_page(array(
        'page_title'    => 'HeroCS - Opzioni Tema',
        'menu_title'    => 'Tema Options',
        'menu_slug'     => 'herocs-theme-options',
        'capability'    => 'manage_options',
        'redirect'      => true,
        'icon_url'      => 'dashicons-admin-customizer',
        'position'      => 59,
    ));
    
    // Sottopagina: Hero Slider
    acf_add_options_sub_page(array(
        'page_title'    => 'Hero Slider Settings',
        'menu_title'    => 'Hero Slider',
        'menu_slug'     => 'herocs-hero-slider',
        'parent_slug'   => 'herocs-theme-options',
        'capability'    => 'manage_options',
    ));
    
    // Sottopagina: Impostazioni Generali
    acf_add_options_sub_page(array(
        'page_title'    => 'Impostazioni Generali',
        'menu_title'    => 'Generali',
        'menu_slug'     => 'herocs-general-settings',
        'parent_slug'   => 'herocs-theme-options',
        'capability'    => 'manage_options',
    ));
    
    // Sottopagina: Footer Settings
    acf_add_options_sub_page(array(
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer',
        'menu_slug'     => 'herocs-footer-settings',
        'parent_slug'   => 'herocs-theme-options',
        'capability'    => 'manage_options',
    ));
}
add_action('acf/init', 'herocs_register_acf_options_pages');

/**
 * Aggiungi admin notice se ACF non e installato
 */
function herocs_acf_notice() {
    if (!function_exists('acf_add_options_page') && current_user_can('manage_options')) {
        ?>
        <div class="notice notice-info is-dismissible">
            <p>
                <strong>HeroCS Tema:</strong> Per sbloccare tutte le funzionalita di personalizzazione (Hero Slider, Footer, etc.), 
                installa <a href="https://www.advancedcustomfields.com/pro/" target="_blank">Advanced Custom Fields PRO</a>.
            </p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'herocs_acf_notice');

/**
 * Register ACF Field Group for General Settings
 */
function herocs_register_acf_general_settings() {
    
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    acf_add_local_field_group(array(
        'key' => 'group_general_settings',
        'title' => 'Impostazioni Generali',
        'fields' => array(
            // Logo Alternativo
            array(
                'key' => 'field_logo_dark',
                'label' => 'Logo per Dark Mode',
                'name' => 'logo_dark',
                'type' => 'image',
                'instructions' => 'Logo da usare quando e attiva la dark mode',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            // Preloader
            array(
                'key' => 'field_enable_preloader',
                'label' => 'Abilita Preloader',
                'name' => 'enable_preloader',
                'type' => 'true_false',
                'default_value' => 0,
                'ui' => 1,
            ),
            // Google Analytics
            array(
                'key' => 'field_google_analytics',
                'label' => 'Google Analytics ID',
                'name' => 'google_analytics_id',
                'type' => 'text',
                'instructions' => 'Es: G-XXXXXXXXXX o UA-XXXXXXXX-X',
                'placeholder' => 'G-XXXXXXXXXX',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'herocs-general-settings',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'herocs_register_acf_general_settings');

/**
 * Register ACF Field Group for Footer Settings
 */
function herocs_register_acf_footer_settings() {
    
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    acf_add_local_field_group(array(
        'key' => 'group_footer_settings',
        'title' => 'Footer Settings',
        'fields' => array(
            // Footer Text
            array(
                'key' => 'field_footer_text',
                'label' => 'Testo Footer',
                'name' => 'footer_text',
                'type' => 'wysiwyg',
                'instructions' => 'Testo da mostrare nel footer (es: indirizzo, info azienda)',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ),
            // Copyright
            array(
                'key' => 'field_footer_copyright',
                'label' => 'Copyright',
                'name' => 'footer_copyright',
                'type' => 'text',
                'instructions' => 'Testo copyright (es: (c) 2024 HeroCS. Tutti i diritti riservati.)',
                'default_value' => '(c) ' . date('Y') . ' HeroCS. Tutti i diritti riservati.',
            ),
            // Social Links
            array(
                'key' => 'field_social_links',
                'label' => 'Social Links',
                'name' => 'social_links',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => 'field_social_facebook',
                        'label' => 'Facebook',
                        'name' => 'facebook',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_social_instagram',
                        'label' => 'Instagram',
                        'name' => 'instagram',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_social_linkedin',
                        'label' => 'LinkedIn',
                        'name' => 'linkedin',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_social_twitter',
                        'label' => 'Twitter/X',
                        'name' => 'twitter',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_social_youtube',
                        'label' => 'YouTube',
                        'name' => 'youtube',
                        'type' => 'url',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'herocs-footer-settings',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'herocs_register_acf_footer_settings');