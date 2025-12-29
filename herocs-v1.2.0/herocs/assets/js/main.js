/**
 * CS Communication Theme - Main JavaScript
 * 
 * @package CS_Communication
 * @since 1.0.0
 */

(function() {
    'use strict';

    // Mobile Menu Toggle
    const initMobileMenu = () => {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const body = document.body;

        if (!menuToggle || !mobileMenu) return;

        menuToggle.addEventListener('click', () => {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('active');
            body.classList.toggle('menu-open');
            
            // Prevent body scroll when menu is open
            if (!isExpanded) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = '';
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                if (mobileMenu.classList.contains('active')) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    mobileMenu.classList.remove('active');
                    body.classList.remove('menu-open');
                    body.style.overflow = '';
                }
            }
        });

        // Close menu on ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                menuToggle.setAttribute('aria-expanded', 'false');
                mobileMenu.classList.remove('active');
                body.classList.remove('menu-open');
                body.style.overflow = '';
                menuToggle.focus();
            }
        });
    };

 // Sticky Header - OTTIMIZZATO con Throttle
const initStickyHeader = () => {
    const header = document.querySelector('.site-header');
    if (!header) return;

    let lastScroll = 0;
    let ticking = false;
    const headerHeight = header.offsetHeight;

    function updateHeaderState() {
        const currentScroll = window.pageYOffset;

        if (currentScroll <= headerHeight) {
            header.classList.remove('sticky', 'scroll-up', 'scroll-down');
        } else {
            header.classList.add('sticky');
            
            if (currentScroll > lastScroll) {
                // Scrolling down
                header.classList.remove('scroll-up');
                header.classList.add('scroll-down');
            } else {
                // Scrolling up
                header.classList.remove('scroll-down');
                header.classList.add('scroll-up');
            }
        }

        lastScroll = currentScroll;
        ticking = false;
    }

    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateHeaderState);
            ticking = true;
        }
    }, { passive: true });
};

    // Smooth Scroll for Anchor Links
    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Skip if it's just "#" or empty
                if (href === '#' || href === '') {
                    e.preventDefault();
                    return;
                }

                const target = document.querySelector(href);
                
                if (target) {
                    e.preventDefault();
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Update focus for accessibility
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            });
        });
    };

    // Dark Mode - Gestito nello script inline in header.php per evitare FOUC
    // Questa funzione ÃƒÂ¨ mantenuta vuota per compatibilitÃƒÂ  con init()
    const initDarkMode = () => {
        // Dark mode toggle ÃƒÂ¨ gestito in header.php con inline script
        // per garantire che venga applicato prima del rendering
        console.log('Dark mode: managed by header.php inline script');
    };

    // Portfolio Filter
    const initPortfolioFilter = () => {
        const filterButtons = document.querySelectorAll('.portfolio-filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        if (!filterButtons.length || !portfolioItems.length) return;

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');

                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-pressed', 'false');
                });
                button.classList.add('active');
                button.setAttribute('aria-pressed', 'true');

                // Filter items
                portfolioItems.forEach(item => {
                    if (filter === 'all' || item.classList.contains(filter)) {
                        item.style.display = '';
                        item.classList.add('fade-in');
                        setTimeout(() => {
                            item.classList.remove('fade-in');
                        }, 600);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    };

    // Back to Top Button
    const initBackToTop = () => {
        const backToTop = document.querySelector('.back-to-top');
        if (!backToTop) return;

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    };

    // Lazy Load Images Enhancement
    const initLazyLoad = () => {
        if ('loading' in HTMLImageElement.prototype) {
            // Browser supports native lazy loading
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                }
                if (img.dataset.srcset) {
                    img.srcset = img.dataset.srcset;
                }
            });
        } else {
            // Fallback: Intersection Observer
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                        }
                        if (img.dataset.srcset) {
                            img.srcset = img.dataset.srcset;
                        }
                        img.classList.add('loaded');
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    };

    // Form Validation Enhancement
    const initFormValidation = () => {
        const forms = document.querySelectorAll('.cs-form');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    const errorMessage = field.parentElement.querySelector('.error-message');
                    
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('error');
                        if (errorMessage) {
                            errorMessage.style.display = 'block';
                        }
                    } else {
                        field.classList.remove('error');
                        if (errorMessage) {
                            errorMessage.style.display = 'none';
                        }
                    }

                    // Email validation
                    if (field.type === 'email' && field.value) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            isValid = false;
                            field.classList.add('error');
                            if (errorMessage) {
                                errorMessage.textContent = 'Please enter a valid email address';
                                errorMessage.style.display = 'block';
                            }
                        }
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    // Focus first error field
                    const firstError = form.querySelector('.error');
                    if (firstError) {
                        firstError.focus();
                    }
                }
            });

            // Remove error on input
            form.querySelectorAll('[required]').forEach(field => {
                field.addEventListener('input', () => {
                    field.classList.remove('error');
                    const errorMessage = field.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }
                });
            });
        });
    };

    // Accessible Dropdown Menus
    const initAccessibleMenus = () => {
        const menuItems = document.querySelectorAll('.menu-item-has-children');

        menuItems.forEach(item => {
            const link = item.querySelector('a');
            const submenu = item.querySelector('.sub-menu');

            if (!link || !submenu) return;

            // Add aria attributes
            link.setAttribute('aria-haspopup', 'true');
            link.setAttribute('aria-expanded', 'false');

            // Toggle on click
            link.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    const isExpanded = link.getAttribute('aria-expanded') === 'true';
                    link.setAttribute('aria-expanded', !isExpanded);
                    item.classList.toggle('active');
                }
            });

            // Keyboard navigation
            link.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const isExpanded = link.getAttribute('aria-expanded') === 'true';
                    link.setAttribute('aria-expanded', !isExpanded);
                    item.classList.toggle('active');
                }
            });
        });
    };

    // Skip to Content Link
    const initSkipLink = () => {
        const skipLink = document.querySelector('.skip-link');
        if (!skipLink) return;

        skipLink.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(skipLink.getAttribute('href'));
            if (target) {
                target.setAttribute('tabindex', '-1');
                target.focus();
            }
        });
    };

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

    // Hero Slider - ACF Dynamic with Swiper
    const initHeroSlider = () => {
        const heroSwiper = document.querySelector('.hero-swiper');
        if (!heroSwiper) return;

        // Controlla se Swiper e disponibile
        if (typeof Swiper === 'undefined') {
            console.warn('Swiper not loaded - Hero Slider disabled');
            return;
        }

        // Leggi configurazione dal data attributes
        const speed = parseInt(heroSwiper.dataset.speed) || 5000;
        const effect = heroSwiper.dataset.effect || 'fade';
        const slideCount = parseInt(heroSwiper.dataset.slides) || 1;

        // Inizializza Swiper
        const swiper = new Swiper('.hero-swiper', {
            // Effetto
            effect: effect,
            fadeEffect: {
                crossFade: true
            },
            
            // Autoplay
            autoplay: slideCount > 1 ? {
                delay: speed,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            } : false,
            
            // Loop
            loop: slideCount > 1,
            
            // Speed
            speed: 800,
            
            // Navigation
            navigation: {
                nextEl: '.hero-nav-next',
                prevEl: '.hero-nav-prev',
            },
            
            // Pagination
            pagination: {
                el: '.hero-pagination',
                clickable: true,
                bulletClass: 'swiper-pagination-bullet',
                bulletActiveClass: 'swiper-pagination-bullet-active',
            },
            
            // Keyboard
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Accessibility
            a11y: {
                prevSlideMessage: 'Slide precedente',
                nextSlideMessage: 'Slide successiva',
                paginationBulletMessage: 'Vai alla slide {{index}}',
            },
            
            // Events
            on: {
                init: function() {
                    // Trigger animations on first slide
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) {
                        activeSlide.classList.add('slide-animated');
                    }
                },
                slideChange: function() {
                    // Reset e trigger animations
                    this.slides.forEach(slide => {
                        slide.classList.remove('slide-animated');
                    });
                    
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) {
                        setTimeout(() => {
                            activeSlide.classList.add('slide-animated');
                        }, 100);
                    }
                },
            },
        });

        // Pause autoplay when video is playing
        const videos = heroSwiper.querySelectorAll('iframe');
        videos.forEach(video => {
            video.addEventListener('load', () => {
                // Video loaded
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (!heroSwiper.matches(':hover')) return;
            
            if (e.key === 'ArrowLeft') {
                swiper.slidePrev();
            } else if (e.key === 'ArrowRight') {
                swiper.slideNext();
            } else if (e.key === ' ') {
                e.preventDefault();
                if (swiper.autoplay.running) {
                    swiper.autoplay.stop();
                } else {
                    swiper.autoplay.start();
                }
            }
        });

        // Expose to window for debugging
        window.heroSwiper = swiper;
    };

    // Initialize all functions when DOM is ready
    const init = () => {
        // Core functionality
        initMobileMenu();
        initStickyHeader();
        initSmoothScroll();
        initDarkMode();
        initPortfolioFilter();
        initBackToTop();
        initLazyLoad();
        initFormValidation();
        initAccessibleMenus();
        initSkipLink();
        
        // Animations
        initCounters();
        initRevealAnimations();
        initHeroSlider();

        // Add loaded class to body
        document.body.classList.add('loaded');
        
        console.log('HeroCS: All modules initialized');
    };

    // Throttle utility function
    const throttle = (func, delay) => {
        let lastCall = 0;
        return function(...args) {
            const now = new Date().getTime();
            if (now - lastCall >= delay) {
                lastCall = now;
                return func(...args);
            }
        };
    };

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Handle window resize with throttle
    window.addEventListener('resize', throttle(() => {
        // Close mobile menu on resize
        document.body.classList.remove('menu-open');
        document.body.style.overflow = '';
        
        // Recalculate header if needed
        const header = document.querySelector('.site-header');
        if (header) {
            header.style.transition = 'none';
            void header.offsetHeight;
            header.style.transition = '';
        }
    }, 250));

})();