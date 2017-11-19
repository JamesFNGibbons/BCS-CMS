angular.module('app').controller('view-customer', function($scope, $http){
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
		  ['Order Type', 'No. of orders'],
		  ['Active',     10],
		  ['Completed',  11]
		]);

		var options = {
		  title: 'Orders Completed / Active'
		};

		var chart = new google.visualization.PieChart(document.getElementById('active_past'));
		chart.draw(data, options);

				var data = google.visualization.arrayToDataTable([
		  ['Order Type', 'No. of orders'],
		  ['Active',     10],
		  ['Completed',  11]
		]);

		var options = {
		  title: 'Orders Completed / Active'
		};

		var chart = new google.visualization.PieChart(document.getElementById('device_types'));
		chart.draw(data, options);	
	}
});