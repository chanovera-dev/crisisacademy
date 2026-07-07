/* ═══════════════════════════════════════════════════════════
   testimonies.js — Infinite loop overlapping coverflow carousel
   ═══════════════════════════════════════════════════════════ */
document.addEventListener("DOMContentLoaded", function () {
    const section = document.getElementById("testimonies");
    if (!section) return;

    const avatars = Array.from(section.querySelectorAll(".avatar-item"));
    const cards = Array.from(section.querySelectorAll(".testimony-card"));
    const bulletsWrapper = section.querySelector(".testi-bullets");
    const prevBtn = section.querySelector(".testi-prev");
    const nextBtn = section.querySelector(".testi-next");

    if (avatars.length === 0 || cards.length === 0) return;

    const total = 7;
    let current = 3; // Start in the middle index for balanced entrance
    let isAnimating = false;

    // Build bullets
    if (bulletsWrapper) {
        bulletsWrapper.innerHTML = "";
        for (let i = 0; i < total; i++) {
            const b = document.createElement("div");
            b.classList.add("bullet");
            if (i === current) b.classList.add("active");
            b.dataset.index = i;
            bulletsWrapper.appendChild(b);
        }
    }
    const bullets = bulletsWrapper ? bulletsWrapper.querySelectorAll(".bullet") : [];

    function updateBullets(idx) {
        bullets.forEach((b, i) => b.classList.toggle("active", i === idx));
    }

    function renderCarousel() {
        const width = window.innerWidth;
        const isMobile = width < 768;
        const isTablet = width >= 768 && width < 1024;

        // Render cards
        cards.forEach((card, i) => {
            let diff = i - current;
            if (diff < -3) diff += total;
            if (diff > 3) diff -= total;

            const absDiff = Math.abs(diff);

            // Overlapping Card z-index
            card.style.zIndex = 10 - absDiff * 2;

            let translateX = 0;
            let scale = 1 - absDiff * 0.1;
            let opacity = 1;

            if (isMobile) {
                translateX = diff * 50; // compact stacking
                scale = 1 - absDiff * 0.15;
                opacity = absDiff > 1 ? 0 : 1; // only show immediate neighbors
            } else if (isTablet) {
                translateX = diff * 160;
                scale = 1 - absDiff * 0.12;
                opacity = absDiff > 2 ? 0 : 1;
            } else {
                translateX = diff * 240; // desktop full layout
            }

            card.style.transform = `translateX(${translateX}px) scale(${scale})`;
            card.style.opacity = opacity;
            card.classList.toggle("active", diff === 0);
            card.classList.toggle("prev", diff < 0);
            card.classList.toggle("next", diff > 0);
        });

        // Render avatars
        avatars.forEach((avatar, i) => {
            let diff = i - current;
            if (diff < -3) diff += total;
            if (diff > 3) diff -= total;

            const absDiff = Math.abs(diff);
            avatar.style.zIndex = 10 - absDiff * 2;

            let translateX = 0;
            let scale = 1.3 - absDiff * 0.22;
            let opacity = 1 - absDiff * 0.22;

            if (isMobile) {
                translateX = diff * 45;
                scale = 1.2 - absDiff * 0.28;
                opacity = absDiff > 2 ? 0 : (1 - absDiff * 0.35);
            } else if (isTablet) {
                translateX = diff * 70;
            } else {
                translateX = diff * 90; // desktop spacing
            }

            avatar.style.transform = `translateX(${translateX}px) scale(${scale})`;
            avatar.style.opacity = opacity >= 0 ? opacity : 0;
            avatar.classList.toggle("active", diff === 0);
        });

        updateBullets(current);
    }

    function goToSlide(targetIdx) {
        if (isAnimating) return;
        isAnimating = true;

        current = ((targetIdx % total) + total) % total;
        renderCarousel();

        setTimeout(() => {
            isAnimating = false;
        }, 500);
    }

    // Controls listeners
    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            goToSlide(current - 1);
            resetAutoplay();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            goToSlide(current + 1);
            resetAutoplay();
        });
    }

    if (bulletsWrapper) {
        bulletsWrapper.addEventListener("click", (e) => {
            const b = e.target.closest(".bullet");
            if (!b) return;
            goToSlide(parseInt(b.dataset.index));
            resetAutoplay();
        });
    }

    // Click on avatar to navigate to its slide
    avatars.forEach((avatar, i) => {
        avatar.addEventListener("click", () => {
            goToSlide(i);
            resetAutoplay();
        });
    });

    // Swipe Support
    let startX = 0;
    const container = section.querySelector(".testimonies-interactive-container");
    if (container) {
        container.addEventListener("touchstart", (e) => {
            startX = e.touches[0].clientX;
        }, { passive: true });

        container.addEventListener("touchend", (e) => {
            const deltaX = e.changedTouches[0].clientX - startX;
            if (Math.abs(deltaX) > 50) {
                goToSlide(deltaX < 0 ? current + 1 : current - 1);
                resetAutoplay();
            }
        });
    }

    // Autoplay when visible
    let autoplayInterval = setInterval(() => {
        const rect = section.getBoundingClientRect();
        const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
        if (isVisible) {
            goToSlide(current + 1);
        }
    }, 10000);

    function resetAutoplay() {
        clearInterval(autoplayInterval);
        autoplayInterval = setInterval(() => {
            const rect = section.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
            if (isVisible) {
                goToSlide(current + 1);
            }
        }, 10000);
    }

    // First Render
    renderCarousel();

    // Responsive adaptation
    window.addEventListener("resize", renderCarousel);
});
