jQuery(document).ready(function($){
    // home slider
    $('.list-testimonials-home.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: true,
        nav: false,
        dots: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        mouseDrag: false
    });
});