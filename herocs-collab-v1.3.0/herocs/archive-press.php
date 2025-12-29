<?php
/**
 * Archive Press Template - Press Room
 *
 * @package HeroCS
 * @since 1.1.0
 */

get_header();
?>

<main id="primary" class="site-main archive-press-page">
    
    <!-- Hero Header -->
    <header class="press-room-hero">
        <div class="press-room-overlay"></div>
        <div class="cs-container">
            <div class="press-room-content">
                <h1 class="press-room-title">Press Room</h1>
                <p class="press-room-subtitle">
                    Rassegna stampa, comunicati e pubblicazioni. Scopri cosa dicono di noi i media.
                </p>
            </div>
        </div>
    </header>

    <div class="cs-container">
        <div class="press-room-layout">
            
            <!-- Main Content -->
            <div class="press-room-main">
                
                <!-- Filtri Categorie -->
                <?php
                $press_categories = get_terms(array(
                    'taxonomy' => 'press_category',
                    'hide_empty' => true,
                ));
                
                if ($press_categories && !is_wp_error($press_categories)) :
                    $current_cat = get_queried_object();
                    ?>
                    <div class="press-filters">
                        <a href="<?php echo esc_url(get_post_type_archive_link('press')); ?>" 
                           class="filter-btn <?php echo !is_tax('press_category') ? 'active' : ''; ?>">
                            Tutti
                        </a>
                        <?php foreach ($press_categories as $cat) : ?>
                            <a href="<?php echo esc_url(get_term_link($cat)); ?>" 
                               class="filter-btn <?php echo (is_tax('press_category') && $current_cat->term_id === $cat->term_id) ? 'active' : ''; ?>">
                                <?php echo esc_html($cat->name); ?>
                                <span class="filter-count"><?php echo esc_html($cat->count); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Grid Articoli -->
                <?php if (have_posts()) : ?>
                    <div class="press-grid">
                        <?php
                        while (have_posts()) :
                            the_post();
                            ?>
                            <article <?php post_class('press-card'); ?>>
                                <!-- Immagine -->
                                <a href="<?php the_permalink(); ?>" class="press-card-image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('cs-press-thumb', array('loading' => 'lazy')); ?>
                                    <?php else : ?>
                                        <div class="press-card-placeholder">
                                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                                <polyline points="22,6 12,13 2,6"></polyline>
                                            </svg>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <!-- Badge Categoria -->
                                    <?php
                                    $cats = get_the_terms(get_the_ID(), 'press_category');
                                    if ($cats && !is_wp_error($cats)) :
                                        $first_cat = $cats[0];
                                        ?>
                                        <span class="press-card-badge">
                                            <?php echo esc_html($first_cat->name); ?>
                                        </span>
                                    <?php endif; ?>
                                </a>

                                <!-- Contenuto -->
                                <div class="press-card-content">
                                    <!-- Data -->
                                    <div class="press-card-meta">
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(get_the_date('j F Y')); ?>
                                        </time>
                                    </div>

                                    <!-- Titolo -->
                                    <h2 class="press-card-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <!-- Excerpt -->
                                    <?php if (has_excerpt()) : ?>
                                        <p class="press-card-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                        </p>
                                    <?php endif; ?>

                                    <!-- Link -->
                                    <a href="<?php the_permalink(); ?>" class="press-card-link">
                                        Leggi l'articolo
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Paginazione -->
                    <nav class="press-pagination" aria-label="Navigazione pagine">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg> Precedente',
                            'next_text' => 'Successivo <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                            'type' => 'list',
                        ));
                        ?>
                    </nav>

                <?php else : ?>
                    <!-- Empty State -->
                    <div class="press-empty">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <h2>Nessun articolo trovato</h2>
                        <p>Non ci sono ancora articoli nella Press Room. Torna presto per le novità!</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="press-room-sidebar">
                <!-- Categorie -->
                <div class="sidebar-widget">
                    <h3 class="widget-title">Categorie</h3>
                    <?php if ($press_categories && !is_wp_error($press_categories)) : ?>
                        <ul class="category-list">
                            <li>
                                <a href="<?php echo esc_url(get_post_type_archive_link('press')); ?>" 
                                   class="<?php echo !is_tax('press_category') ? 'active' : ''; ?>">
                                    <span class="cat-name">Tutti gli articoli</span>
                                    <span class="cat-count"><?php echo wp_count_posts('press')->publish; ?></span>
                                </a>
                            </li>
                            <?php foreach ($press_categories as $cat) : ?>
                                <li>
                                    <a href="<?php echo esc_url(get_term_link($cat)); ?>"
                                       class="<?php echo (is_tax('press_category') && isset($current_cat->term_id) && $current_cat->term_id === $cat->term_id) ? 'active' : ''; ?>">
                                        <span class="cat-name"><?php echo esc_html($cat->name); ?></span>
                                        <span class="cat-count"><?php echo esc_html($cat->count); ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Articoli Recenti -->
                <div class="sidebar-widget">
                    <h3 class="widget-title">Articoli Recenti</h3>
                    <?php
                    $recent_press = new WP_Query(array(
                        'post_type' => 'press',
                        'posts_per_page' => 5,
                        'post__not_in' => array(get_the_ID()),
                    ));
                    
                    if ($recent_press->have_posts()) :
                        ?>
                        <ul class="recent-posts-list">
                            <?php
                            while ($recent_press->have_posts()) :
                                $recent_press->the_post();
                                ?>
                                <li>
                                    <a href="<?php the_permalink(); ?>">
                                        <span class="recent-title"><?php the_title(); ?></span>
                                        <span class="recent-date"><?php echo esc_html(get_the_date('j M Y')); ?></span>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <!-- CTA Contatti -->
                <div class="sidebar-widget sidebar-cta">
                    <h3 class="widget-title">Ufficio Stampa</h3>
                    <p>Per interviste, comunicati stampa e collaborazioni media.</p>
                    <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cs-btn cs-btn-primary">
                        Contattaci
                    </a>
                </div>
            </aside>

        </div>
    </div>
</main>

<style>
/* Archive Press Page Styles */
.archive-press-page {
    padding-top: 0;
}

/* Hero */
.press-room-hero {
    position: relative;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 50%, #3b82f6 100%);
    padding: 120px 0 80px;
    margin-top: 60px;
    text-align: center;
}

.press-room-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.15);
}

.press-room-content {
    position: relative;
    z-index: 1;
}

.press-room-title {
    font-family: var(--cs-font-display);
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.press-room-subtitle {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto;
}

/* Layout */
.press-room-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 3rem;
    padding: 60px 0;
}

/* Filters */
.press-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--cs-light);
}

.filter-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.25rem;
    background: var(--cs-light);
    color: var(--cs-gray);
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.filter-btn:hover {
    background: var(--cs-primary);
    color: white;
}

.filter-btn.active {
    background: var(--cs-primary);
    color: white;
}

.filter-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 24px;
    height: 24px;
    padding: 0 0.4rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50px;
    font-size: 0.75rem;
}

/* Grid */
.press-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

/* Card */
.press-card {
    background: var(--cs-white);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.press-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.press-card-image {
    display: block;
    position: relative;
    height: 200px;
    overflow: hidden;
}

.press-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.press-card:hover .press-card-image img {
    transform: scale(1.05);
}

.press-card-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    color: var(--cs-gray);
}

.press-card-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: var(--cs-secondary);
    color: white;
    padding: 0.4rem 0.9rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.press-card-content {
    padding: 1.5rem;
}

.press-card-meta {
    font-size: 0.85rem;
    color: var(--cs-gray);
    margin-bottom: 0.75rem;
}

.press-card-title {
    font-family: var(--cs-font-display);
    font-size: 1.25rem;
    font-weight: 700;
    line-height: 1.3;
    margin-bottom: 0.75rem;
}

.press-card-title a {
    color: var(--cs-dark);
    text-decoration: none;
    transition: color 0.3s ease;
}

.press-card-title a:hover {
    color: var(--cs-primary);
}

.press-card-excerpt {
    font-size: 0.95rem;
    color: var(--cs-gray);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.press-card-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--cs-secondary);
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.press-card-link:hover {
    color: var(--cs-primary);
    gap: 0.75rem;
}

/* Pagination */
.press-pagination {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid var(--cs-light);
}

.press-pagination ul {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.press-pagination li a,
.press-pagination li span {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    background: var(--cs-light);
    color: var(--cs-gray);
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.press-pagination li a:hover {
    background: var(--cs-primary);
    color: white;
}

.press-pagination li span.current {
    background: var(--cs-primary);
    color: white;
}

/* Empty State */
.press-empty {
    text-align: center;
    padding: 80px 40px;
    background: var(--cs-light);
    border-radius: 16px;
}

.press-empty svg {
    color: var(--cs-gray);
    margin-bottom: 1.5rem;
}

.press-empty h2 {
    font-family: var(--cs-font-display);
    font-size: 1.5rem;
    color: var(--cs-dark);
    margin-bottom: 0.75rem;
}

.press-empty p {
    color: var(--cs-gray);
}

/* Sidebar */
.press-room-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.sidebar-widget {
    background: var(--cs-white);
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
}

.widget-title {
    font-family: var(--cs-font-display);
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--cs-dark);
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--cs-light);
}

/* Category List */
.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li {
    margin-bottom: 0.5rem;
}

.category-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 1rem;
    background: var(--cs-light);
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.category-list a:hover,
.category-list a.active {
    background: var(--cs-primary);
}

.category-list a:hover .cat-name,
.category-list a:hover .cat-count,
.category-list a.active .cat-name,
.category-list a.active .cat-count {
    color: white;
}

.cat-name {
    color: var(--cs-dark);
    font-weight: 500;
    font-size: 0.9rem;
}

.cat-count {
    background: rgba(0, 0, 0, 0.1);
    color: var(--cs-gray);
    padding: 0.2rem 0.6rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
}

/* Recent Posts */
.recent-posts-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recent-posts-list li {
    border-bottom: 1px solid var(--cs-light);
    padding-bottom: 0.75rem;
    margin-bottom: 0.75rem;
}

.recent-posts-list li:last-child {
    border-bottom: none;
    padding-bottom: 0;
    margin-bottom: 0;
}

.recent-posts-list a {
    display: block;
    text-decoration: none;
    transition: color 0.3s ease;
}

.recent-posts-list a:hover .recent-title {
    color: var(--cs-primary);
}

.recent-title {
    display: block;
    color: var(--cs-dark);
    font-weight: 500;
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0.25rem;
}

.recent-date {
    font-size: 0.8rem;
    color: var(--cs-gray);
}

/* Sidebar CTA */
.sidebar-cta {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
}

.sidebar-cta .widget-title {
    color: white;
    border-bottom-color: rgba(255, 255, 255, 0.2);
}

.sidebar-cta p {
    font-size: 0.95rem;
    opacity: 0.9;
    margin-bottom: 1.25rem;
}

.sidebar-cta .cs-btn-primary {
    background: white;
    color: var(--cs-primary);
    width: 100%;
    justify-content: center;
}

.sidebar-cta .cs-btn-primary:hover {
    background: rgba(255, 255, 255, 0.9);
    transform: translateY(-2px);
}

/* Dark Mode */
body.dark-mode .press-card {
    background: #1e293b;
}

body.dark-mode .press-card-title a {
    color: #f1f5f9;
}

body.dark-mode .press-card-placeholder {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
}

body.dark-mode .sidebar-widget {
    background: #1e293b;
}

body.dark-mode .widget-title {
    color: #f1f5f9;
    border-bottom-color: #334155;
}

body.dark-mode .category-list a {
    background: #0f172a;
}

body.dark-mode .cat-name {
    color: #f1f5f9;
}

body.dark-mode .recent-title {
    color: #f1f5f9;
}

body.dark-mode .press-filters {
    border-bottom-color: #334155;
}

body.dark-mode .filter-btn {
    background: #1e293b;
    color: #cbd5e1;
}

body.dark-mode .press-pagination {
    border-top-color: #334155;
}

body.dark-mode .press-pagination li a,
body.dark-mode .press-pagination li span {
    background: #1e293b;
    color: #cbd5e1;
}

body.dark-mode .press-empty {
    background: #1e293b;
}

body.dark-mode .press-empty h2 {
    color: #f1f5f9;
}

/* Responsive */
@media (max-width: 1024px) {
    .press-room-layout {
        grid-template-columns: 1fr;
    }

    .press-room-sidebar {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .sidebar-cta {
        grid-column: span 2;
    }
}

@media (max-width: 768px) {
    .press-room-hero {
        padding: 100px 0 60px;
    }

    .press-grid {
        grid-template-columns: 1fr;
    }

    .press-room-sidebar {
        grid-template-columns: 1fr;
    }

    .sidebar-cta {
        grid-column: span 1;
    }

    .press-filters {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .press-pagination ul {
        flex-wrap: wrap;
    }
}
</style>

<?php
get_footer();
