jQuery(document).ready(function($){
var owl = $('.owl-carousel');
owl.owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});
$('.play').on('click',function(){
   owl.trigger('play.owl.autoplay',[2000]);
})
$('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
})
});