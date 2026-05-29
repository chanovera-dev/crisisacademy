<?php
// Prevent direct access to this file for security reasons.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue child theme styles.
 */
function thecrisisacademy_enqueue_styles() {
    // Enqueue child theme style.css depending on the parent theme's 'global' stylesheet
    wp_enqueue_style(
        'thecrisisacademy-style',
        get_stylesheet_uri(),
        array('global'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'thecrisisacademy_enqueue_styles', 20);

function crisisacademy_homepage_templates() {
    if (is_page_template('templates/crisisacademy-homepage.php')) {
        $a = avante_get_assets();

        function unload_parts_header() {
            wp_dequeue_style( 'page' );
        }
        add_action( 'wp_enqueue_scripts', 'unload_parts_header', 100 );

        avante_enqueue_style('crisisacademy-homepage', $a['css']['crisisacademy-homepage']);
        avante_enqueue_style('crisisacademy-hero', $a['css']['crisisacademy-hero']);
        avante_enqueue_style('crisisacademy-trust-bar', $a['css']['crisisacademy-trust-bar']);
        avante_enqueue_style('crisisacademy-about', $a['css']['crisisacademy-about']);
        avante_enqueue_style('crisisacademy-signals', $a['css']['crisisacademy-signals']);
        avante_enqueue_style('crisisacademy-how-works', $a['css']['crisisacademy-how-works']);
        avante_enqueue_style('crisisacademy-certification', $a['css']['crisisacademy-certification']);
        avante_enqueue_style('crisisacademy-crisis-simulator', $a['css']['crisisacademy-crisis-simulator']);
        avante_enqueue_style('crisisacademy-cta', $a['css']['crisisacademy-cta']);
        avante_enqueue_style('crisisacademy-upcoming-events', $a['css']['crisisacademy-upcoming-events']);
        avante_enqueue_style('crisisacademy-news', $a['css']['crisisacademy-news']);
        avante_enqueue_style('posts-styles', $a['css']['posts-styles']);
        avante_enqueue_style('archive-design', $a['css']['archive-design']);
        avante_enqueue_style('crisisacademy-faq', $a['css']['crisisacademy-faq']);

        // Crisis academy scripts
        avante_enqueue_script('sticky-overlap-efect-script', $a['js']['sticky-overlap-efect-script']);
        avante_enqueue_script('card-glow-efect-script', $a['js']['card-glow-efect-script']);
        avante_enqueue_script('faq-accordion-toggle-script', $a['js']['faq-accordion-toggle-script']);
        avante_enqueue_script('crisisacademy-homepage-script', $a['js']['crisisacademy-homepage-script']);
        avante_enqueue_script('crisisacademy-hero-script', $a['js']['crisisacademy-hero-script']);
        avante_enqueue_script('three', $a['js']['three']);
        avante_enqueue_script('webgl-slideshow-script', $a['js']['webgl-slideshow-script']);
        avante_enqueue_script('crisisacademy-how-works-script', $a['js']['crisisacademy-how-works-script']);
        avante_enqueue_script('cert-slideshow-script', $a['js']['cert-slideshow-script']);
        avante_enqueue_script('quotes-slideshow-script', $a['js']['quotes-slideshow-script']);
        avante_enqueue_script('animate-in', $a['js']['animate-in']);
        avante_enqueue_script('posts-scripts', $a['js']['posts-scripts']);
        avante_enqueue_script('counter', $a['js']['counter']);
        avante_enqueue_script('ws-script', $a['js']['ws-script']);

        // Añadir atributo defer a scripts pesados y secundarios para evitar bloqueo de renderizado
        add_filter('script_loader_tag', function($tag, $handle, $src) {
            $defer_scripts = [
                'three',
                'webgl-slideshow-script',
                'quotes-slideshow-script',
                'cert-slideshow-script',
                'counter',
                'crisisacademy-how-works-script',
                'posts-scripts',
                'ws-script'
            ];
            if (in_array($handle, $defer_scripts)) {
                if (false === strpos($tag, 'defer')) {
                    $tag = str_replace(' src=', ' defer src=', $tag);
                }
            }
            return $tag;
        }, 10, 3);
    }
}
add_action( 'wp_enqueue_scripts', 'crisisacademy_homepage_templates' );

function crisis_academy_contact_templates() {
    if (is_page_template('templates/crisis-academy-contact.php')) {
        $a = avante_get_assets();

        function unload_parts_header() {
            wp_dequeue_style( 'page' );
        }
        add_action( 'wp_enqueue_scripts', 'unload_parts_header', 100 );

        avante_enqueue_style('crisis-academy-contact', $a['css']['crisis-academy-contact']);
        avante_enqueue_script('gsap', $a['js']['gsap']);
        avante_enqueue_script('scrolltrigger', $a['js']['scrolltrigger'], ['gsap']);
        avante_enqueue_script('parallax-script', $a['js']['parallax-script'], ['gsap', 'scrolltrigger']);
    }
}
add_action( 'wp_enqueue_scripts', 'crisis_academy_contact_templates' );

/*
 * =========================================================================
 * CUSTOM POST TYPE ARCHIVE 'NEWS'
 * =========================================================================
 */

/**
 * Filter to ensure the 'news' custom post type has an archive enabled.
 * This makes archive-news.php work automatically.
 */
add_filter('register_post_type_args', function ($args, $post_type) {
    if ($post_type === 'news') {
        $args['has_archive'] = 'news'; // Enable archive at /news/
        $args['rewrite'] = array('slug' => 'news');
    }
    return $args;
}, 10, 2);

/**
 * Configure the main query for the 'news' archive.
 * This ensures pagination works correctly and filters the main loop.
 */
function avante_news_archive_query($query)
{
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('news')) {
        $query->set('post_type', 'news');
        $query->set('post_status', 'publish');
        // El número de posts por página se toma de Ajustes > Lectura por defecto,
        // pero puedes forzarlo aquí si lo deseas:
        // $query->set('posts_per_page', 10);
    }
}
add_action('pre_get_posts', 'avante_news_archive_query');

/**
 * Invalida la cache de transitorios de las noticias de crisis academy cuando se guarda o actualiza un post de tipo 'news'.
 */
function crisisacademy_clear_news_transients($post_id) {
    if (get_post_type($post_id) === 'news') {
        delete_transient('crisisacademy_used_formats_slugs');
        delete_transient('crisisacademy_has_standard_news');
    }
}
add_action('save_post', 'crisisacademy_clear_news_transients');