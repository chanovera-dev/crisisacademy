<?php
/**
 * Team Bio — CTA Section (Dark)
 * Personalized call-to-action for consulting with the expert.
 * Theme: The Crisis Academy
 */
if (!isset($member)) return;
?>
<section id="bio-cta" class="block">
    <div class="backdrop-glow">
        <div class="circle circle-1"></div>
        <div class="circle circle-2"></div>
        <div class="circle circle-3"></div>
        <div class="circle circle-4"></div>
    </div>
    <div class="content object-reveal">
        <div class="content-backdrop-glow">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>
        <div class="cta-intro">
            <span class="pretext pretext-reveal">Consultoría Especializada</span>
            <h2 class="title-section object-reveal">¿Necesitas la expertise de <?php echo esc_html($member['name']); ?> en tu organización?</h2>
            <p class="cta-description object-reveal">Agenda una sesión de diagnóstico estratégico con nuestro equipo. Evaluaremos la preparación de tu organización y diseñaremos un plan a la medida de tu sector y necesidades específicas.</p>
        </div>
        <div class="cta-action object-reveal">
            <div class="cta-buttons">
                <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn primary cta-pulse-btn">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                    Solicitar consultoría con <?php echo esc_html(explode(' ', $member['name'])[0]); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/team')); ?>" class="btn secondary">
                    Ver equipo completo
                </a>
            </div>
            <p class="cta-micro-copy">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                Garantía de confidencialidad institucional · Acuerdo NDA previo
            </p>
        </div>
    </div>
</section>
