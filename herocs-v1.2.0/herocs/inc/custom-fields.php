<?php
/**
 * Custom Fields & Meta Boxes
 *
 * @package CS_Communication
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Portfolio Meta Boxes
 */
function cs_add_portfolio_meta_boxes() {
    add_meta_box(
        'cs_portfolio_details',
        __('Project Details', 'cs-communication'),
        'cs_portfolio_details_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cs_add_portfolio_meta_boxes');

/**
 * Portfolio Details Meta Box Callback
 */
function cs_portfolio_details_callback($post) {
    wp_nonce_field('cs_portfolio_meta_box', 'cs_portfolio_meta_box_nonce');
    
    $client = get_post_meta($post->ID, '_cs_portfolio_client', true);
    $project_date = get_post_meta($post->ID, '_cs_portfolio_date', true);
    $role = get_post_meta($post->ID, '_cs_portfolio_role', true);
    $results = get_post_meta($post->ID, '_cs_portfolio_results', true);
    $project_url = get_post_meta($post->ID, '_cs_portfolio_url', true);
    $testimonial = get_post_meta($post->ID, '_cs_portfolio_testimonial', true);
    $testimonial_author = get_post_meta($post->ID, '_cs_portfolio_testimonial_author', true);
    ?>
    <div class="cs-meta-box">
        <p>
            <label for="cs_portfolio_client"><strong><?php esc_html_e('Client Name', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_portfolio_client" name="cs_portfolio_client" value="<?php echo esc_attr($client); ?>" class="widefat" />
        </p>
        
        <p>
            <label for="cs_portfolio_date"><strong><?php esc_html_e('Project Date', 'cs-communication'); ?></strong></label><br>
            <input type="date" id="cs_portfolio_date" name="cs_portfolio_date" value="<?php echo esc_attr($project_date); ?>" class="widefat" />
        </p>
        
        <p>
            <label for="cs_portfolio_role"><strong><?php esc_html_e('Our Role', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_portfolio_role" name="cs_portfolio_role" value="<?php echo esc_attr($role); ?>" class="widefat" placeholder="<?php esc_attr_e('e.g., Branding, Web Design, Social Media', 'cs-communication'); ?>" />
        </p>
        
        <p>
            <label for="cs_portfolio_url"><strong><?php esc_html_e('Project URL', 'cs-communication'); ?></strong></label><br>
            <input type="url" id="cs_portfolio_url" name="cs_portfolio_url" value="<?php echo esc_url($project_url); ?>" class="widefat" placeholder="https://" />
        </p>
        
        <p>
            <label for="cs_portfolio_results"><strong><?php esc_html_e('Results & Achievements', 'cs-communication'); ?></strong></label><br>
            <textarea id="cs_portfolio_results" name="cs_portfolio_results" rows="4" class="widefat"><?php echo esc_textarea($results); ?></textarea>
            <span class="description"><?php esc_html_e('Key metrics, achievements, or outcomes of the project', 'cs-communication'); ?></span>
        </p>
        
        <p>
            <label for="cs_portfolio_testimonial"><strong><?php esc_html_e('Client Testimonial', 'cs-communication'); ?></strong></label><br>
            <textarea id="cs_portfolio_testimonial" name="cs_portfolio_testimonial" rows="3" class="widefat"><?php echo esc_textarea($testimonial); ?></textarea>
        </p>
        
        <p>
            <label for="cs_portfolio_testimonial_author"><strong><?php esc_html_e('Testimonial Author', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_portfolio_testimonial_author" name="cs_portfolio_testimonial_author" value="<?php echo esc_attr($testimonial_author); ?>" class="widefat" placeholder="<?php esc_attr_e('e.g., John Doe, CEO at Company', 'cs-communication'); ?>" />
        </p>
    </div>
    <style>
        .cs-meta-box p { margin-bottom: 15px; }
        .cs-meta-box label { display: block; margin-bottom: 5px; }
        .cs-meta-box .description { font-style: italic; color: #666; font-size: 12px; }
    </style>
    <?php
}

/**
 * Save Portfolio Meta Box Data
 */
function cs_save_portfolio_meta_box_data($post_id) {
    // Check nonce
    if (!isset($_POST['cs_portfolio_meta_box_nonce']) || !wp_verify_nonce($_POST['cs_portfolio_meta_box_nonce'], 'cs_portfolio_meta_box')) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save fields
    $fields = array(
        'cs_portfolio_client' => 'sanitize_text_field',
        'cs_portfolio_date' => 'sanitize_text_field',
        'cs_portfolio_role' => 'sanitize_text_field',
        'cs_portfolio_url' => 'esc_url_raw',
        'cs_portfolio_results' => 'sanitize_textarea_field',
        'cs_portfolio_testimonial' => 'sanitize_textarea_field',
        'cs_portfolio_testimonial_author' => 'sanitize_text_field',
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, call_user_func($sanitize_function, $_POST[$field]));
        }
    }
}
add_action('save_post_portfolio', 'cs_save_portfolio_meta_box_data');

/**
 * Register Team Meta Boxes
 */
function cs_add_team_meta_boxes() {
    add_meta_box(
        'cs_team_details',
        __('Team Member Details', 'cs-communication'),
        'cs_team_details_callback',
        'team',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cs_add_team_meta_boxes');

/**
 * Team Details Meta Box Callback
 */
function cs_team_details_callback($post) {
    wp_nonce_field('cs_team_meta_box', 'cs_team_meta_box_nonce');
    
    $position = get_post_meta($post->ID, '_cs_team_position', true);
    $bio = get_post_meta($post->ID, '_cs_team_bio', true);
    $email = get_post_meta($post->ID, '_cs_team_email', true);
    $phone = get_post_meta($post->ID, '_cs_team_phone', true);
    $linkedin = get_post_meta($post->ID, '_cs_team_linkedin', true);
    $twitter = get_post_meta($post->ID, '_cs_team_twitter', true);
    $order = get_post_meta($post->ID, '_cs_team_order', true);
    ?>
    <div class="cs-meta-box">
        <p>
            <label for="cs_team_position"><strong><?php esc_html_e('Position/Role', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_team_position" name="cs_team_position" value="<?php echo esc_attr($position); ?>" class="widefat" placeholder="<?php esc_attr_e('e.g., Creative Director', 'cs-communication'); ?>" />
        </p>
        
        <p>
            <label for="cs_team_bio"><strong><?php esc_html_e('Short Bio', 'cs-communication'); ?></strong></label><br>
            <textarea id="cs_team_bio" name="cs_team_bio" rows="4" class="widefat"><?php echo esc_textarea($bio); ?></textarea>
            <span class="description"><?php esc_html_e('Brief biography or description (2-3 sentences)', 'cs-communication'); ?></span>
        </p>
        
        <p>
            <label for="cs_team_email"><strong><?php esc_html_e('Email Address', 'cs-communication'); ?></strong></label><br>
            <input type="email" id="cs_team_email" name="cs_team_email" value="<?php echo esc_attr($email); ?>" class="widefat" />
        </p>
        
        <p>
            <label for="cs_team_phone"><strong><?php esc_html_e('Phone Number', 'cs-communication'); ?></strong></label><br>
            <input type="tel" id="cs_team_phone" name="cs_team_phone" value="<?php echo esc_attr($phone); ?>" class="widefat" />
        </p>
        
        <p>
            <label for="cs_team_linkedin"><strong><?php esc_html_e('LinkedIn URL', 'cs-communication'); ?></strong></label><br>
            <input type="url" id="cs_team_linkedin" name="cs_team_linkedin" value="<?php echo esc_url($linkedin); ?>" class="widefat" placeholder="https://linkedin.com/in/username" />
        </p>
        
        <p>
            <label for="cs_team_twitter"><strong><?php esc_html_e('Twitter/X URL', 'cs-communication'); ?></strong></label><br>
            <input type="url" id="cs_team_twitter" name="cs_team_twitter" value="<?php echo esc_url($twitter); ?>" class="widefat" placeholder="https://twitter.com/username" />
        </p>
        
        <p>
            <label for="cs_team_order"><strong><?php esc_html_e('Display Order', 'cs-communication'); ?></strong></label><br>
            <input type="number" id="cs_team_order" name="cs_team_order" value="<?php echo esc_attr($order); ?>" class="small-text" min="0" />
            <span class="description"><?php esc_html_e('Lower numbers appear first', 'cs-communication'); ?></span>
        </p>
    </div>
    <?php
}

/**
 * Save Team Meta Box Data
 */
function cs_save_team_meta_box_data($post_id) {
    // Check nonce
    if (!isset($_POST['cs_team_meta_box_nonce']) || !wp_verify_nonce($_POST['cs_team_meta_box_nonce'], 'cs_team_meta_box')) {
        return;
    }
    
    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save fields
    $fields = array(
        'cs_team_position' => 'sanitize_text_field',
        'cs_team_bio' => 'sanitize_textarea_field',
        'cs_team_email' => 'sanitize_email',
        'cs_team_phone' => 'sanitize_text_field',
        'cs_team_linkedin' => 'esc_url_raw',
        'cs_team_twitter' => 'esc_url_raw',
        'cs_team_order' => 'absint',
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, call_user_func($sanitize_function, $_POST[$field]));
        }
    }
}
add_action('save_post_team', 'cs_save_team_meta_box_data');

/**
 * Helper functions to get custom field values
 */

// Get portfolio client
function cs_get_portfolio_client($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_portfolio_client', true);
}

// Get portfolio date
function cs_get_portfolio_date($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_portfolio_date', true);
}

// Get portfolio role
function cs_get_portfolio_role($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_portfolio_role', true);
}

// Get portfolio URL
function cs_get_portfolio_url($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_portfolio_url', true);
}

// Get portfolio results
function cs_get_portfolio_results($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_portfolio_results', true);
}

// Get portfolio testimonial
function cs_get_portfolio_testimonial($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return array(
        'quote' => get_post_meta($post_id, '_cs_portfolio_testimonial', true),
        'author' => get_post_meta($post_id, '_cs_portfolio_testimonial_author', true),
    );
}

// Get team position
function cs_get_team_position($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_team_position', true);
}

// Get team bio
function cs_get_team_bio($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_team_bio', true);
}

// Get team email
function cs_get_team_email($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_team_email', true);
}

// Get team phone
function cs_get_team_phone($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_team_phone', true);
}

/**
 * Register Collaborazioni Meta Boxes
 */
function cs_add_collaborazioni_meta_boxes() {
    add_meta_box(
        'cs_collaborazioni_details',
        __('Dettagli Collaborazione', 'cs-communication'),
        'cs_collaborazioni_details_callback',
        'collaborazioni',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cs_add_collaborazioni_meta_boxes');

/**
 * Collaborazioni Details Meta Box Callback
 */
function cs_collaborazioni_details_callback($post) {
    wp_nonce_field('cs_collaborazioni_meta_box', 'cs_collaborazioni_meta_box_nonce');
    $tipo = get_post_meta($post->ID, '_cs_collab_tipo', true);
    $logo = get_post_meta($post->ID, '_cs_collab_logo', true);
    $website = get_post_meta($post->ID, '_cs_collab_website', true);
    $anno = get_post_meta($post->ID, '_cs_collab_anno', true);
    $settore = get_post_meta($post->ID, '_cs_collab_settore', true);
    $servizi = get_post_meta($post->ID, '_cs_collab_servizi', true);
    $risultati = get_post_meta($post->ID, '_cs_collab_risultati', true);
    ?>
    <div class="cs-meta-box">
        <p>
            <label for="cs_collab_logo"><strong><?php esc_html_e('Logo Cliente (URL)', 'cs-communication'); ?></strong></label><br>
            <input type="url" id="cs_collab_logo" name="cs_collab_logo" value="<?php echo esc_url($logo); ?>" class="widefat" placeholder="https://esempio.com/logo.png" />
            <span class="description"><?php esc_html_e('URL del logo del cliente (opzionale, usa Featured Image se preferisci)', 'cs-communication'); ?></span>
        </p>
        
        <p>
            <label for="cs_collab_website"><strong><?php esc_html_e('Sito Web Cliente', 'cs-communication'); ?></strong></label><br>
            <input type="url" id="cs_collab_website" name="cs_collab_website" value="<?php echo esc_url($website); ?>" class="widefat" placeholder="https://cliente.com" />
        </p>
        
        <p>
            <label for="cs_collab_anno"><strong><?php esc_html_e('Anno Collaborazione', 'cs-communication'); ?></strong></label><br>
            <input type="number" id="cs_collab_anno" name="cs_collab_anno" value="<?php echo esc_attr($anno); ?>" min="2000" max="2030" placeholder="<?php echo date('Y'); ?>" />
        </p>
        
        <p>
            <label for="cs_collab_settore"><strong><?php esc_html_e('Settore/Ambito', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_collab_settore" name="cs_collab_settore" value="<?php echo esc_attr($settore); ?>" class="widefat" placeholder="<?php esc_attr_e('es: Comunicazione politica, Marketing sociale, ecc.', 'cs-communication'); ?>" />
        </p>
        
        <p>
            <label for="cs_collab_servizi"><strong><?php esc_html_e('Servizi Forniti', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_collab_servizi" name="cs_collab_servizi" value="<?php echo esc_attr($servizi); ?>" class="widefat" placeholder="<?php esc_attr_e('es: Branding, Social Media, Campagna Elettorale', 'cs-communication'); ?>" />
            <span class="description"><?php esc_html_e('Separa i servizi con virgole', 'cs-communication'); ?></span>
        </p>
        
        <p>
            <label for="cs_collab_tipo"><strong><?php esc_html_e('Tipologia', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_collab_tipo" name="cs_collab_tipo" value="<?php echo esc_attr($tipo); ?>" class="widefat" placeholder="<?php esc_attr_e('es: Partner, Cliente, Collaboratore', 'cs-communication'); ?>" />
            <span class="description"><?php esc_html_e('Campo opzionale per classificare il tipo di collaborazione', 'cs-communication'); ?></span>
        </p>
        
        <p>
            <label for="cs_collab_risultati"><strong><?php esc_html_e('Risultati / Highlights', 'cs-communication'); ?></strong></label><br>
            <textarea id="cs_collab_risultati" name="cs_collab_risultati" rows="4" class="widefat"><?php echo esc_textarea($risultati); ?></textarea>
            <span class="description"><?php esc_html_e('Breve descrizione dei risultati ottenuti', 'cs-communication'); ?></span>
        </p>
    </div>
    <?php
}

/**
 * Save Collaborazioni Meta Box Data
 */
function cs_save_collaborazioni_meta_box_data($post_id) {
    if (!isset($_POST['cs_collaborazioni_meta_box_nonce']) || !wp_verify_nonce($_POST['cs_collaborazioni_meta_box_nonce'], 'cs_collaborazioni_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'cs_collab_logo' => 'esc_url_raw',
        'cs_collab_website' => 'esc_url_raw',
        'cs_collab_anno' => 'absint',
        'cs_collab_settore' => 'sanitize_text_field',
        'cs_collab_servizi' => 'sanitize_text_field',
        'cs_collab_risultati' => 'sanitize_textarea_field',
        'cs_collab_tipo' => 'sanitize_text_field',
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, call_user_func($sanitize_function, $_POST[$field]));
        }
    }
}
add_action('save_post_collaborazioni', 'cs_save_collaborazioni_meta_box_data');

/**
 * Register Press Meta Boxes
 */
function cs_add_press_meta_boxes() {
    add_meta_box(
        'cs_press_details',
        __('Dettagli Pubblicazione', 'cs-communication'),
        'cs_press_details_callback',
        'press',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cs_add_press_meta_boxes');

/**
 * Press Details Meta Box Callback
 */
function cs_press_details_callback($post) {
    wp_nonce_field('cs_press_meta_box', 'cs_press_meta_box_nonce');
    
    $testata = get_post_meta($post->ID, '_cs_press_testata', true);
    $autore = get_post_meta($post->ID, '_cs_press_autore', true);
    $data_pub = get_post_meta($post->ID, '_cs_press_data', true);
    $link = get_post_meta($post->ID, '_cs_press_link', true);
    $pdf = get_post_meta($post->ID, '_cs_press_pdf', true);
    $tipo = get_post_meta($post->ID, '_cs_press_tipo', true);
    ?>
    <div class="cs-meta-box">
        <p>
            <label for="cs_press_testata"><strong><?php esc_html_e('Testata Giornalistica', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_press_testata" name="cs_press_testata" value="<?php echo esc_attr($testata); ?>" class="widefat" placeholder="<?php esc_attr_e('es: La Repubblica, Corriere della Sera, ecc.', 'cs-communication'); ?>" />
        </p>
        
        <p>
            <label for="cs_press_autore"><strong><?php esc_html_e('Autore Articolo', 'cs-communication'); ?></strong></label><br>
            <input type="text" id="cs_press_autore" name="cs_press_autore" value="<?php echo esc_attr($autore); ?>" class="widefat" />
        </p>
        
        <p>
            <label for="cs_press_data"><strong><?php esc_html_e('Data Pubblicazione', 'cs-communication'); ?></strong></label><br>
            <input type="date" id="cs_press_data" name="cs_press_data" value="<?php echo esc_attr($data_pub); ?>" />
        </p>
        
        <p>
            <label for="cs_press_tipo"><strong><?php esc_html_e('Tipo Pubblicazione', 'cs-communication'); ?></strong></label><br>
            <select id="cs_press_tipo" name="cs_press_tipo" class="widefat">
                <option value="articolo" <?php selected($tipo, 'articolo'); ?>><?php esc_html_e('Articolo', 'cs-communication'); ?></option>
                <option value="intervista" <?php selected($tipo, 'intervista'); ?>><?php esc_html_e('Intervista', 'cs-communication'); ?></option>
                <option value="case-study" <?php selected($tipo, 'case-study'); ?>><?php esc_html_e('Case Study', 'cs-communication'); ?></option>
                <option value="comunicato" <?php selected($tipo, 'comunicato'); ?>><?php esc_html_e('Comunicato Stampa', 'cs-communication'); ?></option>
                <option value="video" <?php selected($tipo, 'video'); ?>><?php esc_html_e('Video/TV', 'cs-communication'); ?></option>
            </select>
        </p>
        
        <p>
            <label for="cs_press_link"><strong><?php esc_html_e('Link Articolo Online', 'cs-communication'); ?></strong></label><br>
            <input type="url" id="cs_press_link" name="cs_press_link" value="<?php echo esc_url($link); ?>" class="widefat" placeholder="https://" />
        </p>
        
        <p>
            <label for="cs_press_pdf"><strong><?php esc_html_e('PDF Articolo (URL)', 'cs-communication'); ?></strong></label><br>
            <input type="url" id="cs_press_pdf" name="cs_press_pdf" value="<?php echo esc_url($pdf); ?>" class="widefat" placeholder="https://esempio.com/articolo.pdf" />
            <span class="description"><?php esc_html_e('Carica il PDF nella libreria media e incolla l\'URL qui', 'cs-communication'); ?></span>
        </p>
    </div>
    <?php
}

/**
 * Save Press Meta Box Data
 */
function cs_save_press_meta_box_data($post_id) {
    if (!isset($_POST['cs_press_meta_box_nonce']) || !wp_verify_nonce($_POST['cs_press_meta_box_nonce'], 'cs_press_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'cs_press_testata' => 'sanitize_text_field',
        'cs_press_autore' => 'sanitize_text_field',
        'cs_press_data' => 'sanitize_text_field',
        'cs_press_link' => 'esc_url_raw',
        'cs_press_pdf' => 'esc_url_raw',
        'cs_press_tipo' => 'sanitize_text_field',
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, call_user_func($sanitize_function, $_POST[$field]));
        }
    }
}
add_action('save_post_press', 'cs_save_press_meta_box_data');

// === HELPER FUNCTIONS PER I NUOVI CPT ===

/**
 * Get Collaborazione custom fields
 */
function cs_get_collab_logo($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_collab_logo', true);
}

function cs_get_collab_website($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_collab_website', true);
}

function cs_get_collab_anno($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_collab_anno', true);
}

function cs_get_collab_servizi($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_collab_servizi', true);
}

/**
 * Get Press custom fields
 */
function cs_get_press_testata($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_press_testata', true);
}

function cs_get_press_data($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_press_data', true);
}

function cs_get_press_link($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_press_link', true);
}

function cs_get_press_pdf($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_press_pdf', true);
}

function cs_get_press_tipo($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_cs_press_tipo', true);
}

// ============================================================================
// ACF FIELD GROUPS - Hero Slider Settings
// ============================================================================

/**
 * Register ACF Field Group for Hero Slider
 * Richiede il plugin ACF PRO per i campi Repeater
 */
function herocs_register_acf_hero_slider_fields() {
    
    // Verifica che ACF sia attivo
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    acf_add_local_field_group(array(
        'key' => 'group_hero_slider_settings',
        'title' => 'Hero Slider Settings',
        'fields' => array(
            // Abilita Hero Slider
            array(
                'key' => 'field_hero_slider_enable',
                'label' => 'Abilita Hero Slider',
                'name' => 'hero_slider_enable',
                'type' => 'true_false',
                'instructions' => 'Attiva lo slider hero animato in homepage',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Attivo',
                'ui_off_text' => 'Disattivo',
            ),
            // Autoplay Speed
            array(
                'key' => 'field_hero_slider_speed',
                'label' => 'Velocita Autoplay (ms)',
                'name' => 'hero_slider_speed',
                'type' => 'number',
                'instructions' => 'Tempo tra uno slide e l\'altro in millisecondi (default: 5000)',
                'default_value' => 5000,
                'min' => 3000,
                'max' => 15000,
                'step' => 500,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_hero_slider_enable',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            // Effetto transizione
            array(
                'key' => 'field_hero_slider_effect',
                'label' => 'Effetto Transizione',
                'name' => 'hero_slider_effect',
                'type' => 'select',
                'instructions' => 'Scegli l\'effetto di transizione tra le slide',
                'choices' => array(
                    'fade' => 'Fade (Dissolvenza)',
                    'slide' => 'Slide (Scorrimento)',
                    'cube' => 'Cube (Cubo 3D)',
                    'coverflow' => 'Coverflow',
                ),
                'default_value' => 'fade',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_hero_slider_enable',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
            ),
            // Repeater: Hero Slides
            array(
                'key' => 'field_hero_slides',
                'label' => 'Hero Slides',
                'name' => 'hero_slides',
                'type' => 'repeater',
                'instructions' => 'Aggiungi le slide per l\'hero slider. Trascina per riordinare.',
                'min' => 1,
                'max' => 10,
                'layout' => 'block',
                'button_label' => 'Aggiungi Slide',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_hero_slider_enable',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'sub_fields' => array(
                    // Slide Image
                    array(
                        'key' => 'field_slide_image',
                        'label' => 'Immagine Slide',
                        'name' => 'slide_image',
                        'type' => 'image',
                        'instructions' => 'Dimensione consigliata: 1920x1080px',
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'mime_types' => 'jpg, jpeg, png, webp',
                    ),
                    // Slide Title
                    array(
                        'key' => 'field_slide_title',
                        'label' => 'Titolo Slide',
                        'name' => 'slide_title',
                        'type' => 'text',
                        'instructions' => 'Titolo principale della slide (es: "Comunichiamo il Futuro")',
                        'required' => 1,
                        'placeholder' => 'Inserisci il titolo...',
                    ),
                    // Slide Subtitle
                    array(
                        'key' => 'field_slide_subtitle',
                        'label' => 'Sottotitolo Slide',
                        'name' => 'slide_subtitle',
                        'type' => 'textarea',
                        'instructions' => 'Descrizione breve sotto il titolo',
                        'rows' => 3,
                        'placeholder' => 'Descrizione della slide...',
                    ),
                    // Slide Button Text
                    array(
                        'key' => 'field_slide_button_text',
                        'label' => 'Testo Pulsante',
                        'name' => 'slide_button_text',
                        'type' => 'text',
                        'instructions' => 'Testo del pulsante CTA (es: "Scopri di piu")',
                        'placeholder' => 'Scopri di piu',
                        'default_value' => 'Scopri di piu',
                    ),
                    // Slide Button URL
                    array(
                        'key' => 'field_slide_button_url',
                        'label' => 'URL Pulsante',
                        'name' => 'slide_button_url',
                        'type' => 'url',
                        'instructions' => 'Link del pulsante CTA',
                        'placeholder' => 'https://',
                    ),
                    // Slide Video URL (optional)
                    array(
                        'key' => 'field_slide_video_url',
                        'label' => 'URL Video (Opzionale)',
                        'name' => 'slide_video_url',
                        'type' => 'url',
                        'instructions' => 'URL di un video YouTube o Vimeo da mostrare al posto dell\'immagine',
                        'placeholder' => 'https://www.youtube.com/watch?v=...',
                    ),
                    // Overlay Color
                    array(
                        'key' => 'field_slide_overlay',
                        'label' => 'Overlay Colore',
                        'name' => 'slide_overlay',
                        'type' => 'select',
                        'instructions' => 'Overlay sopra l\'immagine per leggibilita testo',
                        'choices' => array(
                            'gradient' => 'Gradient Viola-Fucsia-Blu',
                            'dark' => 'Scuro (Nero 50%)',
                            'light' => 'Chiaro (Bianco 30%)',
                            'none' => 'Nessuno',
                        ),
                        'default_value' => 'gradient',
                    ),
                    // Text Alignment
                    array(
                        'key' => 'field_slide_text_align',
                        'label' => 'Allineamento Testo',
                        'name' => 'slide_text_align',
                        'type' => 'select',
                        'choices' => array(
                            'center' => 'Centro',
                            'left' => 'Sinistra',
                            'right' => 'Destra',
                        ),
                        'default_value' => 'center',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'herocs-hero-slider',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
}
add_action('acf/init', 'herocs_register_acf_hero_slider_fields');

/**
 * Fallback: Campi Hero Slider senza ACF PRO (usando meta box nativi)
 * Questa funzione crea una versione semplificata se ACF non e disponibile
 */
function herocs_hero_slider_fallback_meta_box() {
    // Solo se ACF NON e attivo
    if (function_exists('acf_add_local_field_group')) {
        return;
    }
    
    add_menu_page(
        'Hero Slider',
        'Hero Slider',
        'manage_options',
        'herocs-hero-slider-fallback',
        'herocs_hero_slider_fallback_page',
        'dashicons-slides',
        30
    );
}
add_action('admin_menu', 'herocs_hero_slider_fallback_meta_box');

/**
 * Pagina fallback Hero Slider (senza ACF)
 */
function herocs_hero_slider_fallback_page() {
    ?>
    <div class="wrap">
        <h1>Hero Slider Settings</h1>
        <div class="notice notice-warning">
            <p><strong>ACF PRO Richiesto:</strong> Per gestire l'hero slider con tutte le funzionalita, 
            installa e attiva <a href="https://www.advancedcustomfields.com/pro/" target="_blank">Advanced Custom Fields PRO</a>.</p>
        </div>
        <p>Una volta installato ACF PRO, troverai la pagina "Hero Slider" nel menu "Tema Options".</p>
    </div>
    <?php
}

// Nota: herocs_get_hero_slides() ÃƒÂ¨ definita più avanti con supporto completo ACF + Customizer

/**
 * Helper function per ottenere le impostazioni dello slider
 */
function herocs_get_hero_slider_settings() {
    $settings = array(
        'enable' => get_theme_mod('cs_hero_enable_slider', true),
        'speed' => get_theme_mod('cs_hero_slider_speed', 6000),
        'effect' => get_theme_mod('cs_hero_slider_effect', 'fade'),
        // Opzioni visibilitÃ  contenuti
        'show_title' => get_theme_mod('cs_hero_show_title', true),
        'show_subtitle' => get_theme_mod('cs_hero_show_subtitle', true),
        'show_button' => get_theme_mod('cs_hero_show_button', true),
    );
    
    // ACF override se disponibile
    if (function_exists('get_field')) {
        $acf_enable = get_field('hero_slider_enable', 'option');
        if ($acf_enable !== null) {
            $settings['enable'] = $acf_enable;
        }
        $acf_speed = get_field('hero_slider_speed', 'option');
        if ($acf_speed) {
            $settings['speed'] = $acf_speed;
        }
        $acf_effect = get_field('hero_slider_effect', 'option');
        if ($acf_effect) {
            $settings['effect'] = $acf_effect;
        }
        // ACF override per visibilitÃ  contenuti
        $acf_show_title = get_field('hero_show_title', 'option');
        if ($acf_show_title !== null) {
            $settings['show_title'] = $acf_show_title;
        }
        $acf_show_subtitle = get_field('hero_show_subtitle', 'option');
        if ($acf_show_subtitle !== null) {
            $settings['show_subtitle'] = $acf_show_subtitle;
        }
        $acf_show_button = get_field('hero_show_button', 'option');
        if ($acf_show_button !== null) {
            $settings['show_button'] = $acf_show_button;
        }
    }
    
    return $settings;
}

/**
 * Get Hero Slides from Customizer
 * Ritorna array di slides configurati nel Customizer
 */
function herocs_get_customizer_slides() {
    $slides = array();
    
    for ($i = 1; $i <= 5; $i++) {
        $enabled = get_theme_mod("cs_hero_slide_{$i}_enable", ($i === 1));
        
        if (!$enabled) {
            continue;
        }
        
        $type = get_theme_mod("cs_hero_slide_{$i}_type", 'image');
        
        // Immagine: prima prova Media Library (ID), poi URL diretto
        $image_id = get_theme_mod("cs_hero_slide_{$i}_image", '');
        $image_url_direct = get_theme_mod("cs_hero_slide_{$i}_image_url", '');
        
        // Se image_id ÃƒÂ¨ un numero, ottieni l'URL dall'attachment
        $final_image = '';
        if (!empty($image_id) && is_numeric($image_id)) {
            $final_image = wp_get_attachment_url($image_id);
        } elseif (!empty($image_id) && filter_var($image_id, FILTER_VALIDATE_URL)) {
            // Se ÃƒÂ¨ giÃƒÂ  un URL (vecchio formato)
            $final_image = $image_id;
        }
        
        // Se non abbiamo immagine dalla libreria, usa URL diretto
        if (empty($final_image) && !empty($image_url_direct)) {
            $final_image = $image_url_direct;
        }
        
        // Video: prima prova Media Library (ID), poi URL diretto
        $video_media_id = get_theme_mod("cs_hero_slide_{$i}_video_media", '');
        $video_url_direct = get_theme_mod("cs_hero_slide_{$i}_video", '');
        
        $final_video = '';
        if (!empty($video_media_id) && is_numeric($video_media_id)) {
            $final_video = wp_get_attachment_url($video_media_id);
        }
        
        // Se non abbiamo video dalla libreria, usa URL diretto
        if (empty($final_video) && !empty($video_url_direct)) {
            $final_video = $video_url_direct;
        }
        
        $title = get_theme_mod("cs_hero_slide_{$i}_title", '');
        $subtitle = get_theme_mod("cs_hero_slide_{$i}_subtitle", '');
        $cta_text = get_theme_mod("cs_hero_slide_{$i}_cta_text", '');
        $cta_link = get_theme_mod("cs_hero_slide_{$i}_cta_link", '');
        $overlay = get_theme_mod("cs_hero_slide_{$i}_overlay", 40);
        
        // Deve avere almeno un media (immagine o video) o un titolo
        if (empty($final_image) && empty($final_video) && empty($title)) {
            continue;
        }
        
        $slides[] = array(
            'type' => $type,
            'image' => $final_image,
            'video' => $final_video,
            'title' => $title,
            'subtitle' => $subtitle,
            'cta_text' => $cta_text,
            'cta_link' => $cta_link,
            'overlay' => $overlay,
        );
    }
    
    return $slides;
}

/**
 * Get All Hero Slides (ACF + Customizer fallback)
 */
function herocs_get_hero_slides() {
    $slides = array();
    
    // Prima prova ACF
    if (function_exists('get_field') && function_exists('have_rows')) {
        if (have_rows('hero_slides', 'option')) {
            while (have_rows('hero_slides', 'option')) {
                the_row();
                $slides[] = array(
                    'type' => get_sub_field('media_type') ?: 'image',
                    'image' => get_sub_field('slide_image'),
                    'video' => get_sub_field('slide_video'),
                    'title' => get_sub_field('slide_title'),
                    'subtitle' => get_sub_field('slide_subtitle'),
                    'cta_text' => get_sub_field('cta_text'),
                    'cta_link' => get_sub_field('cta_link'),
                    'overlay' => get_sub_field('overlay_opacity') ?: 40,
                );
            }
        }
    }
    
    // Se ACF non ha slides, usa Customizer
    if (empty($slides)) {
        $slides = herocs_get_customizer_slides();
    }
    
    // Se ancora vuoto, slide di default
    if (empty($slides)) {
        $slides[] = array(
            'type' => 'image',
            'image' => '',
            'video' => '',
            'title' => 'Comunichiamo il Futuro',
            'subtitle' => 'Strategie di comunicazione innovative per far crescere il tuo brand',
            'cta_text' => 'Scopri di più',
            'cta_link' => home_url('/chi-siamo'),
            'overlay' => 40,
        );
    }
    
    return $slides;
}

// ============================================================================
// SERVICE META BOXES
// ============================================================================

/**
 * Register Service Meta Boxes
 */
function herocs_add_service_meta_boxes() {
    add_meta_box(
        'herocs_service_details',
        __('Dettagli Servizio', 'herocs'),
        'herocs_service_details_callback',
        'service',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'herocs_add_service_meta_boxes');

/**
 * Service Details Meta Box Callback
 */
function herocs_service_details_callback($post) {
    wp_nonce_field('herocs_service_meta_box', 'herocs_service_meta_box_nonce');
    
    $icon = get_post_meta($post->ID, '_herocs_service_icon', true);
    $subtitle = get_post_meta($post->ID, '_herocs_service_subtitle', true);
    $vantaggi = get_post_meta($post->ID, '_herocs_service_vantaggi', true);
    $step1 = get_post_meta($post->ID, '_herocs_service_step1', true);
    $step2 = get_post_meta($post->ID, '_herocs_service_step2', true);
    $step3 = get_post_meta($post->ID, '_herocs_service_step3', true);
    $step4 = get_post_meta($post->ID, '_herocs_service_step4', true);
    $cta_text = get_post_meta($post->ID, '_herocs_service_cta_text', true);
    $cta_url = get_post_meta($post->ID, '_herocs_service_cta_url', true);
    ?>
    <div class="herocs-meta-box">
        <style>
            .herocs-meta-box { padding: 10px 0; }
            .herocs-meta-box p { margin-bottom: 15px; }
            .herocs-meta-box label { display: block; margin-bottom: 5px; font-weight: 600; }
            .herocs-meta-box .description { font-style: italic; color: #666; font-size: 12px; margin-top: 5px; }
            .herocs-meta-box h4 { margin: 25px 0 15px; padding-top: 15px; border-top: 1px solid #ddd; color: #7c3aed; }
        </style>
        
        <p>
            <label for="herocs_service_icon"><strong><?php esc_html_e('Icona Servizio (Nome classe)', 'herocs'); ?></strong></label>
            <input type="text" id="herocs_service_icon" name="herocs_service_icon" value="<?php echo esc_attr($icon); ?>" class="widefat" placeholder="es: briefcase, chart-line, users, etc." />
            <span class="description"><?php esc_html_e('Nome icona Lucide/Feather. Vedi: lucide.dev/icons', 'herocs'); ?></span>
        </p>
        
        <p>
            <label for="herocs_service_subtitle"><strong><?php esc_html_e('Sottotitolo Hero', 'herocs'); ?></strong></label>
            <input type="text" id="herocs_service_subtitle" name="herocs_service_subtitle" value="<?php echo esc_attr($subtitle); ?>" class="widefat" placeholder="Breve descrizione per l'hero" />
        </p>
        
        <h4><?php esc_html_e('Vantaggi (uno per riga, max 5)', 'herocs'); ?></h4>
        <p>
            <textarea id="herocs_service_vantaggi" name="herocs_service_vantaggi" rows="5" class="widefat" placeholder="Vantaggio 1&#10;Vantaggio 2&#10;Vantaggio 3"><?php echo esc_textarea($vantaggi); ?></textarea>
            <span class="description"><?php esc_html_e('Inserisci un vantaggio per riga', 'herocs'); ?></span>
        </p>
        
        <h4><?php esc_html_e('Come Funziona (4 Step)', 'herocs'); ?></h4>
        <p>
            <label for="herocs_service_step1"><strong>Step 1</strong></label>
            <input type="text" id="herocs_service_step1" name="herocs_service_step1" value="<?php echo esc_attr($step1); ?>" class="widefat" placeholder="Analisi iniziale e definizione obiettivi" />
        </p>
        <p>
            <label for="herocs_service_step2"><strong>Step 2</strong></label>
            <input type="text" id="herocs_service_step2" name="herocs_service_step2" value="<?php echo esc_attr($step2); ?>" class="widefat" placeholder="Sviluppo strategia personalizzata" />
        </p>
        <p>
            <label for="herocs_service_step3"><strong>Step 3</strong></label>
            <input type="text" id="herocs_service_step3" name="herocs_service_step3" value="<?php echo esc_attr($step3); ?>" class="widefat" placeholder="Implementazione e lancio" />
        </p>
        <p>
            <label for="herocs_service_step4"><strong>Step 4</strong></label>
            <input type="text" id="herocs_service_step4" name="herocs_service_step4" value="<?php echo esc_attr($step4); ?>" class="widefat" placeholder="Monitoraggio e ottimizzazione" />
        </p>
        
        <h4><?php esc_html_e('Call to Action', 'herocs'); ?></h4>
        <p>
            <label for="herocs_service_cta_text"><strong>Testo CTA</strong></label>
            <input type="text" id="herocs_service_cta_text" name="herocs_service_cta_text" value="<?php echo esc_attr($cta_text); ?>" class="widefat" placeholder="Richiedi una consulenza" />
        </p>
        <p>
            <label for="herocs_service_cta_url"><strong>URL CTA</strong></label>
            <input type="url" id="herocs_service_cta_url" name="herocs_service_cta_url" value="<?php echo esc_url($cta_url); ?>" class="widefat" placeholder="<?php echo home_url('/contatti'); ?>" />
        </p>
    </div>
    <?php
}

/**
 * Save Service Meta Box Data
 */
function herocs_save_service_meta_box_data($post_id) {
    if (!isset($_POST['herocs_service_meta_box_nonce']) || !wp_verify_nonce($_POST['herocs_service_meta_box_nonce'], 'herocs_service_meta_box')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'herocs_service_icon' => 'sanitize_text_field',
        'herocs_service_subtitle' => 'sanitize_text_field',
        'herocs_service_vantaggi' => 'sanitize_textarea_field',
        'herocs_service_step1' => 'sanitize_text_field',
        'herocs_service_step2' => 'sanitize_text_field',
        'herocs_service_step3' => 'sanitize_text_field',
        'herocs_service_step4' => 'sanitize_text_field',
        'herocs_service_cta_text' => 'sanitize_text_field',
        'herocs_service_cta_url' => 'esc_url_raw',
    );
    
    foreach ($fields as $field => $sanitize_function) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, call_user_func($sanitize_function, $_POST[$field]));
        }
    }
}
add_action('save_post_service', 'herocs_save_service_meta_box_data');

/**
 * Helper functions per i servizi
 */
function herocs_get_service_icon($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_herocs_service_icon', true);
}

function herocs_get_service_subtitle($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return get_post_meta($post_id, '_herocs_service_subtitle', true);
}

function herocs_get_service_vantaggi($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    $vantaggi = get_post_meta($post_id, '_herocs_service_vantaggi', true);
    if ($vantaggi) {
        return array_filter(array_map('trim', explode("\n", $vantaggi)));
    }
    return array();
}

function herocs_get_service_steps($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return array(
        get_post_meta($post_id, '_herocs_service_step1', true),
        get_post_meta($post_id, '_herocs_service_step2', true),
        get_post_meta($post_id, '_herocs_service_step3', true),
        get_post_meta($post_id, '_herocs_service_step4', true),
    );
}

function herocs_get_service_cta($post_id = null) {
    $post_id = $post_id ? $post_id : get_the_ID();
    return array(
        'text' => get_post_meta($post_id, '_herocs_service_cta_text', true) ?: 'Richiedi informazioni',
        'url' => get_post_meta($post_id, '_herocs_service_cta_url', true) ?: home_url('/contatti'),
    );
}