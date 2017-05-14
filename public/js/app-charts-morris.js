var App = (function () {
	'use strict';

	App.chartsMorris = function( ){

		getMonthlyExpenseData(function(response) {
			console.log(response);
			line_chart(response);
		});

		//Line Chart
		function line_chart(data){
			var color1 = App.color.primary;
			var color2 = tinycolor( App.color.primary ).lighten( 15 ).toString();

			new Morris.Line({
				element: 'line-chart',
				data: data,
				xkey: 'date',
				ykeys: ['Expenses', 'Income'],
				labels: ['Expenses'],
				lineColors: [color1, color2]
			});
		}

		// Ajax call
		function getMonthlyExpenseData(callback) {
			$.ajax({
				type:'post',
				url: 'dashboard/monthly-expenses',
				data: {
					_token  : $('meta[name="csrf-token"]').attr('content'),
				},
				datatype: 'html',
				success: function(response) {
					console.log('success');
				},
				error: function(response) {
					console.log('fails');
				}
			}).done(function(response) {
				callback(response);
			});
		}

	};

	return App;
})(App || {});
