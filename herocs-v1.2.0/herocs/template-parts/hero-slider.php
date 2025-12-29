<?php
/**
 * Hero Slider Template - ACF Dynamic
 * Con copertura completa media e opzioni customizer per testi/pulsanti
 *
 * @package HeroCS
 * @since 1.2.0
 */

// Verifica se ACF e attivo e ottieni le impostazioni
$slider_settings = herocs_get_hero_slider_settings();
$slides = herocs_get_hero_slides();

// Se lo slider e disabilitato, non mostrare nulla
if (!$slider_settings['enable'] || empty($slides)) {
    return;
}

$slider_speed = $slider_settings['speed'];
$slider_effect = $slider_settings['effect'];
$slide_count = count($slides);

// Opzioni per mostrare/nascondere contenuti (default: mostra tutto)
$show_title = isset($slider_settings['show_title']) ? $slider_settings['show_title'] : true;
$show_subtitle = isset($slider_settings['show_subtitle']) ? $slider_settings['show_subtitle'] : true;
$show_button = isset($slider_settings['show_button']) ? $slider_settings['show_button'] : true;
$show_content_overlay = $show_title || $show_subtitle || $show_button;
?>

<section class="hero-slider-section">
    <!-- Swiper Container -->
    <div class="swiper hero-swiper" 
         data-speed="<?php echo esc_attr($slider_speed); ?>"
         data-effect="<?php echo esc_attr($slider_effect); ?>"
         data-slides="<?php echo esc_attr($slide_count); ?>">
        
        <div class="swiper-wrapper">
            <?php foreach ($slides as $index => $slide) : 
                // Estrai dati slide (compatibile con ACF e Customizer)
                $media_type = isset($slide['type']) ? $slide['type'] : 'image';
                
                // Immagine - supporta sia array ACF che URL stringa
                $image = isset($slide['image']) ? $slide['image'] : (isset($slide['slide_image']) ? $slide['slide_image'] : null);
                $image_url = is_array($image) ? $image['url'] : (is_string($image) ? $image : '');
                $image_alt = is_array($image) && isset($image['alt']) ? $image['alt'] : '';
                
                // Testi
                $title = isset($slide['title']) ? $slide['title'] : (isset($slide['slide_title']) ? $slide['slide_title'] : '');
                $subtitle = isset($slide['subtitle']) ? $slide['subtitle'] : (isset($slide['slide_subtitle']) ? $slide['slide_subtitle'] : '');
                
                // CTA
                $button_text = isset($slide['cta_text']) ? $slide['cta_text'] : (isset($slide['slide_button_text']) ? $slide['slide_button_text'] : 'Scopri di piÃ¹');
                $button_url = isset($slide['cta_link']) ? $slide['cta_link'] : (isset($slide['slide_button_url']) ? $slide['slide_button_url'] : '#');
                
                // Video
                $video_url = isset($slide['video']) ? $slide['video'] : (isset($slide['slide_video_url']) ? $slide['slide_video_url'] : '');
                
                // Overlay
                $overlay_opacity = isset($slide['overlay']) ? $slide['overlay'] : 40;
                $text_align = isset($slide['text_align']) ? $slide['text_align'] : 'center';
                
                // Determina se usare video
                $is_video = ($media_type === 'video' && !empty($video_url)) || (!empty($video_url) && $media_type !== 'image');
                $video_id = '';
                $video_type = '';
                $is_direct_video = false;
                
                if ($is_video) {
                    if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
                        $video_type = 'youtube';
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video_url, $matches);
                        $video_id = isset($matches[1]) ? $matches[1] : '';
                    } elseif (strpos($video_url, 'vimeo.com') !== false) {
                        $video_type = 'vimeo';
                        preg_match('/vimeo\.com\/(?:video\/)?(\d+)/', $video_url, $matches);
                        $video_id = isset($matches[1]) ? $matches[1] : '';
                    } elseif (preg_match('/\.(mp4|webm|ogg)$/i', $video_url)) {
                        $video_type = 'direct';
                        $is_direct_video = true;
                    }
                }
                
                // Calcola stile overlay
                $overlay_style = "background: linear-gradient(135deg, rgba(124, 58, 237, " . ($overlay_opacity / 100) . ") 0%, rgba(236, 72, 153, " . ($overlay_opacity / 100 * 0.8) . ") 50%, rgba(59, 130, 246, " . ($overlay_opacity / 100 * 0.6) . ") 100%);";
            ?>
            
            <div class="swiper-slide hero-slide" data-slide-index="<?php echo $index; ?>">
                
                <!-- Background: Video o Immagine -->
                <?php if ($is_video && ($video_id || $is_direct_video)) : ?>
                    <div class="hero-slide-video">
                        <?php if ($video_type === 'youtube') : ?>
                            <div class="video-background video-youtube">
                                <iframe 
                                    src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?autoplay=1&mute=1&loop=1&playlist=<?php echo esc_attr($video_id); ?>&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1&disablekb=1&fs=0&iv_load_policy=3&origin=<?php echo esc_url(home_url()); ?>"
                                    frameborder="0"
                                    allow="autoplay; fullscreen"
                                    allowfullscreen
                                    title="Video Background"
                                ></iframe>
                                <!-- Copertura completa per nascondere watermark YouTube -->
                                <div class="video-cover video-cover-top"></div>
                                <div class="video-cover video-cover-bottom"></div>
                                <div class="video-cover video-cover-left"></div>
                                <div class="video-cover video-cover-right"></div>
                            </div>
                        <?php elseif ($video_type === 'vimeo') : ?>
                            <div class="video-background video-vimeo">
                                <iframe 
                                    src="https://player.vimeo.com/video/<?php echo esc_attr($video_id); ?>?autoplay=1&muted=1&loop=1&background=1&title=0&byline=0&portrait=0"
                                    frameborder="0"
                                    allow="autoplay; fullscreen"
                                    allowfullscreen
                                    title="Video Background"
                                ></iframe>
                            </div>
                        <?php elseif ($is_direct_video) : ?>
                            <div class="video-background video-direct">
                                <video autoplay muted loop playsinline>
                                    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Fallback image per video -->
                        <?php if ($image_url) : ?>
                            <img src="<?php echo esc_url($image_url); ?>" 
                                 alt="<?php echo esc_attr($image_alt ?: $title); ?>" 
                                 class="hero-slide-image video-fallback"
                                 loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <!-- Solo immagine -->
                    <?php if ($image_url) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" 
                             alt="<?php echo esc_attr($image_alt ?: $title); ?>" 
                             class="hero-slide-image"
                             loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>">
                    <?php else : ?>
                        <!-- Gradient fallback se nessuna immagine -->
                        <div class="hero-slide-gradient"></div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <!-- Overlay -->
                <div class="hero-slide-overlay" style="<?php echo esc_attr($overlay_style); ?>"></div>
                
                <!-- Contenuto Slide (condizionale) -->
                <?php if ($show_content_overlay) : ?>
                <div class="hero-slide-content text-<?php echo esc_attr($text_align); ?>">
                    <div class="hero-content-inner">
                        <?php if ($show_title && $title) : ?>
                            <h1 class="hero-title"><?php echo esc_html($title); ?></h1>
                        <?php endif; ?>
                        
                        <?php if ($show_subtitle && $subtitle) : ?>
                            <p class="hero-subtitle"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($show_button && $button_text && $button_url && $button_url !== '#') : ?>
                            <div class="hero-cta">
                                <a href="<?php echo esc_url($button_url); ?>" class="hero-btn hero-btn-primary">
                                    <?php echo esc_html($button_text); ?>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Navigation Arrows -->
        <?php if ($slide_count > 1) : ?>
            <div class="hero-nav-prev">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </div>
            <div class="hero-nav-next">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        <?php endif; ?>
        
        <!-- Pagination Dots -->
        <?php if ($slide_count > 1) : ?>
            <div class="hero-pagination"></div>
        <?php endif; ?>
        
    </div>
    
    <!-- Scroll Indicator -->
    <div class="hero-scroll-indicator">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
        <span class="scroll-text">Scorri</span>
    </div>
    
</section>

<style>
/* ========================================================================== */
/* HERO SLIDER - ACF Dynamic Version v1.2 */
/* Copertura completa media - No elementi player visibili */
/* ========================================================================== */

.hero-slider-section {
    position: relative;
    width: 100%;
    height: 100vh;
    min-height: 600px;
    overflow: hidden;
    margin-top: -80px; /* Riduzione spazio navbar-slider */
    padding-top: 0;
}

.hero-swiper {
    width: 100%;
    height: 100%;
}

.hero-slide {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* Background Image - Full Cover */
.hero-slide-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    z-index: 1;
}

/* Video Background Container */
.hero-slide-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    overflow: hidden;
}

/* Video Background - Scala maggiorata per nascondere controlli */
.video-background {
    position: absolute;
    top: 50%;
    left: 50%;
    /* Scala il video per nascondere bordi e controlli */
    width: 120%;
    height: 120%;
    min-width: 120%;
    min-height: 120%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}

/* YouTube specifico - margine extra per nascondere watermark */
.video-background.video-youtube {
    width: 140%;
    height: 140%;
    min-width: 140%;
    min-height: 140%;
}

.video-background iframe,
.video-background video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    border: 0;
    pointer-events: none;
}

/* Coperture per nascondere elementi del player YouTube */
.video-cover {
    position: absolute;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.4) 0%, rgba(236, 72, 153, 0.3) 50%, rgba(59, 130, 246, 0.2) 100%);
    z-index: 2;
    pointer-events: none;
}

.video-cover-top {
    top: 0;
    left: 0;
    right: 0;
    height: 80px;
}

.video-cover-bottom {
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
}

.video-cover-left {
    top: 0;
    bottom: 0;
    left: 0;
    width: 60px;
}

.video-cover-right {
    top: 0;
    bottom: 0;
    right: 0;
    width: 60px;
}

/* Video Direct (mp4, webm) */
.video-direct video {
    object-fit: cover;
}

/* Fallback image mentre carica video */
.video-fallback {
    z-index: 0;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.hero-slide-video:not(.video-loaded) .video-fallback {
    opacity: 1;
}

/* Gradient Fallback */
.hero-slide-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    z-index: 1;
}

/* Overlay */
.hero-slide-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 3;
    pointer-events: none;
}

/* Content */
.hero-slide-content {
    position: relative;
    z-index: 5;
    max-width: 900px;
    width: 100%;
    padding: 0 40px;
    padding-top: 80px; /* Compensa il margin-top negativo della section */
}

.hero-slide-content.text-left {
    text-align: left;
    margin-right: auto;
}

.hero-slide-content.text-center {
    text-align: center;
    margin: 0 auto;
}

.hero-slide-content.text-right {
    text-align: right;
    margin-left: auto;
}

.hero-content-inner {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.hero-slide-content.text-center .hero-content-inner {
    align-items: center;
}

.hero-slide-content.text-left .hero-content-inner {
    align-items: flex-start;
}

.hero-slide-content.text-right .hero-content-inner {
    align-items: flex-end;
}

/* Title */
.hero-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2.5rem, 6vw, 4.5rem);
    font-weight: 800;
    line-height: 1.1;
    color: white;
    text-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    margin: 0;
    opacity: 0;
    transform: translateY(30px);
}

/* Subtitle */
.hero-subtitle {
    font-family: 'Inter', sans-serif;
    font-size: clamp(1rem, 2vw, 1.5rem);
    font-weight: 400;
    color: rgba(255, 255, 255, 0.95);
    max-width: 700px;
    margin: 0;
    line-height: 1.6;
    text-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
    opacity: 0;
    transform: translateY(30px);
}

/* CTA Button */
.hero-cta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    opacity: 0;
    transform: translateY(30px);
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2.5rem;
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    cursor: pointer;
}

.hero-btn-primary {
    background: rgba(255, 255, 255, 0.95);
    color: #7c3aed;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
}

.hero-btn-primary:hover {
    background: white;
    transform: translateY(-3px) scale(1.02);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    color: #ec4899;
}

.hero-btn-primary svg {
    transition: transform 0.3s ease;
}

.hero-btn-primary:hover svg {
    transform: translateX(5px);
}

/* Navigation Arrows */
.hero-nav-prev,
.hero-nav-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    color: white;
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0;
}

.hero-swiper:hover .hero-nav-prev,
.hero-swiper:hover .hero-nav-next {
    opacity: 1;
}

.hero-nav-prev:hover,
.hero-nav-next:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-50%) scale(1.1);
}

.hero-nav-prev {
    left: 30px;
}

.hero-nav-next {
    right: 30px;
}

/* Pagination Dots */
.hero-pagination {
    position: absolute;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    gap: 12px;
}

.hero-pagination .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.4);
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.hero-pagination .swiper-pagination-bullet-active {
    background: white;
    transform: scale(1.2);
}

/* Scroll Indicator */
.hero-scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    color: white;
    opacity: 0.8;
    animation: scrollBounce 2s ease-in-out infinite;
}

.scroll-mouse {
    width: 26px;
    height: 40px;
    border: 2px solid rgba(255, 255, 255, 0.6);
    border-radius: 20px;
    display: flex;
    justify-content: center;
    padding-top: 8px;
}

.scroll-wheel {
    width: 4px;
    height: 8px;
    background: white;
    border-radius: 2px;
    animation: scrollWheel 1.5s ease-in-out infinite;
}

.scroll-text {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

/* Animations */
@keyframes heroFadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scrollBounce {
    0%, 100% {
        transform: translateX(-50%) translateY(0);
    }
    50% {
        transform: translateX(-50%) translateY(10px);
    }
}

@keyframes scrollWheel {
    0% {
        opacity: 1;
        transform: translateY(0);
    }
    100% {
        opacity: 0;
        transform: translateY(10px);
    }
}

/* Reset animation on slide change */
.swiper-slide:not(.swiper-slide-active) .hero-title,
.swiper-slide:not(.swiper-slide-active) .hero-subtitle,
.swiper-slide:not(.swiper-slide-active) .hero-cta {
    animation: none;
    opacity: 0;
    transform: translateY(30px);
}

.swiper-slide-active .hero-title,
.swiper-slide-active .hero-subtitle,
.swiper-slide-active .hero-cta {
    animation: heroFadeInUp 0.8s ease forwards;
}

.swiper-slide-active .hero-title {
    animation-delay: 0.2s;
}

.swiper-slide-active .hero-subtitle {
    animation-delay: 0.4s;
}

.swiper-slide-active .hero-cta {
    animation-delay: 0.6s;
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .hero-slider-section {
        margin-top: -70px;
    }
    
    .hero-nav-prev,
    .hero-nav-next {
        width: 48px;
        height: 48px;
    }
    
    .hero-nav-prev {
        left: 20px;
    }
    
    .hero-nav-next {
        right: 20px;
    }
    
    .video-cover-top {
        height: 60px;
    }
    
    .video-cover-bottom {
        height: 80px;
    }
}

@media (max-width: 768px) {
    .hero-slider-section {
        min-height: 500px;
        margin-top: -60px;
    }
    
    .hero-slide-content {
        padding: 0 24px;
        padding-top: 60px;
    }
    
    .hero-title {
        font-size: clamp(2rem, 8vw, 3rem);
        margin-bottom: 1rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
        margin-bottom: 2rem;
    }
    
    .hero-btn {
        padding: 14px 32px;
        font-size: 0.9rem;
    }
    
    .hero-nav-prev,
    .hero-nav-next {
        width: 40px;
        height: 40px;
        opacity: 1;
    }
    
    .hero-nav-prev {
        left: 10px;
    }
    
    .hero-nav-next {
        right: 10px;
    }
    
    .hero-pagination {
        bottom: 20px;
    }
    
    .hero-scroll-indicator {
        display: none;
    }
    
    /* Video cover piÃ¹ ampia su mobile */
    .video-background.video-youtube {
        width: 160%;
        height: 160%;
        min-width: 160%;
        min-height: 160%;
    }
    
    .video-cover-top {
        height: 50px;
    }
    
    .video-cover-bottom {
        height: 70px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.75rem;
    }
    
    .hero-subtitle {
        font-size: 0.9rem;
    }
    
    .hero-btn {
        width: 100%;
        justify-content: center;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .hero-btn-primary {
    background: rgba(255, 255, 255, 0.9);
}

body.dark-mode .hero-btn-primary:hover {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
}
</style>
