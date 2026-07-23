<?php
/**
 * Team Page — Side Drawer Bio Component (Dynamic CPT + Static fallback)
 * Design: Updated to match corporate homepage dark glassmorphism palette
 * Theme: The Crisis Academy
 */

$theme_uri = get_stylesheet_directory_uri();

$static_drawers = [
    'carolina-eslava' => [
        'name'        => 'Carolina Eslava',
        'role'        => 'Fundadora & Directora General de The Crisis Academy',
        'image'       => $theme_uri . '/assets/img/carolina-eslava.webp',
        'quote'       => 'Una crisis no pone a prueba tus comunicados de prensa; pone a prueba la resiliencia estructural y la velocidad de toma de decisiones de tu comité ejecutivo.',
        'bio'         => 'Carolina Eslava es una de las referentes más destacadas en la gestión y entrenamiento de comités de crisis directivos en América Latina. Con más de 25 años de trayectoria profesional, ha asesorado a juntas directivas y presidentes de multinacionales de los sectores petrolero, financiero, farmacéutico y de consumo masivo.',
        'cases'       => [
            'Gestión directa de más de 150 comités de crisis en vivo durante contingencias de alto impacto reputacional.',
            'Diseñadora del simulador de estrés directivo inmersivo bajo fatiga cognitiva acelerada.',
            'Conferencista e investigadora invitada en foros internacionales de gobierno corporativo.'
        ],
        'permalink'   => home_url('/carolina-eslava'),
    ],
    'roberto-mendoza' => [
        'name'        => 'Dr. Roberto Mendoza',
        'role'        => 'Director de Estrategia Legal & Regulatoria',
        'image'       => $theme_uri . '/assets/img/roberto-mendoza.png',
        'quote'       => 'La victoria legal no sirve de nada si la organización pierde su licencia social para operar en el proceso.',
        'bio'         => 'El Dr. Roberto Mendoza lidera la práctica de mitigación de riesgos legales y cumplimiento normativo en The Crisis Academy. Cuenta con amplia experiencia en la coordinación entre la estrategia de defensa jurídica corporativa y la contención del impacto público y reputacional.',
        'cases'       => [
            'Líder de estrategia legal en investigaciones de competencia económica e inspecciones regulatorias.',
            'Asesor legal principal en procesos de reestructuración corporativa bajo escrutinio público.',
            'Especialista en gobernanza de datos y responsabilidad jurídica de ejecutivos C-Level.'
        ],
        'permalink'   => home_url('/roberto-mendoza'),
    ],
    'elena-vasquez' => [
        'name'        => 'Ing. Elena Vásquez',
        'role'        => 'Directora de Ciberseguridad & Respuesta a Incidentes',
        'image'       => $theme_uri . '/assets/img/elena-vasquez.png',
        'quote'       => 'En una cibercrisis, la transparencia técnica combinada con una comunicación adecuada es la única vacuna contra el pánico institucional.',
        'bio'         => 'Elena Vásquez ha dedicado más de 15 años a la respuesta técnica e institucional ante desastres de seguridad informática. Ha liderado la respuesta ejecutiva ante secuestro masivo de datos (Ransomware), fuga de información sensible de clientes y fallas críticas en sistemas bancarios.',
        'cases'       => [
            'Negociación y gestión de contención en más de 120 incidentes de Ransomware y ciberextorsión.',
            'Diseño de protocolos de continuidad tecnológica ante caídas catastróficas de infraestructura.',
            'Miembro de comités consultivos de seguridad de la información en el sector financiero.'
        ],
        'permalink'   => home_url('/elena-vasquez'),
    ],
    'marcelo-alvarez' => [
        'name'        => 'Marcelo Álvarez',
        'role'        => 'Director de Comunicación Estratégica & Media Training',
        'image'       => $theme_uri . '/assets/img/marcelo-alvarez.png',
        'quote'       => 'El silencio en las primeras dos horas de una crisis no es prudencia: es la cesión voluntaria de tu narrativa a tus detractores.',
        'bio'         => 'Marcelo Álvarez aporta más de dos décadas de experiencia combinada entre el periodismo de investigación y la consultoría estratégica de comunicación de crisis. Es el diseñador del simulador de salas de prensa y entrevistas agresivas en vivo de The Crisis Academy.',
        'cases'       => [
            'Entrenamiento personalizado a más de 800 CEO, voceros y directores institucionales.',
            'Estratega de contención en campañas desinformativas y ataques coordinados en redes sociales.',
            'Ex-director de noticieros de televisión y analista de geopolítica mediática.'
        ],
        'permalink'   => home_url('/marcelo-alvarez'),
    ],
    'valeria-gomez' => [
        'name'        => 'Dra. Valeria Gómez',
        'role'        => 'Directora de Psicología Organizacional & Estrés en Crisis',
        'image'       => $theme_uri . '/assets/img/valeria-gomez.png',
        'quote'       => 'La claridad mental del líder en momentos de caos es la ventaja competitiva más valiosa de una empresa.',
        'bio'         => 'La Dra. Valeria Gómez es especialista en la neuropsicología del liderazgo bajo presión extrema. Su labor en The Crisis Academy se enfoca en preparar la mentalidad directiva para operar en escenarios de alta incertidumbre y mitigar los efectos del agotamiento cognitivo.',
        'cases'       => [
            'Desarrollo del marco de evaluación de sesgos cognitivos en situaciones de emergencia.',
            'Intervención en procesos de poscrisis y recuperación de la confianza de equipos humanos.',
            'Publicaciones internacionales en journals de comportamiento organizacional y resiliencia.'
        ],
        'permalink'   => home_url('/valeria-gomez'),
    ],
    'fernando-silva' => [
        'name'        => 'Capitán Fernando Silva',
        'role'        => 'Director de Manejo de Incidentes Operativos & BCP',
        'image'       => $theme_uri . '/assets/img/fernando-silva.png',
        'quote'       => 'Un plan de continuidad que solo existe en papel es una ilusión que se derrumba al primer minuto de un evento real.',
        'bio'         => 'El Capitán Fernando Silva aporta su vasta experiencia en el comando unificado de incidentes físicos y logísticos. Especialista en auditoría de planes de continuidad de negocio (BCP), evacuación de personal e interrupciones en la cadena de suministros globales.',
        'cases'       => [
            'Comando directo de respuesta en emergencias industriales y logísticas multinacionales.',
            'Auditoría y certificación de más de 40 sistemas de continuidad operativa bajo normas ISO 22301.',
            'Consultor de logística de evacuación en zonas de alto riesgo operativo.'
        ],
        'permalink'   => home_url('/fernando-silva'),
    ]
];

// Query CPT team_member posts
$team_drawer_query = new WP_Query([
    'post_type'      => 'team_member',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
]);

$drawers = [];
$cpt_drawer_slugs = [];

if ($team_drawer_query->have_posts()) {
    while ($team_drawer_query->have_posts()) {
        $team_drawer_query->the_post();
        $post_id = get_the_ID();
        $slug    = get_post_field('post_name', $post_id);
        $cpt_drawer_slugs[] = $slug;

        $image_url = get_the_post_thumbnail_url($post_id, 'medium_large');
        if (!$image_url && isset($static_drawers[$slug])) {
            $image_url = $static_drawers[$slug]['image'];
        }

        $role = function_exists('get_field') ? get_field('team_role', $post_id) : '';
        if (!$role && isset($static_drawers[$slug])) {
            $role = $static_drawers[$slug]['role'];
        }

        $quote = function_exists('get_field') ? get_field('team_quote', $post_id) : '';
        if (!$quote && isset($static_drawers[$slug])) {
            $quote = $static_drawers[$slug]['quote'];
        }

        // Bio paragraph(s)
        $bio_text = '';
        if (function_exists('get_field')) {
            $bio_paragraphs = get_field('team_bio_extended', $post_id);
            if (!empty($bio_paragraphs) && is_array($bio_paragraphs)) {
                $p_list = [];
                foreach ($bio_paragraphs as $p) {
                    if (!empty($p['paragraph'])) {
                        $p_list[] = $p['paragraph'];
                    }
                }
                $bio_text = implode("\n\n", $p_list);
            }
        }
        if (!$bio_text) {
            $bio_text = get_the_excerpt();
        }
        if (!$bio_text && isset($static_drawers[$slug])) {
            $bio_text = $static_drawers[$slug]['bio'];
        }

        // Cases list
        $cases = [];
        if (function_exists('get_field')) {
            $cases_repeater = get_field('team_cases', $post_id);
            if (!empty($cases_repeater) && is_array($cases_repeater)) {
                foreach ($cases_repeater as $c) {
                    $c_title = !empty($c['case_title']) ? $c['case_title'] : '';
                    $c_desc = !empty($c['case_description']) ? $c['case_description'] : '';
                    if ($c_title && $c_desc) {
                        $cases[] = $c_title . ': ' . $c_desc;
                    } elseif ($c_title) {
                        $cases[] = $c_title;
                    } elseif ($c_desc) {
                        $cases[] = $c_desc;
                    }
                }
            }
        }
        if (empty($cases) && isset($static_drawers[$slug])) {
            $cases = $static_drawers[$slug]['cases'];
        }

        $drawers[$slug] = [
            'name'      => get_the_title(),
            'role'      => $role,
            'image'     => $image_url,
            'quote'     => $quote,
            'bio'       => $bio_text,
            'cases'     => $cases,
            'permalink' => get_permalink($post_id),
        ];
    }
    wp_reset_postdata();
}

// Append static drawers for missing items
foreach ($static_drawers as $slug => $static) {
    if (!in_array($slug, $cpt_drawer_slugs)) {
        $drawers[$slug] = $static;
    }
}
?>

<div id="expert-drawer-overlay" class="drawer-overlay" aria-hidden="true">
    <div class="drawer-backdrop" data-close-drawer></div>
    
    <div class="drawer-container">
        
        <div class="drawer-header">
            <span class="drawer-label">Perfil del experto</span>
            <button type="button" class="drawer-close-btn" data-close-drawer aria-label="Cerrar perfil">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <?php foreach ($drawers as $key => $d) : ?>
            <div class="drawer-content-pane" data-drawer-pane="<?php echo esc_attr($key); ?>">
                
                <!-- Profile Header -->
                <div class="drawer-profile">
                    <div class="drawer-photo-wrap">
                        <img src="<?php echo esc_url($d['image']); ?>" alt="<?php echo esc_attr($d['name']); ?>" class="drawer-photo">
                    </div>
                    <div class="drawer-info">
                        <h2 class="drawer-name"><?php echo esc_html($d['name']); ?></h2>
                        <div class="drawer-role"><?php echo esc_html($d['role']); ?></div>
                    </div>
                </div>

                <!-- Quote -->
                <?php if (!empty($d['quote'])) : ?>
                    <blockquote class="drawer-quote">
                        <svg class="quote-icon" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p>"<?php echo esc_html($d['quote']); ?>"</p>
                    </blockquote>
                <?php endif; ?>

                <!-- Inner Tabs -->
                <div class="drawer-tabs">
                    <button class="d-tab-btn active" data-d-tab="bio-<?php echo esc_attr($key); ?>">Trayectoria</button>
                    <button class="d-tab-btn" data-d-tab="cases-<?php echo esc_attr($key); ?>">Casos Destacados</button>
                </div>

                <div class="drawer-tab-panels">
                    <div class="d-panel active" id="d-panel-bio-<?php echo esc_attr($key); ?>">
                        <div class="drawer-bio-text"><?php echo nl2br(esc_html($d['bio'])); ?></div>
                    </div>
                    <div class="d-panel" id="d-panel-cases-<?php echo esc_attr($key); ?>">
                        <?php if (!empty($d['cases'])) : ?>
                            <ul class="drawer-cases-list">
                                <?php foreach ($d['cases'] as $case) : ?>
                                    <li>
                                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                        <span><?php echo esc_html($case); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Footer Action -->
                <div class="drawer-footer" style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                    <?php if (!empty($d['permalink'])) : ?>
                        <a href="<?php echo esc_url($d['permalink']); ?>" class="btn-drawer-cta" style="background: var(--wp--preset--color--primary, #1e90ff);">
                            <span>Ver biografía completa</span>
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn-drawer-cta">
                        <span>Solicitar consultoría</span>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>
