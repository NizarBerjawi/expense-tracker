var App = (function () {
    'use strict';

    App.pageCalendar = function( ){
        // Add a height for the calendar panel before it loads
        // for aesthetic reasons
        $('.full-calendar .panel-body').css('height', 300);
        // Show ajax spinner while the calendar loads
        $('#cal-loader').show();

        // Render the default Calendar after getting the data
        getDailyData(function(response) {
            createCalendar(response)
        });

        // Initializes the calendar
        function createCalendar(events) {
            $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: '',
                    right: 'prev,next',
                },
                defaultDate: moment().format("YYYY-MM-DD"), // Today's date
                editable: false,
                eventLimit: true,
                eventClick: function(event, jsEvent, view) {
                    // Show the expense details modal
                    $("#show-expense").modal('toggle');
                    // Fill in the form with the ajax response
                    $("#show-expense #name").val(event.title);
                    $("#show-expense #date").val(event.start.format("YYYY-MM-DD"));
                    $("#show-expense #amount").val(event.amount);
                    $("#show-expense #category").html(
                        '<option value="'+event.category.id+'" selected>'+
                            event.category.name
                        +'</option>'
                    );
                    $("#show-expense #description").html(event.description);
                    $("#show-expense #edit-item").attr('href', '/expenses/'+event.id+'/edit');
                },
                events: events
            });
        }

        // Ajax call to Get calendar events
        function getDailyData(callback) {
            $.ajax({
                type: 'post',
                url: 'dashboard/dailyExpenses',
                data: {
                    _token  : $('meta[name="csrf-token"]').attr('content'),
                },
                datatype: 'html',
                success: function(response) {
                    console.log('success');
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            }).done(function(response) {
                callback(response);
                // Hide the ajax spinner after data loads
                $('#cal-loader').hide();
                // Remove the added height to allow the default calendar height
                // to be rendered
                $('.full-calendar .panel-body').css('height', '');
            })
        }
    };

    return App;
})(App || {});
