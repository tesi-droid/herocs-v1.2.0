<?php
/**
 * Archive Collaborazioni Template
 * Pagina archivio di tutte le collaborazioni
 *
 * @package HeroCS
 * @since 1.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main archive-collaborazioni-page">
    
    <!-- Hero Header -->
    <section class="archive-hero">
        <div class="hero-gradient-overlay"></div>
        <div class="hero-content">
            <div class="archive-container">
                <h1 class="archive-title">Collaborazioni</h1>
                <p class="archive-subtitle">Partner, clienti e collaboratori con cui abbiamo costruito successi insieme</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="archive-content">
        <div class="archive-container">
            
            <!-- Filtri -->
            <?php
            $tipologie = get_terms(array(
                'taxonomy' => 'tipologia_cliente',
                'hide_empty' => true,
            ));

            if ($tipologie && !is_wp_error($tipologie)) :
            ?>
            <div class="archive-filters">
                <button class="filter-btn active" data-filter="all">
                    Tutti
                    <span class="count">(<?php echo wp_count_posts('collaborazioni')->publish; ?>)</span>
                </button>
                <?php foreach ($tipologie as $tipologia) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr($tipologia->slug); ?>">
                        <?php echo esc_html($tipologia->name); ?>
                        <span class="count">(<?php echo esc_html($tipologia->count); ?>)</span>
                    </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- Grid -->
            <?php if (have_posts()) : ?>
                <div class="archive-grid">
                    <?php while (have_posts()) : the_post();
                        $logo = get_post_meta(get_the_ID(), '_cs_collab_logo', true);
                        $website = get_post_meta(get_the_ID(), '_cs_collab_website', true);
                        $anno = get_post_meta(get_the_ID(), '_cs_collab_anno', true);
                        $servizi = get_post_meta(get_the_ID(), '_cs_collab_servizi', true);
                        
                        $tipologie_post = get_the_terms(get_the_ID(), 'tipologia_cliente');
                        $tipologie_slugs = array();
                        if ($tipologie_post && !is_wp_error($tipologie_post)) {
                            $tipologie_slugs = wp_list_pluck($tipologie_post, 'slug');
                        }
                    ?>
                        <article class="collab-card" data-categories="<?php echo esc_attr(implode(' ', $tipologie_slugs)); ?>">
                            <a href="<?php the_permalink(); ?>" class="card-link">
                                
                                <!-- Logo -->
                                <div class="card-logo">
                                    <?php if ($logo) : ?>
                                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                    <?php elseif (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', array('alt' => get_the_title())); ?>
                                    <?php else : ?>
                                        <div class="logo-placeholder">
                                            <span><?php echo esc_html(get_the_title()); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Content -->
                                <div class="card-content">
                                    <?php if ($tipologie_post && !is_wp_error($tipologie_post)) : ?>
                                        <div class="card-badges">
                                            <?php foreach ($tipologie_post as $tip) : ?>
                                                <span class="badge"><?php echo esc_html($tip->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <h2 class="card-title"><?php the_title(); ?></h2>
                                    
                                    <?php if ($anno) : ?>
                                        <p class="card-anno">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                                            </svg>
                                            Dal <?php echo esc_html($anno); ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <?php if (has_excerpt()) : ?>
                                        <p class="card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                    <?php endif; ?>
                                    
                                    <span class="card-link-text">
                                        Scopri di più
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"/>
                                            <polyline points="12 5 19 12 12 19"/>
                                        </svg>
                                    </span>
                                </div>
                                
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="archive-pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>',
                        'next_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>',
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="no-results">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                    <h2>Nessuna collaborazione trovata</h2>
                    <p>Non ci sono ancora collaborazioni da mostrare.</p>
                    <?php if (current_user_can('edit_posts')) : ?>
                        <a href="<?php echo esc_url(admin_url('post-new.php?post_type=collaborazioni')); ?>" class="add-new-btn">
                            Aggiungi collaborazione
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>

</main>

<?php get_footer(); ?>

<style>
/* ==========================================================================
   ARCHIVE COLLABORAZIONI - Styles
   ========================================================================== */

.archive-collaborazioni-page {
    background: #f8fafc;
}

/* Hero */
.archive-hero {
    position: relative;
    height: 300px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
}

.archive-hero .hero-gradient-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.2) 100%);
}

.archive-hero .hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
}

.archive-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.archive-title {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    color: white;
    margin: 0 0 16px 0;
    text-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.archive-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    margin: 0;
    max-width: 600px;
    margin: 0 auto;
}

/* Content */
.archive-content {
    padding: 60px 0 80px;
}

/* Filters */
.archive-filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin-bottom: 48px;
}

.filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 50px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    font-weight: 500;
    color: #64748b;
    cursor: pointer;
    transition: all 0.3s;
}

.filter-btn:hover {
    border-color: #7c3aed;
    color: #7c3aed;
}

.filter-btn.active {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-color: transparent;
    color: white;
}

.filter-btn .count {
    font-size: 0.85rem;
    opacity: 0.7;
}

/* Grid */
.archive-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

/* Cards */
.collab-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    opacity: 1;
    transform: scale(1);
}

.collab-card.hidden {
    opacity: 0;
    transform: scale(0.9);
    position: absolute;
    pointer-events: none;
}

.collab-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(124, 58, 237, 0.15);
}

.card-link {
    display: block;
    text-decoration: none;
    height: 100%;
}

.card-logo {
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    background: #f8fafc;
    border-bottom: 1px solid #f1f5f9;
}

.card-logo img {
    max-width: 100%;
    max-height: 120px;
    object-fit: contain;
}

.card-logo .logo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-radius: 12px;
}

.card-logo .logo-placeholder span {
    font-family: 'Poppins', sans-serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: white;
    text-align: center;
    padding: 16px;
}

.card-content {
    padding: 24px;
}

.card-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 12px;
}

.card-badges .badge {
    display: inline-block;
    padding: 4px 12px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.card-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 8px 0;
    transition: color 0.3s;
}

.collab-card:hover .card-title {
    color: #7c3aed;
}

.card-anno {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    color: #64748b;
    margin: 0 0 12px 0;
}

.card-anno svg {
    color: #94a3b8;
}

.card-excerpt {
    font-size: 0.95rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0 0 16px 0;
}

.card-link-text {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    font-weight: 600;
    color: #7c3aed;
    transition: gap 0.3s;
}

.collab-card:hover .card-link-text {
    gap: 12px;
}

/* Pagination */
.archive-pagination {
    margin-top: 60px;
    text-align: center;
}

.archive-pagination .nav-links {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.archive-pagination a,
.archive-pagination span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    height: 44px;
    padding: 0 16px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    color: #64748b;
    text-decoration: none;
    transition: all 0.3s;
}

.archive-pagination a:hover {
    border-color: #7c3aed;
    color: #7c3aed;
}

.archive-pagination .current {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    border-color: transparent;
    color: white;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 80px 24px;
}

.no-results svg {
    color: #cbd5e1;
    margin-bottom: 24px;
}

.no-results h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 12px 0;
}

.no-results p {
    color: #64748b;
    margin: 0 0 24px 0;
}

.add-new-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s;
}

.add-new-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(124, 58, 237, 0.4);
}

/* ==========================================================================
   RESPONSIVE
   ========================================================================== */

@media (max-width: 768px) {
    .archive-hero {
        height: 250px;
    }
    
    .archive-filters {
        gap: 8px;
    }
    
    .filter-btn {
        padding: 10px 18px;
        font-size: 0.85rem;
    }
    
    .archive-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

@media (max-width: 480px) {
    .archive-hero {
        height: 220px;
    }
    
    .archive-content {
        padding: 40px 0 60px;
    }
}

/* ==========================================================================
   DARK MODE
   ========================================================================== */

body.dark-mode .archive-collaborazioni-page {
    background: #0f172a;
}

body.dark-mode .filter-btn {
    background: #1e293b;
    border-color: #334155;
    color: #94a3b8;
}

body.dark-mode .filter-btn:hover {
    border-color: #a78bfa;
    color: #a78bfa;
}

body.dark-mode .filter-btn.active {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
    color: white;
}

body.dark-mode .collab-card {
    background: #1e293b;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}

body.dark-mode .card-logo {
    background: #0f172a;
    border-color: #334155;
}

body.dark-mode .card-title {
    color: #f1f5f9;
}

body.dark-mode .collab-card:hover .card-title {
    color: #a78bfa;
}

body.dark-mode .card-anno,
body.dark-mode .card-excerpt {
    color: #94a3b8;
}

body.dark-mode .card-link-text {
    color: #a78bfa;
}

body.dark-mode .archive-pagination a,
body.dark-mode .archive-pagination span {
    background: #1e293b;
    border-color: #334155;
    color: #94a3b8;
}

body.dark-mode .archive-pagination a:hover {
    border-color: #a78bfa;
    color: #a78bfa;
}

body.dark-mode .archive-pagination .current {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
    color: white;
}

body.dark-mode .no-results h2 {
    color: #f1f5f9;
}

body.dark-mode .no-results p {
    color: #94a3b8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filtri collaborazioni
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.collab-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter cards
            cards.forEach(card => {
                const categories = card.dataset.categories.split(' ');
                
                if (filter === 'all' || categories.includes(filter)) {
                    card.classList.remove('hidden');
                    card.style.display = '';
                } else {
                    card.classList.add('hidden');
                    setTimeout(() => {
                        if (card.classList.contains('hidden')) {
                            card.style.display = 'none';
                        }
                    }, 300);
                }
            });
        });
    });
});
</script>
