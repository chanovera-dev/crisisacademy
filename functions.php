<?php
// Prevent direct access to this file for security reasons.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue child theme styles.
 */
function thecrisisacademy_enqueue_styles() {
    $theme_ver = wp_get_theme()->get('Version');
    $style_path = get_stylesheet_directory() . '/style.css';
    $ver = file_exists($style_path) ? filemtime($style_path) : $theme_ver;
    wp_enqueue_style('thecrisisacademy-style', get_stylesheet_uri(), array('global'), $ver);
}
add_action('wp_enqueue_scripts', 'thecrisisacademy_enqueue_styles', 20);

/**
 * Get corporate homepage assets
 */
function crisisacademy_get_assets()
{
    $assets_path = '/assets';

    return [
        'css' => [
            'homepage' => $assets_path . '/css/homepage.css',
            'hero-styles' => $assets_path . '/css/homepage/hero.css',
            'trouble-styles' => $assets_path . '/css/homepage/trouble-light.css',
            'hearings-styles' => $assets_path . '/css/homepage/hearings.css',
            'wcu-styles' => $assets_path . '/css/homepage/wcu.css',
            'founder-styles' => $assets_path . '/css/homepage/founder.css',
            'program-styles' => $assets_path . '/css/homepage/program.css',
            'simulation-styles' => $assets_path . '/css/homepage/simulation.css',
            'diff-styles' => $assets_path . '/css/homepage/diff.css',
            'testimonies-styles' => $assets_path . '/css/homepage/testimonies.css',
            'thought-styles' => $assets_path . '/css/homepage/thought.css',
            'cta-styles' => $assets_path . '/css/homepage/cta.css',
            'upcoming-events-styles' => $assets_path . '/css/homepage/upcoming-events.css',
            'news-styles' => $assets_path . '/css/homepage/news.css',
            'faq-styles' => $assets_path . '/css/homepage/faq.css',
            'team-styles' => $assets_path . '/css/team.css'
        ],
        'js' => [
            'homepage-scripts' => $assets_path . '/js/homepage/homepage.js',
            'hero-scripts' => $assets_path . '/js/homepage/hero.js',
            'testimonies-scripts' => $assets_path . '/js/homepage/testimonies.js',
            'upcoming-events-scripts' => $assets_path . '/js/homepage/upcoming-events.js',
            'down-chart-scripts' => $assets_path . '/js/homepage/down-chart.js',
            'team-scripts' => $assets_path . '/js/team.js'
        ]
    ];
}


/**
 * Helper function to enqueue a child theme stylesheet with versioning.
 */
function crisisacademy_enqueue_style($handle, $path, $media = 'all')
{
    $uri = get_stylesheet_directory_uri();
    $dir = get_stylesheet_directory();
    $src = (strpos($path, 'http') === 0) ? $path : $uri . $path;
    $ver = (strpos($path, 'http') === 0) ? '1.0' : (file_exists($dir . $path) ? filemtime($dir . $path) : time());

    wp_enqueue_style($handle, $src, [], $ver, $media);
}

/**
 * Helper function to enqueue a child theme script with versioning and dependency support.
 */
function crisisacademy_enqueue_script($handle, $path, $deps = [])
{
    $uri = get_stylesheet_directory_uri();
    $dir = get_stylesheet_directory();
    $src = (strpos($path, 'http') === 0) ? $path : $uri . $path;
    $ver = (strpos($path, 'http') === 0) ? '1.0' : (file_exists($dir . $path) ? filemtime($dir . $path) : time());

    wp_enqueue_script($handle, $src, $deps, $ver, true);
}



/**
 * Crisis Academy homepage templates
 */
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
                'ws-script',
                'sticky-overlap-efect-script',
                'card-glow-efect-script',
                'faq-accordion-toggle-script',
                'crisisacademy-homepage-script',
                'crisisacademy-hero-script',
                'animate-in',
                'global-script',
                'likes-script'
            ];
            if (in_array($handle, $defer_scripts)) {
                if (false === strpos($tag, 'defer')) {
                    $tag = str_replace(' src=', ' defer src=', $tag);
                }
            }
            return $tag;
        }, 10, 3);

        // Cargar hojas de estilo no críticas de forma asíncrona para evitar bloqueo de renderizado
        add_filter('style_loader_tag', function($html, $handle, $href, $media) {
            $non_critical_styles = [
                'crisisacademy-trust-bar',
                'crisisacademy-about',
                'crisisacademy-signals',
                'crisisacademy-how-works',
                'crisisacademy-certification',
                'crisisacademy-crisis-simulator',
                'crisisacademy-cta',
                'crisisacademy-upcoming-events',
                'crisisacademy-news',
                'posts-styles',
                'archive-design',
                'crisisacademy-faq',
                'shapes',
                'rounded-shapes',
                'breadcrumbs'
            ];
            if (in_array($handle, $non_critical_styles)) {
                return "<link rel='stylesheet' id='" . esc_attr($handle) . "-css' href='" . esc_url($href) . "' media='print' onload=\"this.media='all'\" />\n";
            }
            return $html;
        }, 10, 4);
    }
}
add_action( 'wp_enqueue_scripts', 'crisisacademy_homepage_templates' );

/**
 * Corporate Crisis Academy Homepage
 * 
 * Homepage content:
 * - hero
 * 
 */
function homepage_templates() {
    if (is_page_template('templates/corporate-crisisacademy-homepage.php')) {
        $a = crisisacademy_get_assets();
        $b = avante_get_assets();

        function unload_parts_header() {
            wp_dequeue_style( 'page' );
        }
        add_action( 'wp_enqueue_scripts', 'unload_parts_header', 100 );

        crisisacademy_enqueue_style('homepage', $a['css']['homepage']);
        crisisacademy_enqueue_style('hero-styles', $a['css']['hero-styles']);
        crisisacademy_enqueue_style('trouble-styles', $a['css']['trouble-styles']);
        crisisacademy_enqueue_style('hearings-styles', $a['css']['hearings-styles']);
        crisisacademy_enqueue_style('wcu-styles', $a['css']['wcu-styles']);
        crisisacademy_enqueue_style('founder-styles', $a['css']['founder-styles']);
        crisisacademy_enqueue_style('program-styles', $a['css']['program-styles']);
        avante_enqueue_style('quotes-slideshow-styles', $b['css']['quotes-slideshow-styles']);
        crisisacademy_enqueue_style('simulation-styles', $a['css']['simulation-styles']);
        crisisacademy_enqueue_style('diff-styles', $a['css']['diff-styles']);
        crisisacademy_enqueue_style('testimonies-styles', $a['css']['testimonies-styles']);
        crisisacademy_enqueue_style('thought-styles', $a['css']['thought-styles']);
        crisisacademy_enqueue_style('cta-styles', $a['css']['cta-styles']);
        crisisacademy_enqueue_style('upcoming-events-styles', $a['css']['upcoming-events-styles']);
        crisisacademy_enqueue_style('news-styles', $a['css']['news-styles']);
        avante_enqueue_style('posts-styles', $b['css']['posts-styles']);
        avante_enqueue_style('archive-design', $b['css']['archive-design']);
        crisisacademy_enqueue_style('faq-styles', $a['css']['faq-styles']);

        crisisacademy_enqueue_script('homepage-scripts', $a['js']['homepage-scripts']);
        crisisacademy_enqueue_script('hero-scripts', $a['js']['hero-scripts']);
        crisisacademy_enqueue_script('down-chart-scripts', $a['js']['down-chart-scripts']);
        avante_enqueue_script('quotes-slideshow-scripts', $b['js']['quotes-slideshow-script']);
        avante_enqueue_script('cert-slideshow-script', $b['js']['cert-slideshow-script']);
        crisisacademy_enqueue_script('testimonies-scripts', $a['js']['testimonies-scripts']);
        avante_enqueue_script('ws-script', $b['js']['ws-script']);
        avante_enqueue_script('animate-in', $b['js']['animate-in']);
        avante_enqueue_script('posts-scripts', $b['js']['posts-scripts']);
        avante_enqueue_script('faq-accordion-toggle-script', $b['js']['faq-accordion-toggle-script']);
        avante_enqueue_script('sticky-overlap-efect-script', $b['js']['sticky-overlap-efect-script']);
        avante_enqueue_script('card-glow-efect-script', $b['js']['card-glow-efect-script']);

        // Añadir atributo defer a scripts pesados y secundarios para evitar bloqueo de renderizado
        add_filter('script_loader_tag', function($tag, $handle, $src) {
            $defer_scripts = [
                'quotes-slideshow-script',
                'quotes-slideshow-scripts',
                'cert-slideshow-script',
                'posts-scripts',
                'ws-script',
                'faq-accordion-toggle-script',
                'sticky-overlap-efect-script',
                'homepage-scripts',
                'hero-scripts',
                'down-chart-scripts',
                'testimonies-scripts',
                'animate-in',
                'global-script',
                'likes-script',
                'card-glow-efect-script'
            ];
            if (in_array($handle, $defer_scripts)) {
                if (false === strpos($tag, 'defer')) {
                    $tag = str_replace(' src=', ' defer src=', $tag);
                }
            }
            return $tag;
        }, 10, 3);

        // Cargar hojas de estilo no críticas de forma asíncrona para evitar bloqueo de renderizado
        add_filter('style_loader_tag', function($html, $handle, $href, $media) {
            $non_critical_styles = [
                'hearings-styles',
                'wcu-styles',
                'founder-styles',
                'program-styles',
                'quotes-slideshow-styles',
                'simulation-styles',
                'diff-styles',
                'testimonies-styles',
                'thought-styles',
                'cta-styles',
                'upcoming-events-styles',
                'news-styles',
                'posts-styles',
                'archive-design',
                'faq-styles',
                'shapes',
                'rounded-shapes',
                'breadcrumbs',
                'trouble-styles'
            ];
            if (in_array($handle, $non_critical_styles)) {
                return "<link rel='stylesheet' id='" . esc_attr($handle) . "-css' href='" . esc_url($href) . "' media='print' onload=\"this.media='all'\" />\n";
            }
            return $html;
        }, 10, 4);
    }
}
add_action( 'wp_enqueue_scripts', 'homepage_templates' );

/**
 * Team Page Template
 */
function team_templates() {
    if (is_page_template('templates/team.php')) {
        $a = crisisacademy_get_assets();
        $b = avante_get_assets();

        function unload_parts_header_team() {
            wp_dequeue_style( 'page' );
        }
        add_action( 'wp_enqueue_scripts', 'unload_parts_header_team', 100 );

        crisisacademy_enqueue_style('homepage', $a['css']['homepage']);
        crisisacademy_enqueue_style('team-styles', $a['css']['team-styles']);
        crisisacademy_enqueue_script('team-scripts', $a['js']['team-scripts']);

        // Shared homepage scripts for consistent interactions
        avante_enqueue_script('sticky-overlap-efect-script', $b['js']['sticky-overlap-efect-script']);
        avante_enqueue_script('card-glow-efect-script', $b['js']['card-glow-efect-script']);
        avante_enqueue_script('animate-in', $b['js']['animate-in']);

        // Defer non-critical scripts
        add_filter('script_loader_tag', function($tag, $handle, $src) {
            $defer_scripts = [
                'sticky-overlap-efect-script',
                'card-glow-efect-script',
                'animate-in',
                'team-scripts',
                'global-script',
                'likes-script'
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
add_action( 'wp_enqueue_scripts', 'team_templates' );

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