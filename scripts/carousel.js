document.addEventListener('DOMContentLoaded', function () {
    var currentIndex = 0;
    var slides = document.querySelectorAll('.slide');
    var totalSlides = slides.length;

    function cycleSlides() {
        var slider = document.querySelector('.slides');
        var slideWidth = slides[0].clientWidth;

        // Calcule la position du slide suivant
        var newPosition = -(slideWidth * currentIndex);
        slider.style.transform = 'translateX(' + newPosition + 'px)';

        // Incrémente ou réinitialise l'index
        currentIndex = (currentIndex + 1) % totalSlides;
    }

    // Change de slide toutes les 3 secondes
    setInterval(cycleSlides, 3000);
});