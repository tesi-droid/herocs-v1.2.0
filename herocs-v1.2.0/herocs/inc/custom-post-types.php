<?php
/**
 * Custom Post Types Registration
 *
 * @package CS_Communication
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Portfolio Custom Post Type
 */
function cs_register_portfolio_post_type() {
    $labels = array(
        'name' => _x('Portfolio', 'Post Type General Name', 'cs-communication'),
        'singular_name' => _x('Project', 'Post Type Singular Name', 'cs-communication'),
        'menu_name' => __('Portfolio', 'cs-communication'),
        'name_admin_bar' => __('Project', 'cs-communication'),
        'archives' => __('Project Archives', 'cs-communication'),
        'attributes' => __('Project Attributes', 'cs-communication'),
        'parent_item_colon' => __('Parent Project:', 'cs-communication'),
        'all_items' => __('All Projects', 'cs-communication'),
        'add_new_item' => __('Add New Project', 'cs-communication'),
        'add_new' => __('Add New', 'cs-communication'),
        'new_item' => __('New Project', 'cs-communication'),
        'edit_item' => __('Edit Project', 'cs-communication'),
        'update_item' => __('Update Project', 'cs-communication'),
        'view_item' => __('View Project', 'cs-communication'),
        'view_items' => __('View Projects', 'cs-communication'),
        'search_items' => __('Search Project', 'cs-communication'),
        'not_found' => __('Not found', 'cs-communication'),
        'not_found_in_trash' => __('Not found in Trash', 'cs-communication'),
        'featured_image' => __('Featured Image', 'cs-communication'),
        'set_featured_image' => __('Set featured image', 'cs-communication'),
        'remove_featured_image' => __('Remove featured image', 'cs-communication'),
        'use_featured_image' => __('Use as featured image', 'cs-communication'),
        'insert_into_item' => __('Insert into project', 'cs-communication'),
        'uploaded_to_this_item' => __('Uploaded to this project', 'cs-communication'),
        'items_list' => __('Projects list', 'cs-communication'),
        'items_list_navigation' => __('Projects list navigation', 'cs-communication'),
        'filter_items_list' => __('Filter projects list', 'cs-communication'),
    );
    
    $args = array(
        'label' => __('Project', 'cs-communication'),
        'description' => __('Portfolio projects and case studies', 'cs-communication'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes'),
        'taxonomies' => array('portfolio_category', 'portfolio_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'portfolio', 'with_front' => false),
    );
    
    register_post_type('portfolio', $args);
}
add_action('init', 'cs_register_portfolio_post_type', 0);

/**
 * Register Portfolio Taxonomies
 */
function cs_register_portfolio_taxonomies() {
    // Portfolio Category
    $category_labels = array(
        'name' => _x('Project Categories', 'Taxonomy General Name', 'cs-communication'),
        'singular_name' => _x('Project Category', 'Taxonomy Singular Name', 'cs-communication'),
        'menu_name' => __('Categories', 'cs-communication'),
        'all_items' => __('All Categories', 'cs-communication'),
        'parent_item' => __('Parent Category', 'cs-communication'),
        'parent_item_colon' => __('Parent Category:', 'cs-communication'),
        'new_item_name' => __('New Category Name', 'cs-communication'),
        'add_new_item' => __('Add New Category', 'cs-communication'),
        'edit_item' => __('Edit Category', 'cs-communication'),
        'update_item' => __('Update Category', 'cs-communication'),
        'view_item' => __('View Category', 'cs-communication'),
        'separate_items_with_commas' => __('Separate categories with commas', 'cs-communication'),
        'add_or_remove_items' => __('Add or remove categories', 'cs-communication'),
        'choose_from_most_used' => __('Choose from the most used', 'cs-communication'),
        'popular_items' => __('Popular Categories', 'cs-communication'),
        'search_items' => __('Search Categories', 'cs-communication'),
        'not_found' => __('Not Found', 'cs-communication'),
    );
    
    $category_args = array(
        'labels' => $category_labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'portfolio-category'),
    );
    
    register_taxonomy('portfolio_category', array('portfolio'), $category_args);
    
    // Portfolio Tags
    $tag_labels = array(
        'name' => _x('Project Tags', 'Taxonomy General Name', 'cs-communication'),
        'singular_name' => _x('Project Tag', 'Taxonomy Singular Name', 'cs-communication'),
        'menu_name' => __('Tags', 'cs-communication'),
        'all_items' => __('All Tags', 'cs-communication'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'new_item_name' => __('New Tag Name', 'cs-communication'),
        'add_new_item' => __('Add New Tag', 'cs-communication'),
        'edit_item' => __('Edit Tag', 'cs-communication'),
        'update_item' => __('Update Tag', 'cs-communication'),
        'view_item' => __('View Tag', 'cs-communication'),
        'separate_items_with_commas' => __('Separate tags with commas', 'cs-communication'),
        'add_or_remove_items' => __('Add or remove tags', 'cs-communication'),
        'choose_from_most_used' => __('Choose from the most used', 'cs-communication'),
        'popular_items' => __('Popular Tags', 'cs-communication'),
        'search_items' => __('Search Tags', 'cs-communication'),
        'not_found' => __('Not Found', 'cs-communication'),
    );
    
    $tag_args = array(
        'labels' => $tag_labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'portfolio-tag'),
    );
    
    register_taxonomy('portfolio_tag', array('portfolio'), $tag_args);
    
    // Portfolio Year (for filtering)
    $year_labels = array(
        'name' => _x('Project Years', 'Taxonomy General Name', 'cs-communication'),
        'singular_name' => _x('Project Year', 'Taxonomy Singular Name', 'cs-communication'),
        'menu_name' => __('Years', 'cs-communication'),
        'all_items' => __('All Years', 'cs-communication'),
        'new_item_name' => __('New Year', 'cs-communication'),
        'add_new_item' => __('Add New Year', 'cs-communication'),
        'edit_item' => __('Edit Year', 'cs-communication'),
        'update_item' => __('Update Year', 'cs-communication'),
        'view_item' => __('View Year', 'cs-communication'),
        'search_items' => __('Search Years', 'cs-communication'),
        'not_found' => __('Not Found', 'cs-communication'),
    );
    
    $year_args = array(
        'labels' => $year_labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => false,
        'show_tagcloud' => false,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'year'),
    );
    
    register_taxonomy('portfolio_year', array('portfolio'), $year_args);
}
add_action('init', 'cs_register_portfolio_taxonomies', 0);

/**
 * Register Team Custom Post Type
 */
function cs_register_team_post_type() {
    $labels = array(
        'name' => _x('Team', 'Post Type General Name', 'cs-communication'),
        'singular_name' => _x('Team Member', 'Post Type Singular Name', 'cs-communication'),
        'menu_name' => __('Team', 'cs-communication'),
        'name_admin_bar' => __('Team Member', 'cs-communication'),
        'archives' => __('Team Archives', 'cs-communication'),
        'all_items' => __('All Team Members', 'cs-communication'),
        'add_new_item' => __('Add New Team Member', 'cs-communication'),
        'add_new' => __('Add New', 'cs-communication'),
        'new_item' => __('New Team Member', 'cs-communication'),
        'edit_item' => __('Edit Team Member', 'cs-communication'),
        'update_item' => __('Update Team Member', 'cs-communication'),
        'view_item' => __('View Team Member', 'cs-communication'),
        'view_items' => __('View Team Members', 'cs-communication'),
        'search_items' => __('Search Team Member', 'cs-communication'),
        'not_found' => __('Not found', 'cs-communication'),
        'not_found_in_trash' => __('Not found in Trash', 'cs-communication'),
    );
    
    $args = array(
        'label' => __('Team Member', 'cs-communication'),
        'description' => __('Team members and staff', 'cs-communication'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-groups',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'team', 'with_front' => false),
    );
    
    register_post_type('team', $args);
}
add_action('init', 'cs_register_team_post_type', 0);

/**
 * Register Collaborazioni Custom Post Type
 */
function cs_register_collaborazioni_post_type() {
    $labels = array(
        'name' => _x('Collaborazioni', 'Post Type General Name', 'cs-communication'),
        'singular_name' => _x('Collaborazione', 'Post Type Singular Name', 'cs-communication'),
        'menu_name' => __('Collaborazioni', 'cs-communication'),
        'name_admin_bar' => __('Collaborazione', 'cs-communication'),
        'archives' => __('Collaborazioni Archives', 'cs-communication'),
        'all_items' => __('Tutte le Collaborazioni', 'cs-communication'),
        'add_new_item' => __('Aggiungi Nuova Collaborazione', 'cs-communication'),
        'add_new' => __('Aggiungi Nuova', 'cs-communication'),
        'new_item' => __('Nuova Collaborazione', 'cs-communication'),
        'edit_item' => __('Modifica Collaborazione', 'cs-communication'),
        'update_item' => __('Aggiorna Collaborazione', 'cs-communication'),
        'view_item' => __('Visualizza Collaborazione', 'cs-communication'),
        'view_items' => __('Visualizza Collaborazioni', 'cs-communication'),
        'search_items' => __('Cerca Collaborazione', 'cs-communication'),
        'not_found' => __('Nessuna collaborazione trovata', 'cs-communication'),
        'not_found_in_trash' => __('Nessuna collaborazione nel cestino', 'cs-communication'),
    );
    
    $args = array(
        'label' => __('Collaborazione', 'cs-communication'),
        'description' => __('Clienti e collaborazioni', 'cs-communication'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'taxonomies' => array('tipologia_cliente'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-businessperson',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'collaborazioni', 'with_front' => false),
    );
    
    register_post_type('collaborazioni', $args);
}
add_action('init', 'cs_register_collaborazioni_post_type', 0);

/**
 * Register Tipologia Cliente Taxonomy
 */
function cs_register_tipologia_cliente_taxonomy() {
    $labels = array(
        'name' => _x('Tipologie Cliente', 'Taxonomy General Name', 'cs-communication'),
        'singular_name' => _x('Tipologia Cliente', 'Taxonomy Singular Name', 'cs-communication'),
        'menu_name' => __('Tipologie Cliente', 'cs-communication'),
        'all_items' => __('Tutte le Tipologie', 'cs-communication'),
        'new_item_name' => __('Nuova Tipologia', 'cs-communication'),
        'add_new_item' => __('Aggiungi Tipologia', 'cs-communication'),
        'edit_item' => __('Modifica Tipologia', 'cs-communication'),
        'update_item' => __('Aggiorna Tipologia', 'cs-communication'),
        'view_item' => __('Visualizza Tipologia', 'cs-communication'),
        'popular_items' => __('Tipologie Popolari', 'cs-communication'),
        'search_items' => __('Cerca Tipologie', 'cs-communication'),
        'not_found' => __('Nessuna tipologia trovata', 'cs-communication'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'tipologia-cliente'),
    );
    
    register_taxonomy('tipologia_cliente', array('collaborazioni'), $args);
    
    // Crea le tipologie predefinite se non esistono
    if (!term_exists('ETS', 'tipologia_cliente')) {
        wp_insert_term('ETS', 'tipologia_cliente', array('description' => 'Enti del Terzo Settore'));
    }
    if (!term_exists('Politici', 'tipologia_cliente')) {
        wp_insert_term('Politici', 'tipologia_cliente', array('description' => 'Politici e istituzioni'));
    }
    if (!term_exists('Partiti', 'tipologia_cliente')) {
        wp_insert_term('Partiti', 'tipologia_cliente', array('description' => 'Partiti politici'));
    }
    if (!term_exists('Benessere', 'tipologia_cliente')) {
        wp_insert_term('Benessere', 'tipologia_cliente', array('description' => 'Benessere e lifestyle'));
    }
    if (!term_exists('Salute', 'tipologia_cliente')) {
        wp_insert_term('Salute', 'tipologia_cliente', array('description' => 'Settore sanitario e salute'));
    }
    if (!term_exists('Aziende', 'tipologia_cliente')) {
        wp_insert_term('Aziende', 'tipologia_cliente', array('description' => 'Aziende private'));
    }
}
add_action('init', 'cs_register_tipologia_cliente_taxonomy', 0);

/**
 * Register Press Custom Post Type
 */
function cs_register_press_post_type() {
    $labels = array(
        'name' => _x('Press', 'Post Type General Name', 'herocs'),
        'singular_name' => _x('Articolo Press', 'Post Type Singular Name', 'herocs'),
        'menu_name' => __('Press', 'herocs'),
        'name_admin_bar' => __('Articolo Press', 'herocs'),
        'archives' => __('Press Room', 'herocs'),
        'all_items' => __('Tutti gli Articoli', 'herocs'),
        'add_new_item' => __('Aggiungi Nuovo Articolo', 'herocs'),
        'add_new' => __('Aggiungi Nuovo', 'herocs'),
        'new_item' => __('Nuovo Articolo', 'herocs'),
        'edit_item' => __('Modifica Articolo', 'herocs'),
        'update_item' => __('Aggiorna Articolo', 'herocs'),
        'view_item' => __('Visualizza Articolo', 'herocs'),
        'view_items' => __('Visualizza Articoli', 'herocs'),
        'search_items' => __('Cerca Articolo', 'herocs'),
        'not_found' => __('Nessun articolo trovato', 'herocs'),
        'not_found_in_trash' => __('Nessun articolo nel cestino', 'herocs'),
        'featured_image' => __('Immagine in Evidenza', 'herocs'),
        'set_featured_image' => __('Imposta immagine in evidenza', 'herocs'),
        'remove_featured_image' => __('Rimuovi immagine in evidenza', 'herocs'),
        'use_featured_image' => __('Usa come immagine in evidenza', 'herocs'),
    );
    
    $args = array(
        'label' => __('Press', 'herocs'),
        'description' => __('Rassegna stampa e pubblicazioni', 'herocs'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'author'),
        'taxonomies' => array('press_category'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-newspaper',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => 'press-room',
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'press', 'with_front' => false),
    );
    
    register_post_type('press', $args);
}
add_action('init', 'cs_register_press_post_type', 0);

/**
 * Register Press Category Taxonomy
 */
function cs_register_press_category_taxonomy() {
    $labels = array(
        'name' => _x('Categorie Press', 'Taxonomy General Name', 'cs-communication'),
        'singular_name' => _x('Categoria Press', 'Taxonomy Singular Name', 'cs-communication'),
        'menu_name' => __('Categorie', 'cs-communication'),
        'all_items' => __('Tutte le Categorie', 'cs-communication'),
        'new_item_name' => __('Nuova Categoria', 'cs-communication'),
        'add_new_item' => __('Aggiungi Categoria', 'cs-communication'),
        'edit_item' => __('Modifica Categoria', 'cs-communication'),
        'update_item' => __('Aggiorna Categoria', 'cs-communication'),
        'view_item' => __('Visualizza Categoria', 'cs-communication'),
        'popular_items' => __('Categorie Popolari', 'cs-communication'),
        'search_items' => __('Cerca Categorie', 'cs-communication'),
        'not_found' => __('Nessuna categoria trovata', 'cs-communication'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'press-category'),
    );
    
    register_taxonomy('press_category', array('press'), $args);
}
add_action('init', 'cs_register_press_category_taxonomy', 0);

// ============================================================================
// SERVICES CUSTOM POST TYPE
// ============================================================================

/**
 * Register Services Custom Post Type
 */
function herocs_register_service_post_type() {
    $labels = array(
        'name' => _x('Servizi', 'Post Type General Name', 'herocs'),
        'singular_name' => _x('Servizio', 'Post Type Singular Name', 'herocs'),
        'menu_name' => __('Servizi', 'herocs'),
        'name_admin_bar' => __('Servizio', 'herocs'),
        'archives' => __('Archivio Servizi', 'herocs'),
        'attributes' => __('Attributi Servizio', 'herocs'),
        'parent_item_colon' => __('Servizio Genitore:', 'herocs'),
        'all_items' => __('Tutti i Servizi', 'herocs'),
        'add_new_item' => __('Aggiungi Nuovo Servizio', 'herocs'),
        'add_new' => __('Aggiungi Nuovo', 'herocs'),
        'new_item' => __('Nuovo Servizio', 'herocs'),
        'edit_item' => __('Modifica Servizio', 'herocs'),
        'update_item' => __('Aggiorna Servizio', 'herocs'),
        'view_item' => __('Visualizza Servizio', 'herocs'),
        'view_items' => __('Visualizza Servizi', 'herocs'),
        'search_items' => __('Cerca Servizio', 'herocs'),
        'not_found' => __('Nessun servizio trovato', 'herocs'),
        'not_found_in_trash' => __('Nessun servizio nel cestino', 'herocs'),
        'featured_image' => __('Immagine Servizio', 'herocs'),
        'set_featured_image' => __('Imposta immagine servizio', 'herocs'),
        'remove_featured_image' => __('Rimuovi immagine servizio', 'herocs'),
        'use_featured_image' => __('Usa come immagine servizio', 'herocs'),
        'insert_into_item' => __('Inserisci nel servizio', 'herocs'),
        'uploaded_to_this_item' => __('Caricato per questo servizio', 'herocs'),
        'items_list' => __('Lista servizi', 'herocs'),
        'items_list_navigation' => __('Navigazione lista servizi', 'herocs'),
        'filter_items_list' => __('Filtra lista servizi', 'herocs'),
    );
    
    $args = array(
        'label' => __('Servizio', 'herocs'),
        'description' => __('I servizi offerti dall\'agenzia', 'herocs'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'menu_icon' => 'dashicons-clipboard',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => 'servizi',
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'servizio', 'with_front' => false),
    );
    
    register_post_type('service', $args);
}
add_action('init', 'herocs_register_service_post_type', 0);

/**
 * Register Service Category Taxonomy
 */
function herocs_register_service_category_taxonomy() {
    $labels = array(
        'name' => _x('Categorie Servizi', 'Taxonomy General Name', 'herocs'),
        'singular_name' => _x('Categoria Servizio', 'Taxonomy Singular Name', 'herocs'),
        'menu_name' => __('Categorie', 'herocs'),
        'all_items' => __('Tutte le Categorie', 'herocs'),
        'parent_item' => __('Categoria Genitore', 'herocs'),
        'parent_item_colon' => __('Categoria Genitore:', 'herocs'),
        'new_item_name' => __('Nome Nuova Categoria', 'herocs'),
        'add_new_item' => __('Aggiungi Nuova Categoria', 'herocs'),
        'edit_item' => __('Modifica Categoria', 'herocs'),
        'update_item' => __('Aggiorna Categoria', 'herocs'),
        'view_item' => __('Visualizza Categoria', 'herocs'),
        'popular_items' => __('Categorie Popolari', 'herocs'),
        'search_items' => __('Cerca Categorie', 'herocs'),
        'not_found' => __('Nessuna categoria trovata', 'herocs'),
    );
    
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => false,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'categoria-servizio'),
    );
    
    register_taxonomy('service_category', array('service'), $args);
}
add_action('init', 'herocs_register_service_category_taxonomy', 0);

/**
 * Flush rewrite rules on theme activation
 */
function cs_rewrite_flush() {
    cs_register_portfolio_post_type();
    cs_register_portfolio_taxonomies();
    cs_register_team_post_type();
    cs_register_collaborazioni_post_type();
    cs_register_tipologia_cliente_taxonomy();
    cs_register_press_post_type();
    cs_register_press_category_taxonomy();
    herocs_register_service_post_type();
    herocs_register_service_category_taxonomy();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'cs_rewrite_flush');