<?php
/**
 * Team Bio — Trajectory Section (Light Theme)
 * Extended biography with vertical professional timeline.
 * Theme: The Crisis Academy
 */
if (!isset($member)) return;
?>
<section id="bio-trajectory" class="block">
    <div class="trajectory-bg-grid" aria-hidden="true"></div>
    <div class="trajectory-bg-glow" aria-hidden="true"></div>
    <div class="content">
        <div class="trajectory-grid">

            <!-- Left: Extended Biography -->
            <div class="trajectory-bio">
                <span class="pretext pretext-reveal">Trayectoria Profesional</span>
                <h2 class="object-reveal">Sobre <?php echo esc_html($member['name']); ?></h2>

                <div class="bio-paragraphs object-reveal">
                    <?php if (!empty($member['bio_extended'])) : ?>
                        <?php foreach ($member['bio_extended'] as $paragraph) : ?>
                            <p><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Vertical Timeline -->
            <div class="trajectory-timeline">
                <h3 class="timeline-header object-reveal">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Hitos profesionales
                </h3>
                <div class="timeline-track">
                    <?php if (!empty($member['timeline'])) : ?>
                        <?php foreach ($member['timeline'] as $i => $milestone) : ?>
                            <div class="timeline-item object-reveal" style="transition-delay: <?php echo ($i * 0.1); ?>s;">
                                <div class="timeline-dot" aria-hidden="true">
                                    <div class="dot-pulse"></div>
                                </div>
                                <div class="timeline-content">
                                    <span class="timeline-year"><?php echo esc_html($milestone['year']); ?></span>
                                    <h4 class="timeline-title"><?php echo esc_html($milestone['title']); ?></h4>
                                    <p class="timeline-desc"><?php echo esc_html($milestone['desc']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>
