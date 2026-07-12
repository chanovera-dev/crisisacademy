<section id="simulation" class="block">
    <!-- Background grid decoration -->
    <div class="simulation-bg-decor" aria-hidden="true">
        <div class="decor-grid"></div>
        <div class="decor-glow"></div>
    </div>
    <div class="content">
        <div class="simulation-left">
            <span class="pretext pretext-reveal">Entrenamiento Inmersivo</span>
            <h2 class="title-reveal">Antes de comenzar,<br><span>casi siempre encontramos los mismos problemas.</span></h2>
            <p class="simulation-intro-desc object-reveal">
                Las organizaciones suelen creer que están preparadas hasta que se enfrentan a un incidente real. Nuestro simulador interactivo recrea la presión de una crisis digital y mediática para evaluar y fortalecer su protocolo de respuesta en minutos.
            </p>
            <?php
            if ( ! function_exists( 'is_plugin_active' ) ) {
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            }
            if ( is_plugin_active( 'crisis-simulator/simulador-de-crisis.php' ) ) : ?>
                <div class="cta-wrapper object-reveal">
                    <a href="<?php echo esc_url( home_url( '/simulador-de-crisis/' ) ); ?>" class="btn-simulator-link btn primary">
                        <svg class="terminal-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="4 17 10 11 4 5"/>
                            <line x1="12" y1="19" x2="20" y2="19"/>
                        </svg>
                        <span>Probar Simulador de Crisis</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="simulation-right">
            <div class="vulnerabilities-panel card-reveal">
                <div class="panel-header">
                    <div class="panel-dot dot-red"></div>
                    <div class="panel-dot dot-yellow"></div>
                    <div class="panel-dot dot-green"></div>
                    <span class="panel-title">AUDITORÍA DE VULNERABILIDAD</span>
                </div>
                <div class="vulnerabilities-list">
                    <div class="vuln-card">
                        <div class="vuln-status">
                            <div class="vuln-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </div>
                        </div>
                        <div class="vuln-text">
                            <h4>No existe un protocolo compartido</h4>
                            <p>Los manuales teóricos estáticos se quedan en el papel ante un incidente en tiempo real.</p>
                        </div>
                    </div>
                    <div class="vuln-card">
                        <div class="vuln-status">
                            <div class="vuln-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </div>
                        </div>
                        <div class="vuln-text">
                            <h4>Cada área entiende una crisis diferente</h4>
                            <p>Falta de alineación semántica y objetivos contradictorios entre comités y departamentos clave.</p>
                        </div>
                    </div>
                    <div class="vuln-card">
                        <div class="vuln-status">
                            <div class="vuln-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </div>
                        </div>
                        <div class="vuln-text">
                            <h4>Nadie sabe quién toma la decisión final</h4>
                            <p>Vacíos de liderazgo corporativo y comités de crisis paralizados por la burocracia interna.</p>
                        </div>
                    </div>
                    <div class="vuln-card">
                        <div class="vuln-status">
                            <div class="vuln-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </div>
                        </div>
                        <div class="vuln-text">
                            <h4>El comité nunca ha practicado junto</h4>
                            <p>La primera vez que coordinan una respuesta no debería ser en medio de un ataque reputacional.</p>
                        </div>
                    </div>
                    <div class="vuln-card">
                        <div class="vuln-status">
                            <div class="vuln-box">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </div>
                        </div>
                        <div class="vuln-text">
                            <h4>Los voceros nunca han recibido presión real</h4>
                            <p>Portavoces sin entrenamiento práctico para responder ante el asedio agresivo de medios digitales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>