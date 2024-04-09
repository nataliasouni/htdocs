document.querySelector('.float-left.show-nav-lateral').addEventListener('click', function() {
    var navLateral = document.querySelector('.navLateral');
    var navbarInfo = document.querySelector('.navbar-info');
    var pageContent = document.querySelector('.page-content');
    var containerFluid = document.querySelector('.container-fluid');
    var carousel = document.getElementById("myCarousel");
    var chooseOption = document.querySelector('.choose-option');
    

    if (!navLateral.classList.contains('active')) {
        navLateral.classList.add('active');
        navbarInfo.classList.add('shifted');
        pageContent.classList.add('shifted');
        containerFluid.classList.add('shifted');
        carousel.classList.add("shifted");
        chooseOption.classList.add('nav-active');
    } else {
        navLateral.classList.remove('active');
        navbarInfo.classList.remove('shifted');
        pageContent.classList.remove('shifted');
        containerFluid.classList.remove('shifted');
        carousel.classList.remove("shifted");
        chooseOption.classList.remove('nav-active');
    }
});








