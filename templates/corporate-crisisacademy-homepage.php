<?php
/**
 * Template Name: Corporate Crisis Academy Homepage
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    $directory = get_stylesheet_directory() . '/template-parts/corporate-crisisacademy-homepage';

    $sections = [
        'hero',
        'trouble',
        'hearings',
        // 'wcu',
        'founder',
        'program',
        'simulation',
        'diff', 
        'testimonies',
        'thought',
        // 'cta',
        // 'upcoming-events',
        // 'news',
        // 'faq'
    ];

    foreach ($sections as $section => $condition) {
        if (is_int($section)) {
            $section = $condition;
            $condition = true;
        }

        if ($condition && file_exists("$directory/$section.php")) {
            include "$directory/$section.php";
        }
    }
    ?>
</main>

<?php get_footer();