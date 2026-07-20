<?php
/**
 * Team Page — Founder & Academic Direction Spotlight
 * Design: Matches #founder section from corporate-crisisacademy-homepage
 * Theme: The Crisis Academy
 */

$theme_uri = get_stylesheet_directory_uri();
?>
<section id="founder-spotlight" class="block">
    <div class="founder-bg-grid" aria-hidden="true"></div>
    <div class="founder-bg-glow" aria-hidden="true"></div>
    <div class="content">
        <div class="founder-grid">
            
            <!-- Left Side: Elegant Portrait Photo -->
            <div class="founder-visual object-reveal">
                <div class="visual-frame">
                    <div class="corner-reticle top-left"></div>
                    <div class="corner-reticle top-right"></div>
                    <div class="corner-reticle bottom-left"></div>
                    <div class="corner-reticle bottom-right"></div>
                    <img src="<?php echo esc_url($theme_uri . '/assets/img/carolina-eslava.webp'); ?>" alt="Carolina Eslava - Fundadora & Directora" class="founder-photo" loading="lazy">
                </div>
            </div>

            <!-- Right Side: Content Bio & Methodology -->
            <div class="founder-info">
                <span class="pretext pretext-reveal">Liderazgo Académico</span>
                <h2 class="founder-name object-reveal">Carolina Eslava</h2>
                <div class="founder-role object-reveal">Fundadora & Directora de The Crisis Academy</div>

                <div class="founder-quote object-reveal">
                    <svg class="quote-icon" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <p>25 años formando y preparando comités de crisis en multinacionales frente a escenarios de alta complejidad operativa y mediática.</p>
                </div>

                <!-- Interactive Tabs -->
                <div class="spotlight-tabs object-reveal">
                    <button class="spot-tab-btn btn primary active" data-spot-tab="tab-vision">Visión</button>
                    <button class="spot-tab-btn btn hollow" data-spot-tab="tab-method">Metodología</button>
                    <button class="spot-tab-btn btn hollow" data-spot-tab="tab-impact">Métricas</button>
                </div>

                <div class="spotlight-tab-contents">
                    <!-- Panel 1: Vision -->
                    <div class="spot-tab-panel active" id="tab-vision">
                        <div class="founder-methodology">
                            <div class="methodology-list">
                                <div class="methodology-item">
                                    <div class="item-icon">
                                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M4 19.5A2.5 2.5 0 0 0 6.5 22H20M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5z"/>
                                        </svg>
                                    </div>
                                    <div class="item-text">
                                        <strong>Diseño de simuladores inmersivos</strong>
                                        <span>Pruebas de resiliencia cognitiva y toma de decisiones directiva bajo fatiga acelerada.</span>
                                    </div>
                                </div>
                                <div class="methodology-item">
                                    <div class="item-icon">
                                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                                        </svg>
                                    </div>
                                    <div class="item-text">
                                        <strong>Entrenamiento C-Suite activo</strong>
                                        <span>Preparación directa de juntas directivas y presidentes de multinacionales de 12+ sectores industriales.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 2: Methodology -->
                    <div class="spot-tab-panel" id="tab-method">
                        <div class="founder-methodology">
                            <div class="methodology-list">
                                <div class="methodology-item">
                                    <div class="item-icon">
                                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"/>
                                            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"/>
                                            <line x1="6" y1="6" x2="6.01" y2="6"/>
                                            <line x1="6" y1="18" x2="6.01" y2="18"/>
                                        </svg>
                                    </div>
                                    <div class="item-text">
                                        <strong>Ian Mitroff, Timothy Coombs & William Benoit</strong>
                                        <span>Modelos teóricos consolidados de contención de crisis y estrategias de restauración de imagen corporativa.</span>
                                    </div>
                                </div>
                                <div class="methodology-item">
                                    <div class="item-icon">
                                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="18" y1="20" x2="18" y2="10"/>
                                            <line x1="12" y1="20" x2="12" y2="4"/>
                                            <line x1="6" y1="20" x2="6" y2="14"/>
                                        </svg>
                                    </div>
                                    <div class="item-text">
                                        <strong>Learning Sciences & Simulación</strong>
                                        <span>Práctica inmersiva activa de toma de decisiones bajo presión y fatiga cognitiva acelerada.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Panel 3: Impact -->
                    <div class="spot-tab-panel" id="tab-impact">
                        <div class="founder-counter object-reveal">
                            <div class="counter-number">+2,000</div>
                            <div class="counter-label">Ejecutivos entrenados bajo simulación de crisis activa en toda la región.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
