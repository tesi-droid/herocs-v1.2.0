/**
 * HeroCS Theme - Animations
 * Intersection Observer based animations
 * 
 * @package HeroCS
 * @since 1.0.0
 */

(function() {
    'use strict';

    // Counter Animation for stats
    const animateCounter = (element, target, duration = 2000) => {
        if (!element || !target) return;

        const start = 0;
        const increment = target / (duration / 16); // 60fps
        let current = start;

        const updateCounter = () => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
            } else {
                element.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            }
        };

        updateCounter();
    };

    // Initialize counters when they come into view
    const initCounters = () => {
        const counters = document.querySelectorAll('.cs-counter');
        if (!counters.length) return;

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                    entry.target.classList.add('animated');
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    const duration = parseInt(entry.target.getAttribute('data-duration')) || 2000;
                    animateCounter(entry.target, target, duration);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => counterObserver.observe(counter));
    };

    // Reveal animations on scroll
    const initRevealAnimations = () => {
        const revealElements = document.querySelectorAll('.cs-reveal');
        if (!revealElements.length) return;

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    };

    // Stagger group animations
    const initStaggerAnimations = () => {
        const staggerGroups = document.querySelectorAll('.cs-stagger-group');
        if (!staggerGroups.length) return;

        const staggerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('staggered')) {
                    entry.target.classList.add('staggered');
                    const items = entry.target.querySelectorAll('.cs-stagger-item');
                    
                    items.forEach((item, index) => {
                        item.style.animationDelay = `${index * 0.1}s`;
                        item.classList.add('stagger-animate');
                    });
                    
                    staggerObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        staggerGroups.forEach(group => staggerObserver.observe(group));
    };

    // Fade in animations
    const initFadeInAnimations = () => {
        const fadeElements = document.querySelectorAll('.cs-fade-in');
        if (!fadeElements.length) return;

        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-visible');
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        fadeElements.forEach(el => fadeObserver.observe(el));
    };

    // Tilt card effect on mouse move
    const initTiltCards = () => {
        const tiltCards = document.querySelectorAll('.cs-tilt-card');
        if (!tiltCards.length) return;

        tiltCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * 5;
                const rotateY = ((centerX - x) / centerX) * 5;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
            });
        });
    };

    // Parallax effect
    const initParallaxEffect = () => {
        const parallaxElements = document.querySelectorAll('[data-parallax]');
        if (!parallaxElements.length) return;

        window.addEventListener('scroll', () => {
            parallaxElements.forEach(element => {
                const speed = element.getAttribute('data-parallax') || 0.5;
                const yPos = window.pageYOffset * speed;
                element.style.backgroundPosition = `center ${yPos}px`;
            });
        });
    };

    // Typing text animation
    const initTypingAnimation = () => {
        const typingElements = document.querySelectorAll('.cs-typing-text');
        if (!typingElements.length) return;

        typingElements.forEach(element => {
            const text = element.textContent;
            const speed = parseInt(element.getAttribute('data-speed')) || 50;
            let index = 0;

            element.textContent = '';

            const type = () => {
                if (index < text.length) {
                    element.textContent += text.charAt(index);
                    index++;
                    setTimeout(type, speed);
                }
            };

            // Start typing when element comes into view
            const typingObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && index === 0) {
                        type();
                        typingObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            typingObserver.observe(element);
        });
    };

    // Magnetic button effect
    const initMagneticButtons = () => {
        const magneticBtns = document.querySelectorAll('.cs-magnetic-btn');
        if (!magneticBtns.length) return;

        magneticBtns.forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const moveX = (x - centerX) * 0.3;
                const moveY = (y - centerY) * 0.3;
                
                btn.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });

            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'translate(0, 0)';
            });
        });
    };

    // Scroll progress bar
    const initScrollProgress = () => {
        const progressBar = document.querySelector('.scroll-progress-bar');
        if (!progressBar) return;

        window.addEventListener('scroll', () => {
            const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (window.scrollY / windowHeight) * 100;
            progressBar.style.width = scrolled + '%';
        });
    };

    // Initialize all animations
    const init = () => {
        initCounters();
        initRevealAnimations();
        initStaggerAnimations();
        initFadeInAnimations();
        initTiltCards();
        initParallaxEffect();
        initTypingAnimation();
        initMagneticButtons();
        initScrollProgress();
    };

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();