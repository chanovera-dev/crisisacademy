<?php
/**
 * Auto-import Carolina Eslava post and categories into team_member CPT
 *
 * Theme: The Crisis Academy
 */

if (!defined('ABSPATH')) {
    exit;
}

function crisisacademy_auto_import_carolina_eslava() {
    // Only run if team_member post type exists
    if (!post_type_exists('team_member')) {
        return;
    }

    // Check if categories exist, if not create them
    $categories = [
        'leadership' => 'Dirección',
        'comms'      => 'Comunicación',
        'cyber'      => 'Ciberseguridad',
        'legal'      => 'Legal',
        'ops'        => 'Operaciones',
    ];

    $cat_ids = [];
    foreach ($categories as $slug => $name) {
        $term = get_term_by('slug', $slug, 'team_category');
        if (!$term) {
            $inserted = wp_insert_term($name, 'team_category', ['slug' => $slug]);
            if (!is_wp_error($inserted)) {
                $cat_ids[$slug] = $inserted['term_id'];
            }
        } else {
            $cat_ids[$slug] = $term->term_id;
        }
    }

    // Check if Carolina Eslava post already exists
    $existing = get_posts([
        'post_type'   => 'team_member',
        'name'        => 'carolina-eslava',
        'post_status' => 'any',
        'numberposts' => 1,
    ]);

    if (!empty($existing)) {
        return; // Already imported
    }

    // Create post for Carolina Eslava
    $post_id = wp_insert_post([
        'post_title'   => 'Carolina Eslava',
        'post_name'    => 'carolina-eslava',
        'post_status'  => 'publish',
        'post_type'    => 'team_member',
        'post_content' => 'Carolina Eslava es una de las referentes más destacadas en la gestión y entrenamiento de comités de crisis directivos en América Latina.',
        'post_excerpt' => '25 años formando y preparando comités de crisis en multinacionales frente a escenarios de alta complejidad operativa, reputacional y mediática.',
    ]);

    if (is_wp_error($post_id) || !$post_id) {
        return;
    }

    // Assign categories
    if (!empty($cat_ids['leadership']) && !empty($cat_ids['comms'])) {
        wp_set_object_terms($post_id, [$cat_ids['leadership'], $cat_ids['comms']], 'team_category');
    }

    // Attach featured image if asset file exists
    $image_path = get_stylesheet_directory() . '/assets/img/carolina-eslava.webp';
    if (file_exists($image_path)) {
        // Find existing attachment or insert
        $attachment = get_posts([
            'post_type'   => 'attachment',
            'meta_key'    => '_wp_attached_file',
            'meta_value'  => 'carolina-eslava.webp',
            'numberposts' => 1,
        ]);

        if (!empty($attachment)) {
            set_post_thumbnail($post_id, $attachment[0]->ID);
        } else {
            // Include image handing functions
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            // Copy asset image to uploads directory
            $upload_dir = wp_upload_dir();
            $filename   = 'carolina-eslava.webp';
            $target     = $upload_dir['path'] . '/' . $filename;

            if (@copy($image_path, $target)) {
                $filetype = wp_check_filetype($filename, null);
                $attachment_data = [
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => sanitize_file_name($filename),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                ];
                $attach_id = wp_insert_attachment($attachment_data, $target, $post_id);
                if (!is_wp_error($attach_id)) {
                    $attach_data = wp_generate_attachment_metadata($attach_id, $target);
                    wp_update_attachment_metadata($attach_id, $attach_data);
                    set_post_thumbnail($post_id, $attach_id);
                }
            }
        }
    }

    // Populate ACF Fields if ACF is available
    if (function_exists('update_field')) {
        update_field('team_role', 'Fundadora & Directora General de The Crisis Academy', $post_id);
        update_field('team_role_short', 'Fundadora & Directora', $post_id);
        update_field('team_summary', '25 años formando y preparando comités de crisis en multinacionales frente a escenarios de alta complejidad operativa, reputacional y mediática.', $post_id);
        update_field('team_quote', 'Una crisis no pone a prueba tus comunicados de prensa; pone a prueba la resiliencia estructural y la velocidad de toma de decisiones de tu comité ejecutivo.', $post_id);
        update_field('team_is_founder', true, $post_id);

        // Specialties
        update_field('team_specialties', [
            ['specialty_name' => 'Gestión de Crisis'],
            ['specialty_name' => 'Liderazgo Ejecutivo'],
            ['specialty_name' => 'Media Training C-Suite'],
        ], $post_id);

        // Stats
        update_field('team_stats', [
            ['stat_number' => '+25', 'stat_label' => 'Años de experiencia'],
            ['stat_number' => '+2,000', 'stat_label' => 'Ejecutivos capacitados'],
            ['stat_number' => '+150', 'stat_label' => 'Comités de crisis guiados'],
            ['stat_number' => '12+', 'stat_label' => 'Sectores industriales'],
        ], $post_id);

        // Bio Extended
        update_field('team_bio_extended', [
            ['paragraph' => 'Carolina Eslava es una de las referentes más destacadas en la gestión y entrenamiento de comités de crisis directivos en América Latina. Con más de 25 años de trayectoria profesional, ha asesorado a juntas directivas y presidentes de multinacionales de los sectores petrolero, financiero, farmacéutico y de consumo masivo.'],
            ['paragraph' => 'Fundó The Crisis Academy con la convicción de que la preparación proactiva de los comités ejecutivos ante escenarios de crisis es la diferencia entre una organización que sobrevive y una que se fortalece. Su enfoque combina rigor académico con simulación inmersiva activa, entrenando la toma de decisiones bajo fatiga cognitiva acelerada.'],
            ['paragraph' => 'Carolina es la diseñadora del simulador de estrés directivo inmersivo bajo fatiga cognitiva acelerada, una herramienta propietaria que ha sido adoptada por organizaciones líderes en toda la región para la evaluación y fortalecimiento de sus equipos de crisis.'],
        ], $post_id);

        // Timeline
        update_field('team_timeline', [
            ['year' => '2000', 'title' => 'Inicio en consultoría de crisis', 'description' => 'Primeros proyectos de asesoría en gestión de crisis reputacional para el sector financiero.'],
            ['year' => '2006', 'title' => 'Dirección de crisis multisectoriales', 'description' => 'Liderazgo de comités de crisis en multinacionales petroleras y farmacéuticas de alta complejidad.'],
            ['year' => '2012', 'title' => 'Desarrollo del simulador inmersivo', 'description' => 'Creación del simulador de estrés directivo bajo fatiga cognitiva acelerada, herramienta propietaria de TCA.'],
            ['year' => '2018', 'title' => 'Fundación de The Crisis Academy', 'description' => 'Establecimiento de la academia como centro de excelencia en formación de comités de crisis.'],
            ['year' => '2023', 'title' => 'Expansión regional & programas corporativos', 'description' => 'Programa de certificación internacional y alianzas con universidades líderes en la región.'],
        ], $post_id);

        // Specialty Cards
        update_field('team_specialty_cards', [
            ['icon' => 'shield', 'title' => 'Gestión de Crisis Corporativa', 'description' => 'Diseño y activación de protocolos de respuesta ante crisis de alto impacto reputacional, operativo y mediático.'],
            ['icon' => 'users', 'title' => 'Entrenamiento C-Suite', 'description' => 'Preparación directa de juntas directivas, CEO y presidentes para la toma de decisiones bajo presión extrema.'],
            ['icon' => 'mic', 'title' => 'Media Training Ejecutivo', 'description' => 'Simulación de entrevistas agresivas, ruedas de prensa hostiles y entrenamiento de vocería de emergencia.'],
            ['icon' => 'brain', 'title' => 'Simulación Inmersiva', 'description' => 'Diseño y dirección de ejercicios de simulación de crisis con inyección de estrés y fatiga cognitiva acelerada.'],
            ['icon' => 'chart', 'title' => 'Diagnóstico de Preparación', 'description' => 'Evaluación integral de la capacidad de respuesta de la organización ante escenarios de crisis disruptiva.'],
            ['icon' => 'building', 'title' => 'Gobierno Corporativo en Crisis', 'description' => 'Asesoría en la integración de protocolos de crisis dentro de la estructura de gobernanza corporativa.'],
        ], $post_id);

        // Cases
        update_field('team_cases', [
            ['case_title' => 'Gestión de más de 150 comités de crisis en vivo', 'case_description' => 'Dirección estratégica y operativa de comités de crisis durante contingencias de alto impacto reputacional en sectores financiero, petrolero, farmacéutico y de consumo.'],
            ['case_title' => 'Diseñadora del simulador de estrés directivo inmersivo', 'case_description' => 'Creación de la herramienta propietaria de simulación bajo fatiga cognitiva acelerada, adoptada por organizaciones líderes en América Latina.'],
            ['case_title' => 'Conferencista en foros internacionales de gobierno corporativo', 'case_description' => 'Ponencias y paneles en eventos de primer nivel sobre resiliencia organizacional, liderazgo en crisis y preparación de comités ejecutivos.'],
            ['case_title' => 'Programa de certificación en gestión de crisis', 'case_description' => 'Diseño e implementación del programa de certificación profesional en gestión de crisis para ejecutivos de alta dirección.'],
        ], $post_id);

        // Publications
        update_field('team_publications', [
            ['pub_type' => 'conferencia', 'pub_title' => 'La resiliencia estructural del comité de crisis', 'pub_venue' => 'Foro Iberoamericano de Gobierno Corporativo', 'pub_year' => '2024'],
            ['pub_type' => 'artículo', 'pub_title' => 'Fatiga cognitiva y toma de decisiones en crisis', 'pub_venue' => 'Revista de Liderazgo Estratégico', 'pub_year' => '2023'],
            ['pub_type' => 'conferencia', 'pub_title' => 'Simulación inmersiva: el futuro del entrenamiento directivo', 'pub_venue' => 'Cumbre de Riesgo Operacional LATAM', 'pub_year' => '2023'],
            ['pub_type' => 'artículo', 'pub_title' => 'El protocolo de las primeras 2 horas', 'pub_venue' => 'Harvard Business Review LATAM', 'pub_year' => '2022'],
            ['pub_type' => 'ponencia', 'pub_title' => 'Comunicación de crisis en la era de la desinformación', 'pub_venue' => 'World Communication Forum', 'pub_year' => '2022'],
        ], $post_id);
    }
}
add_action('init', 'crisisacademy_auto_import_carolina_eslava', 20);
