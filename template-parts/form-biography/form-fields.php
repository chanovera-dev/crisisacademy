<?php
/**
 * Form Biography — Interactive Form Fields (Clean Document Design)
 * Theme: The Crisis Academy
 */

if (isset($form_success) && $form_success) {
    return; // Don't show form if successfully submitted
}
?>
<section id="form-bio-section">
    <div class="form-bio-container">

        <form action="" method="POST" enctype="multipart/form-data" id="tca-bio-form">
            <?php wp_nonce_field('tca_submit_biography_form', 'tca_bio_nonce'); ?>

            <!-- 1. Información General -->
            <h2 class="doc-h2">1. Información General</h2>
            <table class="doc-table">
                <tr>
                    <th style="width: 30%;">Campo</th>
                    <th>Respuesta</th>
                </tr>
                <tr>
                    <td><strong>Nombre completo y título <span class="req">*</span></strong></td>
                    <td><input type="text" id="full_name" name="full_name" placeholder="Ej: Dr. Roberto Mendoza" required class="doc-input"></td>
                </tr>
                <tr>
                    <td><strong>Cargo completo institucional <span class="req">*</span></strong></td>
                    <td><input type="text" id="role_full" name="role_full" placeholder="Ej: Director de Estrategia Legal & Regulatoria" required class="doc-input"></td>
                </tr>
                <tr>
                    <td><strong>Cargo corto (para tarjeta)</strong></td>
                    <td><input type="text" id="role_short" name="role_short" placeholder="Ej: Estrategia Legal" class="doc-input"></td>
                </tr>
                <tr>
                    <td><strong>Categorías asignadas</strong><br><small class="instruction">(Marcar las que apliquen)</small></td>
                    <td>
                        <div class="doc-checkboxes">
                            <label><input type="checkbox" name="categories[]" value="Dirección"> Dirección</label>
                            <label><input type="checkbox" name="categories[]" value="Comunicación"> Comunicación</label>
                            <label><input type="checkbox" name="categories[]" value="Ciberseguridad"> Ciberseguridad</label>
                            <label><input type="checkbox" name="categories[]" value="Legal"> Legal</label>
                            <label><input type="checkbox" name="categories[]" value="Operaciones"> Operaciones</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><strong>Fotografía de perfil</strong></td>
                    <td>
                        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="doc-file-input">
                        <br><span class="instruction">(Adjuntar archivo en vertical, alta resolución y fondo corporativo/neutro)</span>
                    </td>
                </tr>
            </table>

            <!-- 2. Sinopsis Corta & Cita Signature -->
            <h2 class="doc-h2">2. Sinopsis Corta & Cita Signature</h2>
            <p><strong>Resumen Corto para Tarjeta (2-3 líneas):</strong></p>
            <textarea id="summary" name="summary" rows="3" placeholder="Breve descripción que se mostrará en la tarjeta principal del equipo al hacer hover..." class="doc-textarea"></textarea>

            <p><strong>Cita Signature / Frase Destacada:</strong></p>
            <p class="instruction">Una frase que refleje tu visión o filosofía sobre la gestión y resolución de crisis.</p>
            <textarea id="quote" name="quote" rows="3" placeholder="Ej: La claridad mental del líder en momentos de caos es la ventaja competitiva más valiosa..." class="doc-textarea"></textarea>

            <!-- 3. Cifras y Métricas Destacadas -->
            <h2 class="doc-h2">3. Cifras y Métricas Destacadas</h2>
            <p class="instruction">Proporciona de 3 a 4 cifras numéricas con su etiqueta correspondiente.</p>
            <table class="doc-table" id="stats-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Cifra / Valor</th>
                        <th>Etiqueta explicativa</th>
                        <th style="width: 50px;"></th>
                    </tr>
                </thead>
                <tbody id="stats-container">
                    <tr>
                        <td><input type="text" name="stat_number[]" placeholder="Ej: +20" class="doc-input"></td>
                        <td><input type="text" name="stat_label[]" placeholder="Ej: Años de experiencia en litigio corporativo" class="doc-input"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="stat_number[]" placeholder="Ej: +80" class="doc-input"></td>
                        <td><input type="text" name="stat_label[]" placeholder="Ej: Investigaciones legales gestionadas" class="doc-input"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="doc-btn-add" data-add-repeater="stats">+ Añadir otra cifra</button>

            <!-- 4. Etiquetas de Especialidad -->
            <h2 class="doc-h2">4. Etiquetas de Especialidad</h2>
            <p class="instruction">Entre 3 y 4 conceptos clave de 2 a 4 palabras cada uno.</p>
            <div id="specialties-container" class="doc-list-inputs">
                <div class="doc-list-row">
                    <span class="doc-num">1.</span>
                    <input type="text" name="specialty_name[]" placeholder="Ej: Litigio de Alta Crisis" class="doc-input">
                </div>
                <div class="doc-list-row">
                    <span class="doc-num">2.</span>
                    <input type="text" name="specialty_name[]" placeholder="Ej: Cumplimiento Regulatorio" class="doc-input">
                </div>
                <div class="doc-list-row">
                    <span class="doc-num">3.</span>
                    <input type="text" name="specialty_name[]" placeholder="Ej: Blindaje Penal Corporativo" class="doc-input">
                </div>
            </div>
            <button type="button" class="doc-btn-add" data-add-repeater="specialties">+ Añadir especialidad</button>

            <!-- 5. Biografía Extendida -->
            <h2 class="doc-h2">5. Biografía Extendida</h2>
            <p class="instruction">Redacta entre 2 y 4 párrafos sobre tu trayectoria, experiencia atendiendo crisis y valor diferencial.</p>
            <div id="bio-container">
                <p><strong>Párrafo 1 (Trayectoria y experiencia principal):</strong></p>
                <textarea name="paragraph[]" rows="4" placeholder="Redacta el primer párrafo..." class="doc-textarea"></textarea>

                <p><strong>Párrafo 2 (Enfoque de trabajo y sectores atendidos):</strong></p>
                <textarea name="paragraph[]" rows="4" placeholder="Redacta el segundo párrafo..." class="doc-textarea"></textarea>
            </div>
            <button type="button" class="doc-btn-add" data-add-repeater="bio">+ Añadir párrafo</button>

            <!-- 6. Hitos de Trayectoria (Timeline) -->
            <h2 class="doc-h2">6. Hitos de Trayectoria (Timeline)</h2>
            <table class="doc-table" id="timeline-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">Año</th>
                        <th style="width: 35%;">Título del hito</th>
                        <th>Descripción corta</th>
                        <th style="width: 50px;"></th>
                    </tr>
                </thead>
                <tbody id="timeline-container">
                    <tr>
                        <td><input type="text" name="tl_year[]" placeholder="2012" class="doc-input"></td>
                        <td><input type="text" name="tl_title[]" placeholder="Investigaciones antimonopolio" class="doc-input"></td>
                        <td><textarea name="tl_desc[]" rows="2" placeholder="Descripción breve..." class="doc-textarea"></textarea></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="doc-btn-add" data-add-repeater="timeline">+ Añadir hito</button>

            <!-- 7. Áreas de Especialización Detalladas -->
            <h2 class="doc-h2">7. Áreas de Especialización Detalladas</h2>
            <p class="instruction">Describe de 4 a 6 áreas de servicio o expertise específico.</p>
            <table class="doc-table" id="cards-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">Área / Título</th>
                        <th>Descripción</th>
                        <th style="width: 50px;"></th>
                    </tr>
                </thead>
                <tbody id="cards-container">
                    <tr>
                        <td><input type="text" name="card_title[]" placeholder="Litigio de Alta Crisis" class="doc-input"></td>
                        <td><textarea name="card_desc[]" rows="2" placeholder="Estrategia de defensa jurídica..." class="doc-textarea"></textarea></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="doc-btn-add" data-add-repeater="cards">+ Añadir área</button>

            <!-- 8. Casos Destacados / Logros -->
            <h2 class="doc-h2">8. Casos Destacados / Logros</h2>
            <table class="doc-table" id="cases-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">Título del Caso o Logro</th>
                        <th>Descripción de la intervención</th>
                        <th style="width: 50px;"></th>
                    </tr>
                </thead>
                <tbody id="cases-container">
                    <tr>
                        <td><input type="text" name="case_title[]" placeholder="Defensa regulatoria multinacional" class="doc-input"></td>
                        <td><textarea name="case_desc[]" rows="2" placeholder="Detalles de la gestión..." class="doc-textarea"></textarea></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="doc-btn-add" data-add-repeater="cases">+ Añadir caso</button>

            <!-- 9. Publicaciones, Conferencias y Reconocimientos -->
            <h2 class="doc-h2">9. Publicaciones, Conferencias y Reconocimientos</h2>
            <table class="doc-table" id="pubs-table">
                <thead>
                    <tr>
                        <th style="width: 20%;">Tipo</th>
                        <th>Título</th>
                        <th>Medio / Evento / Foro</th>
                        <th style="width: 15%;">Año</th>
                        <th style="width: 50px;"></th>
                    </tr>
                </thead>
                <tbody id="pubs-container">
                    <tr>
                        <td>
                            <select name="pub_type[]" class="doc-select">
                                <option value="artículo">Artículo</option>
                                <option value="conferencia">Conferencia</option>
                                <option value="ponencia">Ponencia</option>
                            </select>
                        </td>
                        <td><input type="text" name="pub_title[]" placeholder="Título" class="doc-input"></td>
                        <td><input type="text" name="pub_venue[]" placeholder="Medio o Evento" class="doc-input"></td>
                        <td><input type="text" name="pub_year[]" placeholder="2024" class="doc-input"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="doc-btn-add" data-add-repeater="pubs">+ Añadir publicación</button>

            <!-- Submit Section -->
            <div class="doc-submit-wrap">
                <button type="submit" class="doc-submit-btn">Guardar y Publicar Perfil de Experto</button>
            </div>

        </form>

    </div>
</section>
