<?php
/**
 * Helper Functions
 *
 * @package HeroCS
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get social media links
 */
function cs_get_social_links() {
    $social_links = array();
    
    $networks = array(
        'facebook' => array(
            'label' => __('Facebook', 'herocs'),
            'icon' => 'facebook',
        ),
        'twitter' => array(
            'label' => __('Twitter', 'herocs'),
            'icon' => 'twitter',
        ),
        'linkedin' => array(
            'label' => __('LinkedIn', 'herocs'),
            'icon' => 'linkedin',
        ),
        'instagram' => array(
            'label' => __('Instagram', 'herocs'),
            'icon' => 'instagram',
        ),
        'youtube' => array(
            'label' => __('YouTube', 'herocs'),
            'icon' => 'youtube',
        ),
    );
    
    foreach ($networks as $key => $network) {
        $url = get_theme_mod('cs_' . $key . '_url');
        if ($url) {
            $social_links[$key] = array(
                'url' => esc_url($url),
                'label' => $network['label'],
                'icon' => $network['icon'],
            );
        }
    }
    
    return $social_links;
}

/**
 * Display social media links
 */
function cs_social_links($class = '') {
    $social_links = cs_get_social_links();
    
    if (empty($social_links)) {
        return;
    }
    
    $output = '<ul class="cs-social-links ' . esc_attr($class) . '">';
    
    foreach ($social_links as $network => $link) {
        $output .= sprintf(
            '<li class="cs-social-item cs-social-%s"><a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s"><span class="screen-reader-text">%s</span><svg class="cs-icon" aria-hidden="true"><use xlink:href="#icon-%s"></use></svg></a></li>',
            esc_attr($network),
            esc_url($link['url']),
            esc_attr($link['label']),
            esc_html($link['label']),
            esc_attr($link['icon'])
        );
    }
    
    $output .= '</ul>';
    
    echo $output;
}

/**
 * Get breadcrumbs
 */
function cs_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    $separator = '<span class="breadcrumb-separator" aria-hidden="true">/</span>';
    $home_title = __('Home', 'herocs');
    
    echo '<nav class="cs-breadcrumbs" aria-label="' . esc_attr__('Breadcrumb', 'herocs') . '">';
    echo '<ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">';
    
    // Home link
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<a href="' . esc_url(home_url('/')) . '" itemprop="item"><span itemprop="name">' . esc_html($home_title) . '</span></a>';
    echo '<meta itemprop="position" content="1" />';
    echo '</li>';
    echo $separator;
    
    $position = 2;
    
    if (is_category() || is_single()) {
        $category = get_the_category();
        if ($category) {
            $cat = $category[0];
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" itemprop="item"><span itemprop="name">' . esc_html($cat->name) . '</span></a>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '</li>';
            
            if (is_single()) {
                echo $separator;
                $position++;
            }
        }
    }
    
    if (is_single()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
        echo '<span itemprop="name">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_page()) {
        if ($post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            
            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url(get_permalink($page->ID)) . '" itemprop="item"><span itemprop="name">' . esc_html(get_the_title($page->ID)) . '</span></a><meta itemprop="position" content="' . $position . '" /></li>';
                $parent_id = $page->post_parent;
                $position++;
            }
            
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) {
                echo $crumb . $separator;
            }
        }
        
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
        echo '<span itemprop="name">' . esc_html(get_the_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_archive()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
        echo '<span itemprop="name">' . esc_html(get_the_archive_title()) . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_search()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
        echo '<span itemprop="name">' . esc_html__('Search Results', 'herocs') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    } elseif (is_404()) {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">';
        echo '<span itemprop="name">' . esc_html__('404 Not Found', 'herocs') . '</span>';
        echo '<meta itemprop="position" content="' . $position . '" />';
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}

/**
 * Get reading time
 */
function cs_reading_time($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words/minute
    
    return sprintf(
        _n('%d minute read', '%d minutes read', $reading_time, 'herocs'),
        $reading_time
    );
}

/**
 * Pagination
 */
function cs_pagination() {
    global $wp_query;
    
    if ($wp_query->max_num_pages <= 1) {
        return;
    }
    
    $big = 999999999;
    
    echo '<nav class="cs-pagination" role="navigation" aria-label="' . esc_attr__('Posts navigation', 'herocs') . '">';
    
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<span aria-hidden="true">&laquo;</span> ' . __('Previous', 'herocs'),
        'next_text' => __('Next', 'herocs') . ' <span aria-hidden="true">&raquo;</span>',
        'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'herocs') . ' </span>',
        'type' => 'list',
    ));
    
    echo '</nav>';
}

/**
 * Get post views count
 */
function cs_get_post_views($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $count = get_post_meta($post_id, '_cs_post_views', true);
    return $count ? absint($count) : 0;
}

/**
 * Set post views count
 */
function cs_set_post_views($post_id = null) {
    // Solo per utenti non loggati o non admin
    if (is_admin() || current_user_can('manage_options')) {
        return;
    }
    
    $post_id = $post_id ? $post_id : get_the_ID();
    if (!$post_id) {
        return;
    }
    
    $count = cs_get_post_views($post_id);
    $count++;
    update_post_meta($post_id, '_cs_post_views', absint($count));
}

/**
 * Track post views automatically on single posts
 */
function cs_track_post_views() {
    if (is_single() && !is_attachment()) {
        cs_set_post_views();
    }
}
add_action('wp_head', 'cs_track_post_views');

/**
 * Display estimated reading time and views
 */
function cs_post_meta_info() {
    echo '<div class="cs-post-meta">';
    echo '<span class="cs-reading-time">' . cs_reading_time() . '</span>';
    echo '<span class="cs-post-views">' . sprintf(__('%s views', 'herocs'), cs_get_post_views()) . '</span>';
    echo '</div>';
}

/**
 * Get portfolio items query
 */
function cs_get_portfolio_query($args = array()) {
    $defaults = array(
        'post_type' => 'portfolio',
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => 'DESC',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    return new WP_Query($args);
}

/**
 * Get team members query
 */
function cs_get_team_query($args = array()) {
    $defaults = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'meta_key' => '_cs_team_order',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
    );
    
    $args = wp_parse_args($args, $defaults);
    
    return new WP_Query($args);
}

/**
 * SVG Icons sprite
 */
function cs_svg_icons() {
    ?>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="icon-facebook" viewBox="0 0 24 24" fill="currentColor">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </symbol>
        <symbol id="icon-twitter" viewBox="0 0 24 24" fill="currentColor">
            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
        </symbol>
        <symbol id="icon-linkedin" viewBox="0 0 24 24" fill="currentColor">
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
        </symbol>
        <symbol id="icon-instagram" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
        </symbol>
        <symbol id="icon-youtube" viewBox="0 0 24 24" fill="currentColor">
            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
        </symbol>
    </svg>
    <?php
}
add_action('wp_footer', 'cs_svg_icons');

/**
 * Get team member social links
 */
function cs_get_team_social($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return array(
        'linkedin' => get_post_meta($post_id, '_cs_team_linkedin', true),
        'twitter' => get_post_meta($post_id, '_cs_team_twitter', true),
        'email' => get_post_meta($post_id, '_cs_team_email', true),
    );
}