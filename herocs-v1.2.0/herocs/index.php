<?php
/**
 * The main template file
 * Fallback template
 */
get_header();
?>

<main id="primary" class="site-main">
    <div class="cs-container">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;
            cs_pagination();
        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>