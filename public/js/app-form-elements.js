var App = (function () {
    'use strict';

    App.formElements = function( ){

        //Js Code
        if ($('.datetimepicker').length) {
            $(".datetimepicker").datetimepicker({
                autoclose: true,
                componentIcon: '.mdi.mdi-calendar',
                navIcons:{
                    rightIcon: 'mdi mdi-chevron-right',
                    leftIcon: 'mdi mdi-chevron-left'
                }
            });
        }

        //Select2
        if ($('.select2').length) {
            $(".select2").select2({
                width: '100%'
            });
        }

        //Select2 tags
        if ($('.tags').length) {
            $(".tags").select2({
                tags: true,
                width: '100%',
                maximumSelectionLength: 1,
                createTag: function () {
                    // Disable tagging
                    return null;
                }
            });
        };

        //Select2 tags
        if ($('.categories').length) {
            $(".categories").select2({
                tags: true,
                width: '100%',
                maximumSelectionLength: 1,
                createTag: function () {
                    // Disable tagging
                    return null;
                }
            });
        };

        //Bootstrap Slider
        if ($('.bslider').length) {
            $('.bslider').bootstrapSlider();
        }
    };

    return App;
})(App || {});
