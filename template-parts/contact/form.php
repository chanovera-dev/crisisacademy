<?php
/**
 * Contact Form Section — Executive Intake Light Theme (#ebe8e6)
 */
?>
<section id="contact-form-section" class="block">
    <div class="contact-form-bg-grid"></div>

    <div class="content">
        <div class="contact-form-header object-reveal">
            <span class="section-tag">Formulario de Alta Crisis</span>
            <h2 class="section-title">Inicie el Protocolo de Evaluación</h2>
            <p class="section-subtitle">
                Seleccione el tipo de incidente o consulta para asignar de inmediato al socio directivo especializado en su sector.
            </p>
        </div>

        <div class="contact-form-container object-reveal">
            <form id="crisis-intake-form" class="intake-form" action="#" method="POST" novalidate>
                
                <!-- Category Pill Selector -->
                <div class="form-group full-width">
                    <label class="form-label">Clasificación de Incidente o Requerimiento <span class="required">*</span></label>
                    <div class="category-pills">
                        <label class="cat-pill active">
                            <input type="radio" name="crisis_category" value="ransomware" checked>
                            <span class="pill-badge">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="6" width="20" height="12" rx="2"/>
                                    <path d="M12 12h.01"/>
                                </svg>
                                Ciberataque / Ransomware
                            </span>
                        </label>
                        <label class="cat-pill">
                            <input type="radio" name="crisis_category" value="reputational">
                            <span class="pill-badge">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                Crisis Reputacional / Medios
                            </span>
                        </label>
                        <label class="cat-pill">
                            <input type="radio" name="crisis_category" value="legal">
                            <span class="pill-badge">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 3v18M3 12h18"/>
                                </svg>
                                Investigación Legal / Regulatoria
                            </span>
                        </label>
                        <label class="cat-pill">
                            <input type="radio" name="crisis_category" value="bcp">
                            <span class="pill-badge">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                                </svg>
                                Interrupción / Continuidad Operativa (BCP)
                            </span>
                        </label>
                        <label class="cat-pill">
                            <input type="radio" name="crisis_category" value="csuite">
                            <span class="pill-badge">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                </svg>
                                Entrenamiento / Simulación de Alta Dirección
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Personal / Company Info Grid -->
                <div class="form-group">
                    <label for="contact_name" class="form-label">Nombre del Solicitante <span class="required">*</span></label>
                    <input type="text" id="contact_name" name="contact_name" class="form-input" placeholder="Ej. Roberto Mendoza" required>
                </div>
                <div class="form-group">
                    <label for="contact_position" class="form-label">Cargo Directivo / Rol <span class="required">*</span></label>
                    <input type="text" id="contact_position" name="contact_position" class="form-input" placeholder="Ej. Director de Riesgos / Asesor Legal" required>
                </div>

                <div class="form-group">
                    <label for="contact_email" class="form-label">Correo Corporativo Confidencial <span class="required">*</span></label>
                    <input type="email" id="contact_email" name="contact_email" class="form-input" placeholder="r.mendoza@empresa.com" required>
                </div>
                <div class="form-group">
                    <label for="contact_phone" class="form-label">Teléfono Directo de Contacto <span class="required">*</span></label>
                    <input type="tel" id="contact_phone" name="contact_phone" class="form-input" placeholder="+52 (55) 0000-0000" required>
                </div>

                <div class="form-group">
                    <label for="contact_company" class="form-label">Organización / Empresa <span class="required">*</span></label>
                    <input type="text" id="contact_company" name="contact_company" class="form-input" placeholder="Ej. Grupo Industrial S.A." required>
                </div>
                <div class="form-group">
                    <label for="contact_urgency" class="form-label">Nivel de Urgencia</label>
                    <div class="custom-select-wrapper" id="urgency-custom-select">
                        <select id="contact_urgency" name="contact_urgency" class="hidden-select-input" tabindex="-1">
                            <option value="critical">CRÍTICO — Despliegue en &lt; 2 Horas (Sala de Crisis Activa)</option>
                            <option value="high">ALTO — Respuesta en Mismo Día (24h)</option>
                            <option value="standard" selected>ESTÁNDAR — Asesoría Directiva / Entrenamiento Programado</option>
                        </select>
                        <div class="custom-select-trigger" tabindex="0" role="combobox" aria-expanded="false" aria-haspopup="listbox">
                            <span class="selected-value">ESTÁNDAR — Asesoría Directiva / Entrenamiento Programado</span>
                            <svg class="chevron-icon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </div>
                        <div class="custom-select-options" role="listbox">
                            <div class="custom-option" data-value="critical" role="option">
                                <div class="option-content">
                                    <span class="urgency-dot red"></span>
                                    <span class="option-text"><strong>CRÍTICO</strong> — Despliegue en &lt; 2 Horas (Sala de Crisis Activa)</span>
                                </div>
                                <span class="option-check">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                            </div>
                            <div class="custom-option" data-value="high" role="option">
                                <div class="option-content">
                                    <span class="urgency-dot orange"></span>
                                    <span class="option-text"><strong>ALTO</strong> — Respuesta en Mismo Día (24h)</span>
                                </div>
                                <span class="option-check">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                            </div>
                            <div class="custom-option selected" data-value="standard" role="option">
                                <div class="option-content">
                                    <span class="urgency-dot blue"></span>
                                    <span class="option-text"><strong>ESTÁNDAR</strong> — Asesoría Directiva / Entrenamiento Programado</span>
                                </div>
                                <span class="option-check">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message / Description Field -->
                <div class="form-group full-width">
                    <label for="contact_message" class="form-label">Resumen Ejecutivo del Requerimiento <span class="required">*</span></label>
                    <textarea id="contact_message" name="contact_message" class="form-textarea" rows="4" placeholder="Describa brevemente el contexto o la necesidad. Toda la información enviada a través de este canal se procesa bajo estricta confidencialidad comercial y legal." required></textarea>
                </div>

                <!-- NDA Checkbox & Footer -->
                <div class="form-footer full-width">
                    <div class="nda-notice">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <span>Protegido automáticamente por nuestro acuerdo marco de confidencialidad y protocolo de cifrado corporativo.</span>
                    </div>

                    <button type="submit" class="btn primary btn-submit">
                        <span>Activar Recepción Confidencial</span>
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                            <polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </div>

                <div id="form-response-message" class="form-response-msg hidden"></div>
            </form>
        </div>
    </div>
</section>
