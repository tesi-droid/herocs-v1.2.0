<?php
/**
 * Single Service Template
 * Pagina dettaglio singolo servizio
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();
?>

<main id="primary" class="site-main single-service-page">
    <?php while (have_posts()) : the_post(); 
        // Recupera meta fields
        $icon = herocs_get_service_icon();
        $subtitle = herocs_get_service_subtitle();
        $vantaggi = herocs_get_service_vantaggi();
        $steps = herocs_get_service_steps();
        $cta = herocs_get_service_cta();
        
        // Mappa icone SVG
        $icons_svg = array(
            'briefcase' => '<path d="M20 7H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2z"/><path d="M16 21V5c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v16"/>',
            'chart-line' => '<polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>',
            'users' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
            'megaphone' => '<path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>',
            'target' => '<circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>',
            'lightbulb' => '<path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A6 6 0 0 0 6 8c0 1 .2 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"/><path d="M9 18h6"/><path d="M10 22h4"/>',
            'video' => '<rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/><line x1="7" y1="2" x2="7" y2="22"/><line x1="17" y1="2" x2="17" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><line x1="2" y1="7" x2="7" y2="7"/><line x1="2" y1="17" x2="7" y2="17"/><line x1="17" y1="17" x2="22" y2="17"/><line x1="17" y1="7" x2="22" y2="7"/>',
            'bar-chart' => '<line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>',
            'globe' => '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>',
            'pen-tool' => '<path d="m12 19 7-7 3 3-7 7-3-3z"/><path d="m18 13-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="m2 2 7.586 7.586"/><circle cx="11" cy="11" r="2"/>',
            'default' => '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>',
        );
        
        $icon_svg = isset($icons_svg[$icon]) ? $icons_svg[$icon] : $icons_svg['default'];
    ?>

    <!-- Hero Header con Gradient -->
    <section class="service-hero">
        <div class="hero-gradient-bg"></div>
        <div class="hero-pattern"></div>
        <div class="hero-content">
            <div class="hero-container">
                <!-- Breadcrumb -->
                <nav class="hero-breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span class="separator">/</span>
                    <a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">Servizi</a>
                    <span class="separator">/</span>
                    <span class="current"><?php the_title(); ?></span>
                </nav>
                
                <!-- Icon -->
                <div class="hero-icon">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <?php echo $icon_svg; ?>
                    </svg>
                </div>
                
                <!-- Title -->
                <h1 class="hero-title"><?php the_title(); ?></h1>
                
                <?php if ($subtitle) : ?>
                    <p class="hero-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php elseif (has_excerpt()) : ?>
                    <p class="hero-subtitle"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <article id="post-<?php the_ID(); ?>" <?php post_class('service-content'); ?>>
        <div class="service-container">
            
            <!-- Overview Section -->
            <section class="service-overview">
                <div class="overview-grid">
                    
                    <!-- Main Content -->
                    <div class="overview-content">
                        <span class="section-badge">Panoramica</span>
                        <h2 class="section-title">Di cosa si tratta</h2>
                        
                        <div class="content-text">
                            <?php the_content(); ?>
                        </div>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="service-featured-image">
                                <?php the_post_thumbnail('large', array('class' => 'featured-img')); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Sidebar: Vantaggi -->
                    <?php if (!empty($vantaggi)) : ?>
                        <aside class="overview-sidebar">
                            <div class="vantaggi-card">
                                <h3>Perche scegliere questo servizio</h3>
                                <ul class="vantaggi-list">
                                    <?php foreach ($vantaggi as $vantaggio) : ?>
                                        <li>
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <polyline points="20 6 9 17 4 12"/>
                                            </svg>
                                            <span><?php echo esc_html($vantaggio); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </aside>
                    <?php endif; ?>
                    
                </div>
            </section>
            
            <!-- Come Funziona Section -->
            <?php 
            $has_steps = array_filter($steps);
            if (!empty($has_steps)) : 
            ?>
                <section class="service-steps">
                    <div class="section-header">
                        <span class="section-badge">Processo</span>
                        <h2 class="section-title">Come Funziona</h2>
                        <p class="section-description">Un processo strutturato per garantire risultati eccellenti</p>
                    </div>
                    
                    <div class="steps-grid">
                        <?php foreach ($steps as $index => $step) : 
                            if (empty($step)) continue;
                            $step_num = $index + 1;
                        ?>
                            <div class="step-card">
                                <div class="step-number"><?php echo str_pad($step_num, 2, '0', STR_PAD_LEFT); ?></div>
                                <div class="step-content">
                                    <h4>Step <?php echo $step_num; ?></h4>
                                    <p><?php echo esc_html($step); ?></p>
                                </div>
                                <?php if ($step_num < 4) : ?>
                                    <div class="step-arrow">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
            
            <!-- CTA Section -->
            <section class="service-cta">
                <div class="cta-card">
                    <div class="cta-content">
                        <h2>Pronto a iniziare?</h2>
                        <p>Contattaci per una consulenza gratuita e scopri come possiamo aiutarti</p>
                    </div>
                    <div class="cta-actions">
                        <a href="<?php echo esc_url($cta['url']); ?>" class="cta-btn cta-btn-primary">
                            <?php echo esc_html($cta['text']); ?>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                        <a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>" class="cta-btn cta-btn-secondary">
                            Tutti i Servizi
                        </a>
                    </div>
                </div>
            </section>
            
            <!-- Altri Servizi -->
            <?php
            $related_services = new WP_Query(array(
                'post_type' => 'service',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'orderby' => 'rand',
            ));
            
            if ($related_services->have_posts()) :
            ?>
                <section class="service-related">
                    <div class="section-header">
                        <h2 class="section-title">Altri Servizi</h2>
                    </div>
                    
                    <div class="related-grid">
                        <?php while ($related_services->have_posts()) : $related_services->the_post(); 
                            $rel_icon = herocs_get_service_icon();
                            $rel_icon_svg = isset($icons_svg[$rel_icon]) ? $icons_svg[$rel_icon] : $icons_svg['default'];
                        ?>
                            <a href="<?php the_permalink(); ?>" class="related-card">
                                <div class="related-icon">
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <?php echo $rel_icon_svg; ?>
                                    </svg>
                                </div>
                                <h4><?php the_title(); ?></h4>
                                <span class="related-link">Scopri di più â" '</span>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </section>
            <?php 
            wp_reset_postdata();
            endif; 
            ?>
            
        </div>
    </article>

    <?php endwhile; ?>
</main>

<style>
/* ========================================================================== */
/* SINGLE SERVICE - Styles */
/* ========================================================================== */

.single-service-page {
    background: #f8fafc;
}

/* Hero */
.service-hero {
    position: relative;
    min-height: 450px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 120px 24px 80px;
}

.service-hero .hero-gradient-bg {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
}

.service-hero .hero-pattern {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.service-hero .hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    width: 100%;
}

.service-hero .hero-container {
    max-width: 800px;
    margin: 0 auto;
}

.service-hero .hero-breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-size: 0.9rem;
    margin-bottom: 30px;
}

.service-hero .hero-breadcrumb a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: color 0.3s;
}

.service-hero .hero-breadcrumb a:hover {
    color: white;
}

.service-hero .hero-breadcrumb .separator {
    color: rgba(255, 255, 255, 0.4);
}

.service-hero .hero-breadcrumb .current {
    color: white;
    font-weight: 500;
}

.service-hero .hero-icon {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 30px;
    color: white;
}

.service-hero .hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 700;
    color: white;
    margin: 0 0 20px 0;
    line-height: 1.15;
}

.service-hero .hero-subtitle {
    font-size: clamp(1.1rem, 2vw, 1.35rem);
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    margin: 0;
    max-width: 600px;
    margin: 0 auto;
}

/* Container */
.service-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* Overview Section */
.service-overview {
    padding: 80px 0;
    background: white;
    margin-top: -40px;
    border-radius: 20px 20px 0 0;
    position: relative;
    z-index: 3;
}

.overview-grid {
    display: grid;
    grid-template-columns: 1fr 380px;
    gap: 60px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
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
    font-size: clamp(1.75rem, 3vw, 2.25rem);
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 24px 0;
    line-height: 1.2;
}

.content-text {
    font-family: 'Inter', sans-serif;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #475569;
}

.content-text p {
    margin-bottom: 1.5em;
}

.content-text h2, .content-text h3 {
    font-family: 'Poppins', sans-serif;
    color: #1e293b;
    margin: 2em 0 1em;
}

.content-text ul, .content-text ol {
    padding-left: 1.5em;
    margin-bottom: 1.5em;
}

.content-text li {
    margin-bottom: 0.5em;
}

.service-featured-image {
    margin-top: 40px;
    border-radius: 16px;
    overflow: hidden;
}

.featured-img {
    width: 100%;
    height: auto;
    display: block;
}

/* Vantaggi Sidebar */
.vantaggi-card {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 20px;
    padding: 36px;
    color: white;
    position: sticky;
    top: 100px;
}

.vantaggi-card h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0 0 24px 0;
}

.vantaggi-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.vantaggi-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
}

.vantaggi-list li:last-child {
    border-bottom: none;
}

.vantaggi-list svg {
    flex-shrink: 0;
    margin-top: 2px;
}

.vantaggi-list span {
    font-size: 0.95rem;
    line-height: 1.5;
}

/* Steps Section */
.service-steps {
    padding: 80px 0;
    background: #f8fafc;
}

.service-steps .section-header {
    text-align: center;
    max-width: 600px;
    margin: 0 auto 50px;
}

.section-description {
    font-size: 1.1rem;
    color: #64748b;
    margin: 0;
}

.steps-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.step-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    text-align: center;
    position: relative;
    transition: all 0.3s;
}

.step-card:hover {
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

.step-content h4 {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    color: #7c3aed;
    margin: 0 0 8px 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.step-content p {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
}

.step-arrow {
    position: absolute;
    right: -30px;
    top: 50%;
    transform: translateY(-50%);
    color: #cbd5e1;
    z-index: 2;
}

/* CTA Section */
.service-cta {
    padding: 60px 0 80px;
}

.cta-card {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
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
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
}

.cta-actions {
    display: flex;
    gap: 16px;
    flex-shrink: 0;
}

.cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    white-space: nowrap;
}

.cta-btn-primary {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.cta-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(124, 58, 237, 0.4);
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
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.cta-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: white;
}

/* Related Services */
.service-related {
    padding: 0 0 80px;
}

.service-related .section-header {
    margin-bottom: 30px;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.related-card {
    background: white;
    border-radius: 16px;
    padding: 30px;
    text-decoration: none;
    transition: all 0.3s;
    border: 1px solid transparent;
}

.related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(124, 58, 237, 0.1);
    border-color: rgba(124, 58, 237, 0.2);
}

.related-icon {
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

.related-card:hover .related-icon {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.related-card h4 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 12px 0;
}

.related-link {
    font-size: 0.9rem;
    color: #7c3aed;
    font-weight: 500;
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .overview-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .overview-sidebar {
        order: -1;
    }
    
    .vantaggi-card {
        position: static;
    }
    
    .steps-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
    
    .step-arrow {
        display: none;
    }
    
    .cta-card {
        flex-direction: column;
        text-align: center;
        padding: 50px 30px;
    }
    
    .related-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .service-hero {
        padding: 100px 20px 60px;
        min-height: 400px;
    }
    
    .service-hero .hero-icon {
        width: 80px;
        height: 80px;
    }
    
    .service-overview {
        padding: 50px 0;
        margin-top: -20px;
    }
    
    .service-steps {
        padding: 50px 0;
    }
    
    .steps-grid {
        grid-template-columns: 1fr;
    }
    
    .cta-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .cta-btn {
        justify-content: center;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .single-service-page {
    background: #0f172a;
}

body.dark-mode .service-overview {
    background: #1e293b;
}

body.dark-mode .section-title {
    color: #f1f5f9;
}

body.dark-mode .content-text {
    color: #94a3b8;
}

body.dark-mode .content-text h2,
body.dark-mode .content-text h3 {
    color: #f1f5f9;
}

body.dark-mode .service-steps {
    background: #0f172a;
}

body.dark-mode .step-card {
    background: #1e293b;
}

body.dark-mode .step-content p {
    color: #94a3b8;
}

body.dark-mode .cta-card {
    background: linear-gradient(135deg, #334155 0%, #1e293b 100%);
}

body.dark-mode .related-card {
    background: #1e293b;
}

body.dark-mode .related-card h4 {
    color: #f1f5f9;
}

body.dark-mode .related-link {
    color: #a78bfa;
}
</style>

<?php get_footer(); ?>
