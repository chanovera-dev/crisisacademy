<?php
/**
 * Team Page — Experts Grid (Dynamic CPT loop with ACF & static fallback)
 * Design: Tall portrait cards with hover content reveal
 * Theme: The Crisis Academy
 */

$theme_uri = get_stylesheet_directory_uri();

// Static fallback data for team members not yet imported to CPT
$static_experts = [
    'carolina-eslava' => [
        'id'          => 'carolina-eslava',
        'category'    => 'leadership comms',
        'name'        => 'Carolina Eslava',
        'role'        => 'Fundadora & Directora',
        'image'       => $theme_uri . '/assets/img/carolina-eslava.webp',
        'specialties' => ['Gestión de Crisis', 'Liderazgo Ejecutivo', 'Media Training C-Suite'],
        'summary'     => '25 años formando y preparando comités de crisis en multinacionales frente a escenarios de alta complejidad operativa, reputacional y mediática.',
        'permalink'   => home_url('/carolina-eslava'),
    ]
];

// Dynamic CPT Query
$team_query = new WP_Query([
    'post_type'      => 'team_member',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order title',
    'order'          => 'ASC',
]);

$experts = [];
$cpt_slugs = [];

if ($team_query->have_posts()) {
    while ($team_query->have_posts()) {
        $team_query->the_post();
        $post_id   = get_the_ID();
        $slug      = get_post_field('post_name', $post_id);
        $cpt_slugs[] = $slug;

        // Categories from taxonomy
        $terms = get_the_terms($post_id, 'team_category');
        $cat_slugs = [];
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $t) {
                $cat_slugs[] = $t->slug;
            }
        }
        $category_str = implode(' ', $cat_slugs);

        // Featured Image
        $image_url = get_the_post_thumbnail_url($post_id, 'large');
        if (!$image_url && isset($static_experts[$slug])) {
            $image_url = $static_experts[$slug]['image'];
        }

        // ACF Fields
        $role = function_exists('get_field') ? get_field('team_role_short', $post_id) : '';
        if (!$role && function_exists('get_field')) {
            $role = get_field('team_role', $post_id);
        }
        if (!$role && isset($static_experts[$slug])) {
            $role = $static_experts[$slug]['role'];
        }

        $summary = function_exists('get_field') ? get_field('team_summary', $post_id) : '';
        if (!$summary) {
            $summary = get_the_excerpt();
        }
        if (!$summary && isset($static_experts[$slug])) {
            $summary = $static_experts[$slug]['summary'];
        }

        $specialties = [];
        if (function_exists('get_field')) {
            $spec_repeater = get_field('team_specialties', $post_id);
            if (!empty($spec_repeater)) {
                foreach ($spec_repeater as $sp) {
                    if (!empty($sp['specialty_name'])) {
                        $specialties[] = $sp['specialty_name'];
                    }
                }
            }
        }
        if (empty($specialties) && isset($static_experts[$slug])) {
            $specialties = $static_experts[$slug]['specialties'];
        }

        $experts[] = [
            'id'          => $slug,
            'category'    => $category_str,
            'name'        => get_the_title(),
            'role'        => $role,
            'image'       => $image_url,
            'specialties' => $specialties,
            'summary'     => $summary,
            'permalink'   => get_permalink($post_id),
        ];
    }
    wp_reset_postdata();
}

// Append static experts that are not yet created in CPT
foreach ($static_experts as $slug => $static) {
    if (!in_array($slug, $cpt_slugs)) {
        $experts[] = $static;
    }
}
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
