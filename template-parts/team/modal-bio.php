<?php
/**
 * Team Page Modal Bio Drawer Component
 * Theme: The Crisis Academy
 */

$theme_uri = get_stylesheet_directory_uri();

$bios = [
    'carolina-eslava' => [
        'name'        => 'Carolina Eslava',
        'title'       => 'Fundadora & Directora General de The Crisis Academy',
        'image'       => $theme_uri . '/assets/img/carolina-eslava.webp',
        'bio_full'    => 'Carolina Eslava es una de las referentes más destacadas en la gestión y entrenamiento de comités de crisis directivos en América Latina. Con más de 25 años de trayectoria profesional, ha asesorado a juntas directivas y presidentes de multinacionales de los sectores petrolero, financiero, farmacéutico y de consumo masivo.',
        'achievements'=> [
            'Gestión directa de más de 150 comités de crisis en vivo durante contingencias de alto impacto.',
            'Autora del modelo de entrenamiento inmersivo bajo fatiga cognitiva acelerada.',
            'Docente e investigadora invitada en foros internacionales de reputación corporativa.'
        ],
        'quote'       => 'Una crisis no pone a prueba tus comunicados de prensa; pone a prueba la resiliencia estructural y la velocidad de toma de decisiones de tu comité ejecutivo.'
    ],
    'roberto-mendoza' => [
        'name'        => 'Dr. Roberto Mendoza',
        'title'       => 'Director de Estrategia Legal & Regulatoria',
        'image'       => $theme_uri . '/assets/img/roberto-mendoza.png',
        'bio_full'    => 'El Dr. Roberto Mendoza lidera la práctica de mitigación de riesgos legales y cumplimiento normativo en The Crisis Academy. Cuenta con amplia experiencia en la coordinación entre la estrategia de defensa jurídica corporativa y la contención del impacto público y reputacional.',
        'achievements'=> [
            'Líder de estrategia legal en investigaciones de competencia económica e inspecciones regulatorias.',
            'Asesor legal principal en procesos de reestructuración corporativa bajo escrutinio público.',
            'Especialista en gobernanza de datos y responsabilidad jurídica de ejecutivos C-Level.'
        ],
        'quote'       => 'La victoria legal no sirve de nada si la organización pierde su licencia social para operar en el proceso.'
    ],
    'elena-vasquez' => [
        'name'        => 'Ing. Elena Vásquez',
        'title'       => 'Directora de Ciberseguridad & Respuesta a Incidentes',
        'image'       => $theme_uri . '/assets/img/elena-vasquez.png',
        'bio_full'    => 'Elena Vásquez ha dedicado más de 15 años a la respuesta técnica e institucional ante desastres de seguridad informática. Ha liderado la respuesta ejecutiva ante secuestro masivo de datos (Ransomware), fuga de información sensible de clientes y fallas críticas en sistemas bancarios.',
        'achievements'=> [
            'Negociación y gestión de contención en más de 120 incidentes de Ransomware y ciberextorsión.',
            'Diseño de protocolos de continuidad tecnológica ante caídas catastróficas de infraestructura.',
            'Miembro de comités consultivos de seguridad de la información en el sector financiero.'
        ],
        'quote'       => 'En una cibercrisis, la transparencia técnica combinada con una comunicación transparente es la única vacuna contra el pánico institucional.'
    ],
    'marcelo-alvarez' => [
        'name'        => 'Marcelo Álvarez',
        'title'       => 'Director de Comunicación Estratégica & Media Training',
        'image'       => $theme_uri . '/assets/img/marcelo-alvarez.png',
        'bio_full'    => 'Marcelo Álvarez aporta más de dos décadas de experiencia combinada entre el periodismo de investigación y la consultoría estratégica de comunicación de crisis. Es el diseñador del simulador de salas de prensa y entrevistas agresivas en vivo de The Crisis Academy.',
        'achievements'=> [
            'Entrenamiento personalizado a más de 800 CEO, voceros y directores institucionales.',
            'Estratega de contención en campañas desinformativas y ataques coordinados en redes sociales.',
            'Ex-director de noticieros de televisión y analista de geopolítica mediática.'
        ],
        'quote'       => 'El silencio en las primeras dos horas de una crisis no es prudencia: es la cesión voluntaria de tu narrativa a tus detractores.'
    ],
    'valeria-gomez' => [
        'name'        => 'Dra. Valeria Gómez',
        'title'       => 'Directora de Psicología Organizacional & Estrés en Crisis',
        'image'       => $theme_uri . '/assets/img/valeria-gomez.png',
        'bio_full'    => 'La Dra. Valeria Gómez es especialista en la neuropsicología del liderazgo bajo presión extrema. Su labor en The Crisis Academy se enfoca en preparar la mentalidad directiva para operar en escenarios de alta incertidumbre y mitigar los efectos del agotamiento cognitivo.',
        'achievements'=> [
            'Desarrollo del marco de evaluación de sesgos cognitivos en situaciones de emergencia.',
            'Intervención en procesos de poscrisis y recuperación de la confianza de equipos humanos.',
            'Publicaciones internacionales en journals de comportamiento organizacional y resiliencia.'
        ],
        'quote'       => 'La claridad mental del líder en momentos de caos es la ventaja competitiva más valiosa de una empresa.'
    ],
    'fernando-silva' => [
        'name'        => 'Capitán Fernando Silva',
        'title'       => 'Director de Manejo de Incidentes Operativos & BCP',
        'image'       => $theme_uri . '/assets/img/fernando-silva.png',
        'bio_full'    => 'El Capitán Fernando Silva aporta su vasta experiencia en el comando unificado de incidentes físicos y logísticos. Especialista en auditoría de planes de continuidad de negocio (BCP), evacuación de personal e interrupciones en la cadena de suministros globales.',
        'achievements'=> [
            'Comando directo de respuesta en emergencias industriales y logísticas multinacionales.',
            'Auditoría y certificación de más de 40 sistemas de continuidad operativa bajo normas ISO 22301.',
            'Consultor de logística de evacuación en zonas de alto riesgo operativo.'
        ],
        'quote'       => 'Un plan de continuidad que solo existe en papel es una ilusión que se derrumba al primer minuto de un evento real.'
    ]
];
?>

<div id="expert-bio-modal" class="expert-modal" aria-hidden="true" role="dialog" aria-labelledby="modal-expert-name">
    <div class="modal-backdrop" data-close-modal></div>
    
    <div class="modal-container">
        <button type="button" class="modal-close-btn" data-close-modal aria-label="Cerrar modal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <div class="modal-reticle top-left"></div>
        <div class="modal-reticle top-right"></div>
        <div class="modal-reticle bottom-left"></div>
        <div class="modal-reticle bottom-right"></div>

        <?php foreach ($bios as $key => $data) : ?>
            <div class="modal-expert-content" data-expert-content="<?php echo esc_attr($key); ?>">
                <div class="modal-header-grid">
                    <div class="modal-photo-wrap">
                        <img src="<?php echo esc_url($data['image']); ?>" alt="<?php echo esc_attr($data['name']); ?>" class="modal-photo">
                    </div>
                    <div class="modal-info">
                        <span class="pretext">EXPEDIENTE DEL EXPERTO</span>
                        <h2 id="modal-expert-name" class="modal-name"><?php echo esc_html($data['name']); ?></h2>
                        <div class="modal-title"><?php echo esc_html($data['title']); ?></div>
                    </div>
                </div>

                <div class="modal-body">
                    <blockquote class="modal-quote">
                        <svg class="quote-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p><?php echo esc_html($data['quote']); ?></p>
                    </blockquote>

                    <div class="modal-section">
                        <h3>Trayectoria Profesional</h3>
                        <p><?php echo esc_html($data['bio_full']); ?></p>
                    </div>

                    <div class="modal-section">
                        <h3>Casos & Hitos Destacados</h3>
                        <ul class="modal-achievements-list">
                            <?php foreach ($data['achievements'] as $ach) : ?>
                                <li>
                                    <span class="bullet-dot"></span>
                                    <span><?php echo esc_html($ach); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="modal-footer-action text-center">
                        <a href="#team-cta" class="btn-primary" data-close-modal>
                            <span>Solicitar Asesoría con este Experto</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>
</div>
