<?php
/**
 * Template part for displaying search results
 *
 * @package CS_Communication
 * @since 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
    
    <div class="search-result-content">
        <!-- Post Type Badge -->
        <div class="result-type">
            <?php
            $post_type = get_post_type();
            $post_type_obj = get_post_type_object($post_type);
            echo esc_html($post_type_obj->labels->singular_name);
            ?>
        </div>

        <!-- Title -->
        <h3 class="result-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title(); ?>
            </a>
        </h3>

        <!-- Meta -->
        <div class="result-meta">
            <?php if (get_post_type() === 'post') : ?>
                <span class="result-date">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                        <?php echo esc_html(get_the_date()); ?>
                    </time>
                </span>
                <span class="result-author">
                    <?php
                    printf(
                        esc_html__('by %s', 'cs-communication'),
                        '<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
                    );
                    ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Excerpt -->
        <div class="result-excerpt">
            <?php
            if (has_excerpt()) {
                the_excerpt();
            } else {
                echo wp_trim_words(get_the_content(), 30);
            }
            ?>
        </div>

        <!-- Categories (if available) -->
        <?php if (get_post_type() === 'post') : ?>
            <?php
            $categories = get_the_category();
            if ($categories) :
                ?>
                <div class="result-categories">
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-tag">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Read More Link -->
        <div class="result-footer">
            <a href="<?php the_permalink(); ?>" class="read-more-link">
                <?php esc_html_e('View Result', 'cs-communication'); ?> ÃƒÂ¢Ã¢â‚¬Â Ã¢â‚¬â„¢
            </a>
        </div>
    </div>

</article>

<style>
/* Search Result Styles */
.search-result-item {
    padding: var(--cs-space-md);
    background: var(--cs-white);
    border: 1px solid var(--cs-light);
    border-radius: var(--cs-radius-lg);
    margin-bottom: var(--cs-space-md);
    transition: all 0.3s ease;
}

.search-result-item:hover {
    box-shadow: var(--cs-shadow-md);
    border-color: var(--cs-primary);
}

.search-result-content {
    display: flex;
    flex-direction: column;
}

.result-type {
    display: inline-block;
    font-size: var(--cs-text-xs);
    color: var(--cs-primary);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
    width: fit-content;
}

.result-title {
    font-size: var(--cs-text-lg);
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.result-title a {
    color: var(--cs-dark);
    text-decoration: none;
}

.result-title a:hover {
    color: var(--cs-primary);
    text-decoration: underline;
}

.result-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: var(--cs-text-sm);
    color: var(--cs-gray);
    margin-bottom: var(--cs-space-sm);
}

.result-date,
.result-author {
    display: flex;
    align-items: center;
}

.result-author a {
    color: var(--cs-primary);
    font-weight: 600;
}

.result-excerpt {
    font-size: var(--cs-text-base);
    color: var(--cs-gray);
    line-height: 1.6;
    margin-bottom: var(--cs-space-sm);
    flex-grow: 1;
}

.result-excerpt p {
    margin: 0;
}

.result-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: var(--cs-space-sm);
}

.category-tag {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: var(--cs-light);
    color: var(--cs-dark);
    font-size: var(--cs-text-xs);
    border-radius: var(--cs-radius-sm);
    text-decoration: none;
    transition: all 0.3s;
}

.category-tag:hover {
    background: var(--cs-primary);
    color: white;
}

.result-footer {
    display: flex;
    align-items: center;
    margin-top: auto;
    padding-top: var(--cs-space-sm);
    border-top: 1px solid var(--cs-light);
}

.read-more-link {
    color: var(--cs-primary);
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    transition: gap 0.3s;
}

.read-more-link:hover {
    gap: 0.5rem;
    text-decoration: none;
}

@media (max-width: 768px) {
    .search-result-item {
        padding: var(--cs-space-sm);
    }

    .result-title {
        font-size: var(--cs-text-base);
    }

    .result-meta {
        gap: 0.5rem;
        font-size: var(--cs-text-xs);
    }
}
</style>