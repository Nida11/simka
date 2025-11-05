app.controller('overview_potensi_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		no_need_waiting();
		$scope.labels = ["January", "February", "March", "April", "May", "June", "July"];
		$scope.series = ['Series A', 'Series B'];
		$scope.data = [
			[65, 59, 80, 81, 56, 55, 40],
			[28, 48, 40, 19, 86, 27, 90]
		];
		$scope.onClick = function (points, evt) {
			console.log(points, evt);
		};
		$scope.datasetOverride = [{ yAxisID: 'y-axis-1' }, { yAxisID: 'y-axis-2' }];
		$scope.options = {
			scales: {
				yAxes: [
					{
					  id: 'y-axis-1',
					  type: 'linear',
					  display: true,
					  position: 'left'
					},
					{
					  id: 'y-axis-2',
					  type: 'linear',
					  display: true,
					  position: 'right'
					}
				]
			}	
		};

		$scope.colors = ['#45b7cd', '#ff6384', '#ff8e72'];
	    $scope.labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
	    $scope.datasetOverride_kecamatan = [
	      {
	        label: "Bar chart",
	        borderWidth: 1,
	        type: 'bar'
	      },
	      {
	        label: "Line chart",
	        borderWidth: 3,
	        hoverBackgroundColor: "rgba(255,99,132,0.4)",
	        hoverBorderColor: "rgba(255,99,132,1)",
	        type: 'line'
	      }
	    ];
	}
});