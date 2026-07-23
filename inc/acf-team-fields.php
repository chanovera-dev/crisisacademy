<?php
/**
 * Register ACF/SCF Field Group for Team Member CPT
 *
 * Theme: The Crisis Academy
 */

if (!defined('ABSPATH')) {
    exit;
}

function crisisacademy_register_team_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_team_member_details',
        'title' => __('Detalles del Miembro del Equipo', 'thecrisisacademy'),
        'fields' => [
            // Cargo completo
            [
                'key' => 'field_team_role',
                'label' => __('Cargo Completo', 'thecrisisacademy'),
                'name' => 'team_role',
                'type' => 'text',
                'instructions' => __('Ej: Fundadora & Directora General de The Crisis Academy', 'thecrisisacademy'),
                'required' => 1,
            ],
            // Cargo corto
            [
                'key' => 'field_team_role_short',
                'label' => __('Cargo Corto (Grid)', 'thecrisisacademy'),
                'name' => 'team_role_short',
                'type' => 'text',
                'instructions' => __('Ej: Fundadora & Directora', 'thecrisisacademy'),
                'required' => 0,
            ],
            // Resumen corto (card)
            [
                'key' => 'field_team_summary',
                'label' => __('Resumen Corto (Tarjeta Grid)', 'thecrisisacademy'),
                'name' => 'team_summary',
                'type' => 'textarea',
                'rows' => 3,
                'instructions' => __('Breve descripción para la tarjeta con hover reveal.', 'thecrisisacademy'),
            ],
            // Cita destacada
            [
                'key' => 'field_team_quote',
                'label' => __('Cita Signature / Frase Destacada', 'thecrisisacademy'),
                'name' => 'team_quote',
                'type' => 'textarea',
                'rows' => 3,
            ],
            // Flag fundador
            [
                'key' => 'field_team_is_founder',
                'label' => __('¿Es Dirección / Spotlight Founder?', 'thecrisisacademy'),
                'name' => 'team_is_founder',
                'type' => 'true_false',
                'ui' => 1,
                'instructions' => __('Activar si este miembro debe mostrarse en la sección principal de Dirección de la página de equipo.', 'thecrisisacademy'),
            ],
            // Tags de especialidades
            [
                'key' => 'field_team_specialties',
                'label' => __('Tags de Especialidades', 'thecrisisacademy'),
                'name' => 'team_specialties',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => __('Añadir Especialidad', 'thecrisisacademy'),
                'sub_fields' => [
                    [
                        'key' => 'field_specialty_name',
                        'label' => __('Especialidad', 'thecrisisacademy'),
                        'name' => 'specialty_name',
                        'type' => 'text',
                    ],
                ],
            ],
            // Métricas y estadísticas personales
            [
                'key' => 'field_team_stats',
                'label' => __('Estadísticas y Métricas', 'thecrisisacademy'),
                'name' => 'team_stats',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => __('Añadir Métrica', 'thecrisisacademy'),
                'sub_fields' => [
                    [
                        'key' => 'field_stat_number',
                        'label' => __('Cifra / Valor', 'thecrisisacademy'),
                        'name' => 'stat_number',
                        'type' => 'text',
                        'instructions' => __('Ej: +25', 'thecrisisacademy'),
                    ],
                    [
                        'key' => 'field_stat_label',
                        'label' => __('Etiqueta', 'thecrisisacademy'),
                        'name' => 'stat_label',
                        'type' => 'text',
                        'instructions' => __('Ej: Años de experiencia', 'thecrisisacademy'),
                    ],
                ],
            ],
            // Párrafos de biografía extendida
            [
                'key' => 'field_team_bio_extended',
                'label' => __('Biografía Extendida (Párrafos)', 'thecrisisacademy'),
                'name' => 'team_bio_extended',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Añadir Párrafo', 'thecrisisacademy'),
                'sub_fields' => [
                    [
                        'key' => 'field_bio_paragraph',
                        'label' => __('Párrafo', 'thecrisisacademy'),
                        'name' => 'paragraph',
                        'type' => 'textarea',
                        'rows' => 4,
                    ],
                ],
            ],
            // Timeline de trayectoria
            [
                'key' => 'field_team_timeline',
                'label' => __('Trayectoria / Hitos Profesionales', 'thecrisisacademy'),
                'name' => 'team_timeline',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Añadir Hito', 'thecrisisacademy'),
                'sub_fields' => [
                    [
                        'key' => 'field_timeline_year',
                        'label' => __('Año / Período', 'thecrisisacademy'),
                        'name' => 'year',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_timeline_title',
                        'label' => __('Título del Hito', 'thecrisisacademy'),
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_timeline_desc',
                        'label' => __('Descripción', 'thecrisisacademy'),
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 2,
                    ],
                ],
            ],
            // Tarjetas de áreas de especialización
            [
                'key' => 'field_team_specialty_cards',
                'label' => __('Tarjetas de Áreas de Especialización', 'thecrisisacademy'),
                'name' => 'team_specialty_cards',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Añadir Área', 'thecrisisacademy'),
                'sub_fields' => [
                    [
                        'key' => 'field_specialty_card_icon',
                        'label' => __('Icono', 'thecrisisacademy'),
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => [
                            'shield'    => 'Escudo (Shield)',
                            'users'     => 'Usuarios (Users)',
                            'mic'       => 'Micrófono (Mic)',
                            'brain'     => 'Cerebro (Brain)',
                            'chart'     => 'Gráfica (Chart)',
                            'building'  => 'Edificio (Building)',
                            'scale'     => 'Balanza / Legal (Scale)',
                            'lock'      => 'Candado / Seguridad (Lock)',
                            'database'  => 'Base de datos (Database)',
                            'globe'     => 'Globo (Globe)',
                            'radar'     => 'Radar (Radar)',
                            'search'    => 'Búsqueda (Search)',
                            'server'    => 'Servidor (Server)',
                            'alert'     => 'Alerta (Alert)',
                            'heart'     => 'Corazón (Heart)',
                            'refresh'   => 'Restaurar (Refresh)',
                            'tv'        => 'Televisión / Medios (TV)',
                            'clipboard' => 'Clipboard / BCP',
                            'truck'     => 'Camión / Logística (Truck)',
                        ],
                        'default_value' => 'shield',
                    ],
                    [
                        'key' => 'field_specialty_card_title',
                        'label' => __('Título', 'thecrisisacademy'),
                        'name' => 'title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_specialty_card_desc',
                        'label' => __('Descripción', 'thecrisisacademy'),
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],
            // Casos destacados
            [
                'key' => 'field_team_cases',
                'label' => __('Casos Destacados', 'thecrisisacademy'),
                'name' => 'team_cases',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Añadir Caso', 'thecrisisacademy'),
                'sub_fields' => [
                    [
                        'key' => 'field_case_title',
                        'label' => __('Título del Caso', 'thecrisisacademy'),
                        'name' => 'case_title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_case_description',
                        'label' => __('Descripción del Caso', 'thecrisisacademy'),
                        'name' => 'case_description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ],
                ],
            ],
            // Publicaciones y reconocimientos
            [
                'key' => 'field_team_publications',
                'label' => __('Publicaciones & Reconocimientos', 'thecrisisacademy'),
                'name' => 'team_publications',
                'type' => 'repeater',
                'layout' => 'block',
                'button_label' => __('Añadir Publicación', 'thecrisisacademy'),
                'sub_fields' => [
                    [
                        'key' => 'field_pub_type',
                        'label' => __('Tipo', 'thecrisisacademy'),
                        'name' => 'pub_type',
                        'type' => 'select',
                        'choices' => [
                            'artículo'    => 'Artículo',
                            'conferencia' => 'Conferencia',
                            'ponencia'    => 'Ponencia',
                        ],
                        'default_value' => 'artículo',
                    ],
                    [
                        'key' => 'field_pub_title',
                        'label' => __('Título', 'thecrisisacademy'),
                        'name' => 'pub_title',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pub_venue',
                        'label' => __('Medio / Evento / Foro', 'thecrisisacademy'),
                        'name' => 'pub_venue',
                        'type' => 'text',
                    ],
                    [
                        'key' => 'field_pub_year',
                        'label' => __('Año', 'thecrisisacademy'),
                        'name' => 'pub_year',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'team_member',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ]);
}
add_action('acf/init', 'crisisacademy_register_team_acf_fields');
