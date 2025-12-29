<?php
/**
 * Single Collaborazione Template
 * Pagina dettaglio singola collaborazione/cliente/partner
 *
 * @package HeroCS
 * @since 1.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main single-collaborazione-page">
    <?php while (have_posts()) : the_post(); 
        // Recupera meta fields
        $logo = get_post_meta(get_the_ID(), '_cs_collab_logo', true);
        $website = get_post_meta(get_the_ID(), '_cs_collab_website', true);
        $anno = get_post_meta(get_the_ID(), '_cs_collab_anno', true);
        $settore = get_post_meta(get_the_ID(), '_cs_collab_settore', true);
        $servizi = get_post_meta(get_the_ID(), '_cs_collab_servizi', true);
        $tipo = get_post_meta(get_the_ID(), '_cs_collab_tipo', true);
        $risultati = get_post_meta(get_the_ID(), '_cs_collab_risultati', true);
        
        // Tipologie
        $tipologie = get_the_terms(get_the_ID(), 'tipologia_cliente');
    ?>

    <!-- Hero Header con Gradient -->
    <section class="collab-single-hero">
        <div class="hero-gradient-overlay"></div>
        <div class="hero-content">
            <div class="hero-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="separator">/</span>
                <a href="<?php echo esc_url(home_url('/collaborazioni')); ?>">Collaborazioni</a>
                <span class="separator">/</span>
                <span class="current"><?php the_title(); ?></span>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('collab-single-content'); ?>>
        <div class="collab-container">
            
            <!-- Layout a due colonne -->
            <div class="collab-profile-grid">
                
                <!-- Colonna Sinistra: Logo/Immagine -->
                <div class="collab-logo-column">
                    <div class="collab-logo-wrapper">
                        <?php if ($logo) : ?>
                            <img src="<?php echo esc_url($logo); ?>" 
                                 alt="<?php echo esc_attr(get_the_title()); ?>" 
                                 class="collab-main-logo">
                        <?php elseif (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array(
                                'class' => 'collab-main-logo',
                                'alt' => get_the_title()
                            )); ?>
                        <?php else : ?>
                            <div class="collab-logo-placeholder">
                                <span class="placeholder-text">
                                    <?php echo esc_html(get_the_title()); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Decorazione gradient -->
                        <div class="logo-decoration"></div>
                    </div>
                    
                    <!-- Info Card -->
                    <div class="collab-info-card">
                        <h3 class="info-card-title">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" y1="16" x2="12" y2="12"/>
                                <line x1="12" y1="8" x2="12.01" y2="8"/>
                            </svg>
                            Informazioni
                        </h3>
                        
                        <ul class="info-list">
                            <?php if ($anno) : ?>
                                <li>
                                    <span class="info-label">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                                        </svg>
                                        Anno
                                    </span>
                                    <span class="info-value"><?php echo esc_html($anno); ?></span>
                                </li>
                            <?php endif; ?>
                            
                            <?php if ($settore) : ?>
                                <li>
                                    <span class="info-label">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                                        </svg>
                                        Settore
                                    </span>
                                    <span class="info-value"><?php echo esc_html($settore); ?></span>
                                </li>
                            <?php endif; ?>
                            
                            <?php if ($tipo) : ?>
                                <li>
                                    <span class="info-label">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        Tipologia
                                    </span>
                                    <span class="info-value"><?php echo esc_html($tipo); ?></span>
                                </li>
                            <?php endif; ?>
                            
                            <?php if ($tipologie && !is_wp_error($tipologie)) : ?>
                                <li>
                                    <span class="info-label">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16z"/>
                                        </svg>
                                        Categoria
                                    </span>
                                    <span class="info-value">
                                        <?php echo esc_html(implode(', ', wp_list_pluck($tipologie, 'name'))); ?>
                                    </span>
                                </li>
                            <?php endif; ?>
                        </ul>
                        
                        <?php if ($website) : ?>
                            <a href="<?php echo esc_url($website); ?>" 
                               class="collab-website-btn" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <line x1="2" y1="12" x2="22" y2="12"/>
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                </svg>
                                Visita il sito web
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Colonna Destra: Contenuto -->
                <div class="collab-content-column">
                    
                    <!-- Header -->
                    <header class="collab-header">
                        <?php if ($tipologie && !is_wp_error($tipologie)) : ?>
                            <div class="collab-badges">
                                <?php foreach ($tipologie as $tipologia) : ?>
                                    <span class="tipologia-badge"><?php echo esc_html($tipologia->name); ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <h1 class="collab-title"><?php the_title(); ?></h1>
                        
                        <?php if (has_excerpt()) : ?>
                            <p class="collab-subtitle"><?php echo get_the_excerpt(); ?></p>
                        <?php endif; ?>
                    </header>
                    
                    <!-- Servizi Forniti -->
                    <?php if ($servizi) : ?>
                        <section class="collab-section collab-servizi">
                            <h2 class="section-title">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>
                                </svg>
                                Servizi Forniti
                            </h2>
                            <div class="servizi-tags">
                                <?php
                                $servizi_array = array_map('trim', explode(',', $servizi));
                                foreach ($servizi_array as $servizio) :
                                ?>
                                    <span class="servizio-tag"><?php echo esc_html($servizio); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                    
                    <!-- Descrizione -->
                    <?php if (get_the_content()) : ?>
                        <section class="collab-section collab-description">
                            <h2 class="section-title">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                    <polyline points="10 9 9 9 8 9"/>
                                </svg>
                                La Collaborazione
                            </h2>
                            <div class="collab-text">
                                <?php the_content(); ?>
                            </div>
                        </section>
                    <?php endif; ?>
                    
                    <!-- Risultati / Highlights -->
                    <?php if ($risultati) : ?>
                        <section class="collab-section collab-risultati">
                            <h2 class="section-title">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                                </svg>
                                Risultati Raggiunti
                            </h2>
                            <div class="risultati-content">
                                <?php echo wp_kses_post(wpautop($risultati)); ?>
                            </div>
                        </section>
                    <?php endif; ?>
                    
                    <!-- CTA Section -->
                    <section class="collab-cta-section">
                        <div class="cta-content">
                            <h3>Vuoi diventare nostro partner?</h3>
                            <p>Scopri come possiamo collaborare insieme per raggiungere i tuoi obiettivi.</p>
                            <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cta-btn">
                                Contattaci
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"/>
                                    <polyline points="12 5 19 12 12 19"/>
                                </svg>
                            </a>
                        </div>
                    </section>
                    
                </div>
                
            </div>
            
        </div>
    </article>

    <!-- Altre Collaborazioni -->
    <section class="related-collaborazioni">
        <div class="collab-container">
            <h2 class="related-title">Altre Collaborazioni</h2>
            
            <div class="related-grid">
                <?php
                $related_args = array(
                    'post_type' => 'collaborazioni',
                    'posts_per_page' => 4,
                    'post__not_in' => array(get_the_ID()),
                    'orderby' => 'rand',
                );
                
                // Se ha tipologie, cerca simili
                if ($tipologie && !is_wp_error($tipologie)) {
                    $tipologie_ids = wp_list_pluck($tipologie, 'term_id');
                    $related_args['tax_query'] = array(
                        array(
                            'taxonomy' => 'tipologia_cliente',
                            'field' => 'term_id',
                            'terms' => $tipologie_ids,
                        ),
                    );
                }
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) :
                    while ($related_query->have_posts()) : $related_query->the_post();
                        $rel_logo = get_post_meta(get_the_ID(), '_cs_collab_logo', true);
                        $rel_tipologie = get_the_terms(get_the_ID(), 'tipologia_cliente');
                ?>
                    <a href="<?php the_permalink(); ?>" class="related-card">
                        <div class="related-logo">
                            <?php if ($rel_logo) : ?>
                                <img src="<?php echo esc_url($rel_logo); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            <?php elseif (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                            <?php else : ?>
                                <div class="logo-placeholder-mini">
                                    <span><?php echo esc_html(mb_substr(get_the_title(), 0, 2)); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="related-info">
                            <h3 class="related-name"><?php the_title(); ?></h3>
                            <?php if ($rel_tipologie && !is_wp_error($rel_tipologie)) : ?>
                                <span class="related-category"><?php echo esc_html($rel_tipologie[0]->name); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p class="no-related">Nessuna collaborazione correlata trovata.</p>
                <?php endif; ?>
            </div>
            
            <div class="view-all-cta">
                <a href="<?php echo esc_url(home_url('/collaborazioni')); ?>" class="view-all-btn">
                    Vedi tutte le collaborazioni
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                        <polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>

<style>
/* ==========================================================================
   SINGLE COLLABORAZIONE - Styles
   ========================================================================== */

.single-collaborazione-page {
    background: var(--cs-light, #f8fafc);
}

/* Hero */
.collab-single-hero {
    position: relative;
    height: 200px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    display: flex;
    align-items: flex-end;
    overflow: hidden;
}

.collab-single-hero .hero-gradient-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.3) 100%);
}

.collab-single-hero .hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px 24px;
}

.hero-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: rgba(255,255,255,0.9);
}

.hero-breadcrumb a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: color 0.3s;
}

.hero-breadcrumb a:hover {
    color: white;
}

.hero-breadcrumb .separator {
    opacity: 0.5;
}

.hero-breadcrumb .current {
    font-weight: 600;
    color: white;
}

/* Container */
.collab-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Content */
.collab-single-content {
    padding: 60px 0;
}

/* Grid Layout */
.collab-profile-grid {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 60px;
    align-items: start;
}

/* Logo Column */
.collab-logo-column {
    position: sticky;
    top: 100px;
}

.collab-logo-wrapper {
    position: relative;
    background: white;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    overflow: hidden;
}

.collab-main-logo {
    width: 100%;
    height: auto;
    max-height: 200px;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}

.collab-logo-placeholder {
    width: 100%;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 12px;
}

.collab-logo-placeholder .placeholder-text {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    text-align: center;
    padding: 20px;
}

.logo-decoration {
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 150px;
    height: 150px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 50%;
}

/* Info Card */
.collab-info-card {
    background: white;
    border-radius: 16px;
    padding: 24px;
    margin-top: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

.info-card-title {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
}

.info-card-title svg {
    color: #7c3aed;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
}

.info-list li:last-child {
    border-bottom: none;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #64748b;
}

.info-label svg {
    color: #94a3b8;
}

.info-value {
    font-weight: 600;
    color: #1e293b;
    font-size: 0.95rem;
}

.collab-website-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 14px 24px;
    margin-top: 20px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s;
}

.collab-website-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4);
}

/* Content Column */
.collab-content-column {
    min-width: 0;
}

/* Header */
.collab-header {
    margin-bottom: 40px;
}

.collab-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
}

.tipologia-badge {
    display: inline-block;
    padding: 6px 16px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.collab-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.collab-subtitle {
    font-size: 1.2rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Sections */
.collab-section {
    background: white;
    border-radius: 20px;
    padding: 32px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
    font-family: 'Poppins', sans-serif;
    font-size: 1.3rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 20px 0;
}

.section-title svg {
    color: #7c3aed;
}

/* Servizi Tags */
.servizi-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.servizio-tag {
    display: inline-block;
    padding: 10px 20px;
    background: #f1f5f9;
    color: #1e293b;
    font-size: 0.9rem;
    font-weight: 500;
    border-radius: 10px;
    transition: all 0.3s;
}

.servizio-tag:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

/* Description Text */
.collab-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #475569;
}

.collab-text p {
    margin-bottom: 1.5em;
}

.collab-text p:last-child {
    margin-bottom: 0;
}

/* Risultati */
.risultati-content {
    font-size: 1rem;
    line-height: 1.7;
    color: #475569;
}

/* CTA Section */
.collab-cta-section {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    border-radius: 20px;
    padding: 40px;
    margin-top: 40px;
}

.cta-content {
    text-align: center;
    color: white;
}

.cta-content h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 12px 0;
}

.cta-content p {
    font-size: 1.05rem;
    opacity: 0.9;
    margin: 0 0 24px 0;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: white;
    color: #7c3aed;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s;
}

.cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

/* Related Section */
.related-collaborazioni {
    background: white;
    padding: 80px 0;
}

.related-title {
    font-family: 'Poppins', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    text-align: center;
    margin: 0 0 48px 0;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    margin-bottom: 48px;
}

.related-card {
    display: flex;
    flex-direction: column;
    background: #f8fafc;
    border-radius: 16px;
    overflow: hidden;
    text-decoration: none;
    transition: all 0.3s;
}

.related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}

.related-logo {
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: white;
}

.related-logo img {
    max-width: 100%;
    max-height: 80px;
    object-fit: contain;
}

.logo-placeholder-mini {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 12px;
}

.logo-placeholder-mini span {
    font-family: 'Poppins', sans-serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: white;
}

.related-info {
    padding: 16px 20px;
}

.related-name {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 4px 0;
}

.related-category {
    font-size: 0.85rem;
    color: #7c3aed;
    font-weight: 500;
}

.view-all-cta {
    text-align: center;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: transparent;
    color: #7c3aed;
    border: 2px solid #7c3aed;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s;
}

.view-all-btn:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-color: transparent;
    color: white;
}

/* ==========================================================================
   RESPONSIVE
   ========================================================================== */

@media (max-width: 1024px) {
    .collab-profile-grid {
        grid-template-columns: 300px 1fr;
        gap: 40px;
    }
    
    .related-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .collab-profile-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    
    .collab-logo-column {
        position: static;
    }
    
    .collab-logo-wrapper {
        max-width: 300px;
        margin: 0 auto;
    }
    
    .collab-section {
        padding: 24px;
    }
    
    .collab-cta-section {
        padding: 32px 24px;
    }
    
    .related-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
}

@media (max-width: 480px) {
    .collab-single-hero {
        height: 160px;
    }
    
    .collab-single-content {
        padding: 40px 0;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}

/* ==========================================================================
   DARK MODE
   ========================================================================== */

body.dark-mode .single-collaborazione-page {
    background: #0f172a;
}

body.dark-mode .collab-logo-wrapper,
body.dark-mode .collab-info-card,
body.dark-mode .collab-section {
    background: #1e293b;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

body.dark-mode .info-card-title,
body.dark-mode .collab-title,
body.dark-mode .section-title,
body.dark-mode .related-title,
body.dark-mode .related-name {
    color: #f1f5f9;
}

body.dark-mode .info-value {
    color: #e2e8f0;
}

body.dark-mode .info-label,
body.dark-mode .collab-subtitle,
body.dark-mode .collab-text,
body.dark-mode .risultati-content {
    color: #94a3b8;
}

body.dark-mode .info-list li {
    border-color: #334155;
}

body.dark-mode .info-card-title {
    border-color: #334155;
}

body.dark-mode .servizio-tag {
    background: #334155;
    color: #e2e8f0;
}

body.dark-mode .related-collaborazioni {
    background: #1e293b;
}

body.dark-mode .related-card {
    background: #0f172a;
}

body.dark-mode .related-logo {
    background: #1e293b;
}

body.dark-mode .hero-breadcrumb a {
    color: rgba(255,255,255,0.7);
}

body.dark-mode .hero-breadcrumb a:hover {
    color: white;
}
</style>
