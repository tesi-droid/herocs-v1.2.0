<?php
/**
 * Custom Post Types Registration
 *
 * @package HeroCS
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
        'name' => _x('Portfolio', 'Post Type General Name', 'herocs'),
        'singular_name' => _x('Project', 'Post Type Singular Name', 'herocs'),
        'menu_name' => __('Portfolio', 'herocs'),
        'name_admin_bar' => __('Project', 'herocs'),
        'archives' => __('Project Archives', 'herocs'),
        'attributes' => __('Project Attributes', 'herocs'),
        'parent_item_colon' => __('Parent Project:', 'herocs'),
        'all_items' => __('All Projects', 'herocs'),
        'add_new_item' => __('Add New Project', 'herocs'),
        'add_new' => __('Add New', 'herocs'),
        'new_item' => __('New Project', 'herocs'),
        'edit_item' => __('Edit Project', 'herocs'),
        'update_item' => __('Update Project', 'herocs'),
        'view_item' => __('View Project', 'herocs'),
        'view_items' => __('View Projects', 'herocs'),
        'search_items' => __('Search Project', 'herocs'),
        'not_found' => __('Not found', 'herocs'),
        'not_found_in_trash' => __('Not found in Trash', 'herocs'),
        'featured_image' => __('Featured Image', 'herocs'),
        'set_featured_image' => __('Set featured image', 'herocs'),
        'remove_featured_image' => __('Remove featured image', 'herocs'),
        'use_featured_image' => __('Use as featured image', 'herocs'),
        'insert_into_item' => __('Insert into project', 'herocs'),
        'uploaded_to_this_item' => __('Uploaded to this project', 'herocs'),
        'items_list' => __('Projects list', 'herocs'),
        'items_list_navigation' => __('Projects list navigation', 'herocs'),
        'filter_items_list' => __('Filter projects list', 'herocs'),
    );
    
    $args = array(
        'label' => __('Project', 'herocs'),
        'description' => __('Portfolio projects and case studies', 'herocs'),
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
        'name' => _x('Project Categories', 'Taxonomy General Name', 'herocs'),
        'singular_name' => _x('Project Category', 'Taxonomy Singular Name', 'herocs'),
        'menu_name' => __('Categories', 'herocs'),
        'all_items' => __('All Categories', 'herocs'),
        'parent_item' => __('Parent Category', 'herocs'),
        'parent_item_colon' => __('Parent Category:', 'herocs'),
        'new_item_name' => __('New Category Name', 'herocs'),
        'add_new_item' => __('Add New Category', 'herocs'),
        'edit_item' => __('Edit Category', 'herocs'),
        'update_item' => __('Update Category', 'herocs'),
        'view_item' => __('View Category', 'herocs'),
        'separate_items_with_commas' => __('Separate categories with commas', 'herocs'),
        'add_or_remove_items' => __('Add or remove categories', 'herocs'),
        'choose_from_most_used' => __('Choose from the most used', 'herocs'),
        'popular_items' => __('Popular Categories', 'herocs'),
        'search_items' => __('Search Categories', 'herocs'),
        'not_found' => __('Not Found', 'herocs'),
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
        'name' => _x('Project Tags', 'Taxonomy General Name', 'herocs'),
        'singular_name' => _x('Project Tag', 'Taxonomy Singular Name', 'herocs'),
        'menu_name' => __('Tags', 'herocs'),
        'all_items' => __('All Tags', 'herocs'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'new_item_name' => __('New Tag Name', 'herocs'),
        'add_new_item' => __('Add New Tag', 'herocs'),
        'edit_item' => __('Edit Tag', 'herocs'),
        'update_item' => __('Update Tag', 'herocs'),
        'view_item' => __('View Tag', 'herocs'),
        'separate_items_with_commas' => __('Separate tags with commas', 'herocs'),
        'add_or_remove_items' => __('Add or remove tags', 'herocs'),
        'choose_from_most_used' => __('Choose from the most used', 'herocs'),
        'popular_items' => __('Popular Tags', 'herocs'),
        'search_items' => __('Search Tags', 'herocs'),
        'not_found' => __('Not Found', 'herocs'),
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
        'name' => _x('Project Years', 'Taxonomy General Name', 'herocs'),
        'singular_name' => _x('Project Year', 'Taxonomy Singular Name', 'herocs'),
        'menu_name' => __('Years', 'herocs'),
        'all_items' => __('All Years', 'herocs'),
        'new_item_name' => __('New Year', 'herocs'),
        'add_new_item' => __('Add New Year', 'herocs'),
        'edit_item' => __('Edit Year', 'herocs'),
        'update_item' => __('Update Year', 'herocs'),
        'view_item' => __('View Year', 'herocs'),
        'search_items' => __('Search Years', 'herocs'),
        'not_found' => __('Not Found', 'herocs'),
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
        'name' => _x('Team', 'Post Type General Name', 'herocs'),
        'singular_name' => _x('Team Member', 'Post Type Singular Name', 'herocs'),
        'menu_name' => __('Team', 'herocs'),
        'name_admin_bar' => __('Team Member', 'herocs'),
        'archives' => __('Team Archives', 'herocs'),
        'all_items' => __('All Team Members', 'herocs'),
        'add_new_item' => __('Add New Team Member', 'herocs'),
        'add_new' => __('Add New', 'herocs'),
        'new_item' => __('New Team Member', 'herocs'),
        'edit_item' => __('Edit Team Member', 'herocs'),
        'update_item' => __('Update Team Member', 'herocs'),
        'view_item' => __('View Team Member', 'herocs'),
        'view_items' => __('View Team Members', 'herocs'),
        'search_items' => __('Search Team Member', 'herocs'),
        'not_found' => __('Not found', 'herocs'),
        'not_found_in_trash' => __('Not found in Trash', 'herocs'),
    );
    
    $args = array(
        'label' => __('Team Member', 'herocs'),
        'description' => __('Team members and staff', 'herocs'),
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
        'name' => _x('Collaborazioni', 'Post Type General Name', 'herocs'),
        'singular_name' => _x('Collaborazione', 'Post Type Singular Name', 'herocs'),
        'menu_name' => __('Collaborazioni', 'herocs'),
        'name_admin_bar' => __('Collaborazione', 'herocs'),
        'archives' => __('Collaborazioni Archives', 'herocs'),
        'all_items' => __('Tutte le Collaborazioni', 'herocs'),
        'add_new_item' => __('Aggiungi Nuova Collaborazione', 'herocs'),
        'add_new' => __('Aggiungi Nuova', 'herocs'),
        'new_item' => __('Nuova Collaborazione', 'herocs'),
        'edit_item' => __('Modifica Collaborazione', 'herocs'),
        'update_item' => __('Aggiorna Collaborazione', 'herocs'),
        'view_item' => __('Visualizza Collaborazione', 'herocs'),
        'view_items' => __('Visualizza Collaborazioni', 'herocs'),
        'search_items' => __('Cerca Collaborazione', 'herocs'),
        'not_found' => __('Nessuna collaborazione trovata', 'herocs'),
        'not_found_in_trash' => __('Nessuna collaborazione nel cestino', 'herocs'),
    );
    
    $args = array(
        'label' => __('Collaborazione', 'herocs'),
        'description' => __('Clienti e collaborazioni', 'herocs'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'taxonomies' => array('tipologià_cliente'),
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
 * Register Tipologià Cliente Taxonomy
 */
function cs_register_tipologià_cliente_taxonomy() {
    $labels = array(
        'name' => _x('Tipologie Cliente', 'Taxonomy General Name', 'herocs'),
        'singular_name' => _x('Tipologià Cliente', 'Taxonomy Singular Name', 'herocs'),
        'menu_name' => __('Tipologie Cliente', 'herocs'),
        'all_items' => __('Tutte le Tipologie', 'herocs'),
        'new_item_name' => __('Nuova Tipologià', 'herocs'),
        'add_new_item' => __('Aggiungi Tipologià', 'herocs'),
        'edit_item' => __('Modifica Tipologià', 'herocs'),
        'update_item' => __('Aggiorna Tipologià', 'herocs'),
        'view_item' => __('Visualizza Tipologià', 'herocs'),
        'popular_items' => __('Tipologie Popolari', 'herocs'),
        'search_items' => __('Cerca Tipologie', 'herocs'),
        'not_found' => __('Nessuna tipologià trovata', 'herocs'),
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
        'rewrite' => array('slug' => 'tipologià-cliente'),
    );
    
    register_taxonomy('tipologià_cliente', array('collaborazioni'), $args);
    
    // Crea le tipologie predefinite se non esistono
    if (!term_exists('ETS', 'tipologià_cliente')) {
        wp_insert_term('ETS', 'tipologià_cliente', array('description' => 'Enti del Terzo Settore'));
    }
    if (!term_exists('Politici', 'tipologià_cliente')) {
        wp_insert_term('Politici', 'tipologià_cliente', array('description' => 'Politici e istituzioni'));
    }
    if (!term_exists('Partiti', 'tipologià_cliente')) {
        wp_insert_term('Partiti', 'tipologià_cliente', array('description' => 'Partiti politici'));
    }
    if (!term_exists('Benessere', 'tipologià_cliente')) {
        wp_insert_term('Benessere', 'tipologià_cliente', array('description' => 'Benessere e lifestyle'));
    }
    if (!term_exists('Salute', 'tipologià_cliente')) {
        wp_insert_term('Salute', 'tipologià_cliente', array('description' => 'Settore sanitario e salute'));
    }
    if (!term_exists('Aziende', 'tipologià_cliente')) {
        wp_insert_term('Aziende', 'tipologià_cliente', array('description' => 'Aziende private'));
    }
}
add_action('init', 'cs_register_tipologià_cliente_taxonomy', 0);

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
        'name' => _x('Categorie Press', 'Taxonomy General Name', 'herocs'),
        'singular_name' => _x('Categoria Press', 'Taxonomy Singular Name', 'herocs'),
        'menu_name' => __('Categorie', 'herocs'),
        'all_items' => __('Tutte le Categorie', 'herocs'),
        'new_item_name' => __('Nuova Categoria', 'herocs'),
        'add_new_item' => __('Aggiungi Categoria', 'herocs'),
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
    cs_register_tipologià_cliente_taxonomy();
    cs_register_press_post_type();
    cs_register_press_category_taxonomy();
    herocs_register_service_post_type();
    herocs_register_service_category_taxonomy();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'cs_rewrite_flush');