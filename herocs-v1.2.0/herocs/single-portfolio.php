<?php
/**
 * Single Portfolio Template
 *
 * @package CS_Communication
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        
        // Get custom fields
        $client = cs_get_portfolio_client();
        $project_date = cs_get_portfolio_date();
        $role = cs_get_portfolio_role();
        $project_url = cs_get_portfolio_url();
        $results = cs_get_portfolio_results();
        $testimonial = cs_get_portfolio_testimonial();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-single'); ?>>
            
            <!-- Breadcrumbs -->
            <div class="cs-container">
                <?php cs_breadcrumbs(); ?>
            </div>

            <!-- Hero Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="portfolio-hero">
                    <?php the_post_thumbnail('cs-hero', array('class' => 'portfolio-hero-image')); ?>
                </div>
            <?php endif; ?>

            <!-- Project Header -->
            <div class="portfolio-header cs-container">
                <div class="portfolio-header-content">
                    <header class="entry-header">
                        <?php
                        // Categories
                        $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                        if ($categories && !is_wp_error($categories)) :
                            ?>
                            <div class="portfolio-categories">
                                <?php foreach ($categories as $category) : ?>
                                    <span class="portfolio-category-badge">
                                        <?php echo esc_html($category->name); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="entry-title"><?php the_title(); ?></h1>

                        <?php if (get_the_excerpt()) : ?>
                            <div class="entry-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <!-- Project Meta -->
                    <div class="portfolio-meta">
                        <?php if ($client) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Client', 'cs-communication'); ?></span>
                                <span class="meta-value"><?php echo esc_html($client); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($project_date) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Date', 'cs-communication'); ?></span>
                                <span class="meta-value"><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($project_date))); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($role) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Our Role', 'cs-communication'); ?></span>
                                <span class="meta-value"><?php echo esc_html($role); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if ($project_url) : ?>
                            <div class="meta-item">
                                <span class="meta-label"><?php esc_html_e('Website', 'cs-communication'); ?></span>
                                <span class="meta-value">
                                    <a href="<?php echo esc_url($project_url); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php esc_html_e('Visit Project', 'cs-communication'); ?> ÃƒÂ¢Ã¢â‚¬Â Ã¢â‚¬â„¢
                                    </a>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Project Content -->
            <div class="portfolio-content cs-container cs-content-wrapper">
                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'cs-communication'),
                        'after' => '</div>',
                    ));
                    ?>
                </div>

                <?php if ($results) : ?>
                    <div class="portfolio-results cs-reveal">
                        <h2><?php esc_html_e('Results & Achievements', 'cs-communication'); ?></h2>
                        <div class="results-content">
                            <?php echo wp_kses_post(wpautop($results)); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($testimonial['quote']) : ?>
                    <div class="portfolio-testimonial cs-reveal">
                        <blockquote class="testimonial-quote">
                            <p><?php echo wp_kses_post($testimonial['quote']); ?></p>
                            <?php if ($testimonial['author']) : ?>
                                <cite class="testimonial-author">
                                    <?php echo esc_html($testimonial['author']); ?>
                                </cite>
                            <?php endif; ?>
                        </blockquote>
                    </div>
                <?php endif; ?>

                <!-- Tags -->
                <?php
                $tags = get_the_terms(get_the_ID(), 'portfolio_tag');
                if ($tags && !is_wp_error($tags)) :
                    ?>
                    <div class="portfolio-tags">
                        <span class="tags-label"><?php esc_html_e('Tags:', 'cs-communication'); ?></span>
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_term_link($tag)); ?>" class="tag-link">
                                <?php echo esc_html($tag->name); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Navigation -->
            <div class="portfolio-navigation cs-container">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post) :
                        ?>
                        <div class="nav-previous">
                            <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                <span class="nav-subtitle"><?php esc_html_e('Previous Project', 'cs-communication'); ?></span>
                                <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="nav-center">
                        <a href="<?php echo esc_url(get_post_type_archive_link('portfolio')); ?>" class="back-to-portfolio">
                            <?php esc_html_e('All Projects', 'cs-communication'); ?>
                        </a>
                    </div>

                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                <span class="nav-subtitle"><?php esc_html_e('Next Project', 'cs-communication'); ?></span>
                                <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Related Projects -->
            <?php
            $categories = get_the_terms(get_the_ID(), 'portfolio_category');
            if ($categories && !is_wp_error($categories)) :
                $category_ids = wp_list_pluck($categories, 'term_id');
                
                $related_args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'portfolio_category',
                            'field' => 'term_id',
                            'terms' => $category_ids,
                        ),
                    ),
                );
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) :
                    ?>
                    <section class="related-projects">
                        <div class="cs-container">
                            <h2 class="section-title text-center">
                                <?php esc_html_e('Related Projects', 'cs-communication'); ?>
                            </h2>
                            
                            <div class="portfolio-grid cs-stagger-group">
                                <?php
                                while ($related_query->have_posts()) : $related_query->the_post();
                                    get_template_part('template-parts/portfolio', 'grid');
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </section>
                    <?php
                endif;
            endif;
            ?>

        </article>

    <?php endwhile; ?>
</main>

<?php
get_footer();