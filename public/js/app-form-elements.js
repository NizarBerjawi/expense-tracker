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

        //Select2 tags
        if ($('.select2').length) {
            $(".select2").select2({
                tags: true,
                width: '100%',
                maximumSelectionLength: 1,
                createTag: function () {
                    // Disable tagging
                    return null;
                }
            });
        };
    };

    return App;
})(App || {});
