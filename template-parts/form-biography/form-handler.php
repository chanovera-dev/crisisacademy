<?php
/**
 * Form Biography — POST Processing, CPT Auto-Creation & Email Handler
 * Theme: The Crisis Academy
 */

if (!defined('ABSPATH')) exit;

$form_submitted = false;
$form_success   = false;
$created_post_url = '';
$error_message  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tca_bio_nonce'])) {
    $form_submitted = true;

    // 1. Verify Nonce
    if (!wp_verify_nonce($_POST['tca_bio_nonce'], 'tca_submit_biography_form')) {
        $error_message = 'La verificación de seguridad ha fallado. Por favor recarga la página e intenta de nuevo.';
    } else {

        // 2. Sanitize Main Fields
        $full_name   = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
        $role_full   = isset($_POST['role_full']) ? sanitize_text_field($_POST['role_full']) : '';
        $role_short  = isset($_POST['role_short']) ? sanitize_text_field($_POST['role_short']) : '';
        $categories  = isset($_POST['categories']) && is_array($_POST['categories']) ? array_map('sanitize_text_field', $_POST['categories']) : [];
        $summary     = isset($_POST['summary']) ? sanitize_textarea_field($_POST['summary']) : '';
        $quote       = isset($_POST['quote']) ? sanitize_textarea_field($_POST['quote']) : '';

        // 3. Repeaters
        // Stats
        $stats_numbers = isset($_POST['stat_number']) && is_array($_POST['stat_number']) ? array_map('sanitize_text_field', $_POST['stat_number']) : [];
        $stats_labels  = isset($_POST['stat_label']) && is_array($_POST['stat_label']) ? array_map('sanitize_text_field', $_POST['stat_label']) : [];

        // Specialties
        $specialties = isset($_POST['specialty_name']) && is_array($_POST['specialty_name']) ? array_map('sanitize_text_field', $_POST['specialty_name']) : [];

        // Bio Paragraphs
        $paragraphs = isset($_POST['paragraph']) && is_array($_POST['paragraph']) ? array_map('sanitize_textarea_field', $_POST['paragraph']) : [];

        // Timeline
        $tl_years  = isset($_POST['tl_year']) && is_array($_POST['tl_year']) ? array_map('sanitize_text_field', $_POST['tl_year']) : [];
        $tl_titles = isset($_POST['tl_title']) && is_array($_POST['tl_title']) ? array_map('sanitize_text_field', $_POST['tl_title']) : [];
        $tl_descs  = isset($_POST['tl_desc']) && is_array($_POST['tl_desc']) ? array_map('sanitize_textarea_field', $_POST['tl_desc']) : [];

        // Specialty Cards
        $card_titles = isset($_POST['card_title']) && is_array($_POST['card_title']) ? array_map('sanitize_text_field', $_POST['card_title']) : [];
        $card_descs  = isset($_POST['card_desc']) && is_array($_POST['card_desc']) ? array_map('sanitize_textarea_field', $_POST['card_desc']) : [];

        // Cases
        $case_titles = isset($_POST['case_title']) && is_array($_POST['case_title']) ? array_map('sanitize_text_field', $_POST['case_title']) : [];
        $case_descs  = isset($_POST['case_desc']) && is_array($_POST['case_desc']) ? array_map('sanitize_textarea_field', $_POST['case_desc']) : [];

        // Publications
        $pub_types  = isset($_POST['pub_type']) && is_array($_POST['pub_type']) ? array_map('sanitize_text_field', $_POST['pub_type']) : [];
        $pub_titles = isset($_POST['pub_title']) && is_array($_POST['pub_title']) ? array_map('sanitize_text_field', $_POST['pub_title']) : [];
        $pub_venues = isset($_POST['pub_venue']) && is_array($_POST['pub_venue']) ? array_map('sanitize_text_field', $_POST['pub_venue']) : [];
        $pub_years  = isset($_POST['pub_year']) && is_array($_POST['pub_year']) ? array_map('sanitize_text_field', $_POST['pub_year']) : [];

        if (empty($full_name)) {
            $error_message = 'Por favor ingresa tu nombre completo.';
        }

        if (empty($error_message)) {
            // 4. Create Post in team_member CPT
            $post_data = [
                'post_title'   => $full_name,
                'post_name'    => sanitize_title($full_name),
                'post_status'  => 'publish',
                'post_type'    => 'team_member',
                'post_excerpt' => $summary,
                'post_content' => !empty($paragraphs) ? implode("\n\n", $paragraphs) : $summary,
            ];

            $post_id = wp_insert_post($post_data);

            if (is_wp_error($post_id) || !$post_id) {
                $error_message = 'Error al guardar la entrada del miembro del equipo.';
            } else {
                $created_post_url = get_permalink($post_id);

                // 5. Handle File Upload & Set Featured Image
                $attachments = [];
                if (!empty($_FILES['profile_photo']['name'])) {
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    require_once(ABSPATH . 'wp-admin/includes/media.php');

                    $uploadedfile = $_FILES['profile_photo'];
                    $upload_overrides = ['test_form' => false];
                    $movefile = wp_handle_upload($uploadedfile, $upload_overrides);

                    if ($movefile && !isset($movefile['error'])) {
                        $filename = $movefile['file'];
                        $attachments[] = $filename;

                        $filetype = wp_check_filetype(basename($filename), null);
                        $attachment_data = [
                            'post_mime_type' => $filetype['type'],
                            'post_title'     => sanitize_file_name(basename($filename)),
                            'post_content'   => '',
                            'post_status'    => 'inherit'
                        ];
                        $attach_id = wp_insert_attachment($attachment_data, $filename, $post_id);
                        if (!is_wp_error($attach_id)) {
                            $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                            wp_update_attachment_metadata($attach_id, $attach_data);
                            set_post_thumbnail($post_id, $attach_id);
                        }
                    }
                }

                // 6. Assign Taxonomy Terms (team_category)
                if (!empty($categories)) {
                    $term_ids = [];
                    foreach ($categories as $cat_name) {
                        $term = get_term_by('name', $cat_name, 'team_category');
                        if (!$term) {
                            $term = get_term_by('slug', strtolower($cat_name), 'team_category');
                        }
                        if ($term) {
                            $term_ids[] = (int) $term->term_id;
                        }
                    }
                    if (!empty($term_ids)) {
                        wp_set_object_terms($post_id, $term_ids, 'team_category');
                    }
                }

                // 7. Populate ACF Fields
                if (function_exists('update_field')) {
                    update_field('team_role', $role_full, $post_id);
                    update_field('team_role_short', $role_short ? $role_short : $role_full, $post_id);
                    update_field('team_summary', $summary, $post_id);
                    update_field('team_quote', $quote, $post_id);

                    // Specialties Repeater
                    $formatted_specs = [];
                    foreach ($specialties as $sp) {
                        if ($sp) $formatted_specs[] = ['specialty_name' => $sp];
                    }
                    update_field('team_specialties', $formatted_specs, $post_id);

                    // Stats Repeater
                    $formatted_stats = [];
                    foreach ($stats_numbers as $idx => $num) {
                        $lbl = isset($stats_labels[$idx]) ? $stats_labels[$idx] : '';
                        if ($num || $lbl) {
                            $formatted_stats[] = ['stat_number' => $num, 'stat_label' => $lbl];
                        }
                    }
                    update_field('team_stats', $formatted_stats, $post_id);

                    // Bio Paragraphs Repeater
                    $formatted_paragraphs = [];
                    foreach ($paragraphs as $p) {
                        if ($p) $formatted_paragraphs[] = ['paragraph' => $p];
                    }
                    update_field('team_bio_extended', $formatted_paragraphs, $post_id);

                    // Timeline Repeater
                    $formatted_timeline = [];
                    foreach ($tl_years as $idx => $yr) {
                        $ttl = isset($tl_titles[$idx]) ? $tl_titles[$idx] : '';
                        $dsc = isset($tl_descs[$idx]) ? $tl_descs[$idx] : '';
                        if ($yr || $ttl) {
                            $formatted_timeline[] = ['year' => $yr, 'title' => $ttl, 'description' => $dsc];
                        }
                    }
                    update_field('team_timeline', $formatted_timeline, $post_id);

                    // Specialty Cards Repeater
                    $formatted_cards = [];
                    foreach ($card_titles as $idx => $ct) {
                        $cd = isset($card_descs[$idx]) ? $card_descs[$idx] : '';
                        if ($ct) {
                            $formatted_cards[] = ['icon' => 'shield', 'title' => $ct, 'description' => $cd];
                        }
                    }
                    update_field('team_specialty_cards', $formatted_cards, $post_id);

                    // Cases Repeater
                    $formatted_cases = [];
                    foreach ($case_titles as $idx => $cst) {
                        $csd = isset($case_descs[$idx]) ? $case_descs[$idx] : '';
                        if ($cst) {
                            $formatted_cases[] = ['case_title' => $cst, 'case_description' => $csd];
                        }
                    }
                    update_field('team_cases', $formatted_cases, $post_id);

                    // Publications Repeater
                    $formatted_pubs = [];
                    foreach ($pub_titles as $idx => $pt) {
                        $ptp = isset($pub_types[$idx]) ? $pub_types[$idx] : 'artículo';
                        $pvn = isset($pub_venues[$idx]) ? $pub_venues[$idx] : '';
                        $pyr = isset($pub_years[$idx]) ? $pub_years[$idx] : '';
                        if ($pt) {
                            $formatted_pubs[] = ['pub_type' => $ptp, 'pub_title' => $pt, 'pub_venue' => $pvn, 'pub_year' => $pyr];
                        }
                    }
                    update_field('team_publications', $formatted_pubs, $post_id);
                }

                // 8. Send Notification Email to biography@thecrisisacademy.com
                $to = 'biography@thecrisisacademy.com';
                $subject = '¡Nuevo Perfil de Experto Publicado!: ' . $full_name . ' - The Crisis Academy';

                $body  = '<html><body style="font-family: Arial, sans-serif; line-height: 1.6; color: #111; max-width: 700px; margin: 0 auto; padding: 20px;">';
                $body .= '<div style="background-color: #0b1f3a; color: #ffffff; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">';
                $body .= '<h1 style="margin:0; font-size: 22px;">Nuevo Miembro Publicado en el CPT</h1>';
                $body .= '<p style="margin: 5px 0 0; opacity: 0.8;">The Crisis Academy</p>';
                $body .= '</div>';
                $body .= '<div style="border: 1px solid #ddd; border-top: none; padding: 25px; border-radius: 0 0 8px 8px; background: #ffffff;">';
                $body .= '<p>Se ha creado y publicado automáticamente el perfil para <strong>' . esc_html($full_name) . '</strong>.</p>';
                $body .= '<p><strong>Cargo:</strong> ' . esc_html($role_full) . '</p>';
                $body .= '<p><strong>Enlace del perfil creado:</strong> <a href="' . esc_url($created_post_url) . '" target="_blank">' . esc_url($created_post_url) . '</a></p>';
                $body .= '<p>Puedes editar este perfil en cualquier momento desde el Admin de WordPress en <strong>Equipo de Expertos > Todos los Miembros</strong>.</p>';
                $body .= '</div></body></html>';

                $headers = [
                    'Content-Type: text/html; charset=UTF-8',
                    'From: The Crisis Academy <noreply@thecrisisacademy.com>',
                ];

                wp_mail($to, $subject, $body, $headers, $attachments);

                $form_success = true;
            }
        }
    }
}
?>

<?php if ($form_submitted && $form_success) : ?>
    <section class="block" id="form-bio-notice">
        <div class="content">
            <div class="alert-box success-box object-reveal">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h2>¡Perfil Creado y Publicado con Éxito!</h2>
                <p>Muchas gracias. Tu perfil ha sido registrado automáticamente en el sistema y ya está publicado en la plataforma de <strong>The Crisis Academy</strong>.</p>
                
                <?php if ($created_post_url) : ?>
                    <div style="margin-top: 1.5rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                        <a href="<?php echo esc_url($created_post_url); ?>" class="btn primary" style="display: inline-block;">
                            Ver mi Biografía Publicada
                        </a>
                        <a href="<?php echo esc_url(home_url('/equipo')); ?>" class="btn secondary" style="display: inline-block; color: var(--wp--preset--color--contrast);">
                            Ir a la página de Equipo
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php elseif ($form_submitted && !empty($error_message)) : ?>
    <section class="block" id="form-bio-notice">
        <div class="content">
            <div class="alert-box error-box object-reveal">
                <div class="icon-wrap">
                    <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <h2>Ocurrió un problema</h2>
                <p><?php echo esc_html($error_message); ?></p>
            </div>
        </div>
    </section>
<?php endif; ?>
