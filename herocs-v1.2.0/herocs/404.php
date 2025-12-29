<?php
/**
 * 404 Error Page Template
 *
 * @package CS_Communication
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main error-404-page">
    
    <div class="cs-container">
        <div class="error-404-content text-center">
            
            <!-- 404 Visual -->
            <div class="error-404-visual cs-fade-in">
                <span class="error-404-number" aria-hidden="true">404</span>
            </div>

            <!-- 404 Message -->
            <header class="page-header cs-reveal">
                <h1 class="page-title"><?php esc_html_e('Oops! Page Not Found', 'cs-communication'); ?></h1>
                <p class="error-message">
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'cs-communication'); ?>
                </p>
            </header>

            <!-- Search Box -->
            <div class="error-404-search cs-reveal">
                <h2><?php esc_html_e('Try Searching', 'cs-communication'); ?></h2>
                <?php get_search_form(); ?>
            </div>

            <!-- Helpful Links -->
            <div class="error-404-links cs-reveal">
                <h3><?php esc_html_e('Or explore these sections:', 'cs-communication'); ?></h3>
                
                <div class="helpful-links-grid">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="helpful-link">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                        </svg>
                        <span><?php esc_html_e('Home Page', 'cs-communication'); ?></span>
                    </a>

                    <?php if (has_nav_menu('primary')) : ?>
                        <?php
                        $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
                        if ($menu_items && count($menu_items) > 0) :
                            $count = 0;
                            foreach ($menu_items as $item) :
                                if ($count >= 3) break;
                                if ($item->menu_item_parent == 0) :
                                    ?>
                                    <a href="<?php echo esc_url($item->url); ?>" class="helpful-link">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9 5v2h6.59L4 18.59 5.41 20 17 8.41V15h2V5z"/>
                                        </svg>
                                        <span><?php echo esc_html($item->title); ?></span>
                                    </a>
                                    <?php
                                    $count++;
                                endif;
                            endforeach;
                        endif;
                        ?>
                    <?php endif; ?>

                    <?php
                    // Portfolio link if exists
                    $portfolio_archive = get_post_type_archive_link('portfolio');
                    if ($portfolio_archive) :
                        ?>
                        <a href="<?php echo esc_url($portfolio_archive); ?>" class="helpful-link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 16H4V8h16v12z"/>
                            </svg>
                            <span><?php esc_html_e('Portfolio', 'cs-communication'); ?></span>
                        </a>
                    <?php endif; ?>

                    <?php
                    // Blog link
                    $blog_page = get_option('page_for_posts');
                    if ($blog_page) :
                        ?>
                        <a href="<?php echo esc_url(get_permalink($blog_page)); ?>" class="helpful-link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                            <span><?php esc_html_e('Blog', 'cs-communication'); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Recent Posts -->
            <?php
            $recent_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'ignore_sticky_posts' => true,
            ));

            if ($recent_posts->have_posts()) :
                ?>
                <div class="error-404-recent cs-reveal">
                    <h3><?php esc_html_e('Recent Blog Posts', 'cs-communication'); ?></h3>
                    <div class="recent-posts-grid">
                        <?php
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                            <article class="recent-post-item">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" class="recent-post-thumbnail">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="recent-post-content">
                                    <h4 class="recent-post-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h4>
                                    <span class="recent-post-date">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Back to Home Button -->
            <div class="error-404-cta cs-reveal">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="cs-btn cs-btn-primary cs-magnetic-btn">
                    <?php esc_html_e('Back to Homepage', 'cs-communication'); ?>
                </a>
            </div>

        </div>
    </div>

</main>

<?php
get_footer();