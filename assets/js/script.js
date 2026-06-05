document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.getElementById('nav-links');

    if (mobileMenu) {
        mobileMenu.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });
    }

    // Close mobile menu when a link is clicked
    const links = document.querySelectorAll('.nav-links a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            if (navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
            }
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            if(targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if(targetElement) {
                // Account for fixed navbar
                const headerOffset = 80;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
  
                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        });
    });
    // Carousel Logic
    const track = document.querySelector('.carousel-track');
    if (track) {
        const slides = Array.from(track.children);
        const nextButton = document.querySelector('.next-btn');
        const prevButton = document.querySelector('.prev-btn');
        const dotsNav = document.querySelector('.carousel-nav');
        const dots = Array.from(dotsNav.children);
        const carouselContainer = document.querySelector('.carousel-container');

        const updateCarousel = (currentSlide, targetSlide, currentDot, targetDot) => {
            const slideIndex = slides.indexOf(targetSlide);
            track.style.transform = 'translateX(-' + slideIndex * 100 + '%)';
            
            currentSlide.classList.remove('current-slide');
            targetSlide.classList.add('current-slide');
            
            currentDot.classList.remove('current-indicator');
            targetDot.classList.add('current-indicator');
        };

        const moveToNextSlide = () => {
            const currentSlide = track.querySelector('.current-slide');
            const currentDot = dotsNav.querySelector('.current-indicator');
            let targetSlide = currentSlide.nextElementSibling;
            let targetDot = currentDot.nextElementSibling;
            
            if (!targetSlide) {
                targetSlide = slides[0];
                targetDot = dots[0];
            }
            updateCarousel(currentSlide, targetSlide, currentDot, targetDot);
        };

        const moveToPrevSlide = () => {
            const currentSlide = track.querySelector('.current-slide');
            const currentDot = dotsNav.querySelector('.current-indicator');
            let targetSlide = currentSlide.previousElementSibling;
            let targetDot = currentDot.previousElementSibling;
            
            if (!targetSlide) {
                targetSlide = slides[slides.length - 1];
                targetDot = dots[dots.length - 1];
            }
            updateCarousel(currentSlide, targetSlide, currentDot, targetDot);
        };

        nextButton.addEventListener('click', moveToNextSlide);
        prevButton.addEventListener('click', moveToPrevSlide);

        dotsNav.addEventListener('click', e => {
            const targetDot = e.target.closest('button');
            if (!targetDot) return;
            const currentSlide = track.querySelector('.current-slide');
            const currentDot = dotsNav.querySelector('.current-indicator');
            const targetIndex = dots.findIndex(dot => dot === targetDot);
            const targetSlide = slides[targetIndex];
            updateCarousel(currentSlide, targetSlide, currentDot, targetDot);
        });

        // Autoplay
        let autoplayInterval = setInterval(moveToNextSlide, 6000);

        carouselContainer.addEventListener('mouseenter', () => clearInterval(autoplayInterval));
        carouselContainer.addEventListener('mouseleave', () => {
            autoplayInterval = setInterval(moveToNextSlide, 6000);
        });
    }
});
