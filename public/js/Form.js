Form = {
    Error: {
        log: function(formId, message) {
            message = formId + ': ' + message;
            console.error(message);
        }
    },

    initialize: function(formId, data) {
        let $form = $('#' + formId);
        if($form.attr('onsubmit') != null) {
            Form.Error.log(formId, '"onsubmit" event has to be passed as parameter, not manually asigned.');
            return;
        }

        let ok = Form.checkData(data);
        if(ok) {
            Form.addSubmitBtn($form, data['submitBtnId']);
            Form.addSubmitEvent($form, data['onsubmit']);
        }
    },

    checkData: function (data) {
        let requiredProperties = [
            'submitBtnId',
            'onsubmit'
        ];

        let ok = true;
        $.each(requiredProperties, function (index, property) {
            if(!data.hasOwnProperty(property)) {
                console.error('The property "' + property + '" was not found in data');
                ok = false;
            }
        });

        return ok;
    },

    addSubmitBtn: function($form, buttonId) {
        let $button = $('<button></button>');
        $button
            .attr('type', 'submit')
            .css('display', 'none');

        $form.append($button);

        $('#' + buttonId).on('click', function() {
            $button.click();
        });
    },

    addSubmitEvent: function($form, onsubmitFunction) {
        $form.attr('onsubmit', 'return false;');
        $form.submit(function () {
            onsubmitFunction();
        });
    }

};