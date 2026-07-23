<?php
/**
 * Team Bio — Cases Section (Light Theme)
 * Dossier-style notable cases with check icons and detailed descriptions.
 * Theme: The Crisis Academy
 */
if (!isset($member)) return;
?>
<section id="bio-cases" class="block">
    <div class="cases-bg-grid" aria-hidden="true"></div>
    <div class="cases-bg-glow" aria-hidden="true"></div>
    <div class="content">
        <div class="cases-layout">

            <!-- Left: Header -->
            <div class="cases-header">
                <span class="pretext pretext-reveal">Casos Destacados</span>
                <h2 class="object-reveal">Intervenciones de alto impacto.</h2>
                <p class="cases-intro object-reveal">Logros y casos gestionados que demuestran la capacidad de respuesta y expertise de <?php echo esc_html($member['name']); ?> en escenarios reales de crisis.</p>
            </div>

            <!-- Right: Case Cards -->
            <div class="cases-list">
                <?php if (!empty($member['cases'])) : ?>
                    <?php foreach ($member['cases'] as $i => $case) : ?>
                        <div class="case-card object-reveal" style="transition-delay: <?php echo ($i * 0.1); ?>s;">
                            <div class="case-number">
                                <span><?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                            </div>
                            <div class="case-body">
                                <h3 class="case-title"><?php echo esc_html($case['title']); ?></h3>
                                <p class="case-desc"><?php echo esc_html($case['desc']); ?></p>
                            </div>
                            <div class="case-check" aria-hidden="true">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
