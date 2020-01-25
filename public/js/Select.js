Select = {
    initialize: function(selectId, data) {
        let $select = $('#' + selectId);

        $select.niceSelect();
        if(data.hasOwnProperty('unselectOnNull') && data.unselectOnNull) {
            $select.change(function() {
                Select.Event.checkUnselectOnNull($(this));
            });
        }
    },

    refresh: function (selectId) {
        $('#' + selectId).niceSelect('update');
    },

    generateOptions(selectId, data, valueIndex, textIndex) {
        let $select = $('#' + selectId);
        $.each(data, function (index, value) {
            let $option = $('<option></option>');
            $option.val(value[valueIndex]);
            $option.text(value[textIndex]);
            $select.append($option);
        });

        Select.refresh(selectId);
    },

    Event: {
        checkUnselectOnNull: function ($this) {
            if($this.val() === 'null') {
                $this.find('option:selected').removeAttr('selected');
            }
        }
    }
};