<?php
/**
 * Template Name: Press
 * Template Post Type: page
 * 
 * @package HeroCS
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main page-press">
    
    <!-- HERO HEADER - Press -->
    <div class="page-press-hero">
        <div class="cs-container">
            <header class="page-header text-center cs-reveal">
                <h1 class="page-title"><?php echo wp_get_document_title(); ?></h1>
                <p class="page-excerpt"><?php bloginfo('description'); ?></p>
            </header>
        </div>
    </div>

    <!-- CONTENT SECTION -->
    <div class="cs-container">
        
        <?php while (have_posts()) : the_post(); ?>
            
            <!-- PAGE INTRO -->
            <?php if (get_the_content()) : ?>
                <div class="page-intro cs-content-wrapper cs-reveal">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
            
        <?php endwhile; ?>

                <!-- Press Grid Section -->
                <section class="press-section">
                    <div class="section-header cs-reveal">
                        <h2><?php esc_html_e('Ultimi Articoli', 'herocs'); ?></h2>
                    </div>

                    <?php
                    $press_args = array(
                        'post_type' => 'press',
                        'posts_per_page' => -1,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );
                    $press_query = new WP_Query($press_args);
                    ?>

                    <?php if ($press_query->have_posts()) : ?>
                        <div class="press-grid cs-stagger-group">
                            <?php while ($press_query->have_posts()) : $press_query->the_post(); ?>
                                <?php
                                $testata = get_post_meta(get_the_ID(), '_cs_press_testata', true);
                                $autore = get_post_meta(get_the_ID(), '_cs_press_autore', true);
                                $data = get_post_meta(get_the_ID(), '_cs_press_data', true);
                                $link = get_post_meta(get_the_ID(), '_cs_press_link', true);
                                $pdf = get_post_meta(get_the_ID(), '_cs_press_pdf', true);
                                $tipo = get_post_meta(get_the_ID(), '_cs_press_tipo', true);
                                ?>
                                
                                <article class="press-item cs-stagger-item">
                                    <div class="press-card">
                                        
                                        <!-- Thumbnail -->
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="press-thumbnail">
                                                <figure class="press-image">
                                                    <?php the_post_thumbnail('cs-press-thumb', array('loading' => 'lazy')); ?>
                                                </figure>
                                                <?php if ($tipo) : ?>
                                                    <span class="press-badge press-badge--<?php echo esc_attr(sanitize_html_class($tipo)); ?>">
                                                        <?php echo esc_html(ucfirst($tipo)); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Content -->
                                        <div class="press-content">
                                            
                                            <!-- Publication Details -->
                                            <div class="press-meta">
                                                <?php if ($testata) : ?>
                                                    <div class="press-publication">
                                                        <svg class="icon icon-sm" aria-hidden="true">
                                                            <use href="#icon-newspaper"></use>
                                                        </svg>
                                                        <span><?php echo esc_html($testata); ?></span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if ($data) : ?>
                                                    <time class="press-date" datetime="<?php echo esc_attr($data); ?>">
                                                        <svg class="icon icon-sm" aria-hidden="true">
                                                            <use href="#icon-calendar"></use>
                                                        </svg>
                                                        <span><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($data))); ?></span>
                                                    </time>
                                                <?php endif; ?>

                                                <?php if ($autore) : ?>
                                                    <div class="press-author">
                                                        <svg class="icon icon-sm" aria-hidden="true">
                                                            <use href="#icon-user"></use>
                                                        </svg>
                                                        <span><?php echo esc_html($autore); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Title -->
                                            <h3 class="press-title">
                                                <a href="<?php echo $link ? esc_url($link) : esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>

                                            <!-- Excerpt -->
                                            <?php if (has_excerpt()) : ?>
                                                <p class="press-excerpt">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                                                </p>
                                            <?php endif; ?>

                                            <!-- Actions -->
                                            <div class="press-actions">
                                                <?php if ($link) : ?>
                                                    <a href="<?php echo esc_url($link); ?>" class="cs-link cs-link-arrow" target="_blank" rel="noopener noreferrer">
                                                        <?php esc_html_e('Leggi online', 'herocs'); ?>
                                                        <svg class="icon icon-sm" aria-hidden="true">
                                                            <use href="#icon-arrow-right"></use>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if ($pdf) : ?>
                                                    <a href="<?php echo esc_url($pdf); ?>" class="cs-link cs-link-arrow" target="_blank" rel="noopener noreferrer" download>
                                                        <?php esc_html_e('Scarica PDF', 'herocs'); ?>
                                                        <svg class="icon icon-sm" aria-hidden="true">
                                                            <use href="#icon-download"></use>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                            <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <div class="empty-state cs-reveal">
                            <p><?php esc_html_e('Nessun articolo press trovato.', 'herocs'); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>

                <!-- Featured Press Section -->
                <section class="featured-press-section cs-reveal">
                    <div class="section-header text-center">
                        <h2><?php esc_html_e('In Evidenza', 'herocs'); ?></h2>
                        <p class="section-subtitle"><?php esc_html_e('Le nostre ultime pubblicazioni', 'herocs'); ?></p>
                    </div>

                    <?php
                    $featured_args = array(
                        'post_type' => 'press',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC',
                    );
                    $featured_query = new WP_Query($featured_args);
                    ?>

                    <?php if ($featured_query->have_posts()) : ?>
                        <div class="featured-grid">
                            <?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
                                <?php
                                $testata = get_post_meta(get_the_ID(), '_cs_press_testata', true);
                                $data = get_post_meta(get_the_ID(), '_cs_press_data', true);
                                $link = get_post_meta(get_the_ID(), '_cs_press_link', true);
                                $tipo = get_post_meta(get_the_ID(), '_cs_press_tipo', true);
                                ?>
                                
                                <article class="featured-item cs-stagger-item">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="featured-image">
                                            <figure>
                                                <?php the_post_thumbnail('cs-press-featured', array('loading' => 'lazy')); ?>
                                            </figure>
                                            <?php if ($tipo) : ?>
                                                <span class="press-badge press-badge--<?php echo esc_attr(sanitize_html_class($tipo)); ?>">
                                                    <?php echo esc_html(ucfirst($tipo)); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="featured-content">
                                        <?php if ($testata) : ?>
                                            <div class="featured-publication"><?php echo esc_html($testata); ?></div>
                                        <?php endif; ?>
                                        
                                        <h3 class="featured-title">
                                            <a href="<?php echo $link ? esc_url($link) : esc_url(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        
                                        <?php if ($data) : ?>
                                            <time class="featured-date" datetime="<?php echo esc_attr($data); ?>">
                                                <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($data))); ?>
                                            </time>
                                        <?php endif; ?>
                                        
                                        <?php if (has_excerpt()) : ?>
                                            <p class="featured-excerpt">
                                                <?php the_excerpt(); ?>
                                            </p>
                                        <?php endif; ?>
                                        
                                        <?php if ($link) : ?>
                                            <a href="<?php echo esc_url($link); ?>" class="cs-link cs-link-arrow" target="_blank" rel="noopener noreferrer">
                                                <?php esc_html_e('Leggi l\'articolo', 'herocs'); ?>
                                                <svg class="icon icon-sm" aria-hidden="true">
                                                    <use href="#icon-arrow-right"></use>
                                                </svg>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </article>

                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </section>

                <!-- Stats Section -->
                <section class="press-stats cs-reveal">
                    <h2 class="text-center"><?php esc_html_e('La Nostra Presenza Media', 'herocs'); ?></h2>
                    
                    <div class="stats-grid">
                        <?php
                        $total_press = wp_count_posts('press')->publish ?? 0;
                        $current_year = new WP_Query(array(
                            'post_type' => 'press',
                            'date_query' => array(
                                array('year' => date('Y')),
                            ),
                            'fields' => 'ids',
                        ));
                        $year_count = $current_year->found_posts;
                        wp_reset_postdata();
                        ?>
                        
                        <div class="stat-card">
                            <div class="stat-icon">📰</div>
                            <div class="stat-value cs-counter" data-target="<?php echo esc_attr($total_press); ?>">0</div>
                            <p class="stat-label"><?php esc_html_e('Pubblicazioni Totali', 'herocs'); ?></p>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">📅</div>
                            <div class="stat-value cs-counter" data-target="<?php echo esc_attr($year_count); ?>">0</div>
                            <p class="stat-label"><?php printf(esc_html__('Nel %s', 'herocs'), date('Y')); ?></p>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">🎯</div>
                            <div class="stat-value">50+</div>
                            <p class="stat-label"><?php esc_html_e('Testate Nazionali', 'herocs'); ?></p>
                        </div>
                    </div>
                </section>

                <!-- Press Office CTA -->
                <section class="press-cta-section cs-reveal">
                    <div class="cta-box">
                        <div class="cta-content">
                            <h2><?php esc_html_e('Ufficio Stampa', 'herocs'); ?></h2>
                            <p><?php esc_html_e('Per richieste media, interviste o informazioni sui nostri progetti, contattaci', 'herocs'); ?></p>
                        </div>
                        <div class="cta-buttons">
                            <a href="mailto:press@cscommunicationagency.it" class="cs-btn cs-btn-primary">
                                <svg class="icon icon-sm" aria-hidden="true">
                                    <use href="#icon-mail"></use>
                                </svg>
                                <?php esc_html_e('Email Ufficio Stampa', 'herocs'); ?>
                            </a>
                            <a href="<?php echo esc_url(home_url('/contatti')); ?>" class="cs-btn cs-btn-secondary">
                                <?php esc_html_e('Vai ai Contatti', 'herocs'); ?>
                            </a>
                        </div>
                    </div>
                </section>

            </div>

        </article>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>