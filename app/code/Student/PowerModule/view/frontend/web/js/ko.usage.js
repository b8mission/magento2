define([
        'uiComponent',
        'ko'
    ],
    function (Component, ko) {

        return Component.extend({
            inputText: ko.observable(''),           //same text-bind property for input and span1
            span2Text: ko.observable(''),           //span2 text-bind property. changes by onclick method
            span2IsBold: false,                                //bold_or_normal text-style indicator
            span2Style: ko.observable('normal'),    //span2 style-bind property
            span3Text: ko.observable(''),           //span3 text-bind property. changes by a subscribe feature

            initialize: function (config) {
                //document.ko = this; //for debug purposes

                this._super(); //parent's constructor
                self = this;

                self.inputText.subscribe(function () {

                    self.span3Text(self.inputText());
                });
            },

            onclick: function () {

                self.span2Text(self.inputText());

                self.span2IsBold = !self.span2IsBold;

                if (self.span2IsBold) {
                    self.span2Style('bold');
                } else self.span2Style('normal');
            },

        });
    },
);
