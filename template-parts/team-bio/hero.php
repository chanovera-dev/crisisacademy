<?php
/**
 * Team Bio — Hero Section
 * Full-width hero with large portrait, name, role, signature quote, specialty tags and personal stats.
 * Theme: The Crisis Academy
 */
if (!isset($member)) return;
?>
<section id="bio-hero" class="block">
    <div class="hero-bg-grid" aria-hidden="true"></div>
    <div class="hero-bg-orbs" aria-hidden="true">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    <div class="hero-glow"></div>
    <div class="content">

        <!-- Left: Text Content -->
        <div class="bio-hero-text">
            <a href="<?php echo esc_url(home_url('/equipo')); ?>" class="bio-back-link object-reveal">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Volver al equipo</span>
            </a>

            <div class="bio-hero-tags object-reveal">
                <?php foreach ($member['specialties'] as $tag) : ?>
                    <span class="bio-tag"><?php echo esc_html($tag); ?></span>
                <?php endforeach; ?>
            </div>

            <h1 class="bio-hero-name object-reveal"><?php echo esc_html($member['name']); ?></h1>
            <p class="bio-hero-role object-reveal"><?php echo esc_html($member['role']); ?></p>

            <blockquote class="bio-hero-quote object-reveal">
                <svg class="quote-icon" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                </svg>
                <p><?php echo esc_html($member['quote']); ?></p>
            </blockquote>
        </div>

        <!-- Right: Portrait + Stats -->
        <div class="bio-hero-visual">
            <div class="bio-portrait-frame object-reveal">
                <div class="corner-reticle top-left"></div>
                <div class="corner-reticle top-right"></div>
                <div class="corner-reticle bottom-left"></div>
                <div class="corner-reticle bottom-right"></div>
                <img src="<?php echo esc_url($member['image']); ?>" alt="<?php echo esc_attr($member['name']); ?>" class="bio-portrait-img" loading="eager">
                <div class="bio-portrait-gradient" aria-hidden="true"></div>
            </div>

            <?php if (!empty($member['stats'])) : ?>
                <div class="bio-stats-strip object-reveal">
                    <?php foreach ($member['stats'] as $stat) : ?>
                        <div class="bio-stat">
                            <span class="stat-number"><?php echo esc_html($stat['number']); ?></span>
                            <span class="stat-label"><?php echo esc_html($stat['label']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
