function initBlockViewportObserver() {
    const blocks = document.querySelectorAll('.site-main > .block');
    if (blocks.length === 0) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            entry.target.classList.toggle('in-view', entry.isIntersecting);
        });
    }, {
        threshold: 0.01 // Trigger as soon as 1% of the section enters the screen
    });

    blocks.forEach(block => observer.observe(block));
}

/**
 * Unified Entrance Animations
 * Integrates .pretext-reveal, .title-reveal, .card-reveal, and .object-reveal
 * into a single unified observer and a staggered orchestration queue.
 * This guarantees elements reveal in strict logical/spatial order (top-to-bottom).
 */
function initUnifiedAnimations() {
    const CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%&';
    const SETTLE_FRAMES = 3;

    // Helper: Scramble text effect for pretext
    function scramble(el, originalText, callback) {
        if (el._scrambleId) cancelAnimationFrame(el._scrambleId);

        const len = originalText.length;
        let frame = 0;

        function tick() {
            const total = len * SETTLE_FRAMES;
            const lockedCount = Math.floor(frame / SETTLE_FRAMES);
            let output = '';
            for (let i = 0; i < len; i++) {
                if (originalText[i] === ' ') {
                    output += ' ';
                } else if (i < lockedCount) {
                    output += originalText[i];
                } else {
                    output += CHARS[Math.floor(Math.random() * CHARS.length)];
                }
            }
            el.textContent = output;
            if (frame < total) {
                frame++;
                el._scrambleId = requestAnimationFrame(tick);
            } else {
                el.textContent = originalText;
                el._scrambleId = null;
                if (callback) callback();
            }
        }

        el.classList.add('is-visible');
        tick();
    }

    // Helper: wrap words inside title for word-by-word fade-in
    function wrapWords(el) {
        const walker = document.createTreeWalker(el, NodeFilter.SHOW_TEXT);
        const textNodes = [];
        let node;
        while ((node = walker.nextNode())) textNodes.push(node);

        let wordIndex = 0;

        textNodes.forEach(textNode => {
            const parts = textNode.textContent.split(/(\s+)/);
            const frag = document.createDocumentFragment();

            parts.forEach(part => {
                if (!part || /^\s+$/.test(part)) {
                    frag.appendChild(document.createTextNode(part || ''));
                } else {
                    const span = document.createElement('span');
                    span.className = 'title-word';
                    span.style.setProperty('--word-index', wordIndex++);
                    span.textContent = part;
                    frag.appendChild(span);
                }
            });

            textNode.parentNode.replaceChild(frag, textNode);
        });
    }

    // Prepare Title elements
    document.querySelectorAll('.title-reveal').forEach(el => {
        el.setAttribute('aria-label', el.textContent.trim());
        wrapWords(el);
    });

    // Prepare Pretext elements
    document.querySelectorAll('.pretext-reveal').forEach(el => {
        const originalText = el.textContent.trim();
        el.setAttribute('aria-label', originalText);
        el._originalText = originalText;
    });

    // Central master queue
    let masterQueue = [];
    let isProcessing = false;

    function processQueue() {
        if (masterQueue.length === 0) {
            isProcessing = false;
            return;
        }
        isProcessing = true;

        const el = masterQueue.shift();

        if (el.classList.contains('pretext-reveal')) {
            scramble(el, el._originalText);
            // Stagger next element after scramble starts (200ms)
            setTimeout(processQueue, 200);
        } else if (el.classList.contains('title-reveal')) {
            el.classList.add('is-visible');
            // Stagger next element slightly longer (350ms) to allow word fade-in to build up
            setTimeout(processQueue, 350);
        } else if (el.classList.contains('card-reveal')) {
            el.classList.add('is-visible');
            // Stagger cards by 150ms for smooth cascade
            setTimeout(processQueue, 150);
        } else if (el.classList.contains('object-reveal')) {
            el.classList.add('is-visible');
            // Stagger other objects by 150ms
            setTimeout(processQueue, 150);
        } else {
            el.classList.add('is-visible');
            setTimeout(processQueue, 100);
        }
    }

    const io = new IntersectionObserver((entries) => {
        const visibleEntries = entries.filter(e => e.isIntersecting);

        if (visibleEntries.length === 0) return;

        // Sort all intersecting elements relative to their scroll position
        // Top-to-bottom, and left-to-right (horizontal sorting)
        visibleEntries.sort((a, b) => {
            const rectA = a.target.getBoundingClientRect();
            const rectB = b.target.getBoundingClientRect();
            if (Math.abs(rectA.top - rectB.top) < 50) {
                return rectA.left - rectB.left;
            }
            return rectA.top - rectB.top;
        });

        visibleEntries.forEach(entry => {
            io.unobserve(entry.target);
            masterQueue.push(entry.target);
        });

        if (!isProcessing) processQueue();

    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observe all visual reveal targets
    const selectors = '.pretext-reveal, .title-reveal, .card-reveal, .object-reveal';
    document.querySelectorAll(selectors).forEach(el => io.observe(el));
}

/**
 * Smooth Scroll for Sticky Anchor Links
 * Bypasses the native anchor jump bug where browsers won't scroll 
 * to a sticky element if it's currently stuck at the top.
 */
function initStickyAnchorLinks() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetEl = document.querySelector(targetId);
            if (!targetEl) return;

            // Verificar si el enlace apunta a un bloque o algo dentro de un bloque
            const targetBlock = targetEl.classList.contains('block') ? targetEl : targetEl.closest('.block');

            if (targetBlock) {
                e.preventDefault();

                const blocks = Array.from(document.querySelectorAll('.site-main > .block'));
                const targetIndex = blocks.indexOf(targetBlock);

                if (targetIndex !== -1) {
                    let scrollPos = 0;

                    // Sumamos la posición inicial del contenedor general en la página
                    const siteMain = document.querySelector('.site-main');
                    if (siteMain) {
                        scrollPos += siteMain.getBoundingClientRect().top + window.scrollY;
                    }

                    // Sumamos la altura de todos los bloques que están antes que nuestro objetivo
                    for (let i = 0; i < targetIndex; i++) {
                        scrollPos += blocks[i].offsetHeight;
                    }

                    // Removemos .is-bottom preventivamente para asegurar que sea visible al llegar
                    targetBlock.classList.remove('is-bottom');

                    window.scrollTo({
                        top: scrollPos,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if (typeof initHeroCrisisGrid === 'function') {
        initHeroCrisisGrid(
            '#Negligencia', '#MalasPrácticas', '#Escándalo', '#Fraude',
            '#Corrupción', '#Acoso', '#Discriminación', '#Filtración',
            '#Demanda', '#Boicot', '#DespidoMasivo', '#FugaDeDatos',
            '#ProductoDefectuoso', '#Polémica', '#Difamación',
            '#AbusoLaboral', '#LavadoDeDinero', '#CrisisAmbiental',
            '#PublicidadEngañosa', '#Soborno', '#CrisisDeConfianza',
            '#DeclaracionesOfensivas', '#ConflictoDeInterés',
            '#FaltaDeTransparencia', '#ExplotaciónLaboral',
            '#MalaPraxis', '#PlagioCorporativo', '#DañoAmbiental',
            '#ManipulaciónMediatica', '#RetiradaDeProducto',
            '#CrisisSanitaria', '#Impunidad', '#RumoresVirales',
            '#CaídaDeReputación', '#EscándaloFiscal'
        );
    }

    if (typeof initStickyOverlapEffect === 'function') {
        initStickyOverlapEffect();
    }

    if (typeof initBlockViewportObserver === 'function') {
        initBlockViewportObserver();
    }

    if (typeof initUnifiedAnimations === 'function') {
        initUnifiedAnimations();
    }

    if (typeof initStickyAnchorLinks === 'function') {
        initStickyAnchorLinks();
    }

    // Interactive hearings radar and panels
    const panels = document.querySelectorAll('#hearings .hearing-panel');
    const quadrants = document.querySelectorAll('#hearings .radar-quadrant');

    function setActiveDepartment(dept) {
        panels.forEach(p => {
            if (p.dataset.department === dept) {
                p.classList.add('active');
            } else {
                p.classList.remove('active');
            }
        });

        quadrants.forEach(q => {
            if (q.dataset.target === dept) {
                q.classList.add('active');
            } else {
                q.classList.remove('active');
            }
        });
    }

    // Set first one active initially
    if (panels.length > 0) {
        const firstDept = panels[0].dataset.department;
        setActiveDepartment(firstDept);
    }

    panels.forEach(panel => {
        panel.addEventListener('mouseenter', () => {
            const dept = panel.dataset.department;
            setActiveDepartment(dept);
        });

        panel.addEventListener('click', () => {
            const dept = panel.dataset.department;
            setActiveDepartment(dept);
        });
    });
});