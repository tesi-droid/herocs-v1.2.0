<?php
/**
 * Template Name: Cosa Facciamo
 * Template Post Type: page
 * 
 * Pagina servizi con grid, case study e metodo di lavoro
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();

// Mappa icone SVG per i servizi statici (usata se non ci sono CPT)
$service_icons = array(
    'megaphone' => '<path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
    'building' => '<rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/>',
    'heart-handshake' => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08v0c.82.82 2.13.85 3 .07l2.07-1.9a2.82 2.82 0 0 1 3.79 0l2.96 2.66"/><path d="m18 15-2-2"/><path d="m15 18-2-2"/>',
    'smartphone' => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><path d="M12 18h.01"/>',
    'video' => '<rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/><line x1="7" y1="2" x2="7" y2="22"/><line x1="17" y1="2" x2="17" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><line x1="2" y1="7" x2="7" y2="7"/><line x1="2" y1="17" x2="7" y2="17"/><line x1="17" y1="17" x2="22" y2="17"/><line x1="17" y1="7" x2="22" y2="7"/>',
    'bar-chart' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
);

// Servizi statici (fallback se non ci sono CPT)
$servizi_default = array(
    array(
        'icon' => 'megaphone',
        'title' => 'Comunicazione Politica',
        'description' => 'Strategie complete per campagne elettorali, gestione della reputazione politica e comunicazione istituzionale efficace.',
        'link' => '#',
    ),
    array(
        'icon' => 'building',
        'title' => 'Comunicazione Istituzionale',
        'description' => 'Supporto alle istituzioni pubbliche per una comunicazione efficace e trasparente con i cittadini.',
        'link' => '#',
    ),
    array(
        'icon' => 'heart-handshake',
        'title' => 'Comunicazione Sociale',
        'description' => 'Campagne di sensibilizzazione e progetti per il terzo settore e organizzazioni no-profit.',
        'link' => '#',
    ),
    array(
        'icon' => 'smartphone',
        'title' => 'Digital Strategy',
        'description' => 'Presenza digitale strategica su tutti i canali online per massimizzare la visibilita del tuo brand.',
        'link' => '#',
    ),
    array(
        'icon' => 'video',
        'title' => 'Produzione Contenuti',
        'description' => 'Creazione di contenuti multimediali di alta qualita: video, fotografia, grafiche e copywriting.',
        'link' => '#',
    ),
    array(
        'icon' => 'bar-chart',
        'title' => 'Analisi e Ricerca',
        'description' => 'Dati e insights per decisioni strategiche basate su evidenze concrete e analisi approfondite.',
        'link' => '#',
    ),
);
?>

<main id="primary" class="site-main page-cosa-facciamo">
    
    <!-- ========================================================================== -->
    <!-- HERO SECTION -->
    <!-- ========================================================================== -->
    <section class="cosa-facciamo-hero">
        <div class="hero-gradient-bg"></div>
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <div class="hero-container">
                <span class="hero-badge">I Nostri Servizi</span>
                <h1 class="hero-title">Cosa Facciamo</h1>
                <p class="hero-subtitle">
                    Soluzioni di comunicazione integrate per far crescere il tuo brand, 
                    raggiungere i tuoi obiettivi e costruire relazioni durature.
                </p>
            </div>
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- SERVIZI GRID -->
    <!-- ========================================================================== -->
    <section class="servizi-section">
        <div class="servizi-container">
            
            <div class="section-header">
                <span class="section-badge">Expertise</span>
                <h2 class="section-title">I Nostri Servizi</h2>
                <p class="section-description">
                    Offriamo una gamma completa di servizi di comunicazione per rispondere a ogni esigenza
                </p>
            </div>
            
            <?php
            // Prova a caricare servizi da CPT
            $services_query = new WP_Query(array(
                'post_type' => 'service',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ));
            
            if ($services_query->have_posts()) :
            ?>
                <div class="servizi-grid">
                    <?php while ($services_query->have_posts()) : $services_query->the_post(); 
                        $icon = herocs_get_service_icon();
                        $icon_svg = isset($service_icons[$icon]) ? $service_icons[$icon] : '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>';
                    ?>
                        <article class="servizio-card">
                            <div class="servizio-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <?php echo $icon_svg; ?>
                                </svg>
                            </div>
                            <h3 class="servizio-title"><?php the_title(); ?></h3>
                            <p class="servizio-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            <a href="<?php the_permalink(); ?>" class="servizio-link">
                                Scopri di piu
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <!-- Fallback: Servizi Statici -->
                <div class="servizi-grid">
                    <?php foreach ($servizi_default as $servizio) : 
                        $icon_svg = isset($service_icons[$servizio['icon']]) ? $service_icons[$servizio['icon']] : '';
                    ?>
                        <article class="servizio-card">
                            <div class="servizio-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <?php echo $icon_svg; ?>
                                </svg>
                            </div>
                            <h3 class="servizio-title"><?php echo esc_html($servizio['title']); ?></h3>
                            <p class="servizio-description"><?php echo esc_html($servizio['description']); ?></p>
                            <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="servizio-link">
                                Scopri di piu
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
                
                <?php if (current_user_can('edit_posts')) : ?>
                    <div class="admin-notice">
                        <p>
                            <strong>Suggerimento:</strong> Aggiungi servizi dal pannello admin per renderli dinamici e linkabili.
                            <a href="<?php echo admin_url('post-new.php?post_type=service'); ?>">Aggiungi il primo servizio Ã¢â€ â€™</a>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- METODO DI LAVORO -->
    <!-- ========================================================================== -->
    <section class="metodo-section">
        <div class="metodo-container">
            
            <div class="section-header">
                <span class="section-badge">Processo</span>
                <h2 class="section-title">Il Nostro Metodo</h2>
                <p class="section-description">
                    Un approccio strutturato che garantisce risultati misurabili e soddisfazione del cliente
                </p>
            </div>
            
            <div class="metodo-grid">
                
                <div class="metodo-step">
                    <div class="step-number">01</div>
                    <div class="step-content">
                        <h3>Ascolto</h3>
                        <p>Comprendiamo a fondo le tue esigenze, obiettivi e il contesto in cui operi.</p>
                    </div>
                </div>
                
                <div class="metodo-step">
                    <div class="step-number">02</div>
                    <div class="step-content">
                        <h3>Strategia</h3>
                        <p>Definiamo obiettivi misurabili e un piano d'azione personalizzato.</p>
                    </div>
                </div>
                
                <div class="metodo-step">
                    <div class="step-number">03</div>
                    <div class="step-content">
                        <h3>Creazione</h3>
                        <p>Realizziamo contenuti e campagne di alta qualita per ogni canale.</p>
                    </div>
                </div>
                
                <div class="metodo-step">
                    <div class="step-number">04</div>
                    <div class="step-content">
                        <h3>Lancio</h3>
                        <p>Attiviamo le strategie pianificate con precisione e tempismo.</p>
                    </div>
                </div>
                
                <div class="metodo-step">
                    <div class="step-number">05</div>
                    <div class="step-content">
                        <h3>Analisi</h3>
                        <p>Monitoriamo, misuriamo e ottimizziamo costantemente i risultati.</p>
                    </div>
                </div>
                
            </div>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- CASE STUDY SECTION -->
    <!-- ========================================================================== -->
    <?php
    $portfolio_query = new WP_Query(array(
        'post_type' => 'portfolio',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    
    if ($portfolio_query->have_posts()) :
    ?>
    <section class="case-study-section">
        <div class="case-study-container">
            
            <div class="section-header">
                <span class="section-badge">Portfolio</span>
                <h2 class="section-title">Case Study</h2>
                <p class="section-description">
                    Alcuni dei progetti che abbiamo realizzato per i nostri clienti
                </p>
            </div>
            
            <div class="case-study-grid">
                <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); 
                    $client = get_post_meta(get_the_ID(), '_cs_portfolio_client', true);
                    $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                    $category_name = $categories && !is_wp_error($categories) ? $categories[0]->name : '';
                ?>
                    <article class="case-study-card">
                        <a href="<?php the_permalink(); ?>" class="case-study-link">
                            
                            <!-- Thumbnail -->
                            <div class="case-study-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', array('class' => 'case-img')); ?>
                                <?php else : ?>
                                    <div class="case-placeholder">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Overlay -->
                                <div class="case-study-overlay">
                                    <span class="overlay-text">Vedi Progetto</span>
                                </div>
                            </div>
                            
                            <!-- Info -->
                            <div class="case-study-info">
                                <?php if ($category_name) : ?>
                                    <span class="case-category"><?php echo esc_html($category_name); ?></span>
                                <?php endif; ?>
                                <h3 class="case-title"><?php the_title(); ?></h3>
                                <?php if ($client) : ?>
                                    <p class="case-client"><?php echo esc_html($client); ?></p>
                                <?php endif; ?>
                            </div>
                            
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <div class="case-study-cta">
                <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="view-all-btn">
                    Vedi tutti i progetti
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            
        </div>
    </section>
    <?php 
    wp_reset_postdata();
    endif; 
    ?>

    <!-- ========================================================================== -->
    <!-- CTA FINALE -->
    <!-- ========================================================================== -->
    <section class="final-cta-section">
        <div class="cta-container">
            <div class="cta-card">
                <div class="cta-content">
                    <h2>Pronto a iniziare il tuo progetto?</h2>
                    <p>Contattaci per una consulenza gratuita e scopri come possiamo aiutarti a raggiungere i tuoi obiettivi</p>
                </div>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cta-btn cta-btn-primary">
                        Contattaci Ora
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>" class="cta-btn cta-btn-secondary">
                        Scopri chi siamo
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
/* ========================================================================== */
/* PAGE COSA FACCIAMO - Complete Styles */
/* ========================================================================== */

.page-cosa-facciamo {
    background: #f8fafc;
}

/* ========================================================================== */
/* HERO SECTION */
/* ========================================================================== */

.cosa-facciamo-hero {
    position: relative;
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 120px 24px 80px;
}

.cosa-facciamo-hero .hero-gradient-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
}

.cosa-facciamo-hero .hero-pattern {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.cosa-facciamo-hero .hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
}

.cosa-facciamo-hero .hero-container {
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

/* ========================================================================== */
/* SERVIZI SECTION */
/* ========================================================================== */

.servizi-section {
    padding: 100px 0;
    background: white;
}

.servizi-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.section-header {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 60px;
}

.section-badge {
    display: inline-block;
    padding: 6px 16px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 50px;
    color: #7c3aed;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 16px;
}

.section-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.section-description {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* Servizi Grid */
.servizi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.servizio-card {
    background: white;
    border-radius: 20px;
    padding: 36px;
    border: 1px solid #e2e8f0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.servizio-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 50px rgba(124, 58, 237, 0.15);
    border-color: #ec4899;
}

.servizio-icon {
    width: 72px;
    height: 72px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #7c3aed;
    margin-bottom: 24px;
    transition: all 0.3s;
}

.servizio-card:hover .servizio-icon {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    transform: scale(1.1);
}

.servizio-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.35rem;
    font-weight: 600;
    color: #7c3aed;
    margin: 0 0 12px 0;
}

.servizio-description {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    line-height: 1.7;
    color: #64748b;
    margin: 0 0 20px 0;
}

.servizio-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #7c3aed;
    font-weight: 600;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s;
}

.servizio-link:hover {
    gap: 12px;
    color: #ec4899;
}

.servizio-link svg {
    transition: transform 0.3s;
}

.servizio-link:hover svg {
    transform: translateX(4px);
}

.admin-notice {
    margin-top: 40px;
    padding: 20px;
    background: #fef3c7;
    border-radius: 12px;
    text-align: center;
}

.admin-notice p {
    margin: 0;
    color: #92400e;
}

.admin-notice a {
    color: #7c3aed;
    font-weight: 600;
}

/* ========================================================================== */
/* METODO SECTION */
/* ========================================================================== */

.metodo-section {
    padding: 100px 0;
    background: #f8fafc;
}

.metodo-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.metodo-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.metodo-step {
    background: white;
    border-radius: 16px;
    padding: 30px 24px;
    text-align: center;
    position: relative;
    transition: all 0.3s;
}

.metodo-step:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(124, 58, 237, 0.1);
}

.step-number {
    font-family: 'Poppins', sans-serif;
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: 16px;
}

.step-content h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 8px 0;
}

.step-content p {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

/* ========================================================================== */
/* CASE STUDY SECTION */
/* ========================================================================== */

.case-study-section {
    padding: 100px 0;
    background: white;
}

.case-study-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.case-study-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.case-study-card {
    border-radius: 16px;
    overflow: hidden;
    background: white;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.4s;
}

.case-study-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
}

.case-study-link {
    display: block;
    text-decoration: none;
}

.case-study-image {
    position: relative;
    aspect-ratio: 4/3;
    overflow: hidden;
    background: #f1f5f9;
}

.case-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.case-study-card:hover .case-img {
    transform: scale(1.08);
}

.case-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e2e8f0 0%, #f1f5f9 100%);
    color: #94a3b8;
}

.case-study-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.9) 0%, rgba(236, 72, 153, 0.9) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s;
}

.case-study-card:hover .case-study-overlay {
    opacity: 1;
}

.overlay-text {
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.case-study-info {
    padding: 24px;
}

.case-category {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(124, 58, 237, 0.1);
    color: #7c3aed;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-radius: 50px;
    margin-bottom: 12px;
}

.case-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 8px 0;
    transition: color 0.3s;
}

.case-study-card:hover .case-title {
    color: #7c3aed;
}

.case-client {
    font-size: 0.9rem;
    color: #64748b;
    margin: 0;
}

.case-study-cta {
    text-align: center;
    margin-top: 50px;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    background: transparent;
    color: #7c3aed;
    border: 2px solid #7c3aed;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.view-all-btn:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
}

.view-all-btn svg {
    transition: transform 0.3s;
}

.view-all-btn:hover svg {
    transform: translateX(5px);
}

/* ========================================================================== */
/* CTA FINALE */
/* ========================================================================== */

.final-cta-section {
    padding: 100px 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    position: relative;
}

.final-cta-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.cta-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
}

.cta-card {
    text-align: center;
}

.cta-content h2 {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 700;
    color: white;
    margin: 0 0 16px 0;
}

.cta-content p {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 36px 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 18px 36px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s;
}

.cta-btn-primary {
    background: white;
    color: #7c3aed;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.cta-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.cta-btn-primary svg {
    transition: transform 0.3s;
}

.cta-btn-primary:hover svg {
    transform: translateX(5px);
}

.cta-btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.5);
}

.cta-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .servizi-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .metodo-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .case-study-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .cosa-facciamo-hero {
        padding: 100px 20px 60px;
        min-height: 50vh;
    }
    
    .servizi-section,
    .metodo-section,
    .case-study-section,
    .final-cta-section {
        padding: 60px 0;
    }
    
    .section-header {
        margin-bottom: 40px;
    }
    
    .servizi-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .servizio-card {
        padding: 28px;
    }
    
    .metodo-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .metodo-step {
        display: flex;
        align-items: center;
        gap: 20px;
        text-align: left;
        padding: 24px;
    }
    
    .step-number {
        font-size: 2.5rem;
        flex-shrink: 0;
    }
    
    .case-study-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-buttons {
        flex-direction: column;
    }
    
    .cta-btn {
        width: 100%;
        justify-content: center;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .page-cosa-facciamo {
    background: #0f172a;
}

body.dark-mode .servizi-section {
    background: #1e293b;
}

body.dark-mode .section-title {
    color: #f1f5f9;
}

body.dark-mode .section-description {
    color: #94a3b8;
}

body.dark-mode .servizio-card {
    background: #0f172a;
    border-color: #334155;
}

body.dark-mode .servizio-card:hover {
    border-color: #f472b6;
    box-shadow: 0 25px 50px rgba(167, 139, 250, 0.2);
}

body.dark-mode .servizio-title {
    color: #a78bfa;
}

body.dark-mode .servizio-description {
    color: #94a3b8;
}

body.dark-mode .servizio-link {
    color: #a78bfa;
}

body.dark-mode .servizio-link:hover {
    color: #f472b6;
}

body.dark-mode .metodo-section {
    background: #0f172a;
}

body.dark-mode .metodo-step {
    background: #1e293b;
}

body.dark-mode .step-content h3 {
    color: #f1f5f9;
}

body.dark-mode .step-content p {
    color: #94a3b8;
}

body.dark-mode .case-study-section {
    background: #1e293b;
}

body.dark-mode .case-study-card {
    background: #0f172a;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

body.dark-mode .case-study-card:hover {
    box-shadow: 0 20px 40px rgba(167, 139, 250, 0.2);
}

body.dark-mode .case-title {
    color: #f1f5f9;
}

body.dark-mode .case-study-card:hover .case-title {
    color: #a78bfa;
}

body.dark-mode .case-client {
    color: #94a3b8;
}

body.dark-mode .view-all-btn {
    color: #a78bfa;
    border-color: #a78bfa;
}

body.dark-mode .view-all-btn:hover {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
    color: white;
}
</style>

<?php get_footer(); ?>
