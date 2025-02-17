// Add to your existing JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Active link handling
    const navLinks = document.querySelectorAll('.nav-link:not(.btn)');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Smooth scroll for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});



// Counter JS
// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
    // Function to animate counter
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16); // 60 FPS
        const counter = setInterval(() => {
            start += increment;
            element.textContent = Math.floor(start) + (element.getAttribute('data-suffix') || '+');
            if (start >= target) {
                element.textContent = target + (element.getAttribute('data-suffix') || '+');
                clearInterval(counter);
            }
        }, 16);
    }

    // Intersection Observer for counter animation
    const observerOptions = {
        threshold: 0.5
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.counter-number');
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    animateCounter(counter, target);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe stats section
    const statsSection = document.querySelector('.stats-row');
    if (statsSection) {
        observer.observe(statsSection);
    }
});


// Language Switcher JS
// Add this JavaScript
function googleTranslateElementInit() {
    new google.translate.TranslateElement(
        {
            pageLanguage: 'en',
            includedLanguages: 'en,bn', // Only English and Bengali
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false,
        },
        'google_translate_element'
    );
}

// Clean up Google Translate's automatic styling
document.addEventListener('DOMContentLoaded', function() {
    // Remove the top margin that Google Translate adds
    setTimeout(function() {
        if (document.body.style.top) {
            document.body.style.top = '';
        }
    }, 1000);
});