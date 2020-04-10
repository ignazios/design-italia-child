jQuery(document).ready( function(){

    // This looks at the initial state of each content area, and hide content areas that are closed
    jQuery('.faq-content').each( function() {
        if( jQuery(this).hasClass('faq-closed')) {
            jQuery(this).hide();
        }
    });

    // This runs when a Toggle Title is clicked. It changes the CSS and then runs the animation
    jQuery('.faq-title').each( function() {
        jQuery(this).click(function() {
            var toggleContent = jQuery(this).next('.faq-content');

            jQuery(this).toggleClass('faq-open').toggleClass('faq-closed');
            toggleContent.toggleClass('faq-open').toggleClass('faq-closed');
            toggleContent.slideToggle();
        });
    });

    // If the user sets the style to "accordion"
    jQuery('.faq-accordion-wrap').accordion( {
        collapsible: true,
        active: false,
        heightStyle: "content"
    });
      
});