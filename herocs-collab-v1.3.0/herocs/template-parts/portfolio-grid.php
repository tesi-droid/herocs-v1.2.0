<?php
/**
 * Portfolio Grid Item Template Part
 *
 * @package HeroCS
 * @since 1.0.0
 */

$categories = get_the_terms(get_the_ID(), 'portfolio_category');
$category_class = '';
if ($categories && !is_wp_error($categories)) {
    $category_slugs = wp_list_pluck($categories, 'slug');
    $category_class = implode(' ', $category_slugs);
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item cs-stagger-item ' . $category_class); ?>>
    <a href="<?php the_permalink(); ?>" class="portfolio-link" aria-label="<?php echo esc_attr(sprintf(__('View %s', 'herocs'), get_the_title())); ?>">
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="portfolio-thumbnail">
                <?php the_post_thumbnail('cs-portfolio-thumb', array(
                    'alt' => get_the_title(),
                    'loading' => 'lazy'
                )); ?>
            </div>
        <?php else : ?>
            <div class="portfolio-thumbnail placeholder">
                <span class="placeholder-text"><?php esc_html_e('No Image', 'herocs'); ?></span>
            </div>
        <?php endif; ?>

        <div class="portfolio-content">
            <h3 class="portfolio-title"><?php the_title(); ?></h3>
            
            <?php if ($categories && !is_wp_error($categories)) : ?>
                <div class="portfolio-category">
                    <?php echo esc_html($categories[0]->name); ?>
                </div>
            <?php endif; ?>

            <?php if (has_excerpt()) : ?>
                <div class="portfolio-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                </div>
            <?php endif; ?>

            <span class="portfolio-link-text">
                <?php esc_html_e('View Project', 'herocs'); ?> →
            </span>
        </div>
    </a>
</article>