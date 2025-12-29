<?php
/**
 * Template Name: Collaborazioni
 * Template Post Type: page
 * 
 * Lista collaborazioni con filtri e link a pagine singole
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();

// Get all unique settori and tipi for filters
$all_collaborazioni = get_posts(array(
    'post_type' => 'collaborazioni',
    'posts_per_page' => -1,
    'post_status' => 'publish',
));

$settori = array();
$tipi = array();

foreach ($all_collaborazioni as $collab) {
    $settore = get_post_meta($collab->ID, '_cs_collab_settore', true);
    $tipo = get_post_meta($collab->ID, '_cs_collab_tipo', true);
    
    if ($settore && !in_array($settore, $settori)) {
        $settori[] = $settore;
    }
    if ($tipo && !in_array($tipo, $tipi)) {
        $tipi[] = $tipo;
    }
}

// Tipo labels
$tipo_labels = array(
    'strategic' => 'Strategic Partner',
    'cliente' => 'Cliente',
    'fornitore' => 'Fornitore',
    'partner' => 'Partner',
);

// Pagination
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$per_page = 12;

// Main query
$collab_query = new WP_Query(array(
    'post_type' => 'collaborazioni',
    'posts_per_page' => $per_page,
    'paged' => $paged,
    'orderby' => 'date',
    'order' => 'DESC',
));

$total_collaborazioni = wp_count_posts('collaborazioni')->publish;
?>

<main id="primary" class="site-main page-collaborazioni">
    
    <!-- ========================================================================== -->
    <!-- HERO SECTION -->
    <!-- ========================================================================== -->
    <section class="collab-page-hero">
        <div class="hero-gradient-bg"></div>
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <div class="hero-container">
                <span class="hero-badge">I Nostri Partner</span>
                <h1 class="hero-title"><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="hero-subtitle"><?php echo get_the_excerpt(); ?></p>
                <?php else : ?>
                    <p class="hero-subtitle">
                        Collaboriamo con aziende, istituzioni e organizzazioni per creare 
                        strategie di comunicazione efficaci e durature.
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    
    <!-- ========================================================================== -->
    <!-- FILTERS SECTION -->
    <!-- ========================================================================== -->
    <section class="collab-filters-section">
        <div class="collab-container">
            
            <!-- Filter Controls -->
            <div class="filters-wrapper">
                
                <!-- Tipo Filter -->
                <?php if (!empty($tipi)) : ?>
                <div class="filter-group">
                    <label class="filter-label">Tipo Partnership:</label>
                    <div class="filter-buttons" data-filter-type="tipo">
                        <button class="filter-btn active" data-filter="all">
                            Tutti
                            <span class="count">(<?php echo $total_collaborazioni; ?>)</span>
                        </button>
                        <?php foreach ($tipi as $tipo_value) : 
                            $tipo_display = isset($tipo_labels[$tipo_value]) ? $tipo_labels[$tipo_value] : ucfirst($tipo_value);
                            $count = count(array_filter($all_collaborazioni, function($c) use ($tipo_value) {
                                return get_post_meta($c->ID, '_cs_collab_tipo', true) === $tipo_value;
                            }));
                        ?>
                            <button class="filter-btn" data-filter="<?php echo esc_attr($tipo_value); ?>">
                                <?php echo esc_html($tipo_display); ?>
                                <span class="count">(<?php echo $count; ?>)</span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Settore Filter -->
                <?php if (!empty($settori)) : ?>
                <div class="filter-group">
                    <label class="filter-label">Settore:</label>
                    <div class="filter-buttons" data-filter-type="settore">
                        <button class="filter-btn active" data-filter="all">Tutti i settori</button>
                        <?php foreach ($settori as $settore) : ?>
                            <button class="filter-btn" data-filter="<?php echo esc_attr(sanitize_title($settore)); ?>">
                                <?php echo esc_html($settore); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Search -->
                <div class="filter-group filter-search">
                    <label class="filter-label">Cerca:</label>
                    <div class="search-input-wrapper">
                        <input type="text" id="collab-search" placeholder="Cerca collaborazione..." class="search-input">
                        <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="11" cy="11" r="8"/>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                    </div>
                </div>
                
            </div>
            
            <!-- Results Count -->
            <div class="results-count">
                <span id="visible-count"><?php echo $collab_query->found_posts; ?></span> collaborazioni trovate
            </div>
            
        </div>
    </section>
    
    <!-- ========================================================================== -->
    <!-- COLLABORAZIONI GRID -->
    <!-- ========================================================================== -->
    <section class="collab-grid-section">
        <div class="collab-container">
            
            <?php if ($collab_query->have_posts()) : ?>
                
                <div class="collab-grid" id="collab-grid">
                    <?php while ($collab_query->have_posts()) : $collab_query->the_post();
                        $logo = get_post_meta(get_the_ID(), '_cs_collab_logo', true);
                        $tipo = get_post_meta(get_the_ID(), '_cs_collab_tipo', true);
                        $settore = get_post_meta(get_the_ID(), '_cs_collab_settore', true);
                        $anno = get_post_meta(get_the_ID(), '_cs_collab_anno', true);
                        $anno_fine = get_post_meta(get_the_ID(), '_cs_collab_anno_fine', true);
                        $servizi = get_post_meta(get_the_ID(), '_cs_collab_servizi', true);
                        
                        $tipo_display = isset($tipo_labels[$tipo]) ? $tipo_labels[$tipo] : ($tipo ?: 'Collaborazione');
                        
                        // Periodo
                        $periodo = '';
                        if ($anno) {
                            $periodo = $anno;
                            if (!$anno_fine || $anno_fine >= date('Y')) {
                                $periodo .= ' - Oggi';
                            } elseif ($anno_fine != $anno) {
                                $periodo .= ' - ' . $anno_fine;
                            }
                        }
                    ?>
                    
                    <article class="collab-card" 
                             data-tipo="<?php echo esc_attr($tipo); ?>" 
                             data-settore="<?php echo esc_attr(sanitize_title($settore)); ?>"
                             data-name="<?php echo esc_attr(strtolower(get_the_title())); ?>">
                        
                        <a href="<?php the_permalink(); ?>" class="collab-card-link">
                            
                            <!-- Logo -->
                            <div class="collab-card-logo">
                                <?php if ($logo) : ?>
                                    <img src="<?php echo esc_url($logo); ?>" alt="<?php the_title_attribute(); ?>">
                                <?php elseif (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium', array('class' => 'card-logo-img')); ?>
                                <?php else : ?>
                                    <div class="collab-logo-placeholder">
                                        <span><?php echo esc_html(mb_substr(get_the_title(), 0, 2)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Info -->
                            <div class="collab-card-info">
                                
                                <!-- Badges -->
                                <div class="collab-card-badges">
                                    <span class="tipo-badge tipo-<?php echo esc_attr($tipo); ?>">
                                        <?php echo esc_html($tipo_display); ?>
                                    </span>
                                    <?php if ($settore) : ?>
                                        <span class="settore-badge"><?php echo esc_html($settore); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Title -->
                                <h3 class="collab-card-title"><?php the_title(); ?></h3>
                                
                                <!-- Period -->
                                <?php if ($periodo) : ?>
                                    <p class="collab-card-periodo">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                            <line x1="16" y1="2" x2="16" y2="6"/>
                                            <line x1="8" y1="2" x2="8" y2="6"/>
                                            <line x1="3" y1="10" x2="21" y2="10"/>
                                        </svg>
                                        <?php echo esc_html($periodo); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <!-- Services Tags -->
                                <?php if ($servizi) : 
                                    $servizi_array = array_slice(array_map('trim', explode(',', $servizi)), 0, 3);
                                ?>
                                    <div class="collab-card-services">
                                        <?php foreach ($servizi_array as $serv) : ?>
                                            <span class="service-mini-tag"><?php echo esc_html($serv); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- CTA -->
                                <span class="collab-card-cta">
                                    Scopri Partnership
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                        <polyline points="12 5 19 12 12 19"/>
                                    </svg>
                                </span>
                                
                            </div>
                            
                        </a>
                        
                    </article>
                    
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <?php if ($collab_query->max_num_pages > 1) : ?>
                    <nav class="collab-pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $collab_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>',
                            'next_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>',
                        ));
                        ?>
                    </nav>
                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
                
            <?php else : ?>
                
                <!-- Empty State -->
                <div class="collab-empty">
                    <div class="empty-icon">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3>Nessuna collaborazione trovata</h3>
                    <p>Le nostre collaborazioni verranno pubblicate presto!</p>
                    <?php if (current_user_can('edit_posts')) : ?>
                        <a href="<?php echo admin_url('post-new.php?post_type=collaborazioni'); ?>" class="empty-btn">
                            + Aggiungi Collaborazione
                        </a>
                    <?php endif; ?>
                </div>
                
            <?php endif; ?>
            
        </div>
    </section>
    
    <!-- ========================================================================== -->
    <!-- STATS SECTION -->
    <!-- ========================================================================== -->
    <section class="collab-stats-section">
        <div class="collab-container">
            
            <div class="stats-grid">
                <?php
                $anni_attivita = date('Y') - 2015;
                $progetti_totali = 0;
                foreach ($all_collaborazioni as $c) {
                    $progetti_json = get_post_meta($c->ID, '_cs_collab_progetti', true);
                    if ($progetti_json) {
                        $progetti = json_decode($progetti_json, true);
                        $progetti_totali += is_array($progetti) ? count($progetti) : 0;
                    }
                }
                if ($progetti_totali == 0) {
                    $progetti_totali = $total_collaborazioni * 3;
                }
                ?>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <div class="stat-number" data-target="<?php echo esc_attr($total_collaborazioni); ?>">0</div>
                    <div class="stat-label">Clienti & Partner</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                            <line x1="8" y1="21" x2="16" y2="21"/>
                            <line x1="12" y1="17" x2="12" y2="21"/>
                        </svg>
                    </div>
                    <div class="stat-number" data-target="<?php echo esc_attr($progetti_totali); ?>">0</div>
                    <div class="stat-label">Progetti Realizzati</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <div class="stat-number" data-target="<?php echo esc_attr($anni_attivita); ?>">0</div>
                    <div class="stat-label">Anni di Esperienza</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/>
                        </svg>
                    </div>
                    <div class="stat-number">98<span class="stat-suffix">%</span></div>
                    <div class="stat-label">Clienti Soddisfatti</div>
                </div>
                
            </div>
            
        </div>
    </section>
    
    <!-- ========================================================================== -->
    <!-- CTA SECTION -->
    <!-- ========================================================================== -->
    <section class="collab-cta-section">
        <div class="collab-container">
            <div class="cta-card">
                <div class="cta-content">
                    <h2>Vuoi diventare nostro partner?</h2>
                    <p>Contattaci per scoprire come possiamo collaborare insieme e raggiungere obiettivi straordinari.</p>
                </div>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cta-btn-primary">
                        Richiedi Consulenza
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>" class="cta-btn-secondary">
                        I Nostri Servizi
                    </a>
                </div>
            </div>
        </div>
    </section>
    
</main>

<style>
/* ========================================================================== */
/* PAGE COLLABORAZIONI STYLES */
/* Colori: Viola (#7c3aed), Fucsia (#ec4899), Blu (#3b82f6) */
/* ========================================================================== */

.page-collaborazioni {
    background: #f8fafc;
}

/* HERO */
.collab-page-hero {
    position: relative;
    min-height: 50vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 120px 24px 80px;
}

.collab-page-hero .hero-gradient-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
}

.collab-page-hero .hero-pattern {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.collab-page-hero .hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.collab-page-hero .hero-container {
    max-width: 800px;
    margin: 0 auto;
}

.hero-badge {
    display: inline-block;
    padding: 8px 20px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 24px;
}

.hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 700;
    color: white;
    margin: 0 0 24px 0;
    line-height: 1.1;
}

.hero-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1.1rem, 2vw, 1.35rem);
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    margin: 0;
}

/* CONTAINER */
.collab-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
}

/* FILTERS */
.collab-filters-section {
    padding: 40px 0;
    background: white;
    border-bottom: 1px solid #e2e8f0;
    position: sticky;
    top: 80px;
    z-index: 50;
}

.filters-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 24px;
    align-items: flex-end;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-group.filter-search {
    flex: 0 0 300px;
}

.filter-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 10px;
}

.filter-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.filter-btn {
    padding: 10px 18px;
    background: #f1f5f9;
    border: 2px solid transparent;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #475569;
    cursor: pointer;
    transition: all 0.3s;
    font-family: 'Inter', sans-serif;
}

.filter-btn:hover {
    background: white;
    border-color: #7c3aed;
    color: #7c3aed;
}

.filter-btn.active {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-color: transparent;
}

.filter-btn .count {
    font-size: 0.75rem;
    opacity: 0.7;
    margin-left: 4px;
}

/* Search */
.search-input-wrapper {
    position: relative;
}

.search-input {
    width: 100%;
    padding: 12px 20px 12px 48px;
    border: 2px solid #e2e8f0;
    border-radius: 50px;
    font-size: 0.95rem;
    font-family: 'Inter', sans-serif;
    transition: all 0.3s;
}

.search-input:focus {
    outline: none;
    border-color: #7c3aed;
    box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
}

.search-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
}

.results-count {
    margin-top: 20px;
    font-size: 0.9rem;
    color: #64748b;
}

.results-count span {
    font-weight: 700;
    color: #7c3aed;
}

/* GRID */
.collab-grid-section {
    padding: 60px 0 100px;
}

.collab-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.collab-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.collab-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.12);
}

.collab-card.hidden {
    display: none;
}

.collab-card-link {
    display: block;
    text-decoration: none;
}

.collab-card-logo {
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.collab-card-logo img,
.collab-card-logo .card-logo-img {
    max-width: 160px;
    max-height: 120px;
    object-fit: contain;
    transition: transform 0.4s;
}

.collab-card:hover .collab-card-logo img {
    transform: scale(1.05);
}

.collab-logo-placeholder {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.collab-logo-placeholder span {
    font-size: 2rem;
    font-weight: 800;
    color: white;
    font-family: 'Poppins', sans-serif;
}

.collab-card-info {
    padding: 28px;
}

.collab-card-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
}

.tipo-badge {
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.tipo-badge.tipo-strategic {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.tipo-badge.tipo-cliente {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.tipo-badge.tipo-fornitore {
    background: rgba(124, 58, 237, 0.1);
    color: #7c3aed;
}

.tipo-badge.tipo-partner {
    background: rgba(236, 72, 153, 0.1);
    color: #ec4899;
}

.settore-badge {
    padding: 6px 14px;
    background: #f1f5f9;
    border-radius: 50px;
    font-size: 0.7rem;
    font-weight: 600;
    color: #64748b;
}

.collab-card-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 12px 0;
    transition: color 0.3s;
}

.collab-card:hover .collab-card-title {
    color: #7c3aed;
}

.collab-card-periodo {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.875rem;
    color: #64748b;
    margin: 0 0 16px 0;
}

.collab-card-services {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 20px;
}

.service-mini-tag {
    padding: 4px 10px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    font-size: 0.75rem;
    color: #64748b;
}

.collab-card-cta {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #7c3aed;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.collab-card:hover .collab-card-cta {
    gap: 12px;
    color: #ec4899;
}

.collab-card-cta svg {
    transition: transform 0.3s;
}

.collab-card:hover .collab-card-cta svg {
    transform: translateX(4px);
}

/* PAGINATION */
.collab-pagination {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 60px;
}

.collab-pagination .page-numbers {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: white;
    color: #475569;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    border: 2px solid #e2e8f0;
}

.collab-pagination .page-numbers:hover {
    border-color: #7c3aed;
    color: #7c3aed;
}

.collab-pagination .page-numbers.current {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-color: transparent;
}

/* EMPTY STATE */
.collab-empty {
    text-align: center;
    padding: 80px 40px;
    background: white;
    border-radius: 20px;
}

.collab-empty .empty-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    color: #7c3aed;
}

.collab-empty h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    color: #1e293b;
    margin: 0 0 12px 0;
}

.collab-empty p {
    color: #64748b;
    margin: 0 0 24px 0;
}

.empty-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.empty-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
}

/* STATS */
.collab-stats-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
}

.stat-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 40px 30px;
    text-align: center;
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-icon {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}

.stat-number {
    font-family: 'Poppins', sans-serif;
    font-size: 3rem;
    font-weight: 800;
    line-height: 1;
    margin-bottom: 8px;
}

.stat-suffix {
    font-size: 2rem;
}

.stat-label {
    font-size: 0.95rem;
    opacity: 0.9;
}

/* CTA */
.collab-cta-section {
    padding: 100px 0;
    background: white;
}

.cta-card {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
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
    color: #94a3b8;
    margin: 0;
    max-width: 500px;
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
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.cta-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(124, 58, 237, 0.4);
}

.cta-btn-secondary {
    display: inline-flex;
    align-items: center;
    padding: 16px 32px;
    background: transparent;
    color: white;
    border: 2px solid #475569;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.cta-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: #94a3b8;
}

/* RESPONSIVE */
@media (max-width: 1200px) {
    .collab-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 1024px) {
    .collab-filters-section {
        position: relative;
        top: 0;
    }
    
    .filters-wrapper {
        flex-direction: column;
        gap: 20px;
    }
    
    .filter-group {
        width: 100%;
    }
    
    .filter-group.filter-search {
        flex: 1;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .cta-card {
        flex-direction: column;
        text-align: center;
    }
    
    .cta-content p {
        max-width: 100%;
    }
}

@media (max-width: 768px) {
    .collab-page-hero {
        padding: 100px 20px 60px;
        min-height: 40vh;
    }
    
    .collab-grid {
        grid-template-columns: 1fr;
    }
    
    .collab-grid-section,
    .collab-stats-section,
    .collab-cta-section {
        padding: 60px 0;
    }
    
    .filter-buttons {
        flex-wrap: nowrap;
        overflow-x: auto;
        padding-bottom: 8px;
        -webkit-overflow-scrolling: touch;
    }
    
    .filter-btn {
        flex-shrink: 0;
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
    
    .cta-card {
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

/* DARK MODE */
body.dark-mode .page-collaborazioni {
    background: #0f172a;
}

body.dark-mode .collab-filters-section {
    background: #1e293b;
    border-bottom-color: #334155;
}

body.dark-mode .filter-btn {
    background: #0f172a;
    color: #94a3b8;
}

body.dark-mode .filter-btn:hover {
    background: #1e293b;
    border-color: #a78bfa;
    color: #a78bfa;
}

body.dark-mode .filter-btn.active {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
}

body.dark-mode .search-input {
    background: #0f172a;
    border-color: #334155;
    color: #f1f5f9;
}

body.dark-mode .search-input:focus {
    border-color: #a78bfa;
}

body.dark-mode .collab-grid-section {
    background: #0f172a;
}

body.dark-mode .collab-card {
    background: #1e293b;
}

body.dark-mode .collab-card-logo {
    background: #0f172a;
    border-bottom-color: #334155;
}

body.dark-mode .collab-card-title {
    color: #f1f5f9;
}

body.dark-mode .collab-card:hover .collab-card-title {
    color: #a78bfa;
}

body.dark-mode .collab-card-periodo,
body.dark-mode .settore-badge,
body.dark-mode .service-mini-tag {
    color: #94a3b8;
}

body.dark-mode .service-mini-tag {
    background: #0f172a;
    border-color: #334155;
}

body.dark-mode .collab-card-cta {
    color: #a78bfa;
}

body.dark-mode .collab-card:hover .collab-card-cta {
    color: #f472b6;
}

body.dark-mode .collab-pagination .page-numbers {
    background: #1e293b;
    border-color: #334155;
    color: #94a3b8;
}

body.dark-mode .collab-pagination .page-numbers:hover {
    border-color: #a78bfa;
    color: #a78bfa;
}

body.dark-mode .collab-empty {
    background: #1e293b;
}

body.dark-mode .collab-empty h3 {
    color: #f1f5f9;
}

body.dark-mode .collab-cta-section {
    background: #1e293b;
}

body.dark-mode .cta-card {
    background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoButtons = document.querySelectorAll('[data-filter-type="tipo"] .filter-btn');
    const settoreButtons = document.querySelectorAll('[data-filter-type="settore"] .filter-btn');
    const searchInput = document.getElementById('collab-search');
    const collabCards = document.querySelectorAll('.collab-card');
    const visibleCount = document.getElementById('visible-count');
    
    let currentTipo = 'all';
    let currentSettore = 'all';
    let currentSearch = '';
    
    function filterCards() {
        let visible = 0;
        
        collabCards.forEach(card => {
            const cardTipo = card.dataset.tipo || '';
            const cardSettore = card.dataset.settore || '';
            const cardName = card.dataset.name || '';
            
            const matchesTipo = currentTipo === 'all' || cardTipo === currentTipo;
            const matchesSettore = currentSettore === 'all' || cardSettore === currentSettore;
            const matchesSearch = currentSearch === '' || cardName.includes(currentSearch.toLowerCase());
            
            if (matchesTipo && matchesSettore && matchesSearch) {
                card.classList.remove('hidden');
                card.style.display = '';
                visible++;
            } else {
                card.classList.add('hidden');
                card.style.display = 'none';
            }
        });
        
        if (visibleCount) {
            visibleCount.textContent = visible;
        }
    }
    
    tipoButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            tipoButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentTipo = this.dataset.filter;
            filterCards();
        });
    });
    
    settoreButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            settoreButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentSettore = this.dataset.filter;
            filterCards();
        });
    });
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.trim();
            filterCards();
        });
    }
    
    // Counter animation
    const statNumbers = document.querySelectorAll('.stat-number[data-target]');
    
    const animateCounter = (element) => {
        const target = parseInt(element.dataset.target) || 0;
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    statNumbers.forEach(num => observer.observe(num));
});
</script>

<?php get_footer(); ?>
