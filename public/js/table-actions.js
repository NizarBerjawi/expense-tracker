// Handle the actions at the index tables
$( document ).ready(function() {
    $('.actions').on('click submit', function(event) {
        // Stop link from redirecting
        event.preventDefault();
        if ( $(this).is( "a" ) ) {
            // Get the route from the href attribute
            var route = $(this).attr('href');
        } else {
            var route = $(this).attr('action');
        }

        // Change the action attribute of the form in the modal
        $('.mod-form').attr('action', route);
        // Get the target modal ID
        var dataTarget = $(this).attr('data-target');
        // Show the relative modal
        $(dataTarget).modal('toggle');
    });
});
