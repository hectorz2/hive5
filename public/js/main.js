/**
 * Author: Héctor Zaragoza Arranz
 * Date: 24/01/2020
 */
$(document).ready(function() {
    setTimeout(function () {
        $('.pre-loader').fadeOut(500, function () {
            // setTimeout(function () {
            $('#mainSection')
                .show()
                .css('opacity', '1');
            $('body').css('overflow', 'auto');
            checkInitialHeading();
            // }, 200)
        });
    }, 500);
});

/**
 * This function is a copy of scroll event of template/js/main.js because if you refresh, the browser keeps the scroll
 * position and the code is not executed, so the header is hidden until user scrolls, if we execute it on document ready
 * it is fixed.
 */
function checkInitialHeading() {
    let scroll = $(window).scrollTop();
    if (scroll < 400) {
        $('#sticky-header').removeClass('sticky');
        $('#back-top').fadeIn(500);
    } else {
        $('#sticky-header').addClass('sticky');
        $('#back-top').fadeIn(500);
    }
}