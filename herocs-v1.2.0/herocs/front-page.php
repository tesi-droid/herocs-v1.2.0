<?php
/**
 * Front Page Template - Homepage
 * Layout completo con Hero, Team, Servizi, Collaborazioni, Press
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();

// Mappa icone SVG per servizi
$service_icons = array(
    'megaphone' => '<path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
    'building' => '<rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/>',
    'heart-handshake' => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>',
    'smartphone' => '<rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><path d="M12 18h.01"/>',
    'video' => '<rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/><line x1="7" y1="2" x2="7" y2="22"/><line x1="17" y1="2" x2="17" y2="22"/>',
    'bar-chart' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
    'default' => '<circle cx="12" cy="12" r="10"/>',
);
?>

<main id="primary" class="site-main homepage">
    
    <!-- ========================================================================== -->
    <!-- 1. HERO SLIDER (ACF) -->
    <!-- ========================================================================== -->
    <?php get_template_part('template-parts/hero', 'section'); ?>

    <!-- ========================================================================== -->
    <!-- 2. SEZIONE INTRO - Chi Siamo -->
    <!-- ========================================================================== -->
    <section class="home-intro">
        <div class="intro-container">
            <div class="intro-grid">
                
                <div class="intro-content">
                    <span class="section-badge">Chi Siamo</span>
                    <h2 class="section-title">Comunichiamo con passione, creiamo con strategia</h2>
                    <div class="intro-text">
                        <p>
                            Siamo un'agenzia di comunicazione specializzata in comunicazione politica, 
                            istituzionale e sociale. Da oltre un decennio aiutiamo i nostri clienti a 
                            raggiungere i loro obiettivi attraverso strategie innovative.
                        </p>
                    </div>
                    <div class="intro-stats">
                        <div class="stat-item">
                            <span class="stat-number">15+</span>
                            <span class="stat-label">Anni Esperienza</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">200+</span>
                            <span class="stat-label">Progetti</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Clienti</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>" class="intro-btn">
                        Scopri di più su di noi
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
                
                <div class="intro-visual">
                    <div class="visual-decoration"></div>
                    <div class="visual-card">
                        <div class="visual-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            </svg>
                        </div>
                        <h3>La Nostra Mission</h3>
                        <p>Creare connessioni autentiche tra brand e persone attraverso strategie che lasciano il segno.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- 3. TEAM SLIDER (Swiper) -->
    <!-- ========================================================================== -->
    <section class="home-team">
        <div class="team-section-container">
            
            <div class="section-header">
                <span class="section-badge">Il Team</span>
                <h2 class="section-title">Le persone dietro ai successi</h2>
                <p class="section-description">Professionisti appassionati pronti a trasformare le tue idee</p>
            </div>
            
            <?php
            $team_query = new WP_Query(array(
                'post_type' => 'team',
                'posts_per_page' => 12,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ));
            
            if ($team_query->have_posts()) :
            ?>
                <div class="team-slider-wrapper">
                    <div class="swiper team-swiper">
                        <div class="swiper-wrapper">
                            <?php while ($team_query->have_posts()) : $team_query->the_post(); 
                                $position = get_post_meta(get_the_ID(), '_cs_team_position', true);
                            ?>
                                <div class="swiper-slide">
                                    <a href="<?php the_permalink(); ?>" class="team-slide-card">
                                        <div class="team-slide-photo">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('medium_large', array('class' => 'team-img')); ?>
                                            <?php else : ?>
                                                <div class="team-placeholder">
                                                    <span><?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="team-slide-overlay"></div>
                                        </div>
                                        <div class="team-slide-info">
                                            <h3 class="team-name"><?php the_title(); ?></h3>
                                            <?php if ($position) : ?>
                                                <p class="team-role"><?php echo esc_html($position); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        
                        <!-- Navigation -->
                        <div class="team-nav-prev swiper-nav-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </div>
                        <div class="team-nav-next swiper-nav-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="team-pagination"></div>
                    </div>
                </div>
            <?php 
            wp_reset_postdata();
            else : 
            ?>
                <div class="team-empty">
                    <p>Il team sta arrivando! Aggiungi i membri dal pannello admin.</p>
                    <?php if (current_user_can('edit_posts')) : ?>
                        <a href="<?php echo admin_url('post-new.php?post_type=team'); ?>">+ Aggiungi membro</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="team-cta">
                <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>" class="view-team-btn">
                    Conosci tutto il team
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- 4. SERVIZI PREVIEW -->
    <!-- ========================================================================== -->
    <section class="home-servizi">
        <div class="servizi-container">
            
            <div class="section-header">
                <span class="section-badge">Cosa Facciamo</span>
                <h2 class="section-title">I Nostri Servizi</h2>
                <p class="section-description">Soluzioni integrate per ogni esigenza di comunicazione</p>
            </div>
            
            <div class="servizi-grid">
                <?php
                // Prova CPT service
                $services_query = new WP_Query(array(
                    'post_type' => 'service',
                    'posts_per_page' => 6,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                ));
                
                if ($services_query->have_posts()) :
                    while ($services_query->have_posts()) : $services_query->the_post();
                        $icon = herocs_get_service_icon();
                        $icon_svg = isset($service_icons[$icon]) ? $service_icons[$icon] : $service_icons['default'];
                ?>
                    <article class="servizio-card">
                        <div class="servizio-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <?php echo $icon_svg; ?>
                            </svg>
                        </div>
                        <h3 class="servizio-title"><?php the_title(); ?></h3>
                        <p class="servizio-desc"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        <a href="<?php the_permalink(); ?>" class="servizio-link">
                            Scopri di più
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </article>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback servizi statici
                    $servizi_static = array(
                        array('icon' => 'megaphone', 'title' => 'Comunicazione Politica', 'desc' => 'Strategie per campagne elettorali e gestione reputazione'),
                        array('icon' => 'building', 'title' => 'Comunicazione Istituzionale', 'desc' => 'Supporto alle istituzioni pubbliche'),
                        array('icon' => 'heart-handshake', 'title' => 'Comunicazione Sociale', 'desc' => 'Campagne per il terzo settore'),
                        array('icon' => 'smartphone', 'title' => 'Digital Strategy', 'desc' => 'Presenza digitale strategica'),
                        array('icon' => 'video', 'title' => 'Produzione Contenuti', 'desc' => 'Video, foto e grafica professionale'),
                        array('icon' => 'bar-chart', 'title' => 'Analisi e Ricerca', 'desc' => 'Dati e insights strategici'),
                    );
                    
                    foreach ($servizi_static as $servizio) :
                        $icon_svg = $service_icons[$servizio['icon']];
                ?>
                    <article class="servizio-card">
                        <div class="servizio-icon">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <?php echo $icon_svg; ?>
                            </svg>
                        </div>
                        <h3 class="servizio-title"><?php echo esc_html($servizio['title']); ?></h3>
                        <p class="servizio-desc"><?php echo esc_html($servizio['desc']); ?></p>
                        <a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>" class="servizio-link">
                            Scopri di più
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </article>
                <?php 
                    endforeach;
                endif;
                ?>
            </div>
            
            <div class="servizi-cta">
                <a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>" class="view-all-btn">
                    Tutti i servizi
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- 5. COLLABORAZIONI SLIDER (Swiper) -->
    <!-- ========================================================================== -->
    <section class="home-collaborazioni">
        <div class="collab-container">
            
            <div class="section-header">
                <span class="section-badge">Partner</span>
                <h2 class="section-title">Le Nostre Collaborazioni</h2>
                <p class="section-description">Clienti che hanno scelto di fidarsi di noi</p>
            </div>
            
            <?php
            $collab_query = new WP_Query(array(
                'post_type' => 'collaborazioni',
                'posts_per_page' => 20,
                'orderby' => 'menu_order',
                'order' => 'ASC',
            ));
            
            if ($collab_query->have_posts()) :
            ?>
                <div class="collab-slider-wrapper">
                    <div class="swiper collab-swiper">
                        <div class="swiper-wrapper">
                            <?php while ($collab_query->have_posts()) : $collab_query->the_post();
                                $logo = get_post_meta(get_the_ID(), '_cs_collab_logo', true);
                            ?>
                                <div class="swiper-slide">
                                    <div class="collab-logo-card">
                                        <?php if ($logo) : ?>
                                            <img src="<?php echo esc_url($logo); ?>" alt="<?php the_title_attribute(); ?>" class="collab-logo">
                                        <?php elseif (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', array('class' => 'collab-logo')); ?>
                                        <?php else : ?>
                                            <span class="collab-name"><?php the_title(); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            <?php 
            wp_reset_postdata();
            else :
            ?>
                <div class="collab-empty">
                    <p>Le collaborazioni saranno presto visibili.</p>
                </div>
            <?php endif; ?>
            
            <div class="collab-cta">
                <a href="<?php echo esc_url(home_url('/collaborazioni')); ?>" class="view-collab-btn">
                    Vedi tutte le collaborazioni
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
            
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- 6. CTA GRANDE -->
    <!-- ========================================================================== -->
    <section class="home-cta">
        <div class="cta-inner">
            <div class="cta-pattern"></div>
            <div class="cta-content">
                <h2>Pronto a far crescere il tuo brand?</h2>
                <p>Contattaci per una consulenza gratuita e scopri come possiamo aiutarti</p>
                <div class="cta-buttons">
                    <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cta-btn-primary">
                        Contattaci Ora
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="tel:+390000000000" class="cta-btn-secondary">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72"/>
                        </svg>
                        Chiamaci
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================================== -->
    <!-- 7. PRESS PREVIEW -->
    <!-- ========================================================================== -->
    <?php
    $press_query = new WP_Query(array(
        'post_type' => 'press',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    
    if ($press_query->have_posts()) :
    ?>
    <section class="home-press">
        <div class="press-container">
            
            <div class="section-header">
                <span class="section-badge">News</span>
                <h2 class="section-title">Rassegna Stampa</h2>
                <p class="section-description">Le ultime notizie e pubblicazioni</p>
            </div>
            
            <div class="press-grid">
                <?php while ($press_query->have_posts()) : $press_query->the_post();
                    $source = get_post_meta(get_the_ID(), '_cs_press_source', true);
                    $date = get_post_meta(get_the_ID(), '_cs_press_date', true);
                ?>
                    <article class="press-card">
                        <a href="<?php the_permalink(); ?>" class="press-card-link">
                            <div class="press-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', array('class' => 'press-img')); ?>
                                <?php else : ?>
                                    <div class="press-placeholder">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                                            <path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="press-overlay"></div>
                            </div>
                            <div class="press-info">
                                <div class="press-meta">
                                    <?php if ($source) : ?>
                                        <span class="press-source"><?php echo esc_html($source); ?></span>
                                    <?php endif; ?>
                                    <span class="press-date"><?php echo get_the_date('j M Y'); ?></span>
                                </div>
                                <h3 class="press-title"><?php the_title(); ?></h3>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <div class="press-cta">
                <a href="<?php echo esc_url(home_url('/press')); ?>" class="view-press-btn">
                    Tutta la rassegna stampa
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

</main>

<!-- ========================================================================== -->
<!-- SWIPER INITIALIZATION -->
<!-- ========================================================================== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Team Slider
    if (document.querySelector('.team-swiper')) {
        new Swiper('.team-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 800,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            navigation: {
                nextEl: '.team-nav-next',
                prevEl: '.team-nav-prev',
            },
            pagination: {
                el: '.team-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1280: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });
    }
    
    // Collaborazioni Slider
    if (document.querySelector('.collab-swiper')) {
        new Swiper('.collab-swiper', {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            speed: 3000,
            allowTouchMove: true,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            freeMode: true,
            breakpoints: {
                480: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 40,
                },
                1280: {
                    slidesPerView: 6,
                    spaceBetween: 50,
                },
            },
        });
    }
    
});
</script>

<style>
/* ========================================================================== */
/* HOMEPAGE STYLES */
/* ========================================================================== */

.homepage {
    background: #f8fafc;
}

/* Section common */
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
    margin: 0;
}

.section-header {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 50px;
}

/* ========================================================================== */
/* INTRO SECTION */
/* ========================================================================== */

.home-intro {
    padding: 100px 0;
    background: white;
}

.intro-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.intro-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 80px;
    align-items: center;
}

.intro-content .section-title {
    text-align: left;
}

.intro-text {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #475569;
    margin-bottom: 32px;
}

.intro-stats {
    display: flex;
    gap: 40px;
    margin-bottom: 32px;
    padding: 24px 0;
    border-top: 1px solid #e2e8f0;
    border-bottom: 1px solid #e2e8f0;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-family: 'Poppins', sans-serif;
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.stat-label {
    font-size: 0.85rem;
    color: #64748b;
}

.intro-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.intro-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
}

.intro-visual {
    position: relative;
}

.visual-decoration {
    position: absolute;
    top: -20px;
    left: -20px;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(236, 72, 153, 0.2) 100%);
    border-radius: 20px;
    z-index: 1;
}

.visual-card {
    position: relative;
    z-index: 2;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    border-radius: 20px;
    padding: 40px;
    color: white;
}

.visual-icon {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
}

.visual-card h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    margin: 0 0 16px 0;
}

.visual-card p {
    font-size: 1rem;
    line-height: 1.7;
    opacity: 0.95;
    margin: 0;
}

/* ========================================================================== */
/* TEAM SLIDER */
/* ========================================================================== */

.home-team {
    padding: 100px 0;
    background: #f8fafc;
}

.team-section-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
}

.team-slider-wrapper {
    position: relative;
    margin-bottom: 40px;
}

.team-swiper {
    padding: 20px 0;
}

.team-slide-card {
    display: block;
    text-decoration: none;
    border-radius: 16px;
    overflow: hidden;
    background: white;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.4s;
}

.team-slide-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
}

.team-slide-photo {
    position: relative;
    aspect-ratio: 3/4;
    overflow: hidden;
}

.team-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.team-slide-card:hover .team-img {
    transform: scale(1.08);
}

.team-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.team-placeholder span {
    font-size: 4rem;
    font-weight: 700;
    color: white;
    font-family: 'Poppins', sans-serif;
}

.team-slide-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.8) 0%, rgba(236, 72, 153, 0.8) 100%);
    opacity: 0;
    transition: opacity 0.4s;
}

.team-slide-card:hover .team-slide-overlay {
    opacity: 1;
}

.team-slide-info {
    padding: 20px;
    text-align: center;
}

.team-name {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 4px 0;
    transition: color 0.3s;
}

.team-slide-card:hover .team-name {
    color: #7c3aed;
}

.team-role {
    font-size: 0.85rem;
    color: #7c3aed;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0;
}

/* Swiper Navigation */
.swiper-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
    color: #1e293b;
}

.swiper-nav-btn:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.team-nav-prev {
    left: -25px;
}

.team-nav-next {
    right: -25px;
}

.team-pagination {
    text-align: center;
    margin-top: 20px;
}

.team-pagination .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: #cbd5e1;
    opacity: 1;
    margin: 0 5px;
}

.team-pagination .swiper-pagination-bullet-active {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    width: 30px;
    border-radius: 5px;
}

.team-cta, .servizi-cta, .collab-cta, .press-cta {
    text-align: center;
    margin-top: 40px;
}

.view-team-btn, .view-all-btn, .view-collab-btn, .view-press-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: transparent;
    color: #7c3aed;
    border: 2px solid #7c3aed;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}

.view-team-btn:hover, .view-all-btn:hover, .view-collab-btn:hover, .view-press-btn:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
}

.team-empty, .collab-empty {
    background: #f1f5f9;
    padding: 60px;
    text-align: center;
    border-radius: 16px;
    color: #64748b;
}

.team-empty a, .collab-empty a {
    color: #7c3aed;
    font-weight: 600;
}

/* ========================================================================== */
/* SERVIZI SECTION */
/* ========================================================================== */

.home-servizi {
    padding: 100px 0;
    background: white;
}

.servizi-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.servizi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.servizio-card {
    background: white;
    border-radius: 16px;
    padding: 32px;
    border: 1px solid #e2e8f0;
    transition: all 0.4s;
}

.servizio-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.12);
    border-color: #ec4899;
}

.servizio-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #7c3aed;
    margin-bottom: 20px;
    transition: all 0.3s;
}

.servizio-card:hover .servizio-icon {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.servizio-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: #7c3aed;
    margin: 0 0 10px 0;
}

.servizio-desc {
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0 0 16px 0;
}

.servizio-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #7c3aed;
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s;
}

.servizio-link:hover {
    color: #ec4899;
    gap: 10px;
}

/* ========================================================================== */
/* COLLABORAZIONI SLIDER */
/* ========================================================================== */

.home-collaborazioni {
    padding: 100px 0;
    background: #f8fafc;
}

.collab-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
}

.collab-slider-wrapper {
    margin-bottom: 40px;
    overflow: hidden;
}

.collab-swiper {
    overflow: visible;
}

.collab-logo-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    transition: all 0.3s;
}

.collab-logo-card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.collab-logo {
    max-width: 100%;
    max-height: 80px;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s;
}

.collab-logo-card:hover .collab-logo {
    filter: grayscale(0%);
    opacity: 1;
}

.collab-name {
    font-family: 'Poppins', sans-serif;
    font-size: 0.9rem;
    font-weight: 600;
    color: #64748b;
    text-align: center;
}

/* ========================================================================== */
/* CTA SECTION */
/* ========================================================================== */

.home-cta {
    padding: 0;
}

.cta-inner {
    position: relative;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    padding: 100px 24px;
    overflow: hidden;
}

.cta-pattern {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.cta-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.cta-content h2 {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 700;
    color: white;
    margin: 0 0 16px 0;
}

.cta-content p {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 36px 0;
}

.cta-buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 18px 36px;
    background: #ec4899;
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 4px 20px rgba(236, 72, 153, 0.4);
}

.cta-btn-primary:hover {
    background: white;
    color: #ec4899;
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.cta-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 18px 36px;
    background: transparent;
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}

.cta-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
}

/* ========================================================================== */
/* PRESS SECTION */
/* ========================================================================== */

.home-press {
    padding: 100px 0;
    background: white;
}

.press-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.press-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.press-card {
    border-radius: 16px;
    overflow: hidden;
    background: white;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.4s;
}

.press-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.12);
}

.press-card-link {
    display: block;
    text-decoration: none;
}

.press-image {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
    background: #f1f5f9;
}

.press-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s;
}

.press-card:hover .press-img {
    transform: scale(1.08);
}

.press-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e2e8f0 0%, #f8fafc 100%);
    color: #94a3b8;
}

.press-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, transparent 60%);
}

.press-info {
    padding: 24px;
}

.press-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.press-source {
    font-size: 0.75rem;
    font-weight: 600;
    color: #7c3aed;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.press-date {
    font-size: 0.8rem;
    color: #94a3b8;
}

.press-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    line-height: 1.4;
    transition: color 0.3s;
}

.press-card:hover .press-title {
    color: #7c3aed;
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1280px) {
    .team-nav-prev { left: 10px; }
    .team-nav-next { right: 10px; }
}

@media (max-width: 1024px) {
    .intro-grid {
        grid-template-columns: 1fr;
        gap: 50px;
    }
    
    .intro-visual {
        max-width: 450px;
        margin: 0 auto;
    }
    
    .servizi-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .press-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .home-intro,
    .home-team,
    .home-servizi,
    .home-collaborazioni,
    .home-press {
        padding: 60px 0;
    }
    
    .section-header {
        margin-bottom: 40px;
    }
    
    .intro-stats {
        flex-wrap: wrap;
        gap: 24px;
    }
    
    .stat-item {
        flex: 1;
        min-width: 80px;
    }
    
    .servizi-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .press-grid {
        grid-template-columns: 1fr;
    }
    
    .swiper-nav-btn {
        display: none;
    }
    
    .cta-buttons {
        flex-direction: column;
    }
    
    .cta-btn-primary,
    .cta-btn-secondary {
        width: 100%;
        justify-content: center;
    }
    
    .cta-inner {
        padding: 60px 24px;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .homepage {
    background: #0f172a;
}

body.dark-mode .home-intro {
    background: #1e293b;
}

body.dark-mode .section-title {
    color: #f1f5f9;
}

body.dark-mode .section-description,
body.dark-mode .intro-text {
    color: #94a3b8;
}

body.dark-mode .home-team,
body.dark-mode .home-collaborazioni {
    background: #0f172a;
}

body.dark-mode .team-slide-card {
    background: #1e293b;
}

body.dark-mode .team-name {
    color: #f1f5f9;
}

body.dark-mode .team-role {
    color: #a78bfa;
}

body.dark-mode .home-servizi,
body.dark-mode .home-press {
    background: #1e293b;
}

body.dark-mode .servizio-card {
    background: #0f172a;
    border-color: #334155;
}

body.dark-mode .servizio-card:hover {
    border-color: #f472b6;
}

body.dark-mode .servizio-title {
    color: #a78bfa;
}

body.dark-mode .servizio-desc {
    color: #94a3b8;
}

body.dark-mode .collab-logo-card {
    background: #1e293b;
}

body.dark-mode .press-card {
    background: #0f172a;
}

body.dark-mode .press-title {
    color: #f1f5f9;
}

body.dark-mode .press-card:hover .press-title {
    color: #a78bfa;
}

body.dark-mode .swiper-nav-btn {
    background: #1e293b;
    color: #f1f5f9;
}

body.dark-mode .team-empty,
body.dark-mode .collab-empty {
    background: #1e293b;
    color: #94a3b8;
}

body.dark-mode .view-team-btn,
body.dark-mode .view-all-btn,
body.dark-mode .view-collab-btn,
body.dark-mode .view-press-btn {
    color: #a78bfa;
    border-color: #a78bfa;
}

body.dark-mode .view-team-btn:hover,
body.dark-mode .view-all-btn:hover,
body.dark-mode .view-collab-btn:hover,
body.dark-mode .view-press-btn:hover {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
    color: white;
}
</style>

<?php get_footer(); ?>
