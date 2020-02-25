define([
        'uiComponent',
        'ko'
    ],
    function (Component, ko) {

        return Component.extend({
            inputText: ko.observable(''),
            span2Text: ko.observable(''),
            span2IsBold: false,
            span2Style: ko.observable('normal'),

            initialize: function (config) {
                //document.ko = this; //for debug purposes

                this._super(); //parent's constructor

                self = this;
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
