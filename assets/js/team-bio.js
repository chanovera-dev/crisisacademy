/**
 * Team Bio Page Interactive Scripts
 * Design: Matching team page and homepage interactions
 * Theme: The Crisis Academy
 */

document.addEventListener('DOMContentLoaded', () => {

    // ── 1. Scroll Reveal Observer ────────────────────────────
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

    // ── 2. Card Glow Effect (mouse tracking) ────────────────
    function initBioGlowEffect() {
        const glowTargets = document.querySelectorAll('.specialty-card, .hero-glow');

        glowTargets.forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                el.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                el.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
        });

        // Hero section glow
        const heroSection = document.getElementById('bio-hero');
        if (heroSection) {
            heroSection.addEventListener('mousemove', (e) => {
                const rect = heroSection.getBoundingClientRect();
                heroSection.style.setProperty('--mouse-x', `${e.clientX - rect.left}px`);
                heroSection.style.setProperty('--mouse-y', `${e.clientY - rect.top}px`);
            });
        }
    }

    initBioGlowEffect();

    // ── 3. Sticky Overlap Effect ─────────────────────────────
    if (typeof initStickyOverlapEffect === 'function') {
        initStickyOverlapEffect();
    }

    // ── 4. Timeline Staggered Reveal ─────────────────────────
    const timelineItems = document.querySelectorAll('.timeline-item');
    if ('IntersectionObserver' in window && timelineItems.length > 0) {
        const timelineObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    timelineObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2,
            rootMargin: '0px 0px -30px 0px'
        });

        timelineItems.forEach(el => timelineObserver.observe(el));
    }
});
