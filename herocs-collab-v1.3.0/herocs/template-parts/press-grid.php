<?php
/**
 * Template part for displaying press grid
 *
 * @package HeroCS
 * @since 1.0.0
 */

$press_query = isset($args['query']) ? $args['query'] : null;

if (!$press_query || !$press_query->have_posts()) {
    return;
}
?>

<div class="press-grid cs-stagger-group">
    <?php while ($press_query->have_posts()) : $press_query->the_post(); ?>
        <?php
        $testata = cs_get_press_testata();
        $autore = get_post_meta(get_the_ID(), '_cs_press_autore', true);
        $data = cs_get_press_data();
        $link = cs_get_press_link();
        $pdf = cs_get_press_pdf();
        $tipo = cs_get_press_tipo();
        ?>
        
        <article class="press-item cs-stagger-item">
            <div class="press-card">
                <!-- Thumbnail -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="press-thumbnail">
                        <a href="<?php echo $link ? esc_url($link) : get_permalink(); ?>" target="_blank" rel="noopener">
                            <?php the_post_thumbnail('cs-press-thumb'); ?>
                        </a>
                        <?php if ($tipo) : ?>
                            <span class="press-type-badge"><?php echo esc_html(ucfirst($tipo)); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Content -->
                <div class="press-content">
                    <!-- Testata -->
                    <?php if ($testata) : ?>
                        <div class="press-testata">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                            </svg>
                            <?php echo esc_html($testata); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Title -->
                    <h3 class="press-title">
                        <a href="<?php echo $link ? esc_url($link) : get_permalink(); ?>" target="_blank" rel="noopener">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <!-- Meta Info -->
                    <div class="press-meta">
                        <?php if ($data) : ?>
                            <span class="press-date">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                                </svg>
                                <?php echo esc_html(date_i18n(get_option('date_format'), strtotime($data))); ?>
                            </span>
                        <?php endif; ?>

                        <?php if ($autore) : ?>
                            <span class="press-author">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                <?php echo esc_html($autore); ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Excerpt -->
                    <?php if (has_excerpt()) : ?>
                        <div class="press-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Actions -->
                    <div class="press-actions">
                        <?php if ($link) : ?>
                            <a href="<?php echo esc_url($link); ?>" class="press-link" target="_blank" rel="noopener">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z"/>
                                </svg>
                                <?php esc_html_e('Leggi online', 'herocs'); ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($pdf) : ?>
                            <a href="<?php echo esc_url($pdf); ?>" class="press-pdf" target="_blank" rel="noopener">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/>
                                </svg>
                                <?php esc_html_e('Scarica PDF', 'herocs'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>

<style>
/* Press Grid Styles */
.press-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: var(--cs-space-md);
    margin-top: var(--cs-space-md);
}

.press-card {
    background: var(--cs-white);
    border-radius: var(--cs-radius-lg);
    overflow: hidden;
    box-shadow: var(--cs-shadow-md);
    transition: all var(--cs-transition);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.press-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--cs-shadow-lg);
}

.press-thumbnail {
    position: relative;
    width: 100%;
    height: 220px;
    overflow: hidden;
    background: var(--cs-light);
}

.press-thumbnail a {
    display: block;
    width: 100%;
    height: 100%;
}

.press-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--cs-transition);
}

.press-card:hover .press-thumbnail img {
    transform: scale(1.05);
}

.press-type-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--cs-primary);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: var(--cs-radius-sm);
    font-size: var(--cs-text-xs);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.press-content {
    padding: var(--cs-space-md);
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.press-testata {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: var(--cs-text-sm);
    color: var(--cs-primary);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: var(--cs-space-sm);
}

.press-testata svg {
    flex-shrink: 0;
}

.press-title {
    font-size: var(--cs-text-lg);
    margin-bottom: var(--cs-space-sm);
    line-height: 1.3;
}

.press-title a {
    color: var(--cs-dark);
    text-decoration: none;
}

.press-title a:hover {
    color: var(--cs-primary);
}

.press-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: var(--cs-text-xs);
    color: var(--cs-gray);
    margin-bottom: var(--cs-space-sm);
}

.press-date,
.press-author {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.press-date svg,
.press-author svg {
    flex-shrink: 0;
}

.press-excerpt {
    font-size: var(--cs-text-sm);
    color: var(--cs-gray);
    line-height: 1.6;
    margin-bottom: var(--cs-space-sm);
    flex-grow: 1;
}

.press-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: auto;
    padding-top: var(--cs-space-sm);
    border-top: 1px solid var(--cs-light);
}

.press-link,
.press-pdf {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: var(--cs-text-sm);
    font-weight: 600;
    color: var(--cs-primary);
    text-decoration: none;
    transition: all var(--cs-transition);
}

.press-link:hover,
.press-pdf:hover {
    color: var(--cs-secondary);
    gap: 0.75rem;
}

.press-link svg,
.press-pdf svg {
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .press-grid {
        grid-template-columns: 1fr;
    }
}
</style>