document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    let activeSlide = 0;
    const slideInterval = 7000;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        activeSlide = index;
    }

    function nextSlide() {
        const nextIndex = (activeSlide + 1) % slides.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        const prevIndex = (activeSlide - 1 + slides.length) % slides.length;
        showSlide(prevIndex);
    }

    document.querySelectorAll('[data-action="next-slide"]').forEach(button => {
        button.addEventListener('click', nextSlide);
    });
    document.querySelectorAll('[data-action="prev-slide"]').forEach(button => {
        button.addEventListener('click', prevSlide);
    });
    dots.forEach((dot, index) => {
        dot.addEventListener('click', function() {
            showSlide(index);
        });
    });

    if (slides.length) {
        showSlide(0);
        setInterval(nextSlide, slideInterval);
    }

    document.querySelectorAll('.btn-outline-dark').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.btn-outline-dark').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
