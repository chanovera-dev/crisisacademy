<?php
/**
 * Template Name: Equipo de Expertos
 * Description: Plantilla para mostrar el claustro directivo y equipo de expertos de The Crisis Academy.
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    $team_dir = get_stylesheet_directory() . '/template-parts/team';

    $sections = [
        'hero',
        'spotlight-founder',
        'grid',
        'methodology',
        'cta',
        'drawer-bio'
    ];

    foreach ($sections as $section) {
        $file_path = "$team_dir/$section.php";
        if (file_exists($file_path)) {
            include $file_path;
        }
    }
    ?>
</main>

<?php get_footer(); ?>
