<?php
/**
 * Footer Template
 * Layout: 4 colonne responsive + Copyright
 * Colori: Viola (#7c3aed), Fucsia (#ec4899), Blu (#3b82f6)
 *
 * @package HeroCS
 * @since 1.2.0
 */

// Recupera opzioni footer dal Customizer
$footer_description = get_theme_mod('herocs_footer_description', 'Agenzia di comunicazione specializzata in comunicazione politica, istituzionale e sociale. Costruiamo relazioni attraverso strategie innovative.');
$footer_email = get_theme_mod('herocs_footer_email', 'info@cscommunicationagency.it');
$footer_phone = get_theme_mod('herocs_footer_phone', '+39 081 123 4567');
$footer_address = get_theme_mod('herocs_footer_address', 'Via Roma 123, 80100 Napoli (NA)');

// Social URLs
$social_facebook = get_theme_mod('herocs_social_facebook', '#');
$social_instagram = get_theme_mod('herocs_social_instagram', '#');
$social_linkedin = get_theme_mod('herocs_social_linkedin', '#');
$social_twitter = get_theme_mod('herocs_social_twitter', '#');
$social_youtube = get_theme_mod('herocs_social_youtube', '');
$social_tiktok = get_theme_mod('herocs_social_tiktok', '');
?>

    </div><!-- #content -->

    <!-- ========================================================================== -->
    <!-- FOOTER -->
    <!-- ========================================================================== -->
    <footer id="colophon" class="site-footer" role="contentinfo">
        
        <!-- Footer Main Content -->
        <div class="footer-main">
            <div class="footer-container">
                <div class="footer-grid">
                    
                    <!-- ============================================================ -->
                    <!-- COLONNA 1: About + Social Icons -->
                    <!-- ============================================================ -->
                    <div class="footer-col footer-about">
                        <div class="footer-logo">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-site-title">
                                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <p class="footer-description">
                            <?php echo esc_html($footer_description); ?>
                        </p>
                        
                        <!-- Social Icons - 24px -->
                        <div class="footer-social">
                            <span class="social-label">Seguici</span>
                            <div class="social-icons">
                                <?php if ($social_facebook && $social_facebook !== '#') : ?>
                                <a href="<?php echo esc_url($social_facebook); ?>" class="social-icon" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($social_instagram && $social_instagram !== '#') : ?>
                                <a href="<?php echo esc_url($social_instagram); ?>" class="social-icon" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($social_linkedin && $social_linkedin !== '#') : ?>
                                <a href="<?php echo esc_url($social_linkedin); ?>" class="social-icon" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                        <rect x="2" y="9" width="4" height="12"/>
                                        <circle cx="4" cy="4" r="2"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($social_twitter && $social_twitter !== '#') : ?>
                                <a href="<?php echo esc_url($social_twitter); ?>" class="social-icon" aria-label="X (Twitter)" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($social_youtube) : ?>
                                <a href="<?php echo esc_url($social_youtube); ?>" class="social-icon" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"/>
                                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#1e293b"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php if ($social_tiktok) : ?>
                                <a href="<?php echo esc_url($social_tiktok); ?>" class="social-icon" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                                
                                <?php 
                                // Fallback se nessun social configurato
                                if ((!$social_facebook || $social_facebook === '#') && 
                                    (!$social_instagram || $social_instagram === '#') && 
                                    (!$social_linkedin || $social_linkedin === '#') && 
                                    (!$social_twitter || $social_twitter === '#')) : 
                                ?>
                                <a href="#" class="social-icon" aria-label="Facebook">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                    </svg>
                                </a>
                                <a href="#" class="social-icon" aria-label="Instagram">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                    </svg>
                                </a>
                                <a href="#" class="social-icon" aria-label="LinkedIn">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                        <rect x="2" y="9" width="4" height="12"/>
                                        <circle cx="4" cy="4" r="2"/>
                                    </svg>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- ============================================================ -->
                    <!-- COLONNA 2: Link Pagine -->
                    <!-- ============================================================ -->
                    <div class="footer-col footer-links">
                        <h4 class="footer-title">Pagine</h4>
                        <?php if (has_nav_menu('footer-links')) : ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-links',
                                'menu_class' => 'footer-menu',
                                'container' => false,
                                'depth' => 1,
                            )); ?>
                        <?php else : ?>
                            <ul class="footer-menu">
                                <li>
                                    <a href="<?php echo esc_url(home_url('/chi-siamo')); ?>">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                        Chi Siamo
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                        Cosa Facciamo
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/collaborazioni')); ?>">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                        Collaborazioni
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/press')); ?>">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                        Rassegna Stampa
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/contatti')); ?>">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                        Contatti
                                    </a>
                                </li>
                            </ul>
                        <?php endif; ?>
                    </div>
                    
                    <!-- ============================================================ -->
                    <!-- COLONNA 3: Contatti -->
                    <!-- ============================================================ -->
                    <div class="footer-col footer-contact">
                        <h4 class="footer-title">Contatti</h4>
                        
                        <div class="contact-list">
                            <?php if ($footer_email) : ?>
                            <a href="mailto:<?php echo esc_attr($footer_email); ?>" class="contact-item">
                                <div class="contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($footer_email); ?></span>
                            </a>
                            <?php endif; ?>
                            
                            <?php if ($footer_phone) : ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $footer_phone)); ?>" class="contact-item">
                                <div class="contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($footer_phone); ?></span>
                            </a>
                            <?php endif; ?>
                            
                            <?php if ($footer_address) : ?>
                            <div class="contact-item contact-address">
                                <div class="contact-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                </div>
                                <span><?php echo esc_html($footer_address); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <!-- CTA Button -->
                        <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="footer-cta-btn">
                            Scrivici
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                    
                    <!-- ============================================================ -->
                    <!-- COLONNA 4: Newsletter -->
                    <!-- ============================================================ -->
                    <div class="footer-col footer-newsletter-col">
                        <h4 class="footer-title">Newsletter</h4>
                        
                        <p class="newsletter-text">
                            Iscriviti per ricevere aggiornamenti su progetti, eventi e novità dal mondo della comunicazione.
                        </p>
                        
                        <form class="newsletter-form" action="#" method="post" id="footer-newsletter-form">
                            <div class="newsletter-input-wrapper">
                                <input type="email" 
                                       name="newsletter_email" 
                                       placeholder="La tua email" 
                                       required 
                                       aria-label="Indirizzo email per newsletter">
                                <button type="submit" aria-label="Iscriviti alla newsletter">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="22" y1="2" x2="11" y2="13"/>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="newsletter-consent">
                                <label>
                                    <input type="checkbox" name="privacy_consent" required>
                                    <span>Accetto la <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>" target="_blank">Privacy Policy</a></span>
                                </label>
                            </div>
                            <div class="newsletter-message" aria-live="polite"></div>
                        </form>
                        
                        <!-- Trust Badges (optional) -->
                        <div class="footer-badges">
                            <span class="badge">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                100% Spam-free
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom Bar -->
        <div class="footer-bottom">
            <div class="footer-container">
                <div class="footer-bottom-inner">
                    
                    <div class="copyright">
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tutti i diritti riservati.
                        <span class="made-with">
                            Made with
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="#ec4899" stroke="none">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                            in Napoli
                        </span>
                    </div>
                    
                    <div class="footer-bottom-links">
                        <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
                        <span class="separator">•</span>
                        <a href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a>
                        <span class="separator">•</span>
                        <a href="<?php echo esc_url(home_url('/termini-condizioni')); ?>">Termini</a>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </footer><!-- #colophon -->

</div><!-- #page -->

<!-- Back to Top Button -->
<button class="back-to-top" aria-label="<?php esc_attr_e('Torna su', 'herocs'); ?>">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="18 15 12 9 6 15"/>
    </svg>
</button>

<style>
/* ========================================================================== */
/* FOOTER STYLES - HeroCS Theme                                              */
/* Colori: Viola (#7c3aed), Fucsia (#ec4899), Blu (#3b82f6)                  */
/* ========================================================================== */

.site-footer {
    background: #1e293b;
    color: #94a3b8;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    font-size: 0.9375rem;
    line-height: 1.6;
}

/* ========================================================================== */
/* FOOTER MAIN */
/* ========================================================================== */

.footer-main {
    padding: 80px 0 60px;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.footer-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr 1fr 1.2fr;
    gap: 48px;
}

/* ========================================================================== */
/* FOOTER COLUMNS */
/* ========================================================================== */

.footer-col {
    display: flex;
    flex-direction: column;
}

/* Footer Title */
.footer-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.0625rem;
    font-weight: 700;
    color: white;
    margin: 0 0 24px 0;
    position: relative;
    padding-bottom: 12px;
}

.footer-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 2px;
}

/* ========================================================================== */
/* COLUMN 1: ABOUT + SOCIAL */
/* ========================================================================== */

.footer-logo {
    margin-bottom: 20px;
}

.footer-logo img {
    max-height: 50px;
    width: auto;
    filter: brightness(0) invert(1);
}

.footer-site-title {
    text-decoration: none;
}

.footer-site-title .logo-text {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.footer-description {
    color: #94a3b8;
    margin: 0 0 24px 0;
    line-height: 1.7;
    font-size: 0.9375rem;
}

/* Social Icons */
.footer-social {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.social-label {
    font-size: 0.8125rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

.social-icons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    background: #0f172a;
    border-radius: 12px;
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-icon:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
}

.social-icon svg {
    width: 24px;
    height: 24px;
}

/* ========================================================================== */
/* COLUMN 2: LINKS */
/* ========================================================================== */

.footer-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-menu li {
    margin-bottom: 12px;
}

.footer-menu li:last-child {
    margin-bottom: 0;
}

.footer-menu a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.3s;
    font-size: 0.9375rem;
}

.footer-menu a svg {
    opacity: 0;
    transform: translateX(-8px);
    transition: all 0.3s;
    color: #ec4899;
}

.footer-menu a:hover {
    color: white;
    padding-left: 4px;
}

.footer-menu a:hover svg {
    opacity: 1;
    transform: translateX(0);
}

/* ========================================================================== */
/* COLUMN 3: CONTATTI */
/* ========================================================================== */

.contact-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 24px;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    color: #94a3b8;
    text-decoration: none;
    transition: color 0.3s;
}

a.contact-item:hover {
    color: white;
}

a.contact-item:hover .contact-icon {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: #0f172a;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #7c3aed;
    flex-shrink: 0;
    transition: all 0.3s;
}

.contact-item span {
    padding-top: 8px;
    font-size: 0.9375rem;
    line-height: 1.5;
}

/* CTA Button */
.footer-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9375rem;
    transition: all 0.3s;
    align-self: flex-start;
}

.footer-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(124, 58, 237, 0.35);
}

.footer-cta-btn svg {
    transition: transform 0.3s;
}

.footer-cta-btn:hover svg {
    transform: translateX(4px);
}

/* ========================================================================== */
/* COLUMN 4: NEWSLETTER */
/* ========================================================================== */

.newsletter-text {
    color: #94a3b8;
    margin: 0 0 20px 0;
    font-size: 0.9375rem;
    line-height: 1.6;
}

.newsletter-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.newsletter-input-wrapper {
    display: flex;
    background: #0f172a;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid transparent;
    transition: border-color 0.3s;
}

.newsletter-input-wrapper:focus-within {
    border-color: #7c3aed;
}

.newsletter-input-wrapper input {
    flex: 1;
    padding: 14px 18px;
    border: none;
    background: transparent;
    color: white;
    font-size: 0.9375rem;
    outline: none;
    font-family: inherit;
}

.newsletter-input-wrapper input::placeholder {
    color: #64748b;
}

.newsletter-input-wrapper button {
    padding: 14px 18px;
    border: none;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    cursor: pointer;
    transition: all 0.3s;
}

.newsletter-input-wrapper button:hover {
    opacity: 0.9;
}

/* Newsletter Consent */
.newsletter-consent {
    display: flex;
    align-items: flex-start;
}

.newsletter-consent label {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    cursor: pointer;
    font-size: 0.8125rem;
    color: #64748b;
}

.newsletter-consent input[type="checkbox"] {
    margin-top: 3px;
    accent-color: #7c3aed;
}

.newsletter-consent a {
    color: #7c3aed;
    text-decoration: none;
}

.newsletter-consent a:hover {
    text-decoration: underline;
}

/* Newsletter Message */
.newsletter-message {
    font-size: 0.875rem;
    padding: 0;
    border-radius: 8px;
}

.newsletter-message.success {
    color: #10b981;
    padding: 12px;
    background: rgba(16, 185, 129, 0.1);
}

.newsletter-message.error {
    color: #ef4444;
    padding: 12px;
    background: rgba(239, 68, 68, 0.1);
}

/* Footer Badges */
.footer-badges {
    margin-top: 16px;
}

.footer-badges .badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.75rem;
    color: #64748b;
    background: rgba(100, 116, 139, 0.1);
    padding: 6px 12px;
    border-radius: 50px;
}

.footer-badges .badge svg {
    color: #7c3aed;
}

/* ========================================================================== */
/* FOOTER BOTTOM */
/* ========================================================================== */

.footer-bottom {
    background: #0f172a;
    padding: 24px 0;
    border-top: 1px solid #334155;
}

.footer-bottom-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.copyright {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 0.875rem;
    color: #64748b;
    flex-wrap: wrap;
}

.made-with {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    color: #94a3b8;
}

.made-with svg {
    animation: heartbeat 1.5s ease-in-out infinite;
}

@keyframes heartbeat {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.15); }
}

.footer-bottom-links {
    display: flex;
    align-items: center;
    gap: 12px;
}

.footer-bottom-links a {
    color: #64748b;
    text-decoration: none;
    font-size: 0.875rem;
    transition: color 0.3s;
}

.footer-bottom-links a:hover {
    color: #ec4899;
}

.footer-bottom-links .separator {
    color: #475569;
}

/* ========================================================================== */
/* BACK TO TOP */
/* ========================================================================== */

.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border: none;
    border-radius: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 99;
    box-shadow: 0 4px 20px rgba(124, 58, 237, 0.35);
}

.back-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 35px rgba(124, 58, 237, 0.45);
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .footer-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
    }
    
    .footer-about {
        grid-column: span 2;
    }
    
    .social-icons {
        justify-content: flex-start;
    }
}

@media (max-width: 768px) {
    .footer-main {
        padding: 60px 0 40px;
    }
    
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .footer-about {
        grid-column: span 1;
    }
    
    .footer-title {
        margin-bottom: 20px;
    }
    
    .footer-title::after {
        width: 30px;
    }
    
    .social-icons {
        justify-content: center;
    }
    
    .footer-social {
        align-items: center;
        text-align: center;
    }
    
    .footer-cta-btn {
        align-self: center;
    }
    
    .footer-bottom-inner {
        flex-direction: column;
        text-align: center;
    }
    
    .copyright {
        flex-direction: column;
        gap: 8px;
    }
    
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 48px;
        height: 48px;
    }
}

@media (max-width: 480px) {
    .social-icon {
        width: 42px;
        height: 42px;
    }
    
    .social-icon svg {
        width: 22px;
        height: 22px;
    }
    
    .footer-bottom-links {
        flex-wrap: wrap;
        justify-content: center;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .site-footer {
    background: #0f172a;
}

body.dark-mode .footer-bottom {
    background: #020617;
    border-top-color: #1e293b;
}

body.dark-mode .social-icon {
    background: #1e293b;
}

body.dark-mode .contact-icon {
    background: #1e293b;
}

body.dark-mode .newsletter-input-wrapper {
    background: #1e293b;
}

body.dark-mode .footer-badges .badge {
    background: rgba(100, 116, 139, 0.15);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Back to Top
    const backToTop = document.querySelector('.back-to-top');
    
    if (backToTop) {
        let ticking = false;
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(function() {
                    if (window.pageYOffset > 400) {
                        backToTop.classList.add('visible');
                    } else {
                        backToTop.classList.remove('visible');
                    }
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Newsletter Form
    const newsletterForm = document.getElementById('footer-newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = this.querySelector('input[type="email"]').value;
            const consent = this.querySelector('input[type="checkbox"]').checked;
            const messageEl = this.querySelector('.newsletter-message');
            
            if (!consent) {
                messageEl.textContent = 'Devi accettare la Privacy Policy per iscriverti.';
                messageEl.className = 'newsletter-message error';
                return;
            }
            
            // Simulate API call (replace with actual newsletter integration)
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg width="20" height="20" class="animate-spin" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" opacity="0.25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>';
            
            // Simulated success (replace with real AJAX)
            setTimeout(function() {
                messageEl.textContent = 'Grazie! Iscrizione completata con successo.';
                messageEl.className = 'newsletter-message success';
                newsletterForm.reset();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';
                
                // Clear message after 5 seconds
                setTimeout(function() {
                    messageEl.textContent = '';
                    messageEl.className = 'newsletter-message';
                }, 5000);
            }, 1500);
        });
    }
});
</script>

<?php wp_footer(); ?>

</body>
</html>
