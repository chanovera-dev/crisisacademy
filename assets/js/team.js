/**
 * Team Page Interactive Scripts
 * Design: Matching corporate-crisisacademy-homepage interactions
 * Theme: The Crisis Academy
 */

document.addEventListener('DOMContentLoaded', () => {

    // ── 1. Founder Spotlight Tabs ────────────────────────────
    const spotTabBtns = document.querySelectorAll('.spot-tab-btn');
    const spotTabPanels = document.querySelectorAll('.spot-tab-panel');

    if (spotTabBtns.length > 0 && spotTabPanels.length > 0) {
        spotTabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const targetTabId = btn.getAttribute('data-spot-tab');

                spotTabBtns.forEach(b => {
                    b.classList.remove('active', 'primary');
                    b.classList.add('hollow');
                });
                btn.classList.remove('hollow');
                btn.classList.add('active', 'primary');

                spotTabPanels.forEach(p => {
                    if (p.id === targetTabId) {
                        p.classList.add('active');
                    } else {
                        p.classList.remove('active');
                    }
                });
            });
        });
    }

    // ── 2. Category Filter Bar ──────────────────────────────
    const filterBtns = document.querySelectorAll('.filter-bar .filter-btn');
    const expertCards = document.querySelectorAll('.experts-grid .expert-card');

    if (filterBtns.length > 0 && expertCards.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const filter = btn.getAttribute('data-filter');

                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                expertCards.forEach(card => {
                    const categories = card.getAttribute('data-category') || '';
                    if (filter === 'all' || categories.split(' ').includes(filter)) {
                        card.classList.remove('is-hidden');
                    } else {
                        card.classList.add('is-hidden');
                    }
                });
            });
        });
    }

    // ── 3. Methodology Panel Accordion ──────────────────────
    const methodPanels = document.querySelectorAll('.method-panel');

    if (methodPanels.length > 0) {
        methodPanels.forEach(panel => {
            panel.addEventListener('click', () => {
                const isActive = panel.classList.contains('active');

                // Close all panels
                methodPanels.forEach(p => p.classList.remove('active'));

                // Toggle clicked panel
                if (!isActive) {
                    panel.classList.add('active');
                }
            });
        });
    }

    // ── 4. Side Drawer ──────────────────────────────────────
    const drawerOverlay = document.getElementById('expert-drawer-overlay');
    const openDrawerBtns = document.querySelectorAll('[data-open-drawer]');
    const closeDrawerBtns = document.querySelectorAll('[data-close-drawer]');
    const drawerPanes = document.querySelectorAll('.drawer-content-pane');

    function openDrawer(expertId) {
        if (!drawerOverlay) return;

        // Hide all panes
        drawerPanes.forEach(pane => pane.classList.remove('active'));

        // Show target pane
        const targetPane = drawerOverlay.querySelector(`[data-drawer-pane="${expertId}"]`);
        if (targetPane) {
            targetPane.classList.add('active');
        }

        drawerOverlay.classList.add('is-open');
        drawerOverlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        if (!drawerOverlay) return;
        drawerOverlay.classList.remove('is-open');
        drawerOverlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }

    openDrawerBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const expertId = btn.getAttribute('data-open-drawer');
            openDrawer(expertId);
        });
    });

    closeDrawerBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            closeDrawer();
        });
    });

    // Close on ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && drawerOverlay && drawerOverlay.classList.contains('is-open')) {
            closeDrawer();
        }
    });

    // ── 5. Inner Drawer Tabs ────────────────────────────────
    const dTabBtns = document.querySelectorAll('.d-tab-btn');
    dTabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-d-tab');
            const parentPane = btn.closest('.drawer-content-pane');
            if (!parentPane) return;

            const tabsInPane = parentPane.querySelectorAll('.d-tab-btn');
            const panelsInPane = parentPane.querySelectorAll('.d-panel');

            tabsInPane.forEach(t => t.classList.remove('active'));
            btn.classList.add('active');

            panelsInPane.forEach(p => {
                if (p.id === `d-panel-${targetId}`) {
                    p.classList.add('active');
                } else {
                    p.classList.remove('active');
                }
            });
        });
    });

    // ── 6. Scroll Reveal Observer ────────────────────────────
    const revealElements = document.querySelectorAll('.object-reveal, .card-reveal, .pretext-reveal');
    if ('IntersectionObserver' in window && revealElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => observer.observe(el));
    } else {
        revealElements.forEach(el => el.classList.add('is-visible'));
    }

    // ── 7. Card Glow Effect (mouse tracking) ────────────────
    function initCardGlowEffect() {
        const glowTargets = document.querySelectorAll('.data-block, .method-panel, .hero-glow');

        glowTargets.forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                el.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                el.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
        });

        // Hero section glow
        const heroSection = document.getElementById('team-hero');
        if (heroSection) {
            heroSection.addEventListener('mousemove', (e) => {
                const rect = heroSection.getBoundingClientRect();
                heroSection.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                heroSection.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
        }
    }

    initCardGlowEffect();
});
