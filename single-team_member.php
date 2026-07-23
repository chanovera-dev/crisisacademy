<?php
/**
 * Single Template for CPT team_member
 * Theme: The Crisis Academy
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <?php
    $member = function_exists('crisisacademy_get_team_member_data') ? crisisacademy_get_team_member_data(get_the_ID()) : null;

    if ($member) :
        $bio_dir = get_stylesheet_directory() . '/template-parts/team-bio';

        $sections = [
            'hero',
            'trajectory',
            'specialties',
            'cases',
            'publications',
            'cta',
        ];

        foreach ($sections as $section) {
            $file_path = "$bio_dir/$section.php";
            if (file_exists($file_path)) {
                include $file_path;
            }
        }
    else : ?>
        <section class="block" style="min-height: 60vh; display: grid; place-content: center; text-align: center;">
            <div class="content">
                <h1>Perfil no encontrado</h1>
                <p>No se ha encontrado la información de este miembro del equipo.</p>
                <a href="<?php echo esc_url(home_url('/equipo')); ?>" class="btn primary" style="margin-top: 2rem; display: inline-block;">
                    Volver al equipo
                </a>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
