<?php
/**
 * Template part for displaying team grid
 * Card cliccabili con hover overlay viola
 *
 * @package HeroCS
 * @since 1.1.0
 */

$team_query = isset($args['query']) ? $args['query'] : null;

// Se non c'e una query passata, creane una di default
if (!$team_query) {
    $team_query = new WP_Query(array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ));
}

if (!$team_query->have_posts()) {
    return;
}

// Numero colonne (default 3, o passato come arg)
$columns = isset($args['columns']) ? intval($args['columns']) : 3;
?>

<div class="team-grid team-grid-cols-<?php echo esc_attr($columns); ?>">
    <?php while ($team_query->have_posts()) : $team_query->the_post(); 
        $position = get_post_meta(get_the_ID(), '_cs_team_position', true);
        $bio = get_post_meta(get_the_ID(), '_cs_team_bio', true);
        $email = get_post_meta(get_the_ID(), '_cs_team_email', true);
        $linkedin = get_post_meta(get_the_ID(), '_cs_team_linkedin', true);
        $twitter = get_post_meta(get_the_ID(), '_cs_team_twitter', true);
        
        $permalink = get_permalink();
    ?>
        
        <article class="team-card">
            <!-- Card cliccabile -->
            <a href="<?php echo esc_url($permalink); ?>" class="team-card-link" aria-label="Vai al profilo di <?php echo esc_attr(get_the_title()); ?>">
                
                <!-- Foto -->
                <div class="team-card-photo">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium_large', array(
                            'alt' => get_the_title(),
                            'class' => 'team-photo-img'
                        )); ?>
                    <?php else : ?>
                        <div class="team-photo-placeholder">
                            <span class="placeholder-initial">
                                <?php echo esc_html(mb_substr(get_the_title(), 0, 1)); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Overlay hover -->
                    <div class="team-card-overlay">
                        <span class="overlay-text">Scopri il profilo</span>
                        <svg class="overlay-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </div>
                
                <!-- Info -->
                <div class="team-card-info">
                    <h3 class="team-card-name"><?php the_title(); ?></h3>
                    
                    <?php if ($position) : ?>
                        <p class="team-card-position"><?php echo esc_html($position); ?></p>
                    <?php endif; ?>
                </div>
                
            </a>
            
            <!-- Social Links (fuori dal link principale) -->
            <?php if ($email || $linkedin || $twitter) : ?>
                <div class="team-card-social">
                    <?php if ($email) : ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>" 
                           class="social-icon" 
                           aria-label="Email <?php echo esc_attr(get_the_title()); ?>"
                           onclick="event.stopPropagation();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if ($linkedin) : ?>
                        <a href="<?php echo esc_url($linkedin); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="social-icon"
                           aria-label="LinkedIn <?php echo esc_attr(get_the_title()); ?>"
                           onclick="event.stopPropagation();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <?php if ($twitter) : ?>
                        <a href="<?php echo esc_url($twitter); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="social-icon"
                           aria-label="Twitter/X <?php echo esc_attr(get_the_title()); ?>"
                           onclick="event.stopPropagation();">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        </article>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
</div>

<style>
/* ========================================================================== */
/* TEAM GRID - Card Cliccabili */
/* ========================================================================== */

.team-grid {
    display: grid;
    gap: 30px;
    margin-top: 40px;
}

/* Colonne responsive */
.team-grid-cols-3 {
    grid-template-columns: repeat(3, 1fr);
}

.team-grid-cols-4 {
    grid-template-columns: repeat(4, 1fr);
}

/* Card */
.team-card {
    position: relative;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.team-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
}

/* Link wrapper */
.team-card-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

/* Foto */
.team-card-photo {
    position: relative;
    width: 100%;
    aspect-ratio: 1;
    overflow: hidden;
    background: #f1f5f9;
}

.team-photo-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.team-card:hover .team-photo-img {
    transform: scale(1.08);
}

/* Placeholder */
.team-photo-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.placeholder-initial {
    font-size: 5rem;
    font-weight: 700;
    color: white;
    font-family: 'Poppins', sans-serif;
}

/* Overlay hover */
.team-card-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(124, 58, 237, 0.85) 0%,
        rgba(236, 72, 153, 0.85) 50%,
        rgba(59, 130, 246, 0.85) 100%
    );
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    opacity: 0;
    transition: opacity 0.4s ease;
}

.team-card:hover .team-card-overlay {
    opacity: 1;
}

.overlay-text {
    color: white;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
}

.overlay-arrow {
    color: white;
    animation: bounceRight 1s ease-in-out infinite;
}

@keyframes bounceRight {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(5px);
    }
}

/* Info */
.team-card-info {
    padding: 24px;
    text-align: center;
}

.team-card-name {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 6px 0;
    transition: color 0.3s;
}

.team-card:hover .team-card-name {
    color: #7c3aed;
}

.team-card-position {
    font-size: 0.875rem;
    font-weight: 600;
    color: #7c3aed;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin: 0;
}

/* Social Icons */
.team-card-social {
    display: flex;
    justify-content: center;
    gap: 10px;
    padding: 0 24px 24px;
    margin-top: -8px;
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: #f1f5f9;
    border-radius: 50%;
    color: #64748b;
    transition: all 0.3s;
}

.social-icon:hover {
    background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
    color: white;
    transform: translateY(-3px);
}

/* ========================================================================== */
/* RESPONSIVE */
/* ========================================================================== */

@media (max-width: 1024px) {
    .team-grid-cols-4 {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .team-grid-cols-3,
    .team-grid-cols-4 {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .team-card-info {
        padding: 20px;
    }
    
    .team-card-name {
        font-size: 1.1rem;
    }
    
    .team-card-position {
        font-size: 0.8rem;
    }
    
    .placeholder-initial {
        font-size: 3.5rem;
    }
}

@media (max-width: 480px) {
    .team-grid-cols-3,
    .team-grid-cols-4 {
        grid-template-columns: 1fr;
        max-width: 350px;
        margin-left: auto;
        margin-right: auto;
    }
}

/* ========================================================================== */
/* DARK MODE */
/* ========================================================================== */

body.dark-mode .team-card {
    background: #1e293b;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

body.dark-mode .team-card:hover {
    box-shadow: 0 20px 40px rgba(167, 139, 250, 0.2);
}

body.dark-mode .team-card-photo {
    background: #334155;
}

body.dark-mode .team-card-name {
    color: #f1f5f9;
}

body.dark-mode .team-card:hover .team-card-name {
    color: #a78bfa;
}

body.dark-mode .team-card-position {
    color: #a78bfa;
}

body.dark-mode .social-icon {
    background: #334155;
    color: #94a3b8;
}

body.dark-mode .social-icon:hover {
    background: linear-gradient(135deg, #a78bfa 0%, #f472b6 100%);
    color: white;
}
</style>
