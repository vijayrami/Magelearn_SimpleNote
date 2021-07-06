define(
    [
        'jquery',
        'mage/validation',
        'mage/translate',
        'Magento_Ui/js/model/messageList'
    ],
    function ($, validation, $t, messageList) {
        'use strict';

        return {
            validate: function () {
                var simpleNoteValidationResult = false;
                var simplenote = $('#order-simple-note').val();
                console.log(simplenote);
                if(simplenote == '' || simplenote == null){ //should use Regular expression in real store.
                    messageList.addErrorMessage({ message: $t('Please add your order notes.') });
                } else {
                	simpleNoteValidationResult = true;
                }
                return simpleNoteValidationResult;
            }
        };
    }
);