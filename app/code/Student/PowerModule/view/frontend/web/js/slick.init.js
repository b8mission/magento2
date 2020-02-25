define([
        'uiComponent',
        'jquery',
        'slick',
    ],
    function (Component, $) {

        return Component.extend({
            slidesQuantity: 1,

            initialize: function (config) {
                document.cfg = config;

                let quantity = config.slidesQuantity;
                if (typeof quantity !== "number")
                    throw new Error('slick.init: a bad parameter was given.');

                $(".slider").slick({
                    infinite: true,
                    slidesToShow: quantity,
                    slidesToScroll: quantity
                });
            },

        });
    },
);
