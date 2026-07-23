<?php
/**
 * Template Name: Formulario Biografía del Experto
 * Description: Formulario interactivo para la recolección de datos de miembros del equipo y envío por correo a biography@thecrisisacademy.com.
 * Theme: The Crisis Academy
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    $form_dir = get_stylesheet_directory() . '/template-parts/form-biography';

    $sections = [
        'hero',
        'form-handler',
        'form-fields',
    ];

    foreach ($sections as $section) {
        $file_path = "$form_dir/$section.php";
        if (file_exists($file_path)) {
            include $file_path;
        }
    }
    ?>
</main>

<?php get_footer(); ?>
