document.addEventListener("DOMContentLoaded", function() {
    const carouselItems = document.querySelectorAll(".carousel-item");
    const totalItems = carouselItems.length;
    let currentItem = 0;

    document.querySelector(".carousel-control-prev").addEventListener("click", function() {
        if (currentItem > 0) {
            currentItem--;
        } else {
            currentItem = totalItems - 1;
        }
        updateCarousel();
    });

    document.querySelector(".carousel-control-next").addEventListener("click", function() {
        if (currentItem < totalItems - 1) {
            currentItem++;
        } else {
            currentItem = 0;
        }
        updateCarousel();
    });

    function updateCarousel() {
        const offset = -currentItem * 100;
        document.querySelector(".carousel-inner").style.transform = `translateX(${offset}%)`;
    }
});
