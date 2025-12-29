<?php
/**
 * Color Helpers - Funzioni per gestire colori per categoria
 *
 * @package HeroCS
 * @since 1.0.2
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get category color based on portfolio category
 *
 * @param string $category_slug
 * @return string Hex color code
 */
function cs_get_category_color($category_slug = '') {
    $colors = array(
        'politica'       => '#7c3aed',    // Viola
        'istituzionale'  => '#6b8e7f',    // Verde Salvia
        'sociale'        => '#f5a4d8',    // Rosa
        'digital'        => '#6366f1',    // Blu Viola
    );

    return isset($colors[$category_slug]) ? $colors[$category_slug] : '#2563eb';
}

/**
 * Get category color with transparency
 *
 * @param string $category_slug
 * @param float $alpha (0-1)
 * @return string rgba color code
 */
function cs_get_category_color_rgba($category_slug = '', $alpha = 0.1) {
    $hex = cs_get_category_color($category_slug);
    
    // Convert hex to RGB
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    
    return "rgba($r, $g, $b, $alpha)";
}

/**
 * Get CSS variable for category color
 *
 * @param string $category_slug
 * @return string CSS var() syntax
 */
function cs_get_category_color_var($category_slug = '') {
    $var_map = array(
        'politica'       => '--cs-cat-politica',
        'istituzionale'  => '--cs-cat-istituzionale',
        'sociale'        => '--cs-cat-sociale',
        'digital'        => '--cs-blu-viola',
    );

    $var = isset($var_map[$category_slug]) ? $var_map[$category_slug] : '--cs-primary';
    return "var($var)";
}

/**
 * Get text color that contrasts with category color
 *
 * @param string $category_slug
 * @return string Hex color code
 */
function cs_get_category_text_color($category_slug = '') {
    // Light categories need dark text
    $light_categories = array('social');
    
    if (in_array($category_slug, $light_categories)) {
        return '#1e293b';
    }
    
    // Dark categories need light text
    return '#ffffff';
}

/**
 * Get gradient for category
 *
 * @param string $category_slug
 * @return string gradient CSS
 */
function cs_get_category_gradient($category_slug = '') {
    $gradients = array(
        'politica'       => 'linear-gradient(135deg, #7c3aed 0%, #6366f1 100%)',
        'istituzionale'  => 'linear-gradient(135deg, #6b8e7f 0%, #8ba89f 100%)',
        'sociale'        => 'linear-gradient(135deg, #f5a4d8 0%, #f088cc 100%)',
        'digital'        => 'linear-gradient(135deg, #6366f1 0%, #818cf8 100%)',
    );

    return isset($gradients[$category_slug]) ? $gradients[$category_slug] : 'linear-gradient(135deg, #2563eb 0%, #7c3aed 100%)';
}

/**
 * Get all category colors as CSS custom properties
 *
 * @return array
 */
function cs_get_all_category_colors() {
    return array(
        'politica'       => array(
            'hex'       => '#7c3aed',
            'rgb'       => '124, 58, 237',
            'label'     => __('Politica', 'herocs'),
            'icon'      => '🎨',
        ),
        'istituzionale'  => array(
            'hex'       => '#6b8e7f',
            'rgb'       => '107, 142, 127',
            'label'     => __('Istituzionale', 'herocs'),
            'icon'      => '🏛️',
        ),
        'sociale'        => array(
            'hex'       => '#f5a4d8',
            'rgb'       => '245, 164, 216',
            'label'     => __('Sociale', 'herocs'),
            'icon'      => '🤝',
        ),
        'digital'        => array(
            'hex'       => '#6366f1',
            'rgb'       => '99, 102, 241',
            'label'     => __('Digital', 'herocs'),
            'icon'      => '📱',
        ),
    );
}

/**
 * Output category color badge
 *
 * @param string $category_slug
 * @param string $label
 * @param array $args
 */
function cs_the_category_badge($category_slug = '', $label = '', $args = array()) {
    $defaults = array(
        'class'  => 'category-badge',
        'before' => '<span',
        'after'  => '</span>',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    $color = cs_get_category_color($category_slug);
    $text_color = cs_get_category_text_color($category_slug);
    
    echo wp_kses_post(
        $args['before'] . ' class="' . esc_attr($args['class']) . '" style="background-color: ' . esc_attr($color) . '; color: ' . esc_attr($text_color) . ';">' . esc_html($label) . $args['after']
    );
}