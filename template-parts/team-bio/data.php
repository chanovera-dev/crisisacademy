<?php
/**
 * Team Bio Data — Centralized member profiles
 * Each member is keyed by their page slug.
 * Theme: The Crisis Academy
 */

if (!defined('ABSPATH')) exit;

$theme_uri = get_stylesheet_directory_uri();

$team_members = [

    /* ────────────────────────────────────────────────────────────
       Carolina Eslava — Fundadora & Directora
       ──────────────────────────────────────────────────────────── */
    'carolina-eslava' => [
        'name'        => 'Carolina Eslava',
        'role'        => 'Fundadora & Directora General',
        'role_short'  => 'Dirección General',
        'image'       => $theme_uri . '/assets/img/carolina-eslava.webp',
        'quote'       => 'Una crisis no pone a prueba tus comunicados de prensa; pone a prueba la resiliencia estructural y la velocidad de toma de decisiones de tu comité ejecutivo.',
        'specialties' => ['Gestión de Crisis', 'Liderazgo Ejecutivo', 'Media Training C-Suite'],
        'stats'       => [
            ['number' => '+25',    'label' => 'Años de experiencia'],
            ['number' => '+2,000', 'label' => 'Ejecutivos capacitados'],
            ['number' => '+150',   'label' => 'Comités de crisis guiados'],
            ['number' => '12+',    'label' => 'Sectores industriales'],
        ],
        'bio_extended' => [
            'Carolina Eslava es una de las referentes más destacadas en la gestión y entrenamiento de comités de crisis directivos en América Latina. Con más de 25 años de trayectoria profesional, ha asesorado a juntas directivas y presidentes de multinacionales de los sectores petrolero, financiero, farmacéutico y de consumo masivo.',
            'Fundó The Crisis Academy con la convicción de que la preparación proactiva de los comités ejecutivos ante escenarios de crisis es la diferencia entre una organización que sobrevive y una que se fortalece. Su enfoque combina rigor académico con simulación inmersiva activa, entrenando la toma de decisiones bajo fatiga cognitiva acelerada.',
            'Carolina es la diseñadora del simulador de estrés directivo inmersivo bajo fatiga cognitiva acelerada, una herramienta propietaria que ha sido adoptada por organizaciones líderes en toda la región para la evaluación y fortalecimiento de sus equipos de crisis.',
        ],
        'timeline' => [
            ['year' => '2000', 'title' => 'Inicio en consultoría de crisis',              'desc' => 'Primeros proyectos de asesoría en gestión de crisis reputacional para el sector financiero.'],
            ['year' => '2006', 'title' => 'Dirección de crisis multisectoriales',          'desc' => 'Liderazgo de comités de crisis en multinacionales petroleras y farmacéuticas de alta complejidad.'],
            ['year' => '2012', 'title' => 'Desarrollo del simulador inmersivo',            'desc' => 'Creación del simulador de estrés directivo bajo fatiga cognitiva acelerada, herramienta propietaria de TCA.'],
            ['year' => '2018', 'title' => 'Fundación de The Crisis Academy',               'desc' => 'Establecimiento de la academia como centro de excelencia en formación de comités de crisis.'],
            ['year' => '2023', 'title' => 'Expansión regional & programas corporativos',   'desc' => 'Programa de certificación internacional y alianzas con universidades líderes en la región.'],
        ],
        'specialty_cards' => [
            ['icon' => 'shield',   'title' => 'Gestión de Crisis Corporativa',         'desc' => 'Diseño y activación de protocolos de respuesta ante crisis de alto impacto reputacional, operativo y mediático.'],
            ['icon' => 'users',    'title' => 'Entrenamiento C-Suite',                 'desc' => 'Preparación directa de juntas directivas, CEO y presidentes para la toma de decisiones bajo presión extrema.'],
            ['icon' => 'mic',      'title' => 'Media Training Ejecutivo',              'desc' => 'Simulación de entrevistas agresivas, ruedas de prensa hostiles y entrenamiento de vocería de emergencia.'],
            ['icon' => 'brain',    'title' => 'Simulación Inmersiva',                  'desc' => 'Diseño y dirección de ejercicios de simulación de crisis con inyección de estrés y fatiga cognitiva acelerada.'],
            ['icon' => 'chart',    'title' => 'Diagnóstico de Preparación',            'desc' => 'Evaluación integral de la capacidad de respuesta de la organización ante escenarios de crisis disruptiva.'],
            ['icon' => 'building', 'title' => 'Gobierno Corporativo en Crisis',        'desc' => 'Asesoría en la integración de protocolos de crisis dentro de la estructura de gobernanza corporativa.'],
        ],
        'cases' => [
            ['title' => 'Gestión de más de 150 comités de crisis en vivo',                             'desc' => 'Dirección estratégica y operativa de comités de crisis durante contingencias de alto impacto reputacional en sectores financiero, petrolero, farmacéutico y de consumo.'],
            ['title' => 'Diseñadora del simulador de estrés directivo inmersivo',                      'desc' => 'Creación de la herramienta propietaria de simulación bajo fatiga cognitiva acelerada, adoptada por organizaciones líderes en América Latina.'],
            ['title' => 'Conferencista en foros internacionales de gobierno corporativo',                'desc' => 'Ponencias y paneles en eventos de primer nivel sobre resiliencia organizacional, liderazgo en crisis y preparación de comités ejecutivos.'],
            ['title' => 'Programa de certificación en gestión de crisis',                               'desc' => 'Diseño e implementación del programa de certificación profesional en gestión de crisis para ejecutivos de alta dirección.'],
        ],
        'publications' => [
            ['type' => 'conferencia', 'title' => 'La resiliencia estructural del comité de crisis',               'venue' => 'Foro Iberoamericano de Gobierno Corporativo', 'year' => '2024'],
            ['type' => 'artículo',    'title' => 'Fatiga cognitiva y toma de decisiones en crisis',               'venue' => 'Revista de Liderazgo Estratégico',            'year' => '2023'],
            ['type' => 'conferencia', 'title' => 'Simulación inmersiva: el futuro del entrenamiento directivo',   'venue' => 'Cumbre de Riesgo Operacional LATAM',          'year' => '2023'],
            ['type' => 'artículo',    'title' => 'El protocolo de las primeras 2 horas',                          'venue' => 'Harvard Business Review LATAM',               'year' => '2022'],
            ['type' => 'ponencia',    'title' => 'Comunicación de crisis en la era de la desinformación',         'venue' => 'World Communication Forum',                   'year' => '2022'],
        ],
    ],

    /* ────────────────────────────────────────────────────────────
       Dr. Roberto Mendoza — Estrategia Legal & Regulatoria
       ──────────────────────────────────────────────────────────── */
    'roberto-mendoza' => [
        'name'        => 'Dr. Roberto Mendoza',
        'role'        => 'Director de Estrategia Legal & Regulatoria',
        'role_short'  => 'Estrategia Legal',
        'image'       => $theme_uri . '/assets/img/roberto-mendoza.png',
        'quote'       => 'La victoria legal no sirve de nada si la organización pierde su licencia social para operar en el proceso.',
        'specialties' => ['Litigio de Alta Crisis', 'Cumplimiento Regulatorio', 'Blindaje Penal'],
        'stats'       => [
            ['number' => '+20',  'label' => 'Años en litigio corporativo'],
            ['number' => '+80',  'label' => 'Investigaciones gestionadas'],
            ['number' => '+40',  'label' => 'Reestructuraciones legales'],
            ['number' => '8',    'label' => 'Jurisdicciones internacionales'],
        ],
        'bio_extended' => [
            'El Dr. Roberto Mendoza lidera la práctica de mitigación de riesgos legales y cumplimiento normativo en The Crisis Academy. Cuenta con amplia experiencia en la coordinación entre la estrategia de defensa jurídica corporativa y la contención del impacto público y reputacional.',
            'Su enfoque integra la protección jurídica con la estrategia de comunicación, asegurando que las decisiones legales no comprometan la reputación ni la licencia social de la organización. Ha asesorado a comités de crisis en investigaciones de competencia económica, fraudes corporativos y crisis regulatorias complejas.',
            'Es reconocido como especialista en gobernanza de datos y responsabilidad jurídica de ejecutivos C-Level, siendo consultor frecuente de juntas directivas ante escenarios de escrutinio público intenso.',
        ],
        'timeline' => [
            ['year' => '2003', 'title' => 'Práctica en litigio corporativo de alto perfil',  'desc' => 'Inicio de carrera en firma jurídica internacional especializada en defensa corporativa.'],
            ['year' => '2008', 'title' => 'Investigaciones antimonopolio',                    'desc' => 'Liderazgo de estrategia legal en investigaciones de competencia económica a nivel regional.'],
            ['year' => '2014', 'title' => 'Asesoría en reestructuración bajo escrutinio',     'desc' => 'Asesor legal principal en procesos de reestructuración corporativa con impacto mediático.'],
            ['year' => '2019', 'title' => 'Incorporación a The Crisis Academy',               'desc' => 'Director de la práctica legal de crisis, integrando defensa jurídica con estrategia reputacional.'],
            ['year' => '2024', 'title' => 'Programa de blindaje penal corporativo',           'desc' => 'Diseño del programa de protección jurídica preventiva para comités directivos.'],
        ],
        'specialty_cards' => [
            ['icon' => 'shield',   'title' => 'Litigio de Alta Crisis',              'desc' => 'Estrategia de defensa jurídica en procedimientos legales de alto perfil con impacto reputacional.'],
            ['icon' => 'scale',    'title' => 'Cumplimiento Regulatorio',            'desc' => 'Auditoría y diseño de marcos de cumplimiento normativo ante inspecciones y sanciones regulatorias.'],
            ['icon' => 'lock',     'title' => 'Blindaje Penal Corporativo',          'desc' => 'Protección jurídica preventiva de ejecutivos C-Level ante responsabilidad penal corporativa.'],
            ['icon' => 'database', 'title' => 'Gobernanza de Datos',                 'desc' => 'Marcos de responsabilidad y cumplimiento en protección de datos personales y privacidad corporativa.'],
            ['icon' => 'globe',    'title' => 'Jurisdicciones Internacionales',      'desc' => 'Coordinación de estrategia legal en investigaciones y litigios que abarcan múltiples jurisdicciones.'],
            ['icon' => 'building', 'title' => 'Reestructuración Corporativa',        'desc' => 'Asesoría legal estratégica en procesos de reestructuración bajo escrutinio público e institucional.'],
        ],
        'cases' => [
            ['title' => 'Líder de estrategia legal en investigaciones de competencia económica',  'desc' => 'Coordinación de la defensa jurídica y la contención reputacional en investigaciones antimonopolio de alto perfil.'],
            ['title' => 'Asesor legal principal en reestructuraciones bajo escrutinio público',   'desc' => 'Dirección de la estrategia legal durante procesos de reestructuración corporativa con cobertura mediática intensiva.'],
            ['title' => 'Especialista en gobernanza de datos y responsabilidad C-Level',          'desc' => 'Diseño de marcos de protección jurídica para ejecutivos ante regulaciones de privacidad y protección de datos.'],
            ['title' => 'Blindaje penal en inspecciones regulatorias multinacionales',            'desc' => 'Estrategia de contención legal durante inspecciones regulatorias simultáneas en múltiples jurisdicciones.'],
        ],
        'publications' => [
            ['type' => 'artículo',    'title' => 'La licencia social como activo jurídico',                   'venue' => 'Revista de Derecho Corporativo',             'year' => '2024'],
            ['type' => 'conferencia', 'title' => 'Responsabilidad penal del ejecutivo en crisis',             'venue' => 'Congreso LATAM de Cumplimiento',             'year' => '2023'],
            ['type' => 'artículo',    'title' => 'Integración legal-reputacional en la respuesta a crisis',   'venue' => 'Journal of Corporate Governance',            'year' => '2023'],
            ['type' => 'ponencia',    'title' => 'Gobernanza de datos en escenarios de crisis',               'venue' => 'Foro Internacional de Privacidad Digital',   'year' => '2022'],
        ],
    ],

    /* ────────────────────────────────────────────────────────────
       Ing. Elena Vásquez — Ciberseguridad & Incidencias
       ──────────────────────────────────────────────────────────── */
    'elena-vasquez' => [
        'name'        => 'Ing. Elena Vásquez',
        'role'        => 'Directora de Ciberseguridad & Respuesta a Incidentes',
        'role_short'  => 'Ciberseguridad',
        'image'       => $theme_uri . '/assets/img/elena-vasquez.png',
        'quote'       => 'En una cibercrisis, la transparencia técnica combinada con una comunicación adecuada es la única vacuna contra el pánico institucional.',
        'specialties' => ['Cibercrisis & Ransomware', 'Inteligencia de Amenazas', 'Forense Digital'],
        'stats'       => [
            ['number' => '+15',  'label' => 'Años en ciberseguridad'],
            ['number' => '+120', 'label' => 'Incidentes de ransomware'],
            ['number' => '+60',  'label' => 'Protocolos de continuidad'],
            ['number' => '< 4h', 'label' => 'Tiempo de contención promedio'],
        ],
        'bio_extended' => [
            'Elena Vásquez ha dedicado más de 15 años a la respuesta técnica e institucional ante desastres de seguridad informática. Ha liderado la respuesta ejecutiva ante secuestro masivo de datos (Ransomware), fuga de información sensible de clientes y fallas críticas en sistemas bancarios.',
            'Su enfoque único combina la contención técnica con la gestión estratégica de la comunicación durante cibercrisis, trabajando directamente con comités de crisis para coordinar respuestas que protegen tanto los activos digitales como la reputación corporativa.',
            'Es miembro de comités consultivos de seguridad de la información en el sector financiero y ha participado en la creación de marcos normativos de ciberseguridad a nivel regional.',
        ],
        'timeline' => [
            ['year' => '2008', 'title' => 'Inicio en seguridad informática',                       'desc' => 'Análisis de vulnerabilidades y respuesta a incidentes en infraestructura bancaria crítica.'],
            ['year' => '2012', 'title' => 'Liderazgo en respuesta a ciberataques',                  'desc' => 'Primera respuesta ejecutiva ante ataque de ransomware masivo en institución financiera regional.'],
            ['year' => '2016', 'title' => 'Inteligencia de amenazas y forense digital',             'desc' => 'Desarrollo de capacidades de threat intelligence y análisis forense post-incidente.'],
            ['year' => '2020', 'title' => 'Incorporación a The Crisis Academy',                     'desc' => 'Directora de la práctica de ciberseguridad, integrando respuesta técnica con gestión ejecutiva de crisis.'],
            ['year' => '2024', 'title' => 'Programa de simulación de cibercrisis',                  'desc' => 'Diseño del simulador de cibercrisis para entrenamiento de comités directivos ante ataques sofisticados.'],
        ],
        'specialty_cards' => [
            ['icon' => 'shield',   'title' => 'Respuesta a Ransomware',                 'desc' => 'Contención técnica y negociación estratégica ante secuestro de datos y ciberextorsión a escala empresarial.'],
            ['icon' => 'radar',    'title' => 'Inteligencia de Amenazas',                'desc' => 'Monitoreo proactivo y análisis de amenazas emergentes para la prevención de ciberataques dirigidos.'],
            ['icon' => 'search',   'title' => 'Forense Digital',                         'desc' => 'Investigación técnica post-incidente para la identificación de vectores de ataque y evidencia digital.'],
            ['icon' => 'server',   'title' => 'Continuidad Tecnológica',                 'desc' => 'Diseño de protocolos de recuperación ante caídas catastróficas de infraestructura tecnológica.'],
            ['icon' => 'lock',     'title' => 'Protección de Datos Sensibles',           'desc' => 'Estrategias de contención ante fugas de información sensible de clientes y datos regulados.'],
            ['icon' => 'alert',    'title' => 'Comunicación de Cibercrisis',             'desc' => 'Coordinación de la comunicación técnica y pública durante incidentes de seguridad de alto impacto.'],
        ],
        'cases' => [
            ['title' => 'Negociación y contención en +120 incidentes de ransomware',                 'desc' => 'Gestión técnica y estratégica de ciberextorsiones masivas en sectores financiero, salud y energético.'],
            ['title' => 'Diseño de protocolos de continuidad ante caídas catastróficas',              'desc' => 'Creación de frameworks de recuperación ante la pérdida total de infraestructura tecnológica crítica.'],
            ['title' => 'Miembro de comités consultivos de seguridad del sector financiero',           'desc' => 'Participación activa en la definición de estándares de ciberseguridad para instituciones financieras reguladas.'],
            ['title' => 'Respuesta ejecutiva ante fuga de datos de millones de clientes',             'desc' => 'Coordinación de la contención técnica, comunicación y remediación ante una brecha de datos masiva.'],
        ],
        'publications' => [
            ['type' => 'artículo',    'title' => 'Transparencia técnica en cibercrisis: un marco de acción',     'venue' => 'Cybersecurity Journal LATAM',                 'year' => '2024'],
            ['type' => 'conferencia', 'title' => 'La hora dorada del ransomware: qué hacer en los primeros 60 minutos', 'venue' => 'Congreso de Seguridad Informática', 'year' => '2023'],
            ['type' => 'artículo',    'title' => 'Forense digital como herramienta de gestión de crisis',        'venue' => 'IEEE Security & Privacy',                    'year' => '2023'],
            ['type' => 'ponencia',    'title' => 'El rol del CISO en la sala de crisis',                         'venue' => 'RSA Conference LATAM',                       'year' => '2022'],
        ],
    ],

    /* ────────────────────────────────────────────────────────────
       Marcelo Álvarez — Comunicación & Media Training
       ──────────────────────────────────────────────────────────── */
    'marcelo-alvarez' => [
        'name'        => 'Marcelo Álvarez',
        'role'        => 'Director de Comunicación Estratégica & Media Training',
        'role_short'  => 'Comunicación Estratégica',
        'image'       => $theme_uri . '/assets/img/marcelo-alvarez.png',
        'quote'       => 'El silencio en las primeras dos horas de una crisis no es prudencia: es la cesión voluntaria de tu narrativa a tus detractores.',
        'specialties' => ['Vocería de Emergencia', 'Gestión de Fake News', 'Restauración de Imagen'],
        'stats'       => [
            ['number' => '+20',  'label' => 'Años en comunicación de crisis'],
            ['number' => '+800', 'label' => 'Voceros entrenados'],
            ['number' => '+200', 'label' => 'Simulaciones de prensa'],
            ['number' => '15+',  'label' => 'Países de operación'],
        ],
        'bio_extended' => [
            'Marcelo Álvarez aporta más de dos décadas de experiencia combinada entre el periodismo de investigación y la consultoría estratégica de comunicación de crisis. Es el diseñador del simulador de salas de prensa y entrevistas agresivas en vivo de The Crisis Academy.',
            'Su trayectoria como ex-director de noticieros de televisión le otorga una perspectiva única: entiende cómo operan los medios desde dentro, lo que le permite anticipar las narrativas mediáticas y preparar voceros que dominen la entrevista antes de que comience.',
            'Ha entrenado a más de 800 CEO, voceros y directores institucionales para enfrentar la presión en vivo, desde conferencias de prensa hostiles hasta campañas de desinformación coordinadas en redes sociales.',
        ],
        'timeline' => [
            ['year' => '2002', 'title' => 'Periodismo de investigación',                          'desc' => 'Inicio como periodista de investigación en medios nacionales de alto alcance.'],
            ['year' => '2007', 'title' => 'Dirección de noticieros de televisión',                 'desc' => 'Director editorial de noticieros en televisión nacional, gestionando coberturas de crisis.'],
            ['year' => '2013', 'title' => 'Consultoría de comunicación de crisis',                 'desc' => 'Transición a la consultoría estratégica, entrenando voceros ejecutivos de multinacionales.'],
            ['year' => '2019', 'title' => 'Incorporación a The Crisis Academy',                    'desc' => 'Director de comunicación, diseñando el simulador de salas de prensa hostiles y media training.'],
            ['year' => '2024', 'title' => 'Programa anti-desinformación corporativa',              'desc' => 'Lanzamiento del módulo de contención y respuesta ante campañas de fake news coordinadas.'],
        ],
        'specialty_cards' => [
            ['icon' => 'mic',      'title' => 'Vocería de Emergencia',                  'desc' => 'Entrenamiento intensivo de voceros para comparecencias en vivo bajo máxima presión mediática.'],
            ['icon' => 'shield',   'title' => 'Contención de Fake News',                'desc' => 'Estrategias de monitoreo, detección y respuesta ante campañas de desinformación organizadas.'],
            ['icon' => 'refresh',  'title' => 'Restauración de Imagen',                 'desc' => 'Diseño e implementación de planes de recuperación reputacional post-crisis a medio y largo plazo.'],
            ['icon' => 'tv',       'title' => 'Simulación de Salas de Prensa',          'desc' => 'Ejercicios inmersivos de rueda de prensa hostil con periodistas profesionales como antagonistas.'],
            ['icon' => 'globe',    'title' => 'Comunicación Digital de Crisis',         'desc' => 'Gestión de la narrativa en redes sociales, medios digitales y ecosistemas de información durante crisis.'],
            ['icon' => 'chart',    'title' => 'Análisis de Geopolítica Mediática',      'desc' => 'Evaluación del contexto mediático y político para la calibración de mensajes estratégicos.'],
        ],
        'cases' => [
            ['title' => 'Entrenamiento de +800 CEO y voceros ejecutivos',                               'desc' => 'Preparación personalizada para enfrentar entrevistas agresivas, conferencias hostiles y crisis en vivo.'],
            ['title' => 'Estratega de contención ante campañas de desinformación',                       'desc' => 'Coordinación de respuesta ante ataques informativos coordinados en redes sociales contra marcas multinacionales.'],
            ['title' => 'Ex-director de noticieros de televisión nacional',                              'desc' => 'Experiencia directa en la toma de decisiones editoriales durante coberturas de crisis de alto impacto.'],
            ['title' => 'Diseñador del simulador de entrevistas agresivas en vivo',                      'desc' => 'Creación de la metodología propietaria de media training bajo presión con periodistas profesionales.'],
        ],
        'publications' => [
            ['type' => 'artículo',    'title' => 'Las primeras 2 horas: la batalla por la narrativa',             'venue' => 'Comunicación & Sociedad',                    'year' => '2024'],
            ['type' => 'conferencia', 'title' => 'Fake news corporativas: cómo detectar y contener',              'venue' => 'Cumbre de Comunicación Estratégica',          'year' => '2023'],
            ['type' => 'artículo',    'title' => 'El vocero como activo estratégico en crisis',                    'venue' => 'Journal of Strategic Communication',          'year' => '2023'],
            ['type' => 'ponencia',    'title' => 'De la redacción a la sala de crisis: lecciones del periodismo', 'venue' => 'Festival de Medios LATAM',                    'year' => '2022'],
        ],
    ],

    /* ────────────────────────────────────────────────────────────
       Dra. Valeria Gómez — Psicología & Estrés en Crisis
       ──────────────────────────────────────────────────────────── */
    'valeria-gomez' => [
        'name'        => 'Dra. Valeria Gómez',
        'role'        => 'Directora de Psicología Organizacional & Estrés en Crisis',
        'role_short'  => 'Psicología Organizacional',
        'image'       => $theme_uri . '/assets/img/valeria-gomez.png',
        'quote'       => 'La claridad mental del líder en momentos de caos es la ventaja competitiva más valiosa de una empresa.',
        'specialties' => ['Fatiga Cognitiva', 'Toma de Decisiones', 'Resiliencia de Comités'],
        'stats'       => [
            ['number' => '+18',  'label' => 'Años en neuropsicología'],
            ['number' => '+500', 'label' => 'Evaluaciones de sesgo ejecutivo'],
            ['number' => '+30',  'label' => 'Intervenciones poscrisis'],
            ['number' => '5',    'label' => 'Publicaciones internacionales'],
        ],
        'bio_extended' => [
            'La Dra. Valeria Gómez es especialista en la neuropsicología del liderazgo bajo presión extrema. Su labor en The Crisis Academy se enfoca en preparar la mentalidad directiva para operar en escenarios de alta incertidumbre y mitigar los efectos del agotamiento cognitivo.',
            'Doctora en Neuropsicología del Trabajo, ha desarrollado marcos de evaluación de sesgos cognitivos específicos para situaciones de emergencia corporativa, identificando los patrones de pánico y parálisis por análisis que afectan a los directivos en momentos críticos.',
            'Su trabajo en procesos de poscrisis se centra en la recuperación de la confianza y el bienestar de los equipos humanos, reconociendo que el impacto psicológico de una crisis organizacional se extiende mucho más allá de la contingencia inmediata.',
        ],
        'timeline' => [
            ['year' => '2005', 'title' => 'Doctorado en Neuropsicología del Trabajo',                 'desc' => 'Investigación sobre toma de decisiones bajo estrés y fatiga cognitiva en entornos corporativos.'],
            ['year' => '2010', 'title' => 'Consultoría en psicología organizacional',                  'desc' => 'Asesoría a organizaciones en evaluación de capacidades cognitivas de equipos directivos.'],
            ['year' => '2015', 'title' => 'Marco de evaluación de sesgos cognitivos',                  'desc' => 'Desarrollo del framework de detección de sesgos de pánico y parálisis en situaciones de emergencia.'],
            ['year' => '2020', 'title' => 'Incorporación a The Crisis Academy',                        'desc' => 'Directora de la práctica de psicología organizacional, integrando neurociencia con gestión de crisis.'],
            ['year' => '2024', 'title' => 'Programa de resiliencia directiva poscrisis',               'desc' => 'Diseño del protocolo de recuperación psicológica organizacional tras eventos de crisis severa.'],
        ],
        'specialty_cards' => [
            ['icon' => 'brain',    'title' => 'Fatiga Cognitiva Ejecutiva',              'desc' => 'Diagnóstico y mitigación del agotamiento cognitivo en directivos durante operaciones de crisis prolongadas.'],
            ['icon' => 'chart',    'title' => 'Toma de Decisiones bajo Presión',         'desc' => 'Entrenamiento para optimizar la calidad de las decisiones estratégicas en entornos de incertidumbre extrema.'],
            ['icon' => 'shield',   'title' => 'Resiliencia de Comités',                  'desc' => 'Fortalecimiento de la cohesión y rendimiento de equipos directivos antes, durante y después de una crisis.'],
            ['icon' => 'search',   'title' => 'Evaluación de Sesgos Cognitivos',         'desc' => 'Identificación de sesgos de confirmación, pánico y parálisis por análisis en tomadores de decisiones.'],
            ['icon' => 'heart',    'title' => 'Recuperación Poscrisis',                  'desc' => 'Protocolos de intervención psicológica para la restauración de la confianza y bienestar de equipos.'],
            ['icon' => 'users',    'title' => 'Psicología del Liderazgo',                'desc' => 'Desarrollo de capacidades de liderazgo adaptativo para escenarios de alta complejidad e incertidumbre.'],
        ],
        'cases' => [
            ['title' => 'Marco de evaluación de sesgos cognitivos en emergencias',                    'desc' => 'Desarrollo del framework propietario para la detección de patrones de pánico y parálisis en directivos.'],
            ['title' => 'Intervención en procesos de poscrisis organizacional',                        'desc' => 'Recuperación de la confianza y cohesión de equipos humanos tras crisis corporativas de alto impacto.'],
            ['title' => 'Publicaciones internacionales en comportamiento organizacional',              'desc' => 'Investigación publicada en journals de primer nivel sobre resiliencia y neuropsicología del trabajo.'],
            ['title' => 'Protocolo de resiliencia directiva bajo fatiga acelerada',                    'desc' => 'Diseño de programas de entrenamiento cognitivo para mantener la claridad mental en crisis prolongadas.'],
        ],
        'publications' => [
            ['type' => 'artículo',    'title' => 'Sesgos cognitivos en la sala de crisis: un modelo de intervención',  'venue' => 'Journal of Organizational Behavior',         'year' => '2024'],
            ['type' => 'artículo',    'title' => 'La resiliencia como competencia directiva entrenada',                 'venue' => 'Psychological Science in the Public Interest','year' => '2023'],
            ['type' => 'conferencia', 'title' => 'Neurociencia aplicada al liderazgo en crisis',                        'venue' => 'Congreso Iberoamericano de Psicología',       'year' => '2023'],
            ['type' => 'artículo',    'title' => 'Fatiga de decisión y su impacto en la gestión de emergencias',        'venue' => 'Journal of Crisis Management',                'year' => '2022'],
            ['type' => 'ponencia',    'title' => 'El cerebro del CEO bajo presión: hallazgos y aplicaciones',           'venue' => 'TEDx LATAM',                                  'year' => '2021'],
        ],
    ],

    /* ────────────────────────────────────────────────────────────
       Capitán Fernando Silva — Incidentes Operativos & BCP
       ──────────────────────────────────────────────────────────── */
    'fernando-silva' => [
        'name'        => 'Capitán Fernando Silva',
        'role'        => 'Director de Manejo de Incidentes Operativos & BCP',
        'role_short'  => 'Incidentes Operativos',
        'image'       => $theme_uri . '/assets/img/fernando-silva.png',
        'quote'       => 'Un plan de continuidad que solo existe en papel es una ilusión que se derrumba al primer minuto de un evento real.',
        'specialties' => ['Planes de Continuidad (BCP)', 'Cadena de Suministro', 'Evacuación & Seguridad'],
        'stats'       => [
            ['number' => '+22',  'label' => 'Años en operaciones de emergencia'],
            ['number' => '+40',  'label' => 'Sistemas BCP certificados ISO 22301'],
            ['number' => '+70',  'label' => 'Emergencias industriales comandadas'],
            ['number' => '6',    'label' => 'Continentes de operación'],
        ],
        'bio_extended' => [
            'El Capitán Fernando Silva aporta su vasta experiencia en el comando unificado de incidentes físicos y logísticos. Especialista en auditoría de planes de continuidad de negocio (BCP), evacuación de personal e interrupciones en la cadena de suministros globales.',
            'Ex-Comandante de Operaciones de Emergencia, ha liderado la respuesta directa ante emergencias industriales, desastres naturales y crisis logísticas que han afectado a multinacionales en múltiples continentes.',
            'Su enfoque se centra en garantizar que los planes de continuidad no sean documentos teóricos, sino protocolos vivos que funcionan bajo la presión de un evento real, verificados mediante ejercicios de simulación operativa rigurosos.',
        ],
        'timeline' => [
            ['year' => '2001', 'title' => 'Comando de operaciones de emergencia',                     'desc' => 'Inicio de carrera en manejo de emergencias industriales y logísticas de alto riesgo.'],
            ['year' => '2006', 'title' => 'Auditoría de continuidad operativa ISO 22301',              'desc' => 'Certificación y auditoría de sistemas de continuidad de negocio en multinacionales.'],
            ['year' => '2012', 'title' => 'Respuesta ante desastres naturales',                        'desc' => 'Comando de operaciones de evacuación y recuperación ante eventos catastróficos regionales.'],
            ['year' => '2018', 'title' => 'Incorporación a The Crisis Academy',                        'desc' => 'Director de incidentes operativos, integrando BCP con gestión ejecutiva de crisis.'],
            ['year' => '2024', 'title' => 'Programa de resiliencia de cadena de suministro',           'desc' => 'Diseño del módulo de continuidad logística ante disrupciones globales de cadena de suministro.'],
        ],
        'specialty_cards' => [
            ['icon' => 'clipboard','title' => 'Planes de Continuidad (BCP)',             'desc' => 'Diseño, auditoría y certificación de planes de continuidad de negocio bajo estándares ISO 22301.'],
            ['icon' => 'truck',    'title' => 'Cadena de Suministro',                    'desc' => 'Gestión de interrupciones logísticas globales y reactivación de cadenas de suministro críticas.'],
            ['icon' => 'alert',    'title' => 'Evacuación & Seguridad',                  'desc' => 'Protocolos de evacuación de personal, activos e información en escenarios de emergencia física.'],
            ['icon' => 'building', 'title' => 'Emergencias Industriales',                'desc' => 'Comando operativo ante incidentes industriales con riesgo para personas, medio ambiente y operaciones.'],
            ['icon' => 'globe',    'title' => 'Operaciones Multinacionales',             'desc' => 'Coordinación de respuesta a crisis operativas que afectan múltiples sedes en diferentes jurisdicciones.'],
            ['icon' => 'refresh',  'title' => 'Reactivación Operativa',                  'desc' => 'Planificación y ejecución de la recuperación operativa tras incidentes que interrumpen la producción.'],
        ],
        'cases' => [
            ['title' => 'Comando directo de emergencias industriales multinacionales',                 'desc' => 'Liderazgo operativo en la respuesta ante incidentes industriales de alto riesgo en plantas de manufactura global.'],
            ['title' => 'Certificación de +40 sistemas BCP bajo normas ISO 22301',                     'desc' => 'Auditoría y certificación de planes de continuidad operativa en sectores energético, financiero y manufacturero.'],
            ['title' => 'Consultor de evacuación en zonas de alto riesgo operativo',                    'desc' => 'Diseño e implementación de protocolos de evacuación para instalaciones en entornos geográficos de alto riesgo.'],
            ['title' => 'Resiliencia de cadena de suministro ante disrupciones globales',              'desc' => 'Asesoría en la diversificación y fortalecimiento de cadenas logísticas ante eventos de disrupción global.'],
        ],
        'publications' => [
            ['type' => 'artículo',    'title' => 'Del papel al simulacro: planes BCP que funcionan',               'venue' => 'Journal of Business Continuity',             'year' => '2024'],
            ['type' => 'conferencia', 'title' => 'La cadena de suministro como punto crítico de crisis',           'venue' => 'Foro Global de Logística & Riesgo',          'year' => '2023'],
            ['type' => 'artículo',    'title' => 'Comando unificado en emergencias industriales complejas',        'venue' => 'Emergency Management Review',                'year' => '2023'],
            ['type' => 'ponencia',    'title' => 'Lecciones de evacuación en zona cero',                           'venue' => 'Congreso LATAM de Seguridad Industrial',     'year' => '2022'],
        ],
    ],
];
