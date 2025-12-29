<?php
/**
 * Header Template
 * Layout: Menu Left + Logo Center (con sporgenza) + Actions Right (Dark Mode)
 *
 * @package HeroCS
 * @since 1.2.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <?php if (has_custom_logo()) : ?>
        <link rel="preload" as="image" href="<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>">
    <?php endif; ?>
    
    <style>
        /* Critical CSS */
        body { margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        .site-header { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; }
    </style>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-theme="<?php echo esc_attr(get_theme_mod('cs_default_mode', 'light')); ?>">
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary">
    <?php esc_html_e('Skip to content', 'herocs'); ?>
</a>

<div id="page" class="site">
    
    <!-- ========================================================================== -->
    <!-- HEADER - Logo Centrato con Sporgenza -->
    <!-- ========================================================================== -->
    <header id="masthead" class="site-header header-centered-logo" role="banner">
        <div class="header-inner">
            
            <!-- Left Section: Navigation -->
            <div class="header-left">
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'herocs'); ?>">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                            'menu_class' => 'primary-menu',
                            'container' => false,
                            'fallback_cb' => false,
                        ));
                    }
                    ?>
                </nav>
                
                <!-- Mobile Menu Toggle (visibile solo su mobile) -->
                <button class="mobile-menu-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle menu', 'herocs'); ?>">
                    <span class="hamburger">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </span>
                </button>
            </div>
            
            <!-- Center Section: Logo con Sporgenza Circolare -->
            <div class="header-center">
                <div class="logo-container">
                    <div class="logo-circle">
                        <?php if (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title-link" rel="home">
                                <span class="site-title"><?php bloginfo('name'); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Section: Dark Mode Toggle -->
            <div class="header-right">
                <div class="header-actions">
                    <!-- Dark Mode Toggle - Posizionato a destra -->
                    <button class="dark-mode-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'herocs'); ?>" aria-pressed="false">
                        <svg class="icon-sun" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                        </svg>
                        <svg class="icon-moon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                        </svg>
                    </button>
                </div>
            </div>
            
        </div>
    </header>

    <!-- ========================================================================== -->
    <!-- MOBILE MENU (Slide-in) -->
    <!-- ========================================================================== -->
    <div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>
    
    <nav id="mobile-menu" class="mobile-menu" role="navigation" aria-label="<?php esc_attr_e('Mobile Navigation', 'herocs'); ?>">
        
        <div class="mobile-menu-header">
            <div class="mobile-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <span class="site-title"><?php bloginfo('name'); ?></span>
                <?php endif; ?>
            </div>
            <button class="mobile-menu-close" aria-label="<?php esc_attr_e('Close menu', 'herocs'); ?>">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        
        <div class="mobile-menu-content">
            <?php
            if (has_nav_menu('mobile')) {
                wp_nav_menu(array(
                    'theme_location' => 'mobile',
                    'menu_id' => 'mobile-menu-list',
                    'menu_class' => 'mobile-menu-list',
                    'container' => false,
                    'fallback_cb' => false,
                ));
            } elseif (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id' => 'mobile-menu-list',
                    'menu_class' => 'mobile-menu-list',
                    'container' => false,
                    'fallback_cb' => false,
                ));
            }
            ?>
        </div>
        
        <div class="mobile-menu-footer">
            <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="mobile-cta-btn">
                Contattaci
            </a>
        </div>
        
    </nav>

    <div id="content" class="site-content">

<style>
/* ========================================================================== */
/* HEADER STYLES - Logo Centrato con Sporgenza v1.2 */
/* ========================================================================== */

.site-header {
    background: white;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 80px;
}

.site-header.scrolled {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Layout a 3 colonne */
.header-inner {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    height: 100%;
    gap: 1rem;
}

/* Sezione sinistra - Menu */
.header-left {
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

/* Sezione centrale - Logo con sporgenza */
.header-center {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.logo-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Cerchio del logo con sporgenza */
.logo-circle {
    position: relative;
    width: 100px;
    height: 100px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(124, 58, 237, 0.15);
    border: 3px solid transparent;
    background-image: linear-gradient(white, white), linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    background-origin: border-box;
    background-clip: padding-box, border-box;
    margin-top: 20px; /* Sporgenza verso il basso */
    transition: all 0.3s ease;
    z-index: 10;
}

.logo-circle:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 30px rgba(124, 58, 237, 0.25);
}

/* Logo immagine */
.logo-circle .custom-logo-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    padding: 12px;
}

.logo-circle .custom-logo {
    max-width: 70px;
    max-height: 70px;
    width: auto;
    height: auto;
    object-fit: contain;
    transition: opacity 0.3s;
}

.logo-circle .custom-logo:hover {
    opacity: 0.85;
}

/* Titolo sito (fallback) */
.logo-circle .site-title-link {
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.logo-circle .site-title {
    font-family: 'Poppins', sans-serif;
    font-size: 0.9rem;
    font-weight: 700;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-align: center;
    line-height: 1.2;
}

/* Sezione destra - Dark Mode */
.header-right {
    display: flex;
    align-items: center;
    justify-content: flex-end;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* Dark Mode Toggle - Stile migliorato */
.dark-mode-toggle {
    position: relative;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    border: none;
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    color: #7c3aed;
}

.dark-mode-toggle:hover {
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(236, 72, 153, 0.2) 100%);
    transform: scale(1.1);
}

.dark-mode-toggle .icon-sun,
.dark-mode-toggle .icon-moon {
    position: absolute;
    transition: all 0.3s ease;
}

.dark-mode-toggle .icon-moon {
    opacity: 0;
    transform: rotate(-90deg) scale(0);
}

body.dark-mode .dark-mode-toggle .icon-sun {
    opacity: 0;
    transform: rotate(90deg) scale(0);
}

body.dark-mode .dark-mode-toggle .icon-moon {
    opacity: 1;
    transform: rotate(0) scale(1);
}

/* Main Navigation */
.main-navigation {
    display: flex;
    align-items: center;
}

.primary-menu {
    display: flex;
    align-items: center;
    gap: 2rem;
    list-style: none;
    margin: 0;
    padding: 0;
}

.primary-menu li {
    position: relative;
}

.primary-menu > li > a {
    display: block;
    padding: 0.5rem 0;
    color: #334155;
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s;
    position: relative;
}

.primary-menu > li > a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    transition: width 0.3s ease;
}

.primary-menu > li > a:hover,
.primary-menu > li.current-menu-item > a {
    color: #7c3aed;
}

.primary-menu > li > a:hover::after,
.primary-menu > li.current-menu-item > a::after {
    width: 100%;
}

/* Submenu */
.primary-menu .sub-menu {
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%) translateY(10px);
    min-width: 220px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    padding: 0.75rem 0;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 100;
    list-style: none;
}

.primary-menu li:hover > .sub-menu {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(0);
}

.primary-menu .sub-menu a {
    display: block;
    padding: 0.75rem 1.5rem;
    color: #334155;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.primary-menu .sub-menu a:hover {
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    color: #7c3aed;
    padding-left: 1.75rem;
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none;
    width: 44px;
    height: 44px;
    border: none;
    background: transparent;
    cursor: pointer;
    padding: 8px;
    border-radius: 8px;
    transition: background 0.3s;
}

.mobile-menu-toggle:hover {
    background: rgba(124, 58, 237, 0.1);
}

.hamburger {
    display: flex;
    flex-direction: column;
    gap: 5px;
    width: 100%;
    height: 100%;
    justify-content: center;
    align-items: center;
}

.hamburger-line {
    width: 24px;
    height: 2px;
    background: #334155;
    border-radius: 2px;
    transition: all 0.3s ease;
}

/* Mobile Menu */
.mobile-menu-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 998;
}

.mobile-menu-overlay.active {
    opacity: 1;
    visibility: visible;
}

.mobile-menu {
    position: fixed;
    top: 0;
    right: -100%;
    width: 100%;
    max-width: 360px;
    height: 100%;
    background: white;
    z-index: 999;
    transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    overflow-y: auto;
}

.mobile-menu.active {
    right: 0;
}

.mobile-menu-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e2e8f0;
}

.mobile-logo img {
    max-height: 45px;
    width: auto;
}

.mobile-menu-close {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background: #f1f5f9;
    border-radius: 50%;
    cursor: pointer;
    color: #64748b;
    transition: all 0.3s;
}

.mobile-menu-close:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.mobile-menu-content {
    flex: 1;
    padding: 1rem 0;
    overflow-y: auto;
}

.mobile-menu-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.mobile-menu-list li {
    border-bottom: 1px solid #f1f5f9;
}

.mobile-menu-list a {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    color: #334155;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
}

.mobile-menu-list a:hover,
.mobile-menu-list .current-menu-item > a {
    background: linear-gradient(135deg, rgba(124, 58, 237, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);
    color: #7c3aed;
    padding-left: 2rem;
}

.mobile-menu-list .sub-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    background: #f8fafc;
}

.mobile-menu-list .sub-menu a {
    padding-left: 2.5rem;
    font-size: 0.9rem;
}

.mobile-menu-footer {
    padding: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.mobile-cta-btn {
    display: block;
    text-align: center;
    padding: 1rem;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    font-weight: 600;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s;
}

.mobile-cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4);
    color: white;
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .main-navigation {
        display: none;
    }
    
    .mobile-menu-toggle {
        display: flex;
    }
    
    .logo-circle {
        width: 85px;
        height: 85px;
        margin-top: 15px;
    }
    
    .logo-circle .custom-logo {
        max-width: 55px;
        max-height: 55px;
    }
    
    .header-inner {
        grid-template-columns: auto 1fr auto;
    }
    
    .header-left {
        order: 1;
    }
    
    .header-center {
        order: 2;
    }
    
    .header-right {
        order: 3;
    }
}

@media (max-width: 768px) {
    .site-header {
        height: 70px;
    }
    
    .logo-circle {
        width: 75px;
        height: 75px;
        margin-top: 12px;
    }
    
    .logo-circle .custom-logo {
        max-width: 48px;
        max-height: 48px;
    }
    
    .logo-circle .custom-logo-link {
        padding: 8px;
    }
    
    .dark-mode-toggle {
        width: 42px;
        height: 42px;
    }
    
    .dark-mode-toggle svg {
        width: 18px;
        height: 18px;
    }
}

@media (max-width: 480px) {
    .header-inner {
        padding: 0 1rem;
    }
    
    .logo-circle {
        width: 65px;
        height: 65px;
        margin-top: 10px;
    }
    
    .logo-circle .custom-logo {
        max-width: 42px;
        max-height: 42px;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .site-header {
    background: #1e293b;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

body.dark-mode .logo-circle {
    background: #1e293b;
    background-image: linear-gradient(#1e293b, #1e293b), linear-gradient(135deg, #a78bfa 0%, #f472b6 50%, #60a5fa 100%);
    box-shadow: 0 4px 20px rgba(167, 139, 250, 0.2);
}

body.dark-mode .primary-menu > li > a {
    color: #e2e8f0;
}

body.dark-mode .primary-menu > li > a:hover,
body.dark-mode .primary-menu > li.current-menu-item > a {
    color: #a78bfa;
}

body.dark-mode .primary-menu > li > a::after {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
}

body.dark-mode .primary-menu .sub-menu {
    background: #334155;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
}

body.dark-mode .primary-menu .sub-menu a {
    color: #cbd5e1;
}

body.dark-mode .primary-menu .sub-menu a:hover {
    background: rgba(167, 139, 250, 0.15);
    color: #a78bfa;
}

body.dark-mode .dark-mode-toggle {
    background: #334155;
    color: #f472b6;
}

body.dark-mode .dark-mode-toggle:hover {
    background: #475569;
}

body.dark-mode .hamburger-line {
    background: #e2e8f0;
}

body.dark-mode .mobile-menu {
    background: #1e293b;
}

body.dark-mode .mobile-menu-header {
    border-color: #334155;
}

body.dark-mode .mobile-menu-close {
    background: #334155;
    color: #94a3b8;
}

body.dark-mode .mobile-menu-list li {
    border-color: #334155;
}

body.dark-mode .mobile-menu-list a {
    color: #e2e8f0;
}

body.dark-mode .mobile-menu-list a:hover,
body.dark-mode .mobile-menu-list .current-menu-item > a {
    background: rgba(167, 139, 250, 0.15);
    color: #a78bfa;
}

body.dark-mode .mobile-menu-list .sub-menu {
    background: #0f172a;
}

body.dark-mode .mobile-menu-footer {
    border-color: #334155;
}

/* ========================================
   GLOBAL DARK MODE STYLES
   ======================================== */
html.dark-mode,
body.dark-mode {
    --cs-bg: #0f172a;
    --cs-bg-secondary: #1e293b;
    --cs-text: #e2e8f0;
    --cs-text-muted: #94a3b8;
    --cs-border: #334155;
    color-scheme: dark;
}

body.dark-mode {
    background-color: #0f172a;
    color: #e2e8f0;
}

body.dark-mode main,
body.dark-mode .site-content,
body.dark-mode article,
body.dark-mode section:not(.hero-slider-section) {
    background-color: #0f172a;
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode h3,
body.dark-mode h4,
body.dark-mode h5,
body.dark-mode h6 {
    color: #f1f5f9;
}

body.dark-mode p,
body.dark-mode li,
body.dark-mode span:not(.icon) {
    color: #cbd5e1;
}

body.dark-mode a {
    color: #a78bfa;
}

body.dark-mode a:hover {
    color: #f472b6;
}

body.dark-mode .card,
body.dark-mode .service-card,
body.dark-mode .team-card,
body.dark-mode .press-card,
body.dark-mode .portfolio-card {
    background: #1e293b;
    border-color: #334155;
}

body.dark-mode input,
body.dark-mode textarea,
body.dark-mode select {
    background: #1e293b;
    border-color: #334155;
    color: #e2e8f0;
}

body.dark-mode input::placeholder,
body.dark-mode textarea::placeholder {
    color: #64748b;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const mobileClose = document.querySelector('.mobile-menu-close');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileOverlay = document.querySelector('.mobile-menu-overlay');
    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    
    // Header scroll effect
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });
    
    // Mobile menu toggle
    function openMobileMenu() {
        mobileMenu.classList.add('active');
        mobileOverlay.classList.add('active');
        mobileToggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        mobileOverlay.classList.remove('active');
        mobileToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }
    
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            if (isExpanded) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }
    
    if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileMenu);
    }
    
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }
    
    // ========================================
    // DARK MODE TOGGLE - IMPROVED
    // ========================================
    function setDarkMode(isDark) {
        if (isDark) {
            document.body.classList.add('dark-mode');
            document.documentElement.classList.add('dark-mode');
            if (darkModeToggle) {
                darkModeToggle.setAttribute('aria-pressed', 'true');
            }
        } else {
            document.body.classList.remove('dark-mode');
            document.documentElement.classList.remove('dark-mode');
            if (darkModeToggle) {
                darkModeToggle.setAttribute('aria-pressed', 'false');
            }
        }
        console.log('Dark mode:', isDark ? 'ON' : 'OFF');
    }
    
    // Check saved preference first, then system preference
    const savedTheme = localStorage.getItem('herocs-theme');
    const systemPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (savedTheme === 'dark') {
        setDarkMode(true);
    } else if (savedTheme === 'light') {
        setDarkMode(false);
    } else if (systemPrefersDark) {
        // No saved preference, use system preference
        setDarkMode(true);
    }
    
    // Toggle click handler
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const isDark = !document.body.classList.contains('dark-mode');
            setDarkMode(isDark);
            localStorage.setItem('herocs-theme', isDark ? 'dark' : 'light');
        });
    }
    
    // Listen for system preference changes
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            // Only apply if user hasn't set a preference
            if (!localStorage.getItem('herocs-theme')) {
                setDarkMode(e.matches);
            }
        });
    }
    
    // Close mobile menu on escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
});
</script>
