<?php
/**
 * Template Name: Contacto de Alta Crisis
 * Description: Plantilla para la página de contacto de alta prioridad, soporte ejecutivo 24/7 e intake confidencial de The Crisis Academy.
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    $contact_dir = get_stylesheet_directory() . '/template-parts/contact';

    $sections = [
        'hero',
        'form',
        'channels',
        'faq',
        'cta'
    ];

    foreach ($sections as $section) {
        $file_path = "$contact_dir/$section.php";
        if (file_exists($file_path)) {
            include $file_path;
        }
    }
    ?>
</main>

<?php get_footer(); ?>
