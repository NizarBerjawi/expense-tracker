var App = (function () {
    'use strict';

    App.uiNotifications = function( ){

        $('#submit-form').click(function(event){
            $.gritter.add({
                title: 'Success',
                text: 'This is a simple Gritter Notification.',
                class_name: 'color success'
            });
        });

        $('#not-danger').click(function(){
            $.gritter.add({
                title: 'Danger',
                text: 'This is a simple Gritter Notification.',
                class_name: 'color danger'
            });
        });
    };

    return App;
})(App || {});
