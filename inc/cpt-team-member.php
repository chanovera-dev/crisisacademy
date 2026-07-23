<?php
/**
 * Register Custom Post Type: Team Member (team_member)
 * and Custom Taxonomy: Team Category (team_category)
 *
 * Theme: The Crisis Academy
 */

if (!defined('ABSPATH')) {
    exit;
}

function crisisacademy_register_team_member_cpt() {

    // Labels for CPT
    $labels = [
        'name'                  => _x('Equipo de Expertos', 'Post Type General Name', 'thecrisisacademy'),
        'singular_name'         => _x('Miembro del Equipo', 'Post Type Singular Name', 'thecrisisacademy'),
        'menu_name'             => __('Equipo de Expertos', 'thecrisisacademy'),
        'name_admin_bar'        => __('Miembro del Equipo', 'thecrisisacademy'),
        'archives'              => __('Archivo de Equipo', 'thecrisisacademy'),
        'attributes'            => __('Atributos de Miembro', 'thecrisisacademy'),
        'parent_item_colon'     => __('Miembro Padre:', 'thecrisisacademy'),
        'all_items'             => __('Todos los Miembros', 'thecrisisacademy'),
        'add_new_item'          => __('Añadir Nuevo Miembro', 'thecrisisacademy'),
        'add_new'               => __('Añadir Nuevo', 'thecrisisacademy'),
        'new_item'              => __('Nuevo Miembro', 'thecrisisacademy'),
        'edit_item'             => __('Editar Miembro', 'thecrisisacademy'),
        'update_item'           => __('Actualizar Miembro', 'thecrisisacademy'),
        'view_item'             => __('Ver Miembro', 'thecrisisacademy'),
        'view_items'            => __('Ver Equipo', 'thecrisisacademy'),
        'search_items'          => __('Buscar Miembro', 'thecrisisacademy'),
        'not_found'             => __('No se encontraron miembros', 'thecrisisacademy'),
        'not_found_in_trash'    => __('No hay miembros en la papelera', 'thecrisisacademy'),
        'featured_image'        => __('Fotografía de Perfil', 'thecrisisacademy'),
        'set_featured_image'    => __('Establecer fotografía de perfil', 'thecrisisacademy'),
        'remove_featured_image' => __('Eliminar fotografía de perfil', 'thecrisisacademy'),
        'use_featured_image'    => __('Usar como fotografía de perfil', 'thecrisisacademy'),
        'insert_into_item'      => __('Insertar en miembro', 'thecrisisacademy'),
        'uploaded_to_this_item' => __('Subido a este miembro', 'thecrisisacademy'),
        'items_list'            => __('Lista de miembros', 'thecrisisacademy'),
        'items_list_navigation' => __('Navegación de lista de miembros', 'thecrisisacademy'),
        'filter_items_list'     => __('Filtrar lista de miembros', 'thecrisisacademy'),
    ];

    $args = [
        'label'                 => __('Miembro del Equipo', 'thecrisisacademy'),
        'description'           => __('Claustro directivo y consultores especializados', 'thecrisisacademy'),
        'labels'                => $labels,
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'taxonomies'            => ['team_category'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
        'rewrite'               => ['slug' => 'team', 'with_front' => false],
    ];

    register_post_type('team_member', $args);
}
add_action('init', 'crisisacademy_register_team_member_cpt', 0);

// Auto-flush rewrite rules once to prevent 404 errors on /team/ URLs
function crisisacademy_flush_team_cpt_rewrites() {
    if (get_option('crisisacademy_team_rewrite_flushed_v3') !== '1') {
        flush_rewrite_rules(false);
        update_option('crisisacademy_team_rewrite_flushed_v3', '1');
    }
}
add_action('init', 'crisisacademy_flush_team_cpt_rewrites', 99);


function crisisacademy_register_team_category_taxonomy() {

    $labels = [
        'name'                       => _x('Categorías del Equipo', 'Taxonomy General Name', 'thecrisisacademy'),
        'singular_name'              => _x('Categoría del Equipo', 'Taxonomy Singular Name', 'thecrisisacademy'),
        'menu_name'                  => __('Categorías de Filtro', 'thecrisisacademy'),
        'all_items'                  => __('Todas las Categorías', 'thecrisisacademy'),
        'parent_item'                => __('Categoría Padre', 'thecrisisacademy'),
        'parent_item_colon'          => __('Categoría Padre:', 'thecrisisacademy'),
        'new_item_name'              => __('Nueva Categoría', 'thecrisisacademy'),
        'add_new_item'               => __('Añadir Nueva Categoría', 'thecrisisacademy'),
        'edit_item'                  => __('Editar Categoría', 'thecrisisacademy'),
        'update_item'                => __('Actualizar Categoría', 'thecrisisacademy'),
        'view_item'                  => __('Ver Categoría', 'thecrisisacademy'),
        'separate_items_with_commas' => __('Separar categorías con comas', 'thecrisisacademy'),
        'add_or_remove_items'        => __('Añadir o eliminar categorías', 'thecrisisacademy'),
        'choose_from_most_used'      => __('Elegir de las más usadas', 'thecrisisacademy'),
        'popular_items'              => __('Categorías populares', 'thecrisisacademy'),
        'search_items'               => __('Buscar categorías', 'thecrisisacademy'),
        'not_found'                  => __('No encontrada', 'thecrisisacademy'),
        'no_terms'                   => __('Sin categorías', 'thecrisisacademy'),
        'items_list'                 => __('Lista de categorías', 'thecrisisacademy'),
        'items_list_navigation'      => __('Navegación de lista de categorías', 'thecrisisacademy'),
    ];

    $args = [
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => ['slug' => 'categoria-equipo'],
    ];

    register_taxonomy('team_category', ['team_member'], $args);
}
add_action('init', 'crisisacademy_register_team_category_taxonomy', 0);


/**
 * Helper function to retrieve structured member data from CPT post or data.php fallback
 */
function crisisacademy_get_team_member_data($slug_or_id = null) {
    if (!$slug_or_id) {
        $slug_or_id = get_the_ID();
    }

    $post = null;
    if (is_numeric($slug_or_id)) {
        $post = get_post($slug_or_id);
    } else {
        $posts = get_posts([
            'post_type'   => 'team_member',
            'name'        => $slug_or_id,
            'post_status' => 'publish',
            'numberposts' => 1,
        ]);
        if (!empty($posts)) {
            $post = $posts[0];
        }
    }

    if ($post && $post->post_type === 'team_member') {
        $post_id = $post->ID;
        $slug    = $post->post_name;

        // Photo
        $image = get_the_post_thumbnail_url($post_id, 'full');
        if (!$image) {
            $image = get_stylesheet_directory_uri() . '/assets/img/' . $slug . '.webp';
        }

        // Roles
        $role = function_exists('get_field') ? get_field('team_role', $post_id) : '';
        $role_short = function_exists('get_field') ? get_field('team_role_short', $post_id) : '';
        if (!$role_short) $role_short = $role;

        // Quote
        $quote = function_exists('get_field') ? get_field('team_quote', $post_id) : '';

        // Specialties tags
        $specialties = [];
        if (function_exists('get_field')) {
            $spec_rep = get_field('team_specialties', $post_id);
            if (!empty($spec_rep) && is_array($spec_rep)) {
                foreach ($spec_rep as $sp) {
                    if (!empty($sp['specialty_name'])) {
                        $specialties[] = $sp['specialty_name'];
                    }
                }
            }
        }

        // Stats
        $stats = [];
        if (function_exists('get_field')) {
            $stats_rep = get_field('team_stats', $post_id);
            if (!empty($stats_rep) && is_array($stats_rep)) {
                foreach ($stats_rep as $st) {
                    $stats[] = [
                        'number' => !empty($st['stat_number']) ? $st['stat_number'] : '',
                        'label'  => !empty($st['stat_label']) ? $st['stat_label'] : '',
                    ];
                }
            }
        }

        // Bio Extended
        $bio_extended = [];
        if (function_exists('get_field')) {
            $bio_rep = get_field('team_bio_extended', $post_id);
            if (!empty($bio_rep) && is_array($bio_rep)) {
                foreach ($bio_rep as $bp) {
                    if (!empty($bp['paragraph'])) {
                        $bio_extended[] = $bp['paragraph'];
                    }
                }
            }
        }
        if (empty($bio_extended) && $post->post_content) {
            $bio_extended[] = $post->post_content;
        }

        // Timeline
        $timeline = [];
        if (function_exists('get_field')) {
            $time_rep = get_field('team_timeline', $post_id);
            if (!empty($time_rep) && is_array($time_rep)) {
                foreach ($time_rep as $t) {
                    $timeline[] = [
                        'year' => !empty($t['year']) ? $t['year'] : '',
                        'title' => !empty($t['title']) ? $t['title'] : '',
                        'desc' => !empty($t['description']) ? $t['description'] : '',
                    ];
                }
            }
        }

        // Specialty Cards
        $specialty_cards = [];
        if (function_exists('get_field')) {
            $cards_rep = get_field('team_specialty_cards', $post_id);
            if (!empty($cards_rep) && is_array($cards_rep)) {
                foreach ($cards_rep as $c) {
                    $specialty_cards[] = [
                        'icon' => !empty($c['icon']) ? $c['icon'] : 'shield',
                        'title' => !empty($c['title']) ? $c['title'] : '',
                        'desc' => !empty($c['description']) ? $c['description'] : '',
                    ];
                }
            }
        }

        // Cases
        $cases = [];
        if (function_exists('get_field')) {
            $cases_rep = get_field('team_cases', $post_id);
            if (!empty($cases_rep) && is_array($cases_rep)) {
                foreach ($cases_rep as $ca) {
                    $cases[] = [
                        'title' => !empty($ca['case_title']) ? $ca['case_title'] : '',
                        'desc'  => !empty($ca['case_description']) ? $ca['case_description'] : '',
                    ];
                }
            }
        }

        // Publications
        $publications = [];
        if (function_exists('get_field')) {
            $pub_rep = get_field('team_publications', $post_id);
            if (!empty($pub_rep) && is_array($pub_rep)) {
                foreach ($pub_rep as $p) {
                    $publications[] = [
                        'type'  => !empty($p['pub_type']) ? $p['pub_type'] : 'artículo',
                        'title' => !empty($p['pub_title']) ? $p['pub_title'] : '',
                        'venue' => !empty($p['pub_venue']) ? $p['pub_venue'] : '',
                        'year'  => !empty($p['pub_year']) ? $p['pub_year'] : '',
                    ];
                }
            }
        }

        return [
            'name'             => $post->post_title,
            'role'             => $role,
            'role_short'       => $role_short,
            'image'            => $image,
            'quote'            => $quote,
            'specialties'      => $specialties,
            'stats'            => $stats,
            'bio_extended'     => $bio_extended,
            'timeline'         => $timeline,
            'specialty_cards'  => $specialty_cards,
            'cases'            => $cases,
            'publications'     => $publications,
        ];
    }

    return null;
}

