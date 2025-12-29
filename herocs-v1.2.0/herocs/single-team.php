<?php
/**
 * Single Team Member Template
 * Profilo completo del membro del team
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();
?>

<main id="primary" class="site-main single-team-page">
    <?php while (have_posts()) : the_post(); 
        // Recupera meta fields
        $position = get_post_meta(get_the_ID(), '_cs_team_position', true);
        $bio = get_post_meta(get_the_ID(), '_cs_team_bio', true);
        $email = get_post_meta(get_the_ID(), '_cs_team_email', true);
        $phone = get_post_meta(get_the_ID(), '_cs_team_phone', true);
        $linkedin = get_post_meta(get_the_ID(), '_cs_team_linkedin', true);
        $twitter = get_post_meta(get_the_ID(), '_cs_team_twitter', true);
        $order = get_post_meta(get_the_ID(), '_cs_team_order', true);
    ?>

    <!-- Hero Header con Gradient -->
    <section class="team-single-hero">
        <div class="hero-gradient-overlay"></div>
        <div class="hero-content">
            <div class="hero-breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span class="separator">/</span>
                <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>">Team</a>
                <span class="separator">/</span>
                <span class="current"><?php the_title(); ?></span>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <article id="post-<?php the_ID(); ?>" <?php post_class('team-single-content'); ?>>
        <div class="team-container">
            
            <!-- Layout a due colonne -->
            <div class="team-profile-grid">
                
                <!-- Colonna Sinistra: Foto -->
                <div class="team-photo-column">
                    <div class="team-photo-wrapper">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large', array(
                                'class' => 'team-main-photo',
                                'alt' => get_the_title()
                            )); ?>
                        <?php else : ?>
                            <div class="team-photo-placeholder">
                                <span class="placeholder-initial">
                                    <?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Decorazione gradient -->
                        <div class="photo-decoration"></div>
                    </div>
                    
                    <!-- Social Links sotto la foto (mobile) -->
                    <div class="team-social-mobile">
                        <?php if ($email || $phone || $linkedin || $twitter) : ?>
                            <div class="social-links">
                                <?php if ($email) : ?>
                                    <a href="mailto:<?php echo esc_attr($email); ?>" class="social-link" aria-label="Email">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            <polyline points="22,6 12,13 2,6"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($phone) : ?>
                                    <a href="tel:<?php echo esc_attr($phone); ?>" class="social-link" aria-label="Telefono">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($linkedin) : ?>
                                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <?php if ($twitter) : ?>
                                    <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Twitter/X">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Colonna Destra: Info -->
                <div class="team-info-column">
                    
                    <!-- Nome e Ruolo -->
                    <header class="team-header">
                        <h1 class="team-name"><?php the_title(); ?></h1>
                        <?php if ($position) : ?>
                            <p class="team-position"><?php echo esc_html($position); ?></p>
                        <?php endif; ?>
                    </header>
                    
                    <!-- Social Links (desktop) -->
                    <?php if ($email || $phone || $linkedin || $twitter) : ?>
                        <div class="team-social-desktop">
                            <div class="social-links">
                                <?php if ($email) : ?>
                                    <a href="mailto:<?php echo esc_attr($email); ?>" class="social-link" aria-label="Email">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            <polyline points="22,6 12,13 2,6"/>
                                        </svg>
                                        <span>Email</span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($phone) : ?>
                                    <a href="tel:<?php echo esc_attr($phone); ?>" class="social-link" aria-label="Telefono">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                        <span>Chiama</span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($linkedin) : ?>
                                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="LinkedIn">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                        </svg>
                                        <span>LinkedIn</span>
                                    </a>
                                <?php endif; ?>
                                <?php if ($twitter) : ?>
                                    <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" class="social-link" aria-label="Twitter/X">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                        </svg>
                                        <span>X</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Bio Completa -->
                    <?php if ($bio) : ?>
                        <div class="team-bio-section">
                            <h2 class="section-title">Chi sono</h2>
                            <div class="bio-content">
                                <?php echo wp_kses_post(wpautop($bio)); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Contenuto aggiuntivo da editor -->
                    <?php if (get_the_content()) : ?>
                        <div class="team-extra-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Info di contatto -->
                    <?php if ($email || $phone) : ?>
                        <div class="team-contact-info">
                            <h2 class="section-title">Contatti diretti</h2>
                            <div class="contact-items">
                                <?php if ($email) : ?>
                                    <div class="contact-item">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                            <polyline points="22,6 12,13 2,6"/>
                                        </svg>
                                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($phone) : ?>
                                    <div class="contact-item">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                        </svg>
                                        <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
                
            </div>
            
            <!-- Back Link -->
            <div class="team-back-section">
                <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>" class="back-to-team">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Torna al Team
                </a>
            </div>
            
        </div>
    </article>

    <?php endwhile; ?>
</main>

<style>
/* ========================================================================== */
/* SINGLE TEAM - Profilo Membro */
/* ========================================================================== */

.single-team-page {
    background: #f8fafc;
}

/* Hero Header */
.team-single-hero {
    position: relative;
    height: 200px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    overflow: hidden;
}

.hero-gradient-overlay {
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    height: 100%;
    display: flex;
    align-items: flex-end;
    padding-bottom: 30px;
}

.hero-breadcrumb {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.hero-breadcrumb a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color 0.3s;
}

.hero-breadcrumb a:hover {
    color: white;
}

.hero-breadcrumb .separator {
    color: rgba(255, 255, 255, 0.5);
}

.hero-breadcrumb .current {
    color: white;
    font-weight: 600;
}

/* Main Content */
.team-single-content {
    position: relative;
    margin-top: -60px;
}

.team-container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px 80px;
}

/* Grid Layout */
.team-profile-grid {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 60px;
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

/* Photo Column */
.team-photo-column {
    position: relative;
}

.team-photo-wrapper {
    position: relative;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(124, 58, 237, 0.2);
}

.team-main-photo {
    width: 100%;
    height: auto;
    display: block;
    aspect-ratio: 1;
    object-fit: cover;
}

.team-photo-placeholder {
    width: 100%;
    aspect-ratio: 1;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder-initial {
    font-size: 8rem;
    font-weight: 700;
    color: white;
    font-family: 'Poppins', sans-serif;
}

.photo-decoration {
    position: absolute;
    bottom: -20px;
    right: -20px;
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 16px;
    z-index: -1;
    opacity: 0.3;
}

/* Social Mobile */
.team-social-mobile {
    display: none;
    margin-top: 24px;
}

.team-social-mobile .social-links {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.team-social-mobile .social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-radius: 12px;
    transition: all 0.3s;
}

.team-social-mobile .social-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
}

/* Info Column */
.team-info-column {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

/* Header */
.team-header {
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 24px;
}

.team-name {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

.team-position {
    font-size: 1.1rem;
    font-weight: 600;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Social Desktop */
.team-social-desktop .social-links {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.team-social-desktop .social-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: #f1f5f9;
    color: #475569;
    border-radius: 50px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s;
}

.team-social-desktop .social-link:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    transform: translateY(-2px);
}

.team-social-desktop .social-link svg {
    flex-shrink: 0;
}

/* Section Titles */
.section-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title::before {
    content: '';
    width: 4px;
    height: 24px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 2px;
}

/* Bio Section */
.team-bio-section .bio-content {
    font-family: 'Inter', sans-serif;
    font-size: 1rem;
    line-height: 1.8;
    color: #475569;
}

.team-bio-section .bio-content p {
    margin-bottom: 1em;
}

.team-bio-section .bio-content p:last-child {
    margin-bottom: 0;
}

/* Extra Content */
.team-extra-content {
    font-family: 'Inter', sans-serif;
    line-height: 1.8;
    color: #475569;
}

/* Contact Info */
.team-contact-info {
    background: #f8fafc;
    padding: 24px;
    border-radius: 12px;
}

.contact-items {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #64748b;
}

.contact-item svg {
    flex-shrink: 0;
    color: #7c3aed;
}

.contact-item a {
    color: #1e293b;
    text-decoration: none;
    transition: color 0.3s;
}

.contact-item a:hover {
    color: #7c3aed;
}

/* Back Section */
.team-back-section {
    margin-top: 40px;
    text-align: center;
}

.back-to-team {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 32px;
    background: transparent;
    color: #7c3aed;
    border: 2px solid #7c3aed;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: all 0.3s;
}

.back-to-team:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-color: transparent;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(124, 58, 237, 0.3);
}

.back-to-team svg {
    transition: transform 0.3s;
}

.back-to-team:hover svg {
    transform: translateX(-5px);
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 968px) {
    .team-profile-grid {
        grid-template-columns: 1fr;
        gap: 40px;
        padding: 30px;
    }
    
    .team-photo-column {
        max-width: 350px;
        margin: 0 auto;
    }
    
    .team-social-mobile {
        display: block;
    }
    
    .team-social-desktop {
        display: none;
    }
    
    .photo-decoration {
        display: none;
    }
}

@media (max-width: 640px) {
    .team-single-hero {
        height: 150px;
    }
    
    .team-container {
        padding: 0 16px 60px;
    }
    
    .team-profile-grid {
        padding: 24px;
        margin-top: 0;
    }
    
    .team-name {
        font-size: 1.75rem;
    }
    
    .team-position {
        font-size: 1rem;
    }
    
    .hero-breadcrumb {
        font-size: 0.8rem;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .single-team-page {
    background: #0f172a;
}

body.dark-mode .team-profile-grid {
    background: #1e293b;
}

body.dark-mode .team-name {
    color: #f1f5f9;
}

body.dark-mode .team-header {
    border-bottom-color: #334155;
}

body.dark-mode .team-bio-section .bio-content,
body.dark-mode .team-extra-content {
    color: #94a3b8;
}

body.dark-mode .section-title {
    color: #f1f5f9;
}

body.dark-mode .team-social-desktop .social-link {
    background: #334155;
    color: #e2e8f0;
}

body.dark-mode .team-contact-info {
    background: #0f172a;
}

body.dark-mode .contact-item a {
    color: #e2e8f0;
}

body.dark-mode .back-to-team {
    color: #a78bfa;
    border-color: #a78bfa;
}

body.dark-mode .back-to-team:hover {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
    color: white;
}
</style>

<?php get_footer(); ?>
