<?php
/**
 * Single Post Template
 *
 * @package HeroCS
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        
        // Increment post views
        cs_set_post_views();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
            
            <div class="cs-container">
                <!-- Breadcrumbs -->
                <?php cs_breadcrumbs(); ?>

                <div class="post-layout <?php echo get_theme_mod('cs_sidebar_position', 'right') !== 'none' ? 'has-sidebar sidebar-' . get_theme_mod('cs_sidebar_position', 'right') : 'no-sidebar'; ?>">
                    
                    <div class="post-content-wrapper">
                        <!-- Post Header -->
                        <header class="entry-header">
                            <?php
                            // Categories
                            $categories = get_the_category();
                            if ($categories) :
                                ?>
                                <div class="post-categories">
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-badge">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <h1 class="entry-title"><?php the_title(); ?></h1>

                            <div class="entry-meta">
                                <?php if (get_theme_mod('cs_show_author', true)) : ?>
                                    <span class="meta-author">
                                        <svg class="meta-icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                            <path d="M8 8a3 3 0 100-6 3 3 0 000 6zm2 3H6c-2.21 0-4 1.79-4 4v1h12v-1c0-2.21-1.79-4-4-4z"/>
                                        </svg>
                                        <span class="author vcard">
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="url fn">
                                                <?php echo esc_html(get_the_author()); ?>
                                            </a>
                                        </span>
                                    </span>
                                <?php endif; ?>

                                <?php if (get_theme_mod('cs_show_date', true)) : ?>
                                    <span class="meta-date">
                                        <svg class="meta-icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                            <path d="M4 2V0h2v2h4V0h2v2h2a2 2 0 012 2v10a2 2 0 01-2 2H2a2 2 0 01-2-2V4a2 2 0 012-2h2zM2 6v8h12V6H2z"/>
                                        </svg>
                                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                            <?php echo esc_html(get_the_date()); ?>
                                        </time>
                                    </span>
                                <?php endif; ?>

                                <span class="meta-reading-time">
                                    <svg class="meta-icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                        <path d="M8 0a8 8 0 110 16A8 8 0 018 0zm0 2a6 6 0 100 12A6 6 0 008 2zm1 3v4l3 1.5-.5 1-3.5-2V5h1z"/>
                                    </svg>
                                    <?php echo cs_reading_time(); ?>
                                </span>

                                <span class="meta-views">
                                    <svg class="meta-icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                        <path d="M8 2C4.5 2 1.5 4.5 0 8c1.5 3.5 4.5 6 8 6s6.5-2.5 8-6c-1.5-3.5-4.5-6-8-6zm0 10c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                    <?php echo esc_html(cs_get_post_views()); ?> <?php esc_html_e('views', 'herocs'); ?>
                                </span>
                            </div>
                        </header>

                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large', array('loading' => 'eager')); ?>
                                <?php if (get_the_post_thumbnail_caption()) : ?>
                                    <figcaption class="wp-caption-text">
                                        <?php echo get_the_post_thumbnail_caption(); ?>
                                    </figcaption>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Post Content -->
                        <div class="entry-content cs-content-wrapper">
                            <?php
                            the_content(sprintf(
                                wp_kses(
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'herocs'),
                                    array('span' => array('class' => array()))
                                ),
                                get_the_title()
                            ));

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'herocs'),
                                'after' => '</div>',
                            ));
                            ?>
                        </div>

                        <!-- Post Footer -->
                        <footer class="entry-footer">
                            <?php
                            // Tags
                            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'herocs'));
                            if ($tags_list) :
                                ?>
                                <div class="post-tags">
                                    <span class="tags-label">
                                        <svg class="tags-icon" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                                            <path d="M2 2v4.586L8.293 13.293a1 1 0 001.414 0l4.586-4.586a1 1 0 000-1.414L7.586 2H2zm2 2h2v2H4V4z"/>
                                        </svg>
                                        <?php esc_html_e('Tags:', 'herocs'); ?>
                                    </span>
                                    <?php echo $tags_list; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Share Buttons -->
                            <div class="post-share">
                                <span class="share-label"><?php esc_html_e('Share:', 'herocs'); ?></span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="share-btn share-facebook"
                                   aria-label="<?php esc_attr_e('Share on Facebook', 'herocs'); ?>">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="share-btn share-twitter"
                                   aria-label="<?php esc_attr_e('Share on Twitter', 'herocs'); ?>">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="share-btn share-linkedin"
                                   aria-label="<?php esc_attr_e('Share on LinkedIn', 'herocs'); ?>">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        </footer>

                        <!-- Author Bio -->
                        <?php if (get_the_author_meta('description')) : ?>
                            <div class="author-bio cs-reveal">
                                <div class="author-avatar">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                                </div>
                                <div class="author-info">
                                    <h3 class="author-name">
                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                            <?php echo esc_html(get_the_author()); ?>
                                        </a>
                                    </h3>
                                    <p class="author-description"><?php echo wp_kses_post(get_the_author_meta('description')); ?></p>
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="author-posts-link">
                                        <?php esc_html_e('View all posts', 'herocs'); ?> →
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Post Navigation -->
                        <nav class="post-navigation" aria-label="<?php esc_attr_e('Post navigation', 'herocs'); ?>">
                            <div class="nav-links">
                                <?php
                                $prev_post = get_previous_post();
                                $next_post = get_next_post();
                                
                                if ($prev_post) :
                                    ?>
                                    <div class="nav-previous">
                                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" rel="prev">
                                            <span class="nav-subtitle">← <?php esc_html_e('Previous', 'herocs'); ?></span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($next_post) : ?>
                                    <div class="nav-next">
                                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" rel="next">
                                            <span class="nav-subtitle"><?php esc_html_e('Next', 'herocs'); ?> →</span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </nav>

                        <!-- Comments -->
                        <?php
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </div>

                    <!-- Sidebar -->
                    <?php if (get_theme_mod('cs_sidebar_position', 'right') !== 'none' && is_active_sidebar('sidebar-1')) : ?>
                        <aside id="secondary" class="widget-area" role="complementary">
                            <?php dynamic_sidebar('sidebar-1'); ?>
                        </aside>
                    <?php endif; ?>

                </div>
            </div>

        </article>

    <?php endwhile; ?>
</main>

<?php
get_footer();