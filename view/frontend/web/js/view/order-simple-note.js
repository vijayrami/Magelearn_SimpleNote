define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Magelearn_SimpleNote/js/action/save-order-simple-note',
        'Magento_Checkout/js/model/quote'
    ],
    function ($, ko, Component, saveOrderSimpleNote, quote) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Magelearn_SimpleNote/order_simple_note',
                simpleNote: ''
            },
            initObservable: function () {
                return this._super().observe(['simpleNote'])
            },
            saveSimpleNote: function () {
                var simpleNote = this.simpleNote();
                saveOrderSimpleNote.save(simpleNote);
            }
        });
    }
);