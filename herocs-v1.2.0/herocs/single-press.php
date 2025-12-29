<?php
/**
 * Single Press Article Template
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();

// Calcola tempo di lettura
function herocs_press_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return $reading_time . ' min';
}
?>

<main id="primary" class="site-main single-press-page">
    <?php
    while (have_posts()) :
        the_post();
        ?>

        <!-- Hero Header con Gradient -->
        <header class="press-hero-header">
            <div class="press-hero-overlay"></div>
            <div class="cs-container">
                <div class="press-hero-content">
                    <!-- Categorie Press -->
                    <?php
                    $press_categories = get_the_terms(get_the_ID(), 'press_category');
                    if ($press_categories && !is_wp_error($press_categories)) :
                        ?>
                        <div class="press-categories">
                            <?php foreach ($press_categories as $cat) : ?>
                                <a href="<?php echo esc_url(get_term_link($cat)); ?>" class="press-category-badge">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h1 class="press-title"><?php the_title(); ?></h1>

                    <!-- Meta Info -->
                    <div class="press-meta">
                        <span class="press-meta-item press-date">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo esc_html(get_the_date('j F Y')); ?>
                            </time>
                        </span>
                        
                        <span class="press-meta-separator">Ã¢â‚¬Â¢</span>
                        
                        <span class="press-meta-item press-author">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <?php echo esc_html(get_the_author()); ?>
                        </span>
                        
                        <span class="press-meta-separator">Ã¢â‚¬Â¢</span>
                        
                        <span class="press-meta-item press-reading-time">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <?php echo herocs_press_reading_time(); ?> lettura
                        </span>
                    </div>
                </div>
            </div>
        </header>

        <article id="post-<?php the_ID(); ?>" <?php post_class('press-article'); ?>>
            <div class="cs-container">
                <div class="press-content-wrapper">
                    
                    <!-- Immagine in Evidenza -->
                    <?php if (has_post_thumbnail()) : ?>
                        <figure class="press-featured-image">
                            <?php the_post_thumbnail('large', array('loading' => 'eager')); ?>
                            <?php if (get_the_post_thumbnail_caption()) : ?>
                                <figcaption><?php echo get_the_post_thumbnail_caption(); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php endif; ?>

                    <!-- Contenuto Articolo -->
                    <div class="press-content entry-content">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pagine:', 'herocs'),
                            'after' => '</div>',
                        ));
                        ?>
                    </div>

                    <!-- Footer Articolo -->
                    <footer class="press-footer">
                        <!-- Tags -->
                        <?php
                        $press_tags = get_the_terms(get_the_ID(), 'post_tag');
                        if ($press_tags && !is_wp_error($press_tags)) :
                            ?>
                            <div class="press-tags">
                                <span class="tags-label">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                    </svg>
                                    Tags:
                                </span>
                                <?php foreach ($press_tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_term_link($tag)); ?>" class="press-tag">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Share Buttons -->
                        <div class="press-share">
                            <span class="share-label">Condividi:</span>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" rel="noopener noreferrer" class="share-btn share-facebook"
                                   aria-label="Condividi su Facebook">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" rel="noopener noreferrer" class="share-btn share-twitter"
                                   aria-label="Condividi su Twitter">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" rel="noopener noreferrer" class="share-btn share-linkedin"
                                   aria-label="Condividi su LinkedIn">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                                <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" 
                                   class="share-btn share-email"
                                   aria-label="Condividi via Email">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </footer>

                    <!-- Navigazione Precedente/Successivo -->
                    <nav class="press-navigation" aria-label="Navigazione articoli">
                        <div class="nav-links">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            
                            if ($prev_post) :
                                ?>
                                <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="nav-previous" rel="prev">
                                    <span class="nav-arrow">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="19" y1="12" x2="5" y2="12"></line>
                                            <polyline points="12 19 5 12 12 5"></polyline>
                                        </svg>
                                    </span>
                                    <span class="nav-content">
                                        <span class="nav-label">Articolo Precedente</span>
                                        <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if ($next_post) : ?>
                                <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="nav-next" rel="next">
                                    <span class="nav-content">
                                        <span class="nav-label">Articolo Successivo</span>
                                        <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                                    </span>
                                    <span class="nav-arrow">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <!-- CTA Torna alla Press Room -->
                    <div class="press-back-cta">
                        <a href="<?php echo esc_url(get_post_type_archive_link('press')); ?>" class="cs-btn cs-btn-secondary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Torna alla Press Room
                        </a>
                    </div>

                </div>
            </div>
        </article>

    <?php endwhile; ?>
</main>

<style>
/* Single Press Page Styles */
.single-press-page {
    padding-top: 0;
}

/* Hero Header */
.press-hero-header {
    position: relative;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    padding: 120px 0 80px;
    margin-top: 60px;
    overflow: hidden;
}

.press-hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.2);
}

.press-hero-content {
    position: relative;
    z-index: 1;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}

/* Categorie */
.press-categories {
    display: flex;
    gap: 0.75rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}

.press-category-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-decoration: none;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.press-category-badge:hover {
    background: rgba(255, 255, 255, 0.35);
    color: white;
    transform: translateY(-2px);
}

/* Titolo */
.press-title {
    font-family: var(--cs-font-display, 'Fahkwang', sans-serif);
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
    color: white;
    line-height: 1.2;
    margin-bottom: 1.5rem;
}

/* Meta Info */
.press-meta {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
}

.press-meta-item {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.press-meta-item svg {
    opacity: 0.8;
}

.press-meta-separator {
    opacity: 0.5;
}

/* Article Content */
.press-article {
    background: var(--cs-white);
    padding: 60px 0;
}

.press-content-wrapper {
    max-width: 800px;
    margin: 0 auto;
}

/* Featured Image */
.press-featured-image {
    margin: 0 0 2.5rem;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.press-featured-image img {
    width: 100%;
    height: auto;
    display: block;
}

.press-featured-image figcaption {
    background: var(--cs-light);
    padding: 1rem;
    font-size: 0.875rem;
    color: var(--cs-gray);
    text-align: center;
}

/* Content */
.press-content {
    font-size: 1.125rem;
    line-height: 1.9;
    color: var(--cs-dark);
}

.press-content p {
    margin-bottom: 1.5rem;
}

.press-content h2,
.press-content h3,
.press-content h4 {
    font-family: var(--cs-font-display);
    margin-top: 2.5rem;
    margin-bottom: 1rem;
    color: var(--cs-dark);
}

.press-content a {
    color: var(--cs-primary);
    text-decoration: underline;
}

.press-content a:hover {
    color: var(--cs-secondary);
}

.press-content blockquote {
    border-left: 4px solid var(--cs-secondary);
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: var(--cs-gray);
}

.press-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}

/* Footer */
.press-footer {
    border-top: 1px solid var(--cs-light);
    padding-top: 2rem;
    margin-top: 3rem;
}

/* Tags */
.press-tags {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.tags-label {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--cs-dark);
}

.press-tag {
    display: inline-block;
    background: var(--cs-light);
    color: var(--cs-gray);
    padding: 0.4rem 0.9rem;
    border-radius: 50px;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.press-tag:hover {
    background: var(--cs-primary);
    color: white;
}

/* Share */
.press-share {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.share-label {
    font-weight: 600;
    color: var(--cs-dark);
}

.share-buttons {
    display: flex;
    gap: 0.75rem;
}

.share-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: var(--cs-light);
    color: var(--cs-gray);
    transition: all 0.3s ease;
}

.share-btn:hover {
    transform: translateY(-3px);
}

.share-facebook:hover {
    background: #1877f2;
    color: white;
}

.share-twitter:hover {
    background: #1da1f2;
    color: white;
}

.share-linkedin:hover {
    background: #0a66c2;
    color: white;
}

.share-email:hover {
    background: var(--cs-secondary);
    color: white;
}

/* Navigation */
.press-navigation {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--cs-light);
}

.press-navigation .nav-links {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.nav-previous,
.nav-next {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--cs-light);
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-previous:hover,
.nav-next:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(124, 58, 237, 0.3);
}

.nav-previous:hover .nav-label,
.nav-previous:hover .nav-title,
.nav-previous:hover .nav-arrow,
.nav-next:hover .nav-label,
.nav-next:hover .nav-title,
.nav-next:hover .nav-arrow {
    color: white;
}

.nav-next {
    text-align: right;
    justify-content: flex-end;
}

.nav-arrow {
    color: var(--cs-gray);
    flex-shrink: 0;
}

.nav-content {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.nav-label {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--cs-gray);
}

.nav-title {
    font-weight: 600;
    color: var(--cs-dark);
    font-size: 1rem;
    line-height: 1.4;
}

/* Back CTA */
.press-back-cta {
    text-align: center;
    margin-top: 3rem;
}

.press-back-cta .cs-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

/* Dark Mode */
body.dark-mode .press-article {
    background: #0f172a;
}

body.dark-mode .press-content,
body.dark-mode .press-content h2,
body.dark-mode .press-content h3,
body.dark-mode .press-content h4 {
    color: var(--cs-dark);
}

body.dark-mode .press-footer {
    border-top-color: #334155;
}

body.dark-mode .press-tag {
    background: #1e293b;
    color: #cbd5e1;
}

body.dark-mode .press-tag:hover {
    background: var(--cs-primary);
    color: white;
}

body.dark-mode .share-btn {
    background: #1e293b;
    color: #cbd5e1;
}

body.dark-mode .nav-previous,
body.dark-mode .nav-next {
    background: #1e293b;
}

body.dark-mode .nav-label {
    color: #94a3b8;
}

body.dark-mode .nav-title {
    color: #f1f5f9;
}

body.dark-mode .press-navigation {
    border-top-color: #334155;
}

body.dark-mode .press-featured-image figcaption {
    background: #1e293b;
    color: #cbd5e1;
}

/* Responsive */
@media (max-width: 768px) {
    .press-hero-header {
        padding: 100px 0 60px;
    }

    .press-title {
        font-size: clamp(1.75rem, 6vw, 2.5rem);
    }

    .press-meta {
        flex-direction: column;
        gap: 0.75rem;
    }

    .press-meta-separator {
        display: none;
    }

    .press-navigation .nav-links {
        grid-template-columns: 1fr;
    }

    .nav-next {
        text-align: left;
        justify-content: flex-start;
        flex-direction: row-reverse;
    }

    .press-share {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<?php
get_footer();
