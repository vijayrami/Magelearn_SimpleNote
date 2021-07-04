define(
    [
        'jquery',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/url-builder',
        'Magento_Checkout/js/model/error-processor',
        'mage/url'
    ],
    function ($, quote, urlBuilder, errorProcessor, urlFormatter) {
    'use strict';
    return {
        /**
         * Save SimpleNote ibn the quote
         *
         * @param simpleNote
         */
        save: function (simpleNote) {
            if (simpleNote) {
                var quoteId = quote.getQuoteId();
                var url;
                url = urlBuilder.createUrl('/carts/mine/set-simple-note', {});
                var payload = {
                    cartId: quoteId,
                    simpleNote: {
                        simpleNote: simpleNote
                    }
                };
                if (!payload.simpleNote.simpleNote) {
                    return true;
                }
                var result = true;
                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: false
                }).done(
                    function (response) {
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );
                return result;
            }
        }
    };
});