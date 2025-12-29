/**
 * HeroCS Theme - Main JavaScript
 * Includes: Navigation, Dark Mode, Swiper Sliders, Animations
 * 
 * @package HeroCS
 * @since 1.2.0
 */

(function() {
    'use strict';

    // ============================================================================
    // MOBILE MENU
    // ============================================================================
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

    // ============================================================================
    // STICKY HEADER
    // ============================================================================
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
                    header.classList.remove('scroll-up');
                    header.classList.add('scroll-down');
                } else {
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

    // ============================================================================
    // SMOOTH SCROLL
    // ============================================================================
    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
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

                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            });
        });
    };

    // ============================================================================
    // DARK MODE - Managed by header.php
    // ============================================================================
    const initDarkMode = () => {
        // Dark mode toggle is managed in header.php with inline script
        console.log('Dark mode: managed by header.php inline script');
    };

    // ============================================================================
    // PORTFOLIO FILTER
    // ============================================================================
    const initPortfolioFilter = () => {
        const filterButtons = document.querySelectorAll('.portfolio-filter-btn');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        if (!filterButtons.length || !portfolioItems.length) return;

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');

                filterButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-pressed', 'false');
                });
                button.classList.add('active');
                button.setAttribute('aria-pressed', 'true');

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

    // ============================================================================
    // BACK TO TOP
    // ============================================================================
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

    // ============================================================================
    // LAZY LOAD IMAGES
    // ============================================================================
    const initLazyLoad = () => {
        if ('loading' in HTMLImageElement.prototype) {
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

    // ============================================================================
    // FORM VALIDATION
    // ============================================================================
    const initFormValidation = () => {
        const forms = document.querySelectorAll('.cs-form');
        
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('error');
                        
                        // Show error message
                        let errorMsg = field.parentNode.querySelector('.error-message');
                        if (!errorMsg) {
                            errorMsg = document.createElement('span');
                            errorMsg.className = 'error-message';
                            errorMsg.textContent = 'Questo campo è obbligatorio';
                            field.parentNode.appendChild(errorMsg);
                        }
                    } else {
                        field.classList.remove('error');
                        const errorMsg = field.parentNode.querySelector('.error-message');
                        if (errorMsg) {
                            errorMsg.remove();
                        }
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
            
            // Real-time validation
            form.querySelectorAll('[required]').forEach(field => {
                field.addEventListener('blur', () => {
                    if (!field.value.trim()) {
                        field.classList.add('error');
                    } else {
                        field.classList.remove('error');
                        const errorMsg = field.parentNode.querySelector('.error-message');
                        if (errorMsg) {
                            errorMsg.remove();
                        }
                    }
                });
            });
        });
    };

    // ============================================================================
    // ACCESSIBLE MENUS
    // ============================================================================
    const initAccessibleMenus = () => {
        const menuItems = document.querySelectorAll('.menu-item-has-children > a');
        
        menuItems.forEach(item => {
            item.addEventListener('keydown', (e) => {
                const submenu = item.nextElementSibling;
                if (!submenu) return;
                
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    submenu.classList.toggle('visible');
                } else if (e.key === 'Escape') {
                    submenu.classList.remove('visible');
                }
            });
        });
    };

    // ============================================================================
    // SKIP LINK
    // ============================================================================
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

    // ============================================================================
    // COUNTERS ANIMATION
    // ============================================================================
    const animateCounter = (element, target, duration = 2000) => {
        if (!element || !target) return;

        const start = 0;
        const increment = target / (duration / 16);
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

    // ============================================================================
    // REVEAL ANIMATIONS
    // ============================================================================
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

    // ============================================================================
    // HERO SLIDER - Swiper Configuration
    // ============================================================================
    const initHeroSlider = () => {
        const heroSwiper = document.querySelector('.hero-swiper');
        if (!heroSwiper) return;

        if (typeof Swiper === 'undefined') {
            console.warn('Swiper not loaded - Hero Slider disabled');
            return;
        }

        const speed = parseInt(heroSwiper.dataset.speed) || 5000;
        const effect = heroSwiper.dataset.effect || 'fade';
        const slideCount = parseInt(heroSwiper.dataset.slides) || 1;

        const swiper = new Swiper('.hero-swiper', {
            effect: effect,
            fadeEffect: {
                crossFade: true
            },
            autoplay: slideCount > 1 ? {
                delay: speed,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            } : false,
            loop: slideCount > 1,
            speed: 800,
            navigation: {
                nextEl: '.hero-nav-next',
                prevEl: '.hero-nav-prev',
            },
            pagination: {
                el: '.hero-pagination',
                clickable: true,
                bulletClass: 'swiper-pagination-bullet',
                bulletActiveClass: 'swiper-pagination-bullet-active',
            },
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            a11y: {
                prevSlideMessage: 'Slide precedente',
                nextSlideMessage: 'Slide successiva',
                paginationBulletMessage: 'Vai alla slide {{index}}',
            },
            on: {
                init: function() {
                    const activeSlide = this.slides[this.activeIndex];
                    if (activeSlide) {
                        activeSlide.classList.add('slide-animated');
                    }
                },
                slideChange: function() {
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

        window.heroSwiper = swiper;
    };

    // ============================================================================
    // TEAM SLIDER - Swiper Configuration
    // ============================================================================
    const initTeamSlider = () => {
        const teamSwiper = document.querySelector('.team-swiper');
        if (!teamSwiper) return;

        if (typeof Swiper === 'undefined') {
            console.warn('Swiper not loaded - Team Slider disabled');
            return;
        }

        const slideCount = teamSwiper.querySelectorAll('.swiper-slide').length;

        const swiper = new Swiper('.team-swiper', {
            // Layout
            slidesPerView: 2,
            spaceBetween: 20,
            
            // Loop only if enough slides
            loop: slideCount >= 6,
            
            // Speed
            speed: 600,
            
            // Autoplay
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            // Navigation
            navigation: {
                nextEl: '.team-nav-next',
                prevEl: '.team-nav-prev',
            },
            
            // Pagination
            pagination: {
                el: '.team-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            
            // Responsive breakpoints
            breakpoints: {
                // Mobile
                320: {
                    slidesPerView: 1.2,
                    spaceBetween: 16,
                    centeredSlides: true,
                },
                // Mobile landscape
                480: {
                    slidesPerView: 2,
                    spaceBetween: 16,
                    centeredSlides: false,
                },
                // Tablet
                768: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
                // Desktop
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 28,
                },
                // Large desktop
                1280: {
                    slidesPerView: 5,
                    spaceBetween: 30,
                },
                // Extra large
                1536: {
                    slidesPerView: 6,
                    spaceBetween: 32,
                },
            },
            
            // Keyboard
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Accessibility
            a11y: {
                prevSlideMessage: 'Membro precedente',
                nextSlideMessage: 'Membro successivo',
                slideLabelMessage: 'Slide {{index}} di {{slidesLength}}',
            },
            
            // Touch
            grabCursor: true,
            
            // Events
            on: {
                init: function() {
                    console.log('Team Slider initialized with', slideCount, 'slides');
                },
            },
        });

        window.teamSwiper = swiper;
    };

    // ============================================================================
    // COLLABORAZIONI SLIDER - Swiper Configuration (Infinite Loop)
    // ============================================================================
    const initCollabSlider = () => {
        const collabSwiper = document.querySelector('.collab-swiper');
        if (!collabSwiper) return;

        if (typeof Swiper === 'undefined') {
            console.warn('Swiper not loaded - Collab Slider disabled');
            return;
        }

        const slideCount = collabSwiper.querySelectorAll('.swiper-slide').length;

        const swiper = new Swiper('.collab-swiper', {
            // Layout
            slidesPerView: 2,
            spaceBetween: 20,
            
            // Infinite loop
            loop: slideCount >= 4,
            loopAdditionalSlides: 4,
            
            // Speed for smooth scrolling
            speed: 3000,
            
            // Autoplay - Continuous
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            // No navigation/pagination for cleaner look
            navigation: false,
            pagination: false,
            
            // Free mode for continuous scroll
            freeMode: {
                enabled: true,
                momentum: false,
            },
            
            // Responsive breakpoints
            breakpoints: {
                // Mobile
                320: {
                    slidesPerView: 2,
                    spaceBetween: 16,
                },
                // Mobile landscape
                480: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                // Tablet
                768: {
                    slidesPerView: 4,
                    spaceBetween: 24,
                },
                // Desktop
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 28,
                },
                // Large desktop
                1280: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                },
                // Extra large
                1536: {
                    slidesPerView: 7,
                    spaceBetween: 32,
                },
            },
            
            // Accessibility
            a11y: {
                enabled: false, // Disable for continuous slider
            },
            
            // Allow touch
            allowTouchMove: true,
            grabCursor: true,
            
            // Events
            on: {
                init: function() {
                    console.log('Collab Slider initialized with', slideCount, 'slides');
                },
            },
        });

        window.collabSwiper = swiper;
    };

    // ============================================================================
    // ALL SLIDERS INITIALIZATION
    // ============================================================================
    const initAllSliders = () => {
        // Check if Swiper is available
        if (typeof Swiper === 'undefined') {
            console.warn('Swiper library not loaded');
            return;
        }

        // Initialize all sliders
        initHeroSlider();
        initTeamSlider();
        initCollabSlider();

        console.log('HeroCS: All sliders initialized');
    };

    // ============================================================================
    // MAIN INITIALIZATION
    // ============================================================================
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
        
        // Sliders
        initAllSliders();

        // Add loaded class to body
        document.body.classList.add('loaded');
        
        console.log('HeroCS: All modules initialized');
    };

    // ============================================================================
    // UTILITY FUNCTIONS
    // ============================================================================
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

    // ============================================================================
    // EVENT LISTENERS
    // ============================================================================
    
    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Handle window resize
    window.addEventListener('resize', throttle(() => {
        // Close mobile menu on resize
        document.body.classList.remove('menu-open');
        document.body.style.overflow = '';
        
        // Recalculate header
        const header = document.querySelector('.site-header');
        if (header) {
            header.style.transition = 'none';
            void header.offsetHeight;
            header.style.transition = '';
        }
    }, 250));

})();
