/**
 * Author: Héctor Zaragoza Arranz
 * Date: 24/01/2020
 */
$(document).ready(function() {
    H5Main.initialize();
});

H5Main = {
    initialize: function() {
        H5Main.handlePreloader();
        H5Main.assignEvents();
        H5Main.handlePlaceholders();
        H5Main.handleRequiredLabels();
        H5Main.handleDefaults();
        H5Main.Event.handleHeaderExtraButtons();
    },
    
    handlePreloader: function() {
        setTimeout(function () {
            $('.pre-loader').fadeOut(500, function () {
                $('#mainSection')
                    .show()
                    .css('opacity', '1');
                $('body').css('overflow', 'auto');
                H5Main.checkInitialHeading();
            });
        }, 500);
    },
    
    assignEvents: function() {
        $('#logInHeaderBtn').on('click', function () {
            $('#loginModal').modal('show');
        });

        $(window).resize(function () {
            H5Main.Event.handleHeaderExtraButtons();
        });
    },

    /**
     * This function is a copy of scroll event of template/js/H5Main.js because if you refresh, the browser keeps the scroll
     * position and the code is not executed, so the header is hidden until user scrolls, if we execute it on document ready
     * it is fixed.
     */
    checkInitialHeading: function () {
        let scroll = $(window).scrollTop();
        if (scroll < 400) {
            $('#sticky-header').removeClass('sticky');
            $('#back-top').fadeIn(500);
        } else {
            $('#sticky-header').addClass('sticky');
            $('#back-top').fadeIn(500);
        }
    },
    
    handlePlaceholders: function () {
        let $inputs = $('input, textarea');
        $.each($inputs, function(index, input) {
            let $input = $(input);
            if($input.attr('placeholder') == null) {
                let id = $input.attr('id');
                if(id != null) {
                    let $label = $('label[for="' + id + '"]');
                    if($label.length > 0) {
                        $input.attr('placeholder', $label.text());
                    }
                }
            }
        });
    },

    handleRequiredLabels: function() {
        let $requiredInputs = $('input[required="required"], textarea[required="required"]');
        $.each($requiredInputs, function(index, input) {
            let $input = $(input);
            let id = $input.attr('id');
            if(id != null) {
                let $label = $('label[for="' + id + '"]');
                if($label.length > 0) {
                    let labelText = $label.text();
                    if(!labelText.includes('(*)')) {
                        $label.text(labelText + ' (*)');
                    }
                }
            }
        });
    },

    handleDefaults: function() {
        $('[maxlength]').maxlength({
            alwaysShow: true,
            warningClass: 'badge mt-1 bg-success text-dark',
            limitReachedClass: 'badge mt-1 bg-danger'
        });
    },

    Event: {
        MINIMUM_DESKTOP_WIDTH: 992,
        buttonsInDesktop: true,
        handleHeaderExtraButtons: function () {
            if($(window).width() >= H5Main.Event.MINIMUM_DESKTOP_WIDTH) {
                if(!H5Main.Event.buttonsInDesktop) {
                    let $buttonsContainer = $('#headerMobileExtraButtons').find('.extra-buttons-container');
                    $('#headerDesktopExtraButtons').append($buttonsContainer);
                    H5Main.Event.buttonsInDesktop = true;
                }
            } else {
                if(H5Main.Event.buttonsInDesktop) {
                    let $buttonsContainer = $('#headerDesktopExtraButtons').find('.extra-buttons-container');
                    $('#headerMobileExtraButtons').append($buttonsContainer);
                    H5Main.Event.buttonsInDesktop = false;
                }
            }
        }
    }
};