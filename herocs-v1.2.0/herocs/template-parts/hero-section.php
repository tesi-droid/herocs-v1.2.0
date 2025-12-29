<?php
/**
 * Hero Section Template Part - With Slider
 * Versione 1.2.0 - Copertura completa media, opzioni visibilitÃ  contenuti
 *
 * @package HeroCS
 * @since 1.2.0
 */

$enable_slider = get_theme_mod('cs_hero_enable_slider', true);

if ($enable_slider && is_front_page()) {
    // Include lo slider dinamico
    // Include lo slider dinamico dalla cartella template-parts
    get_template_part('template-parts/hero', 'slider');
} elseif (!is_front_page()) {
    // Per pagine interne - Hero statico
    $page_title = get_the_title();
    $page_subtitle = get_field('page_subtitle') ? get_field('page_subtitle') : '';
    $hero_image = get_field('hero_image') ? get_field('hero_image') : '';
    ?>
    
    <section class="page-hero">
        <?php if ($hero_image) : ?>
            <img src="<?php echo esc_url($hero_image['url']); ?>" 
                 alt="<?php echo esc_attr($hero_image['alt']); ?>" 
                 class="page-hero-image">
        <?php endif; ?>
        
        <div class="page-hero-overlay"></div>
        
        <div class="page-hero-content">
            <h1 class="page-hero-title"><?php echo esc_html($page_title); ?></h1>
            <?php if ($page_subtitle) : ?>
                <p class="page-hero-subtitle"><?php echo esc_html($page_subtitle); ?></p>
            <?php endif; ?>
        </div>
    </section>
    
    <style>
    .page-hero {
        position: relative;
        width: 100%;
        height: 50vh;
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-top: -80px;
        padding-top: 80px;
    }
    
    .page-hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }
    
    .page-hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(124, 58, 237, 0.6) 0%, rgba(236, 72, 153, 0.5) 50%, rgba(59, 130, 246, 0.4) 100%);
        z-index: 2;
    }
    
    .page-hero-content {
        position: relative;
        z-index: 3;
        text-align: center;
        color: white;
        padding: 0 20px;
        max-width: 800px;
    }
    
    .page-hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
    }
    
    .page-hero-subtitle {
        font-size: clamp(1rem, 2vw, 1.25rem);
        opacity: 0.9;
        margin: 0;
    }
    
    @media (max-width: 768px) {
        .page-hero {
            height: 40vh;
            min-height: 280px;
            margin-top: -70px;
            padding-top: 70px;
        }
    }
    
    body.dark-mode .page-hero-overlay {
        background: linear-gradient(135deg, rgba(167, 139, 250, 0.7) 0%, rgba(244, 114, 182, 0.6) 50%, rgba(96, 165, 250, 0.5) 100%);
    }
    </style>
    
    <?php
} else {
    // Homepage senza slider abilitato - Hero statico fallback
    $title = get_theme_mod('cs_hero_title', 'CS Communication');
    $subtitle = get_theme_mod('cs_hero_subtitle', 'Strategie di comunicazione innovativa per il tuo brand');
    $button_text = get_theme_mod('cs_hero_button_text', 'Scopri i nostri servizi');
    $button_url = get_theme_mod('cs_hero_button_url', '#servizi');
    ?>
    
    <section class="hero-static">
        <div class="hero-static-overlay"></div>
        <div class="hero-static-content">
            <h1 class="hero-static-title"><?php echo esc_html($title); ?></h1>
            <p class="hero-static-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php if ($button_text && $button_url) : ?>
                <a href="<?php echo esc_url($button_url); ?>" class="hero-static-btn">
                    <?php echo esc_html($button_text); ?>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </section>
    
    <style>
    .hero-static {
        position: relative;
        width: 100%;
        height: 100vh;
        min-height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
        margin-top: -80px;
    }
    
    .hero-static-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,...') repeat;
        opacity: 0.1;
        z-index: 1;
    }
    
    .hero-static-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        padding: 0 40px;
        max-width: 900px;
    }
    
    .hero-static-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    }
    
    .hero-static-subtitle {
        font-size: clamp(1rem, 2vw, 1.5rem);
        opacity: 0.95;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .hero-static-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2.5rem;
        background: rgba(255, 255, 255, 0.95);
        color: #7c3aed;
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 50px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    
    .hero-static-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        color: #ec4899;
    }
    
    @media (max-width: 768px) {
        .hero-static {
            min-height: 500px;
            margin-top: -70px;
        }
        
        .hero-static-content {
            padding: 0 24px;
        }
    }
    </style>
    
    <?php
}
?>
