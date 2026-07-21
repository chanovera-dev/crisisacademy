/**
 * Contact Page JavaScript — The Crisis Academy
 * Executive Intake, Category Pills, Accordion, Mouse Tracking Glow & Sticky Overlap
 */

document.addEventListener('DOMContentLoaded', function () {

    // ── 1. Category Pills Selector ───────────────────────────
    const catPills = document.querySelectorAll('.cat-pill');

    if (catPills.length > 0) {
        catPills.forEach(pill => {
            pill.addEventListener('click', () => {
                catPills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');

                const radio = pill.querySelector('input[type="radio"]');
                if (radio) {
                    radio.checked = true;
                }
            });
        });
    }

    // ── 2. Intake Form Handler ───────────────────────────────
    const intakeForm = document.getElementById('crisis-intake-form');
    const formResponseMsg = document.getElementById('form-response-message');

    if (intakeForm) {
        intakeForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = intakeForm.querySelector('.btn-submit');
            const originalBtnHTML = submitBtn ? submitBtn.innerHTML : '';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
                submitBtn.innerHTML = `<span>Procesando Recepción Confidencial...</span>`;
            }

            // Simulate encrypted AJAX dispatch
            setTimeout(() => {
                if (formResponseMsg) {
                    formResponseMsg.className = 'form-response-msg success';
                    formResponseMsg.innerHTML = `
                        <strong>Protocolo de Recepción Confidencial Activado.</strong><br>
                        Su información ha sido encriptada e ingresada al centro de mando. Un socio consultor sénior se comunicará telefónicamente en menos de 120 minutos.
                    `;
                    formResponseMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }

                intakeForm.reset();

                // Reset category pills
                catPills.forEach((p, idx) => {
                    if (idx === 0) p.classList.add('active');
                    else p.classList.remove('active');
                });

                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.innerHTML = originalBtnHTML;
                }
            }, 1200);
        });
    }

    // ── 3. FAQ Accordion Panels ──────────────────────────────
    const faqPanels = document.querySelectorAll('#contact-faq .method-panel');

    if (faqPanels.length > 0) {
        function activateFaqPanel(targetPanel) {
            faqPanels.forEach(p => p.classList.remove('active'));
            targetPanel.classList.add('active');
        }

        faqPanels.forEach(panel => {
            panel.addEventListener('mouseenter', () => {
                activateFaqPanel(panel);
            });

            panel.addEventListener('click', () => {
                activateFaqPanel(panel);
            });
        });
    }

    // ── 4. Scroll Reveal Observer ────────────────────────────
    const revealElements = document.querySelectorAll('.object-reveal');

    if (revealElements.length > 0 && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => observer.observe(el));
    } else {
        revealElements.forEach(el => el.classList.add('is-visible'));
    }

    // ── 5. Mouse Tracking Card Glow ──────────────────────────
    function initContactGlowEffect() {
        const glowTargets = document.querySelectorAll('.data-block, .channel-card, .radar-channel-strip, #contact-faq .method-panel, .contact-form-container');

        glowTargets.forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                el.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                el.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
        });

        // Hero section glow tracking
        const heroSection = document.getElementById('contact-hero');
        if (heroSection) {
            heroSection.addEventListener('mousemove', (e) => {
                const rect = heroSection.getBoundingClientRect();
                heroSection.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                heroSection.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
        }
    }

    initContactGlowEffect();

    // ── 5.1 Channels Console Interactive Tabs ────────────────
    function initChannelsConsole() {
        const tabs = document.querySelectorAll('.console-tab');
        const panels = document.querySelectorAll('.console-panel');

        if (!tabs.length || !panels.length) return;

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetChannel = tab.getAttribute('data-channel');

                tabs.forEach(t => t.classList.remove('is-active'));
                panels.forEach(p => p.classList.remove('is-active'));

                tab.classList.add('is-active');
                const targetPanel = document.getElementById(`panel-${targetChannel}`);
                if (targetPanel) {
                    targetPanel.classList.add('is-active');
                }
            });
        });
    }

    initChannelsConsole();

    // ── 6. Protocol Steps Progressive Reveal & Dynamic Card Resizing ──────
    const protocolSteps = document.querySelectorAll('.protocol-steps .p-step');
    if (protocolSteps.length > 0) {
        let stepPhase = 0;

        function runProtocolSequence() {
            if (stepPhase === 0) {
                // Phase 0: Step 1 appears
                protocolSteps.forEach((s, idx) => {
                    if (idx === 0) {
                        s.classList.add('visible', 'active');
                    } else {
                        s.classList.remove('visible', 'active');
                    }
                });
                stepPhase = 1;
                setTimeout(runProtocolSequence, 1800);
            } else if (stepPhase === 1) {
                // Phase 1: Step 2 appears
                if (protocolSteps[0]) protocolSteps[0].classList.remove('active');
                if (protocolSteps[1]) protocolSteps[1].classList.add('visible', 'active');
                stepPhase = 2;
                setTimeout(runProtocolSequence, 1800);
            } else if (stepPhase === 2) {
                // Phase 2: Step 3 appears
                if (protocolSteps[1]) protocolSteps[1].classList.remove('active');
                if (protocolSteps[2]) protocolSteps[2].classList.add('visible', 'active');
                stepPhase = 3;
                setTimeout(runProtocolSequence, 3500); // Hold full state
            } else {
                // Reset phase: collapse steps before restarting
                stepPhase = 0;
                protocolSteps.forEach(s => s.classList.remove('visible', 'active'));
                setTimeout(runProtocolSequence, 700);
            }
        }

        setTimeout(runProtocolSequence, 400);
    }

    // ── 7. Custom Select Dropdown Handler ─────────────────────
    function initCustomSelects() {
        const customSelects = document.querySelectorAll('.custom-select-wrapper');

        customSelects.forEach(wrapper => {
            const trigger = wrapper.querySelector('.custom-select-trigger');
            const options = wrapper.querySelectorAll('.custom-option');
            const nativeSelect = wrapper.querySelector('.hidden-select-input');
            const selectedTextSpan = wrapper.querySelector('.selected-value');

            if (!trigger || !nativeSelect) return;

            // Toggle dropdown open/close
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();

                // Close other open selects first
                customSelects.forEach(other => {
                    if (other !== wrapper) other.classList.remove('is-open');
                });

                const isOpen = wrapper.classList.toggle('is-open');
                trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });

            // Handle option selection
            options.forEach(opt => {
                opt.addEventListener('click', (e) => {
                    e.stopPropagation();

                    const val = opt.getAttribute('data-value');
                    const text = opt.querySelector('.option-text')?.textContent || opt.textContent;

                    // Update native select
                    nativeSelect.value = val;
                    nativeSelect.dispatchEvent(new Event('change', { bubbles: true }));

                    // Update UI text and active states
                    if (selectedTextSpan) selectedTextSpan.textContent = text;

                    options.forEach(o => o.classList.remove('selected'));
                    opt.classList.add('selected');

                    // Close dropdown
                    wrapper.classList.remove('is-open');
                    trigger.setAttribute('aria-expanded', 'false');
                });
            });

            // Keyboard navigation
            trigger.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    trigger.click();
                } else if (e.key === 'Escape') {
                    wrapper.classList.remove('is-open');
                    trigger.setAttribute('aria-expanded', 'false');
                }
            });
        });

        // Close dropdown when clicking anywhere outside
        document.addEventListener('click', () => {
            customSelects.forEach(wrapper => {
                wrapper.classList.remove('is-open');
                const trigger = wrapper.querySelector('.custom-select-trigger');
                if (trigger) trigger.setAttribute('aria-expanded', 'false');
            });
        });
    }

    initCustomSelects();

    // ── 8. Sticky Overlap Effect ─────────────────────────────
    if (typeof initStickyOverlapEffect === 'function') {
        initStickyOverlapEffect();
    }
});
