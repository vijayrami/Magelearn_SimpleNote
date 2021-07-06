define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Magelearn_SimpleNote/js/model/isSimpleNote'
    ],
    function (Component, additionalValidators, simpleNoteValidation) {
        'use strict';
        additionalValidators.registerValidator(simpleNoteValidation);
        return Component.extend({});
    }
);