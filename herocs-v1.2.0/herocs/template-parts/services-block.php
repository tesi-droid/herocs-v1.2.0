<?php
/**
 * Services Block Template Part
 *
 * @package CS_Communication
 * @since 1.0.0
 */

$services_title = get_theme_mod('cs_services_title', __('Our Services', 'cs-communication'));
$services_subtitle = get_theme_mod('cs_services_subtitle', __('Comprehensive communication solutions tailored to your needs', 'cs-communication'));
?>

<section class="cs-services-section cs-reveal">
    <div class="cs-container">
        <div class="section-header text-center">
            <h2><?php echo esc_html($services_title); ?></h2>
            <p class="section-description"><?php echo esc_html($services_subtitle); ?></p>
        </div>

        <div class="services-grid cs-stagger-group">
            <?php
            // Get services from customizer or default services
            $services = array(
                array(
                    'icon' => 'ÃƒÂ°Ã…Â¸Ã…Â½Ã‚Â¨',
                    'title' => get_theme_mod('cs_service_1_title', __('Branding & Identity', 'cs-communication')),
                    'description' => get_theme_mod('cs_service_1_description', __('Create a memorable brand that resonates with your audience', 'cs-communication')),
                    'link' => get_theme_mod('cs_service_1_link', '#'),
                ),
                array(
                    'icon' => 'ÃƒÂ°Ã…Â¸Ã¢â‚¬Å“Ã‚Â±',
                    'title' => get_theme_mod('cs_service_2_title', __('Social Media Marketing', 'cs-communication')),
                    'description' => get_theme_mod('cs_service_2_description', __('Engage your audience across all social platforms', 'cs-communication')),
                    'link' => get_theme_mod('cs_service_2_link', '#'),
                ),
                array(
                    'icon' => 'ÃƒÂ°Ã…Â¸Ã¢â‚¬â„¢Ã‚Â»',
                    'title' => get_theme_mod('cs_service_3_title', __('Web Design & Development', 'cs-communication')),
                    'description' => get_theme_mod('cs_service_3_description', __('Build stunning websites that convert visitors into customers', 'cs-communication')),
                    'link' => get_theme_mod('cs_service_3_link', '#'),
                ),
                array(
                    'icon' => 'ÃƒÂ°Ã…Â¸Ã¢â‚¬Å“Ã‚Â¢',
                    'title' => get_theme_mod('cs_service_4_title', __('Advertising Campaigns', 'cs-communication')),
                    'description' => get_theme_mod('cs_service_4_description', __('Strategic campaigns that drive results and ROI', 'cs-communication')),
                    'link' => get_theme_mod('cs_service_4_link', '#'),
                ),
                array(
                    'icon' => 'ÃƒÂ¢Ã…â€œÃ‚ÂÃƒÂ¯Ã‚Â¸Ã‚Â',
                    'title' => get_theme_mod('cs_service_5_title', __('Content Creation', 'cs-communication')),
                    'description' => get_theme_mod('cs_service_5_description', __('Compelling content that tells your story', 'cs-communication')),
                    'link' => get_theme_mod('cs_service_5_link', '#'),
                ),
                array(
                    'icon' => 'ÃƒÂ°Ã…Â¸Ã¢â‚¬Å“Ã…Â ',
                    'title' => get_theme_mod('cs_service_6_title', __('Analytics & Strategy', 'cs-communication')),
                    'description' => get_theme_mod('cs_service_6_description', __('Data-driven insights to optimize your communication', 'cs-communication')),
                    'link' => get_theme_mod('cs_service_6_link', '#'),
                ),
            );

            foreach ($services as $service) :
                if (empty($service['title'])) continue;
                ?>
                <div class="service-item cs-stagger-item cs-tilt-card">
                    <div class="service-icon" aria-hidden="true">
                        <?php echo $service['icon']; ?>
                    </div>
                    <h3 class="service-title"><?php echo esc_html($service['title']); ?></h3>
                    <p class="service-description"><?php echo esc_html($service['description']); ?></p>
                    <?php if ($service['link'] && $service['link'] !== '#') : ?>
                        <a href="<?php echo esc_url($service['link']); ?>" class="service-link">
                            <?php esc_html_e('Learn More', 'cs-communication'); ?> ÃƒÂ¢Ã¢â‚¬Â Ã¢â‚¬â„¢
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
        $services_cta_text = get_theme_mod('cs_services_cta_text');
        $services_cta_url = get_theme_mod('cs_services_cta_url');
        if ($services_cta_text && $services_cta_url) :
            ?>
            <div class="services-cta text-center mt-lg cs-reveal">
                <a href="<?php echo esc_url($services_cta_url); ?>" class="cs-btn cs-btn-primary">
                    <?php echo esc_html($services_cta_text); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
/* Services Section Styles */
.cs-services-section {
    background: var(--cs-white);
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--cs-space-md);
    margin-top: var(--cs-space-md);
}

.service-item {
    padding: var(--cs-space-md);
    background: var(--cs-light);
    border-radius: var(--cs-radius-lg);
    transition: all var(--cs-transition);
    border: 2px solid transparent;
}

.service-item:hover {
    transform: translateY(-5px);
    box-shadow: var(--cs-shadow-lg);
    border-color: var(--cs-primary);
}

.service-icon {
    font-size: 3rem;
    margin-bottom: var(--cs-space-sm);
    display: inline-block;
}

.service-title {
    font-size: var(--cs-text-lg);
    margin-bottom: var(--cs-space-sm);
    color: var(--cs-dark);
}

.service-description {
    color: var(--cs-gray);
    margin-bottom: var(--cs-space-sm);
    line-height: 1.6;
}

.service-link {
    color: var(--cs-primary);
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    transition: gap var(--cs-transition);
}

.service-link:hover {
    gap: 0.5rem;
    text-decoration: none;
}

@media (max-width: 768px) {
    .services-grid {
        grid-template-columns: 1fr;
    }
}
</style>