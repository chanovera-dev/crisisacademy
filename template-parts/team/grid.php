<?php
/**
 * Team Page — Experts Grid (Dark, Hover-Reveal Cards)
 * Design: Tall portrait cards with hover content reveal
 * Theme: The Crisis Academy
 */

$theme_uri = get_stylesheet_directory_uri();

$experts = [
    [
        'id'          => 'carolina-eslava',
        'category'    => 'leadership comms',
        'name'        => 'Carolina Eslava',
        'role'        => 'Fundadora & Directora',
        'image'       => $theme_uri . '/assets/img/carolina-eslava.webp',
        'specialties' => ['Gestión de Crisis', 'Liderazgo Ejecutivo', 'Media Training C-Suite'],
        'summary'     => '25 años formando y preparando comités de crisis en multinacionales frente a escenarios de alta complejidad operativa, reputacional y mediática.',
    ],
    [
        'id'          => 'roberto-mendoza',
        'category'    => 'legal leadership',
        'name'        => 'Dr. Roberto Mendoza',
        'role'        => 'Estrategia Legal & Regulatoria',
        'image'       => $theme_uri . '/assets/img/roberto-mendoza.png',
        'specialties' => ['Litigio de Alta Crisis', 'Cumplimiento Regulatorio', 'Blindaje Penal'],
        'summary'     => 'Especialista en protección jurídica ante investigaciones antimonopolio, fraudes corporativos e incidentes regulatorios complejos.',
    ],
    [
        'id'          => 'elena-vasquez',
        'category'    => 'cyber ops',
        'name'        => 'Ing. Elena Vásquez',
        'role'        => 'Ciberseguridad & Incidencias',
        'image'       => $theme_uri . '/assets/img/elena-vasquez.png',
        'specialties' => ['Cibercrisis & Ransomware', 'Inteligencia de Amenazas', 'Forense Digital'],
        'summary'     => 'Experta en contención técnica y estratégica de ataques cibernéticos a gran escala, secuestro de datos e interrupción tecnológica.',
    ],
    [
        'id'          => 'marcelo-alvarez',
        'category'    => 'comms',
        'name'        => 'Marcelo Álvarez',
        'role'        => 'Comunicación & Media Training',
        'image'       => $theme_uri . '/assets/img/marcelo-alvarez.png',
        'specialties' => ['Vocería de Emergencia', 'Gestión de Fake News', 'Restauración de Imagen'],
        'summary'     => 'Periodista de investigación y estratega de comunicación de crisis. Ha entrenado a más de 800 voceros ejecutivos ante la presión en vivo.',
    ],
    [
        'id'          => 'valeria-gomez',
        'category'    => 'leadership ops',
        'name'        => 'Dra. Valeria Gómez',
        'role'        => 'Psicología & Estrés en Crisis',
        'image'       => $theme_uri . '/assets/img/valeria-gomez.png',
        'specialties' => ['Fatiga Cognitiva', 'Toma de Decisiones', 'Resiliencia de Comités'],
        'summary'     => 'Doctora en Neuropsicología del Trabajo. Desarrolla protocolos para mitigar el sesgo de pánico y la parálisis por análisis en directivos.',
    ],
    [
        'id'          => 'fernando-silva',
        'category'    => 'ops legal',
        'name'        => 'Capitán Fernando Silva',
        'role'        => 'Incidentes Operativos & BCP',
        'image'       => $theme_uri . '/assets/img/fernando-silva.png',
        'specialties' => ['Planes de Continuidad (BCP)', 'Cadena de Suministro', 'Evacuación & Seguridad'],
        'summary'     => 'Ex-Comandante de Operaciones de Emergencia. Asesora en logística de respuesta, evacuación de activos y reactivación operativa.',
    ]
];
?>

<section id="team-grid" class="block">
    <div class="grid-bg-overlay" aria-hidden="true"></div>
    <div class="grid-bg-glow" aria-hidden="true"></div>
    <div class="content">
        
        <div class="grid-header">
            <span class="pretext pretext-reveal">Nuestro equipo</span>
            <h2 class="object-reveal">Claustro directivo &<br><span>consultores especializados</span></h2>
        </div>

        <!-- Category Filter Bar -->
        <div class="filter-bar object-reveal">
            <button class="filter-btn active" data-filter="all">Todos</button>
            <button class="filter-btn" data-filter="leadership">Dirección</button>
            <button class="filter-btn" data-filter="comms">Comunicación</button>
            <button class="filter-btn" data-filter="cyber">Ciberseguridad</button>
            <button class="filter-btn" data-filter="legal">Legal</button>
            <button class="filter-btn" data-filter="ops">Operaciones</button>
        </div>

        <!-- Experts Grid -->
        <div class="experts-grid">
            <?php foreach ($experts as $expert) : ?>
                <article class="expert-card object-reveal" data-category="<?php echo esc_attr($expert['category']); ?>" id="dossier-<?php echo esc_attr($expert['id']); ?>">
                    
                    <!-- Photo Layer -->
                    <div class="card-photo">
                        <img src="<?php echo esc_url($expert['image']); ?>" alt="<?php echo esc_attr($expert['name']); ?>" loading="lazy">
                        <div class="card-photo-gradient" aria-hidden="true"></div>
                    </div>

                    <!-- Info Layer (visible by default, moves up on hover) -->
                    <div class="card-info">
                        <h3 class="card-name"><?php echo esc_html($expert['name']); ?></h3>
                        <span class="card-role"><?php echo esc_html($expert['role']); ?></span>
                    </div>

                    <!-- Reveal Layer (hidden, slides up on hover) -->
                    <div class="card-reveal-panel">
                        <div class="reveal-inner">
                            <div class="reveal-tags">
                                <?php foreach ($expert['specialties'] as $tag) : ?>
                                    <span class="reveal-tag"><?php echo esc_html($tag); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <p class="reveal-summary"><?php echo esc_html($expert['summary']); ?></p>
                            <button type="button" class="btn-open-drawer" data-open-drawer="<?php echo esc_attr($expert['id']); ?>">
                                <span>Ver perfil completo</span>
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Bottom accent bar -->
                    <div class="card-accent-bar" aria-hidden="true"></div>

                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>
