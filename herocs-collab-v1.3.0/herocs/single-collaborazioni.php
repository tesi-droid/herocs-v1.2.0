<?php
/**
 * Template: Single Collaborazione
 * Layout completo per pagina singola collaborazione/partnership
 *
 * @package HeroCS
 * @since 1.2.0
 */

get_header();

// Meta data
$logo_url = get_post_meta(get_the_ID(), '_cs_collab_logo', true);
$website = get_post_meta(get_the_ID(), '_cs_collab_website', true);
$anno_inizio = get_post_meta(get_the_ID(), '_cs_collab_anno', true);
$anno_fine = get_post_meta(get_the_ID(), '_cs_collab_anno_fine', true);
$settore = get_post_meta(get_the_ID(), '_cs_collab_settore', true);
$tipo = get_post_meta(get_the_ID(), '_cs_collab_tipo', true);
$servizi = get_post_meta(get_the_ID(), '_cs_collab_servizi', true);
$risultati = get_post_meta(get_the_ID(), '_cs_collab_risultati', true);
$descrizione = get_post_meta(get_the_ID(), '_cs_collab_descrizione', true);
$brand_color = get_post_meta(get_the_ID(), '_cs_collab_brand_color', true);
$progetti_json = get_post_meta(get_the_ID(), '_cs_collab_progetti', true);
$kpi_json = get_post_meta(get_the_ID(), '_cs_collab_kpi', true);

// Parse JSON data
$progetti = $progetti_json ? json_decode($progetti_json, true) : array();
$kpi_items = $kpi_json ? json_decode($kpi_json, true) : array();

// Default brand color
if (empty($brand_color)) {
    $brand_color = '#7c3aed';
}

// Periodo
$periodo = '';
if ($anno_inizio) {
    $periodo = $anno_inizio;
    if ($anno_fine && $anno_fine != $anno_inizio) {
        $periodo .= ' - ' . $anno_fine;
    } elseif (!$anno_fine || $anno_fine >= date('Y')) {
        $periodo .= ' - Presente';
    }
}

// Tipo mapping
$tipo_labels = array(
    'strategic' => 'Strategic Partner',
    'cliente' => 'Cliente',
    'fornitore' => 'Fornitore',
    'partner' => 'Partner',
);
$tipo_display = isset($tipo_labels[$tipo]) ? $tipo_labels[$tipo] : ($tipo ?: 'Collaborazione');

// Servizi array
$servizi_array = $servizi ? array_map('trim', explode(',', $servizi)) : array();

// Use featured image or logo
$hero_image = '';
if (has_post_thumbnail()) {
    $hero_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
}
?>

<main id="primary" class="site-main single-collaborazione">
    
    <!-- ========================================================================== -->
    <!-- HERO SECTION -->
    <!-- ========================================================================== -->
    <section class="collab-hero" style="--brand-color: <?php echo esc_attr($brand_color); ?>">
        <div class="collab-hero-bg"></div>
        <div class="collab-hero-pattern"></div>
        
        <div class="collab-hero-content">
            <div class="collab-hero-container">
                
                <!-- Logo Cliente -->
                <div class="collab-logo-wrapper">
                    <?php if ($logo_url) : ?>
                        <img src="<?php echo esc_url($logo_url); ?>" 
                             alt="<?php echo esc_attr(get_the_title()); ?>" 
                             class="collab-hero-logo">
                    <?php elseif (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium', array('class' => 'collab-hero-logo')); ?>
                    <?php else : ?>
                        <div class="collab-logo-placeholder">
                            <span><?php echo esc_html(mb_substr(get_the_title(), 0, 2)); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Info -->
                <div class="collab-hero-info">
                    <div class="collab-meta-badges">
                        <span class="collab-type-badge"><?php echo esc_html($tipo_display); ?></span>
                        <?php if ($settore) : ?>
                            <span class="collab-sector-badge"><?php echo esc_html($settore); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="collab-hero-title"><?php the_title(); ?></h1>
                    
                    <?php if ($periodo) : ?>
                        <p class="collab-periodo">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <?php echo esc_html($periodo); ?>
                        </p>
                    <?php endif; ?>
                    
                    <?php if ($website) : ?>
                        <a href="<?php echo esc_url($website); ?>" class="collab-website-btn" target="_blank" rel="noopener noreferrer">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="2" y1="12" x2="22" y2="12"/>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                            </svg>
                            Visita il sito
                        </a>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="collab-scroll-indicator">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </div>
    </section>
    
    <!-- ========================================================================== -->
    <!-- ABOUT SECTION -->
    <!-- ========================================================================== -->
    <section class="collab-about">
        <div class="collab-container">
            
            <div class="collab-about-grid">
                
                <!-- Descrizione -->
                <div class="collab-description">
                    <h2 class="collab-section-title">
                        <span class="title-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                                <line x1="16" y1="13" x2="8" y2="13"/>
                                <line x1="16" y1="17" x2="8" y2="17"/>
                                <polyline points="10 9 9 9 8 9"/>
                            </svg>
                        </span>
                        La Collaborazione
                    </h2>
                    
                    <?php if ($descrizione) : ?>
                        <div class="collab-description-content">
                            <?php echo wp_kses_post($descrizione); ?>
                        </div>
                    <?php elseif (has_excerpt()) : ?>
                        <div class="collab-description-content">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php elseif (get_the_content()) : ?>
                        <div class="collab-description-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($risultati) : ?>
                        <div class="collab-highlights">
                            <h3>Highlights</h3>
                            <p><?php echo wp_kses_post(nl2br($risultati)); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Sidebar Info -->
                <div class="collab-sidebar">
                    
                    <!-- Timeline -->
                    <?php if ($anno_inizio) : ?>
                    <div class="collab-info-card">
                        <h3>Timeline</h3>
                        <div class="timeline-visual">
                            <div class="timeline-point start">
                                <span class="timeline-year"><?php echo esc_html($anno_inizio); ?></span>
                                <span class="timeline-label">Inizio</span>
                            </div>
                            <div class="timeline-line"></div>
                            <div class="timeline-point end">
                                <span class="timeline-year"><?php echo $anno_fine ? esc_html($anno_fine) : 'Oggi'; ?></span>
                                <span class="timeline-label"><?php echo $anno_fine ? 'Fine' : 'In corso'; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Servizi -->
                    <?php if (!empty($servizi_array)) : ?>
                    <div class="collab-info-card">
                        <h3>Servizi Forniti</h3>
                        <div class="collab-services-tags">
                            <?php foreach ($servizi_array as $servizio) : ?>
                                <span class="service-tag"><?php echo esc_html($servizio); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Settore -->
                    <?php if ($settore) : ?>
                    <div class="collab-info-card">
                        <h3>Settore</h3>
                        <p class="sector-value"><?php echo esc_html($settore); ?></p>
                    </div>
                    <?php endif; ?>
                    
                </div>
                
            </div>
            
        </div>
    </section>
    
    <!-- ========================================================================== -->
    <!-- KPI / RISULTATI SECTION -->
    <!-- ========================================================================== -->
    <?php if (!empty($kpi_items)) : ?>
    <section class="collab-kpi">
        <div class="collab-container">
            
            <h2 class="collab-section-title centered">
                <span class="title-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                </span>
                Risultati Ottenuti
            </h2>
            
            <div class="kpi-grid">
                <?php foreach ($kpi_items as $kpi) : 
                    $kpi_value = isset($kpi['value']) ? $kpi['value'] : '';
                    $kpi_label = isset($kpi['label']) ? $kpi['label'] : '';
                    $kpi_desc = isset($kpi['description']) ? $kpi['description'] : '';
                ?>
                <div class="kpi-card" data-value="<?php echo esc_attr($kpi_value); ?>">
                    <div class="kpi-value">
                        <span class="kpi-number" data-target="<?php echo esc_attr(preg_replace('/[^0-9]/', '', $kpi_value)); ?>">0</span>
                        <span class="kpi-suffix"><?php echo esc_html(preg_replace('/[0-9]/', '', $kpi_value)); ?></span>
                    </div>
                    <h3 class="kpi-label"><?php echo esc_html($kpi_label); ?></h3>
                    <?php if ($kpi_desc) : ?>
                        <p class="kpi-desc"><?php echo esc_html($kpi_desc); ?></p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            
        </div>
    </section>
    <?php endif; ?>
    
    <!-- ========================================================================== -->
    <!-- PROGETTI SECTION -->
    <!-- ========================================================================== -->
    <?php if (!empty($progetti)) : ?>
    <section class="collab-progetti">
        <div class="collab-container">
            
            <h2 class="collab-section-title centered">
                <span class="title-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                        <line x1="8" y1="21" x2="16" y2="21"/>
                        <line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </span>
                Progetti Realizzati
            </h2>
            
            <div class="progetti-grid">
                <?php foreach ($progetti as $index => $progetto) : 
                    $prog_title = isset($progetto['title']) ? $progetto['title'] : '';
                    $prog_desc = isset($progetto['description']) ? $progetto['description'] : '';
                    $prog_image = isset($progetto['image']) ? $progetto['image'] : '';
                ?>
                <article class="progetto-card">
                    <div class="progetto-image">
                        <?php if ($prog_image) : ?>
                            <img src="<?php echo esc_url($prog_image); ?>" alt="<?php echo esc_attr($prog_title); ?>">
                        <?php else : ?>
                            <div class="progetto-placeholder">
                                <span><?php echo esc_html($index + 1); ?></span>
                            </div>
                        <?php endif; ?>
                        <div class="progetto-overlay">
                            <span>Progetto <?php echo $index + 1; ?></span>
                        </div>
                    </div>
                    <div class="progetto-content">
                        <h3><?php echo esc_html($prog_title); ?></h3>
                        <?php if ($prog_desc) : ?>
                            <p><?php echo esc_html($prog_desc); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
            
        </div>
    </section>
    <?php endif; ?>
    
    <!-- ========================================================================== -->
    <!-- RELATED COLLABORAZIONI -->
    <!-- ========================================================================== -->
    <?php
    $related_args = array(
        'post_type' => 'collaborazioni',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'orderby' => 'rand',
    );
    
    // Filtra per settore se presente
    if ($settore) {
        $related_args['meta_query'] = array(
            array(
                'key' => '_cs_collab_settore',
                'value' => $settore,
                'compare' => 'LIKE'
            )
        );
    }
    
    $related_query = new WP_Query($related_args);
    
    if ($related_query->have_posts()) :
    ?>
    <section class="collab-related">
        <div class="collab-container">
            
            <h2 class="collab-section-title centered">Altre Collaborazioni</h2>
            
            <div class="related-grid">
                <?php while ($related_query->have_posts()) : $related_query->the_post(); 
                    $rel_logo = get_post_meta(get_the_ID(), '_cs_collab_logo', true);
                    $rel_settore = get_post_meta(get_the_ID(), '_cs_collab_settore', true);
                ?>
                <a href="<?php the_permalink(); ?>" class="related-card">
                    <div class="related-logo">
                        <?php if ($rel_logo) : ?>
                            <img src="<?php echo esc_url($rel_logo); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php elseif (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('thumbnail'); ?>
                        <?php else : ?>
                            <div class="related-placeholder">
                                <?php echo esc_html(mb_substr(get_the_title(), 0, 2)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <h3><?php the_title(); ?></h3>
                    <?php if ($rel_settore) : ?>
                        <span class="related-sector"><?php echo esc_html($rel_settore); ?></span>
                    <?php endif; ?>
                </a>
                <?php endwhile; ?>
            </div>
            
        </div>
    </section>
    <?php 
    wp_reset_postdata();
    endif; 
    ?>
    
    <!-- ========================================================================== -->
    <!-- CTA / BACK -->
    <!-- ========================================================================== -->
    <section class="collab-cta">
        <div class="collab-container">
            <div class="collab-cta-inner">
                <div class="cta-content">
                    <h2>Vuoi collaborare con noi?</h2>
                    <p>Scopri come possiamo aiutarti a raggiungere i tuoi obiettivi di comunicazione</p>
                </div>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cta-btn-primary">
                        Contattaci
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/collaborazioni')); ?>" class="cta-btn-secondary">
                        ← Tutte le collaborazioni
                    </a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<style>
/* ========================================================================== */
/* SINGLE COLLABORAZIONE STYLES */
/* Colori: Viola (#7c3aed), Fucsia (#ec4899), Blu (#3b82f6) */
/* ========================================================================== */

.single-collaborazione {
    background: #f8fafc;
}

/* ========================================================================== */
/* HERO SECTION */
/* ========================================================================== */

.collab-hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 120px 24px 80px;
}

.collab-hero-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--brand-color, #7c3aed) 0%, #ec4899 50%, #3b82f6 100%);
}

.collab-hero-pattern {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.collab-hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

.collab-hero-container {
    max-width: 1000px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 30px;
}

/* Logo */
.collab-logo-wrapper {
    width: 180px;
    height: 180px;
    background: white;
    border-radius: 24px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.collab-hero-logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.collab-logo-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.collab-logo-placeholder span {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    font-family: 'Poppins', sans-serif;
}

/* Info */
.collab-hero-info {
    color: white;
}

.collab-meta-badges {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.collab-type-badge,
.collab-sector-badge {
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.collab-type-badge {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
}

.collab-sector-badge {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.collab-hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.collab-periodo {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0 0 24px 0;
}

.collab-website-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: rgba(255, 255, 255, 0.95);
    color: #7c3aed;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.collab-website-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Scroll Indicator */
.collab-scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    opacity: 0.7;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(10px); }
}

/* ========================================================================== */
/* CONTAINER */
/* ========================================================================== */

.collab-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* ========================================================================== */
/* ABOUT SECTION */
/* ========================================================================== */

.collab-about {
    padding: 100px 0;
    background: white;
}

.collab-about-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 60px;
    align-items: start;
}

.collab-section-title {
    display: flex;
    align-items: center;
    gap: 16px;
    font-family: 'Poppins', sans-serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 30px 0;
}

.collab-section-title.centered {
    justify-content: center;
    text-align: center;
}

.title-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #7c3aed;
}

.collab-description-content {
    font-size: 1.0625rem;
    line-height: 1.8;
    color: #475569;
}

.collab-description-content p {
    margin-bottom: 1.5em;
}

.collab-highlights {
    margin-top: 40px;
    padding: 30px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.05) 0%, rgba(236, 72, 153, 0.05) 100%);
    border-radius: 16px;
    border-left: 4px solid #7c3aed;
}

.collab-highlights h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    color: #7c3aed;
    margin: 0 0 12px 0;
}

.collab-highlights p {
    color: #475569;
    margin: 0;
    line-height: 1.7;
}

/* Sidebar */
.collab-sidebar {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.collab-info-card {
    background: #f8fafc;
    border-radius: 16px;
    padding: 28px;
}

.collab-info-card h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0 0 16px 0;
}

/* Timeline */
.timeline-visual {
    display: flex;
    align-items: center;
    gap: 12px;
}

.timeline-point {
    text-align: center;
}

.timeline-year {
    display: block;
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: #7c3aed;
}

.timeline-label {
    font-size: 0.8rem;
    color: #64748b;
}

.timeline-line {
    flex: 1;
    height: 3px;
    background: linear-gradient(90deg, #7c3aed, #ec4899);
    border-radius: 2px;
}

/* Services Tags */
.collab-services-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.service-tag {
    padding: 8px 16px;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 50px;
    font-size: 0.85rem;
    color: #475569;
    transition: all 0.3s;
}

.service-tag:hover {
    border-color: #7c3aed;
    color: #7c3aed;
}

.sector-value {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

/* ========================================================================== */
/* KPI SECTION */
/* ========================================================================== */

.collab-kpi {
    padding: 100px 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
}

.collab-kpi .collab-section-title {
    color: white;
}

.collab-kpi .title-icon {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.kpi-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.kpi-value {
    margin-bottom: 16px;
}

.kpi-number {
    font-family: 'Poppins', sans-serif;
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1;
}

.kpi-suffix {
    font-size: 2rem;
    font-weight: 700;
}

.kpi-label {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 8px 0;
}

.kpi-desc {
    font-size: 0.9rem;
    opacity: 0.8;
    margin: 0;
}

/* ========================================================================== */
/* PROGETTI SECTION */
/* ========================================================================== */

.collab-progetti {
    padding: 100px 0;
    background: white;
}

.progetti-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    margin-top: 50px;
}

.progetto-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.4s;
}

.progetto-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
}

.progetto-image {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
    background: #f1f5f9;
}

.progetto-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.progetto-card:hover .progetto-image img {
    transform: scale(1.08);
}

.progetto-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
}

.progetto-placeholder span {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    font-family: 'Poppins', sans-serif;
}

.progetto-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.9) 0%, rgba(236, 72, 153, 0.9) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s;
}

.progetto-card:hover .progetto-overlay {
    opacity: 1;
}

.progetto-overlay span {
    color: white;
    font-weight: 600;
    padding: 12px 24px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    border-radius: 50px;
}

.progetto-content {
    padding: 28px;
}

.progetto-content h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 12px 0;
}

.progetto-content p {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* ========================================================================== */
/* RELATED SECTION */
/* ========================================================================== */

.collab-related {
    padding: 100px 0;
    background: #f8fafc;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
    margin-top: 50px;
}

.related-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    text-align: center;
    text-decoration: none;
    transition: all 0.4s;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

.related-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.12);
}

.related-logo {
    width: 100px;
    height: 100px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.related-logo img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.related-placeholder {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
    font-family: 'Poppins', sans-serif;
}

.related-card h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 8px 0;
    transition: color 0.3s;
}

.related-card:hover h3 {
    color: #7c3aed;
}

.related-sector {
    font-size: 0.85rem;
    color: #64748b;
}

/* ========================================================================== */
/* CTA SECTION */
/* ========================================================================== */

.collab-cta {
    padding: 100px 0;
    background: white;
}

.collab-cta-inner {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    border-radius: 24px;
    padding: 60px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

.cta-content h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    color: white;
    margin: 0 0 12px 0;
}

.cta-content p {
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
}

.cta-buttons {
    display: flex;
    gap: 16px;
    flex-shrink: 0;
}

.cta-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    background: white;
    color: #7c3aed;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.cta-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.cta-btn-secondary {
    display: inline-flex;
    align-items: center;
    padding: 16px 32px;
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.cta-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .collab-about-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .collab-sidebar {
        flex-direction: row;
        flex-wrap: wrap;
    }
    
    .collab-info-card {
        flex: 1;
        min-width: 200px;
    }
    
    .collab-cta-inner {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .collab-hero {
        min-height: 60vh;
        padding: 100px 20px 60px;
    }
    
    .collab-logo-wrapper {
        width: 140px;
        height: 140px;
    }
    
    .collab-about,
    .collab-kpi,
    .collab-progetti,
    .collab-related,
    .collab-cta {
        padding: 60px 0;
    }
    
    .collab-sidebar {
        flex-direction: column;
    }
    
    .progetti-grid {
        grid-template-columns: 1fr;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
    
    .kpi-grid {
        grid-template-columns: 1fr 1fr;
    }
    
    .kpi-number {
        font-size: 2.5rem;
    }
    
    .collab-cta-inner {
        padding: 40px 24px;
    }
    
    .cta-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .cta-btn-primary,
    .cta-btn-secondary {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .collab-meta-badges {
        flex-direction: column;
        gap: 8px;
    }
    
    .kpi-grid {
        grid-template-columns: 1fr;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .single-collaborazione {
    background: #0f172a;
}

body.dark-mode .collab-about,
body.dark-mode .collab-progetti,
body.dark-mode .collab-cta {
    background: #1e293b;
}

body.dark-mode .collab-section-title {
    color: #f1f5f9;
}

body.dark-mode .collab-description-content {
    color: #94a3b8;
}

body.dark-mode .collab-highlights {
    background: linear-gradient(135deg, rgba(167, 139, 250, 0.1) 0%, rgba(244, 114, 182, 0.1) 100%);
    border-left-color: #a78bfa;
}

body.dark-mode .collab-highlights h3 {
    color: #a78bfa;
}

body.dark-mode .collab-info-card {
    background: #0f172a;
}

body.dark-mode .service-tag {
    background: #1e293b;
    border-color: #334155;
    color: #94a3b8;
}

body.dark-mode .service-tag:hover {
    border-color: #a78bfa;
    color: #a78bfa;
}

body.dark-mode .sector-value {
    color: #f1f5f9;
}

body.dark-mode .collab-related {
    background: #0f172a;
}

body.dark-mode .related-card,
body.dark-mode .progetto-card {
    background: #1e293b;
}

body.dark-mode .related-card h3,
body.dark-mode .progetto-content h3 {
    color: #f1f5f9;
}

body.dark-mode .related-card:hover h3 {
    color: #a78bfa;
}

body.dark-mode .related-sector,
body.dark-mode .progetto-content p {
    color: #94a3b8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // KPI Counter Animation
    const kpiNumbers = document.querySelectorAll('.kpi-number');
    
    if (kpiNumbers.length === 0) return;
    
    const animateCounter = (element) => {
        const target = parseInt(element.dataset.target) || 0;
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                element.textContent = target.toLocaleString('it-IT');
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString('it-IT');
            }
        }, 16);
    };
    
    // Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    kpiNumbers.forEach(num => observer.observe(num));
});
</script>

<?php get_footer(); ?>
