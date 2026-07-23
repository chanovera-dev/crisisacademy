/**
 * Form Biography Interactive Scripts — Clean Document Design
 * Dynamic table row addition/removal for biography intake form
 * Theme: The Crisis Academy
 */

document.addEventListener('DOMContentLoaded', () => {

    const addButtons = document.querySelectorAll('[data-add-repeater]');

    addButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.getAttribute('data-add-repeater');
            let container = null;
            let newHtml = '';

            switch (target) {
                case 'stats':
                    container = document.getElementById('stats-container');
                    newHtml = `
                        <tr>
                            <td><input type="text" name="stat_number[]" placeholder="Cifra / Valor" class="doc-input"></td>
                            <td><input type="text" name="stat_label[]" placeholder="Etiqueta explicativa" class="doc-input"></td>
                            <td><button type="button" class="doc-btn-del" onclick="this.closest('tr').remove()">×</button></td>
                        </tr>`;
                    break;

                case 'specialties':
                    container = document.getElementById('specialties-container');
                    const currentCount = container.children.length + 1;
                    newHtml = `
                        <div class="doc-list-row">
                            <span class="doc-num">${currentCount}.</span>
                            <input type="text" name="specialty_name[]" placeholder="Especialidad" class="doc-input">
                            <button type="button" class="doc-btn-del" onclick="this.closest('.doc-list-row').remove()">×</button>
                        </div>`;
                    break;

                case 'bio':
                    container = document.getElementById('bio-container');
                    const pCount = container.querySelectorAll('textarea').length + 1;
                    newHtml = `
                        <div style="margin-top: 15px; position: relative;">
                            <p><strong>Párrafo ${pCount}:</strong></p>
                            <textarea name="paragraph[]" rows="4" placeholder="Redacta el párrafo..." class="doc-textarea"></textarea>
                            <button type="button" class="doc-btn-del" style="position: absolute; right: 0; top: 0;" onclick="this.parentElement.remove()">×</button>
                        </div>`;
                    break;

                case 'timeline':
                    container = document.getElementById('timeline-container');
                    newHtml = `
                        <tr>
                            <td><input type="text" name="tl_year[]" placeholder="Año" class="doc-input"></td>
                            <td><input type="text" name="tl_title[]" placeholder="Título del hito" class="doc-input"></td>
                            <td><textarea name="tl_desc[]" rows="2" placeholder="Descripción breve..." class="doc-textarea"></textarea></td>
                            <td><button type="button" class="doc-btn-del" onclick="this.closest('tr').remove()">×</button></td>
                        </tr>`;
                    break;

                case 'cards':
                    container = document.getElementById('cards-container');
                    newHtml = `
                        <tr>
                            <td><input type="text" name="card_title[]" placeholder="Título del área" class="doc-input"></td>
                            <td><textarea name="card_desc[]" rows="2" placeholder="Descripción..." class="doc-textarea"></textarea></td>
                            <td><button type="button" class="doc-btn-del" onclick="this.closest('tr').remove()">×</button></td>
                        </tr>`;
                    break;

                case 'cases':
                    container = document.getElementById('cases-container');
                    newHtml = `
                        <tr>
                            <td><input type="text" name="case_title[]" placeholder="Título del caso" class="doc-input"></td>
                            <td><textarea name="case_desc[]" rows="2" placeholder="Descripción de la intervención..." class="doc-textarea"></textarea></td>
                            <td><button type="button" class="doc-btn-del" onclick="this.closest('tr').remove()">×</button></td>
                        </tr>`;
                    break;

                case 'pubs':
                    container = document.getElementById('pubs-container');
                    newHtml = `
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
                            <td><input type="text" name="pub_year[]" placeholder="Año" class="doc-input"></td>
                            <td><button type="button" class="doc-btn-del" onclick="this.closest('tr').remove()">×</button></td>
                        </tr>`;
                    break;
            }

            if (container && newHtml) {
                const temp = document.createElement(container.tagName === 'TBODY' ? 'tbody' : 'div');
                temp.innerHTML = newHtml.trim();
                container.appendChild(temp.firstElementChild);
            }
        });
    });

});
