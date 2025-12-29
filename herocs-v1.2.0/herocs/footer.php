<?php
/**
 * Footer Template
 * Layout: 4 colonne + Copyright
 *
 * @package HeroCS
 * @since 1.1.0
 */
?>

    </div><!-- #content -->

    <!-- ========================================================================== -->
    <!-- FOOTER -->
    <!-- ========================================================================== -->
    <footer id="colophon" class="site-footer" role="contentinfo">
        
        <!-- Footer Main -->
        <div class="footer-main">
            <div class="footer-container">
                <div class="footer-grid">
                    
                    <!-- Column 1: Logo + Description -->
                    <div class="footer-col footer-about">
                        <div class="footer-logo">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php else : ?>
                                <span class="footer-site-title"><?php bloginfo('name'); ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="footer-description">
                            <?php 
                            $description = get_theme_mod('cs_footer_description', 'Agenzia di comunicazione specializzata in comunicazione politica, istituzionale e sociale. Costruiamo relazioni attraverso strategie innovative.');
                            echo esc_html($description);
                            ?>
                        </p>
                        <div class="footer-contact-quick">
                            <a href="mailto:info@example.com" class="footer-email">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                info@cscommunication.it
                            </a>
                        </div>
                    </div>
                    
                    <!-- Column 2: Link Utili -->
                    <div class="footer-col footer-links">
                        <h4 class="footer-title">Link Utili</h4>
                        <?php if (has_nav_menu('footer-links')) : ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-links',
                                'menu_class' => 'footer-menu',
                                'container' => false,
                                'depth' => 1,
                            )); ?>
                        <?php else : ?>
                            <ul class="footer-menu">
                                <li><a href="<?php echo esc_url(home_url('/chi-siamo')); ?>">Chi Siamo</a></li>
                                <li><a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">Cosa Facciamo</a></li>
                                <li><a href="<?php echo esc_url(home_url('/collaborazioni')); ?>">Collaborazioni</a></li>
                                <li><a href="<?php echo esc_url(home_url('/press')); ?>">Rassegna Stampa</a></li>
                                <li><a href="<?php echo esc_url(home_url('/contatti')); ?>">Contatti</a></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Column 3: Servizi -->
                    <div class="footer-col footer-services-col">
                        <h4 class="footer-title">Servizi</h4>
                        <?php if (has_nav_menu('footer-services')) : ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-services',
                                'menu_class' => 'footer-menu',
                                'container' => false,
                                'depth' => 1,
                            )); ?>
                        <?php else : ?>
                            <ul class="footer-menu">
                                <?php
                                $services_query = new WP_Query(array(
                                    'post_type' => 'service',
                                    'posts_per_page' => 5,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC',
                                ));
                                
                                if ($services_query->have_posts()) :
                                    while ($services_query->have_posts()) : $services_query->the_post();
                                ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                <?php 
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                ?>
                                    <li><a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">Comunicazione Politica</a></li>
                                    <li><a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">Comunicazione Istituzionale</a></li>
                                    <li><a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">Comunicazione Sociale</a></li>
                                    <li><a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">Digital Strategy</a></li>
                                    <li><a href="<?php echo esc_url(home_url('/cosa-facciamo')); ?>">Produzione Contenuti</a></li>
                                <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Column 4: Social + Newsletter -->
                    <div class="footer-col footer-connect">
                        <h4 class="footer-title">Seguici</h4>
                        
                        <!-- Social Icons -->
                        <div class="footer-social">
                            <a href="<?php echo esc_url(get_theme_mod('cs_facebook_url', '#')); ?>" class="social-icon" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                </svg>
                            </a>
                            <a href="<?php echo esc_url(get_theme_mod('cs_instagram_url', '#')); ?>" class="social-icon" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                </svg>
                            </a>
                            <a href="<?php echo esc_url(get_theme_mod('cs_linkedin_url', '#')); ?>" class="social-icon" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                    <rect x="2" y="9" width="4" height="12"/>
                                    <circle cx="4" cy="4" r="2"/>
                                </svg>
                            </a>
                            <a href="<?php echo esc_url(get_theme_mod('cs_twitter_url', '#')); ?>" class="social-icon" aria-label="Twitter/X" target="_blank" rel="noopener noreferrer">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                        </div>
                        
                        <!-- Newsletter -->
                        <div class="footer-newsletter">
                            <p class="newsletter-text">Iscriviti alla newsletter</p>
                            <form class="newsletter-form" action="#" method="post">
                                <div class="newsletter-input-wrapper">
                                    <input type="email" name="email" placeholder="La tua email" required>
                                    <button type="submit" aria-label="Iscriviti">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="22" y1="2" x2="11" y2="13"/>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-container">
                <div class="footer-bottom-inner">
                    
                    <div class="copyright">
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tutti i diritti riservati.
                    </div>
                    
                    <div class="footer-bottom-links">
                        <a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a>
                        <span class="separator">|</span>
                        <a href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a>
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
/* FOOTER STYLES */
/* ========================================================================== */

.site-footer {
    background: #1e293b;
    color: #94a3b8;
    font-family: 'Inter', sans-serif;
}

/* Footer Main */
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
    grid-template-columns: 1.5fr 1fr 1fr 1.3fr;
    gap: 50px;
}

/* Footer Columns */
.footer-col {
    min-width: 0;
}

.footer-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    margin: 0 0 24px 0;
    position: relative;
    padding-bottom: 12px;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 2px;
}

/* Column 1: About */
.footer-logo {
    margin-bottom: 20px;
}

.footer-logo .custom-logo {
    max-height: 50px;
    width: auto;
    filter: brightness(0) invert(1);
}

.footer-site-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
}

.footer-description {
    font-size: 0.95rem;
    line-height: 1.7;
    margin: 0 0 20px 0;
    color: #94a3b8;
}

.footer-email {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s;
}

.footer-email:hover {
    color: #ec4899;
}

/* Footer Menu */
.footer-menu {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-menu li {
    margin-bottom: 12px;
}

.footer-menu a {
    color: #94a3b8;
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.3s;
    display: inline-block;
}

.footer-menu a:hover {
    color: #ec4899;
    transform: translateX(4px);
}

/* Column 4: Social + Newsletter */
.footer-social {
    display: flex;
    gap: 12px;
    margin-bottom: 30px;
}

.social-icon {
    width: 42px;
    height: 42px;
    background: #334155;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    text-decoration: none;
    transition: all 0.3s;
}

.social-icon:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    transform: translateY(-3px);
}

.newsletter-text {
    font-size: 0.9rem;
    margin: 0 0 12px 0;
    color: #cbd5e1;
}

.newsletter-form {
    margin: 0;
}

.newsletter-input-wrapper {
    display: flex;
    background: #334155;
    border-radius: 10px;
    overflow: hidden;
}

.newsletter-input-wrapper input {
    flex: 1;
    padding: 12px 16px;
    border: none;
    background: transparent;
    color: white;
    font-size: 0.9rem;
    outline: none;
}

.newsletter-input-wrapper input::placeholder {
    color: #64748b;
}

.newsletter-input-wrapper button {
    padding: 12px 16px;
    border: none;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    cursor: pointer;
    transition: all 0.3s;
}

.newsletter-input-wrapper button:hover {
    opacity: 0.9;
}

/* Footer Bottom */
.footer-bottom {
    background: #0f172a;
    padding: 20px 0;
}

.footer-bottom-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.copyright {
    font-size: 0.875rem;
    color: #64748b;
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

/* Back to Top */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 99;
    box-shadow: 0 4px 20px rgba(124, 58, 237, 0.3);
}

.back-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(124, 58, 237, 0.4);
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
    
    .footer-bottom-inner {
        flex-direction: column;
        text-align: center;
    }
    
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 44px;
        height: 44px;
    }
}

@media (max-width: 480px) {
    .footer-social {
        justify-content: center;
    }
    
    .social-icon {
        width: 38px;
        height: 38px;
    }
}

/* ========================================================================== */
/* DARK MODE (Footer is already dark) */
/* ========================================================================== */

body.dark-mode .site-footer {
    background: #0f172a;
}

body.dark-mode .footer-bottom {
    background: #020617;
}

body.dark-mode .social-icon {
    background: #1e293b;
}

body.dark-mode .newsletter-input-wrapper {
    background: #1e293b;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const backToTop = document.querySelector('.back-to-top');
    
    if (backToTop) {
        // Show/hide button based on scroll position
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 400) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });
        
        // Scroll to top on click
        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Newsletter form handling (placeholder)
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            // Add your newsletter subscription logic here
            alert('Grazie per l\'iscrizione! (' + email + ')');
            this.reset();
        });
    }
});
</script>

<?php wp_footer(); ?>

</body>
</html>
