var App = (function () {
	'use strict';

	App.chartsMorris = function( ) {
		// Get the year selected in the dropdown
		var year = $('#expenses-year').find(":selected").text();
		$('#line-loader').show();

		// Render the Line chart
		getMonthlyExpenseData(function(response) {
			line_chart(response);
		});

		// Attach an event listener to the year select input
		$('#expenses-year').on('change', function() {
		  year = this.value;
		  $('#line-chart').empty();
		  $('#line-loader').show();

		  getMonthlyExpenseData(function(response) {
			  line_chart(response);
		  });
		})

		// Set up the Line Chart
		function line_chart(data){
			var color1 = App.color.primary;
			var color2 = tinycolor( App.color.primary ).lighten( 15 ).toString();

			new Morris.Line({
				element: 'line-chart',
				data: data,
				xkey: 'month',
				ykeys: ['expenses', 'income'],
				labels: ['Expenses', 'Income'],
				lineColors: [color1, color2]
			});
		}

		// Ajax call
		function getMonthlyExpenseData(callback) {
			$.ajax({
				type:'post',
				url: 'dashboard/'+year+'/data',
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
				$('#line-loader').hide();
			});
		}
	};

	return App;
})(App || {});
