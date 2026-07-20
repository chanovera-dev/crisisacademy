<?php
/**
 * Team Page — CTA Section (Dark)
 * Design: Matches #cta from corporate-crisisacademy-homepage
 * Theme: The Crisis Academy
 */
?>
<section id="team-cta" class="block">
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
            <span class="pretext pretext-reveal">Despliegue & Consultoría Directiva</span>
            <h2 class="title-section object-reveal">¿Tu organización está lista para enfrentar un escenario de alta vulnerabilidad?</h2>
            <p class="cta-description object-reveal">Agenda una sesión de diagnóstico estratégico con la Dirección General de The Crisis Academy. Evaluaremos la preparación de tu comité y diseñaremos un plan de simulación o contención a la medida de tu sector.</p>
        </div>
        <div class="cta-action object-reveal">
            <div class="cta-buttons">
                <a href="<?php echo esc_url(home_url('/contacto')); ?>" class="btn primary cta-pulse-btn">
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                    Iniciar sesión de diagnóstico
                </a>
                <a href="<?php echo esc_url(home_url('/programas')); ?>" class="btn secondary">
                    Ver simuladores & programas
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
