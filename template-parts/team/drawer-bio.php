<?php
/**
 * Team Page — Side Drawer Bio Component (Pure Dynamic CPT loop)
 * Design: Matching corporate homepage dark glassmorphism palette
 * Theme: The Crisis Academy
 */

// Query CPT team_member posts
$team_drawer_query = new WP_Query([
    'post_type'      => 'team_member',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
]);

$drawers = [];

if ($team_drawer_query->have_posts()) {
    while ($team_drawer_query->have_posts()) {
        $team_drawer_query->the_post();
        $post_id = get_the_ID();
        $slug    = get_post_field('post_name', $post_id);

        $image_url = get_the_post_thumbnail_url($post_id, 'medium_large');
        $role      = function_exists('get_field') ? get_field('team_role', $post_id) : '';
        $quote     = function_exists('get_field') ? get_field('team_quote', $post_id) : '';

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

        // Cases list
        $cases = [];
        if (function_exists('get_field')) {
            $cases_repeater = get_field('team_cases', $post_id);
            if (!empty($cases_repeater) && is_array($cases_repeater)) {
                foreach ($cases_repeater as $c) {
                    $c_title = !empty($c['case_title']) ? $c['case_title'] : '';
                    $c_desc  = !empty($c['case_description']) ? $c['case_description'] : '';
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
?>

<?php if (!empty($drawers)) : ?>
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
                        <?php if ($d['image']) : ?>
                            <img src="<?php echo esc_url($d['image']); ?>" alt="<?php echo esc_attr($d['name']); ?>" class="drawer-photo">
                        <?php endif; ?>
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
<?php endif; ?>
