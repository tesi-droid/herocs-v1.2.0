<?php
/**
 * Template Name: Collaborazioni
 * Template Post Type: page
 * 
 * @package CS_Communication
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main page-collaborazioni">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- HERO HEADER - Collaborazioni -->
            <div class="page-collaborazioni-hero">
                <div class="cs-container">
                    <header class="page-header text-center cs-reveal">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    <?php if (has_excerpt()) : ?>
                        <div class="page-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <!-- Intro Content -->
                <?php if (get_the_content()) : ?>
                    <div class="page-intro cs-content-wrapper cs-reveal">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>

                <!-- Filtri Tipologia Cliente -->
                <?php
                $tipologie = get_terms(array(
                    'taxonomy' => 'tipologia_cliente',
                    'hide_empty' => true,
                ));

                if ($tipologie && !is_wp_error($tipologie)) :
                    ?>
                    <div class="collaborazioni-filters cs-reveal">
                        <button class="filter-btn active" data-filter="all" aria-pressed="true">
                            <?php esc_html_e('Tutti', 'cs-communication'); ?>
                        </button>
                        <?php foreach ($tipologie as $tipologia) : ?>
                            <button class="filter-btn" 
                                    data-filter="<?php echo esc_attr($tipologia->slug); ?>"
                                    aria-pressed="false">
                                <?php echo esc_html($tipologia->name); ?>
                                <span class="count">(<?php echo esc_html($tipologia->count); ?>)</span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Collaborazioni Grid -->
                <?php
                $collaborazioni_query = new WP_Query(array(
                    'post_type' => 'collaborazioni',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($collaborazioni_query->have_posts()) :
                    get_template_part('template-parts/collaborazioni', 'grid', array('query' => $collaborazioni_query));
                else :
                    ?>
                    <div class="no-collaborazioni text-center cs-reveal">
                        <p><?php esc_html_e('Nessuna collaborazione trovata.', 'cs-communication'); ?></p>
                    </div>
                <?php endif; ?>

                <!-- Stats Section -->
                <section class="collaborazioni-stats cs-reveal">
                    <div class="stats-grid">
                        <?php
                        $total_collab = wp_count_posts('collaborazioni')->publish;
                        $anni_attivita = date('Y') - 2010; // Modifica l'anno di inizio
                        ?>
                        <div class="stat-item">
                            <div class="stat-number cs-counter" data-target="<?php echo esc_attr($total_collab); ?>">0</div>
                            <div class="stat-label"><?php esc_html_e('Clienti', 'cs-communication'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number cs-counter" data-target="<?php echo esc_attr($anni_attivita); ?>">0</div>
                            <div class="stat-label"><?php esc_html_e('Anni di Esperienza', 'cs-communication'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number cs-counter" data-target="<?php echo esc_attr($total_collab * 3); ?>">0</div>
                            <div class="stat-label"><?php esc_html_e('Progetti Realizzati', 'cs-communication'); ?></div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">98<span class="percent">%</span></div>
                            <div class="stat-label"><?php esc_html_e('Clienti Soddisfatti', 'cs-communication'); ?></div>
                        </div>
                    </div>
                </section>

                <!-- CTA Section -->
                <section class="collaborazioni-cta cs-reveal">
                    <div class="cta-box text-center">
                        <h2><?php esc_html_e('Vuoi diventare nostro cliente?', 'cs-communication'); ?></h2>
                        <p><?php esc_html_e('Contattaci per scoprire come possiamo aiutarti a raggiungere i tuoi obiettivi', 'cs-communication'); ?></p>
                        <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cs-btn cs-btn-primary cs-magnetic-btn">
                            <?php esc_html_e('Richiedi Consulenza', 'cs-communication'); ?>
                        </a>
                    </div>
                </section>

            </div>

        </article>

    <?php endwhile; ?>

</main>

<style>
/* ========================================================================== */
/* COLLABORAZIONI PAGE - INLINE STYLES */
/* ========================================================================== */

.page-collaborazioni .page-header {
    padding: var(--cs-space-xl) 0 var(--cs-space-lg);
}

.page-collaborazioni .page-excerpt {
    font-size: var(--cs-text-lg);
    color: var(--cs-gray);
    max-width: 800px;
    margin: var(--cs-space-md) auto 0;
}

.page-intro {
    margin-bottom: var(--cs-space-lg);
    text-align: center;
}

/* Filtri */
.collaborazioni-filters {
    display: flex;
    flex-wrap: wrap;
    gap: var(--cs-space-sm);
    justify-content: center;
    margin-bottom: var(--cs-space-lg);
    padding: var(--cs-space-md) 0;
}

.filter-btn {
    padding: 0.75rem 1.5rem;
    background: var(--cs-light);
    border: 2px solid transparent;
    border-radius: var(--cs-radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: all var(--cs-transition);
    color: var(--cs-dark);
    font-family: var(--cs-font-secondary);
}

.filter-btn:hover {
    background: var(--cs-white);
    border-color: var(--cs-primary);
    transform: translateY(-2px);
}

.filter-btn.active {
    background: var(--cs-primary);
    color: white;
    border-color: var(--cs-primary);
}

.filter-btn .count {
    font-size: var(--cs-text-sm);
    opacity: 0.8;
    margin-left: 0.25rem;
}

/* Stats Section */
.collaborazioni-stats {
    padding: var(--cs-space-xl) 0;
    background: var(--cs-light);
    margin: var(--cs-space-xl) calc(-1 * var(--cs-space-sm));
    padding-left: var(--cs-space-sm);
    padding-right: var(--cs-space-sm);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--cs-space-md);
    max-width: 1000px;
    margin: 0 auto;
}

.stat-item {
    text-align: center;
    padding: var(--cs-space-md);
}

.stat-number {
    font-size: 3.5rem;
    font-weight: 800;
    color: var(--cs-primary);
    font-family: var(--cs-font-secondary);
    line-height: 1;
}

.stat-number .percent {
    font-size: 2rem;
}

.stat-label {
    margin-top: var(--cs-space-sm);
    font-size: var(--cs-text-base);
    color: var(--cs-gray);
    font-weight: 600;
}

/* CTA */
.collaborazioni-cta {
    padding: var(--cs-space-xl) 0;
}

.collaborazioni-cta .cta-box {
    background: linear-gradient(135deg, var(--cs-primary) 0%, var(--cs-secondary) 100%);
    color: white;
    padding: var(--cs-space-xl) var(--cs-space-lg);
    border-radius: var(--cs-radius-lg);
}

.collaborazioni-cta .cta-box h2 {
    color: white;
    margin-bottom: var(--cs-space-sm);
}

.collaborazioni-cta .cta-box p {
    font-size: var(--cs-text-lg);
    margin-bottom: var(--cs-space-md);
    opacity: 0.95;
}

/* No collaborazioni */
.no-collaborazioni {
    text-align: center;
    padding: var(--cs-space-lg);
}
/* Hero header - Collaborazioni Page (Viola) */
.page-collaborazioni-hero {
    background: linear-gradient(135deg, #7c3aed 0%, #6366f1 100%);
    padding: 80px 20px;
    margin-bottom: 60px;
    color: white;
}

.page-collaborazioni-hero .page-header {
    text-align: center;
}

.page-collaborazioni-hero h1 {
    color: white;
    font-size: clamp(2rem, 5vw, 3rem);
}

.page-collaborazioni-hero .page-excerpt {
    color: rgba(255, 255, 255, 0.95);
    font-size: 1.25rem;
    max-width: 800px;
    margin: 20px auto 0;
}

@media (max-width: 768px) {
    .collaborazioni-filters {
        flex-direction: column;
    }
    
    .filter-btn {
        width: 100%;
        text-align: center;
    }
    
    .collaborazioni-stats {
        margin-left: 0;
        margin-right: 0;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>


<script>
// Filtro Collaborazioni
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const collabItems = document.querySelectorAll('.collaborazione-item');

    if (!filterBtns.length || !collabItems.length) return;

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Update active button
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-pressed', 'false');
            });
            this.classList.add('active');
            this.setAttribute('aria-pressed', 'true');

            // Filter items
            collabItems.forEach(item => {
                const itemCategories = item.getAttribute('data-categories');
                
                if (filter === 'all' || itemCategories.includes(filter)) {
                    item.style.display = '';
                    item.classList.add('cs-fade-in');
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php
get_footer();