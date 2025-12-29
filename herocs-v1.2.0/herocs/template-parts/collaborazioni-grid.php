<?php
/**
 * Template part for displaying collaborazioni grid
 *
 * @package CS_Communication
 * @since 1.0.0
 */

$collab_query = isset($args['query']) ? $args['query'] : null;

if (!$collab_query || !$collab_query->have_posts()) {
    return;
}
?>

<div class="collaborazioni-grid cs-stagger-group">
    <?php while ($collab_query->have_posts()) : $collab_query->the_post(); ?>
        <?php
        $logo = cs_get_collab_logo();
        $website = cs_get_collab_website();
        $anno = cs_get_collab_anno();
        $servizi = cs_get_collab_servizi();
        
        // Get tipologie for filtering
        $tipologie = get_the_terms(get_the_ID(), 'tipologia_cliente');
        $tipologie_slugs = array();
        if ($tipologie && !is_wp_error($tipologie)) {
            $tipologie_slugs = wp_list_pluck($tipologie, 'slug');
        }
        ?>
        
        <div class="collaborazione-item cs-stagger-item" data-categories="<?php echo esc_attr(implode(' ', $tipologie_slugs)); ?>">
            <div class="collaborazione-card">
                <!-- Logo/Image -->
                <div class="collaborazione-logo">
                    <?php if ($logo) : ?>
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                    <?php elseif (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('cs-portfolio-thumb', array('alt' => get_the_title())); ?>
                    <?php else : ?>
                        <div class="logo-placeholder">
                            <span class="placeholder-text"><?php echo esc_html(get_the_title()); ?></span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Content -->
                <div class="collaborazione-content">
                    <h3 class="collaborazione-title"><?php the_title(); ?></h3>
                    
                    <!-- Tipologie -->
                    <?php if ($tipologie && !is_wp_error($tipologie)) : ?>
                        <div class="collaborazione-tipologie">
                            <?php foreach ($tipologie as $tipologia) : ?>
                                <span class="tipologia-badge"><?php echo esc_html($tipologia->name); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Anno -->
                    <?php if ($anno) : ?>
                        <div class="collaborazione-anno">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                            </svg>
                            <?php echo esc_html($anno); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Servizi -->
                    <?php if ($servizi) : ?>
                        <div class="collaborazione-servizi">
                            <?php
                            $servizi_array = array_map('trim', explode(',', $servizi));
                            foreach ($servizi_array as $servizio) :
                                ?>
                                <span class="servizio-tag"><?php echo esc_html($servizio); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Excerpt -->
                    <?php if (has_excerpt()) : ?>
                        <div class="collaborazione-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Link -->
                    <div class="collaborazione-footer">
                        <?php if ($website) : ?>
                            <a href="<?php echo esc_url($website); ?>" 
                               class="website-link" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/>
                                </svg>
                                <?php esc_html_e('Sito web', 'cs-communication'); ?>
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?php the_permalink(); ?>" class="read-more-link">
                            <?php esc_html_e('Scopri di pià’Ã‚Â¹', 'cs-communication'); ?> ÃƒÂ¢Ã¢â‚¬Â Ã¢â‚¬â„¢
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>

<style>
/* Collaborazioni Grid Styles */
.collaborazioni-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: var(--cs-space-md);
    margin-top: var(--cs-space-md);
}

.collaborazione-item {
    opacity: 1;
    transition: opacity 0.3s ease;
}

.collaborazione-card {
    background: var(--cs-white);
    border-radius: var(--cs-radius-lg);
    overflow: hidden;
    box-shadow: var(--cs-shadow-md);
    transition: all var(--cs-transition);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.collaborazione-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--cs-shadow-lg);
}

.collaborazione-logo {
    position: relative;
    width: 100%;
    height: 200px;
    background: var(--cs-light);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--cs-space-md);
}

.collaborazione-logo img {
    max-width: 80%;
    max-height: 80%;
    object-fit: contain;
}

.logo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--cs-primary), var(--cs-secondary));
}

.placeholder-text {
    font-size: var(--cs-text-xl);
    font-weight: 800;
    color: white;
    text-align: center;
    padding: var(--cs-space-sm);
}

.collaborazione-content {
    padding: var(--cs-space-md);
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.collaborazione-title {
    font-size: var(--cs-text-lg);
    margin-bottom: var(--cs-space-sm);
    color: var(--cs-dark);
}

.collaborazione-tipologie {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: var(--cs-space-sm);
}

.tipologia-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: var(--cs-primary);
    color: white;
    font-size: var(--cs-text-xs);
    font-weight: 600;
    border-radius: var(--cs-radius-sm);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.collaborazione-anno {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: var(--cs-text-sm);
    color: var(--cs-gray);
    margin-bottom: var(--cs-space-sm);
}

.collaborazione-anno svg {
    flex-shrink: 0;
}

.collaborazione-servizi {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: var(--cs-space-sm);
}

.servizio-tag {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    background: var(--cs-light);
    color: var(--cs-dark);
    font-size: var(--cs-text-xs);
    border-radius: var(--cs-radius-sm);
}

.collaborazione-excerpt {
    font-size: var(--cs-text-sm);
    color: var(--cs-gray);
    line-height: 1.6;
    margin-bottom: var(--cs-space-sm);
    flex-grow: 1;
}

.collaborazione-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-top: auto;
    padding-top: var(--cs-space-sm);
    border-top: 1px solid var(--cs-light);
}

.website-link,
.read-more-link {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    font-size: var(--cs-text-sm);
    font-weight: 600;
    color: var(--cs-primary);
    text-decoration: none;
    transition: gap var(--cs-transition);
}

.website-link:hover,
.read-more-link:hover {
    gap: 0.5rem;
}

@media (max-width: 768px) {
    .collaborazioni-grid {
        grid-template-columns: 1fr;
    }
    
    .collaborazione-footer {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>