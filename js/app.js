/**
 * Created by online2 on 12/07/2017.
 */

jQuery(document).ready(function() {

    jQuery('#owl-carousel').owlCarousel({
        loop:true,
        margin:5,
        items: 3,
        nav:false,
        dots: true,
        center: true,
        autoplay:true,
        // autoplayTimeout:3000,
        // autoplayHoverPause:true,
        // smartSpeed: 5000
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            }
        }
    });
    jQuery('#owl-carousel-partenaire').owlCarousel({
        loop:true,
        margin:15,
        items: 6,
        nav:false,
        dots: true,
        center: true,
        autoplay:true,
        // autoplayTimeout:3000,
        // autoplayHoverPause:true,
        // smartSpeed: 5000
    });

    jQuery(".dotdot").dotdotdot({
        //	configuration goes here
        watch: true
    });



});











