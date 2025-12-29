<?php
/**
 * Template part for displaying posts
 *
 * @package HeroCS
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-item cs-stagger-item'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(sprintf(__('Read %s', 'herocs'), get_the_title())); ?>">
                <?php the_post_thumbnail('medium_large', array('loading' => 'lazy')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="post-content">
        <!-- Categories -->
        <?php if (get_theme_mod('cs_show_categories', true)) : ?>
            <?php
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
        <?php endif; ?>

        <!-- Title -->
        <h2 class="entry-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h2>

        <!-- Meta -->
        <div class="entry-meta">
            <?php if (get_theme_mod('cs_show_author', true)) : ?>
                <span class="meta-author">
                    <?php
                    printf(
                        '<a href="%s">%s</a>',
                        esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                        esc_html(get_the_author())
                    );
                    ?>
                </span>
            <?php endif; ?>

            <?php if (get_theme_mod('cs_show_date', true)) : ?>
                <span class="meta-date">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                </span>
            <?php endif; ?>

            <span class="meta-reading-time">
                <?php echo cs_reading_time(); ?>
            </span>
        </div>

        <!-- Excerpt -->
        <div class="entry-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <!-- Read More -->
        <div class="entry-footer">
            <a href="<?php the_permalink(); ?>" class="read-more-link">
                <?php esc_html_e('Read More', 'herocs'); ?> →
            </a>
        </div>
    </div>

</article>