app.controller('potensi_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		//var d = new Date();
		//$scope.sync_tahun = d.getFullYear();
		$scope.series = [];
		$scope.labels = [];
		$scope.data = [[[]]];
		$scope.data2 = [[[]]];
		$scope.data_wilayah = [];
		$scope.data_kecamatan = [];
		no_need_waiting();
		$(document).find('#dt_bulan').hide();
		$(document).find('#dt_tgl1').hide();
		$(document).find('#dt_tgl2').hide();
		$(document).find('#printChart1').hide();
		$(document).find('#printChart2').hide();
	},
	$scope.cariData = function(data_input) {
		var data = {
			url: $scope.base_url + 'grafik/potensi/get_data_chart/pajak',
			data: {
				sync_tahun: $scope.sync_tahun,
				sync_bulan: $scope.sync_bulan,
				sync_tanggal1: $scope.sync_tanggal1,
				sync_tanggal2: $scope.sync_tanggal2
			},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				$scope.series.length = 0;
				$scope.labels.length = 0;
				$scope.data[0].length = 0;

				data_response = result.response;
				if (data_response.length > 0){
					$.each(data_response, function(index, value){
						$scope.series.push("Total");
						$scope.labels.push(value.nama_singkat);
						$scope.data[0].push(value.total);
					});
				}

				$scope.onClick = function (points, evt) {
					console.log(points, evt);
				};
				$scope.datasetOverride = [
					{
						hoverBackgroundColor: "rgba(255,99,132,0.4)",
	        			hoverBorderColor: "rgba(255,99,132,1)"
					}
				];
				$scope.options = {
					events: false,
						animation: {
							onComplete: function () {
								var ctx = this.chart.ctx;
								ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
								ctx.textAlign = 'left';
								ctx.textBaseline = 'bottom';

								this.data.datasets.forEach(function (dataset) {
									for (var i = 0; i < dataset.data.length; i++) {
										var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
										left = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._xScale.left;
										ctx.fillStyle = '#444'; // label color
										var label = dataset.data[i];
										if (label == null){
											label = 0;
										}
										ctx.fillText(label, model.x + 5, model.y + 8);
									}
								});
							}
						},
					scales: {
						xAxes: [
							{
							  	ticks: {
							  		beginAtZero: true
						      	}
							}
						]
					}	
				};
				$scope.$apply();
			},
			error: function(result){
				if(result.statusText!=='abort')
				sweetAlert(result.statusText, result.responseText, "error");
			}
		};

		var data2 = {
			url: $scope.base_url + 'grafik/potensi/get_data_chart/stnk',
			data: {
				sync_tahun: $scope.sync_tahun,
				sync_bulan: $scope.sync_bulan,
				sync_tanggal1: $scope.sync_tanggal1,
				sync_tanggal2: $scope.sync_tanggal2
			},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				$scope.series.length = 0;
				$scope.labels.length = 0;
				$scope.data2[0].length = 0;

				data_response = result.response;
				if (data_response.length > 0){
					$.each(data_response, function(index, value){
						$scope.series.push("Total");
						$scope.labels.push(value.nama_singkat);
						$scope.data2[0].push(value.total);
					});
				}
				$scope.$apply();
			},
			error: function(result){
				if(result.statusText!=='abort')
				sweetAlert(result.statusText, result.responseText, "error");
			}
		};
		
		
		$(document).find('#printChart1').show();
		$(document).find('#printChart2').show();
		if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
		$rootScope.ajaxRequest = $.ajax(data);
		$rootScope.ajaxRequest = $.ajax(data2);
	},
	$scope.getData_wilayah = function(data_input){
		var data = {
			url: $scope.base_url + 'admin/wilayah/get_data',
			type: 'POST',
			dataType: 'json',
			success: function(result){
				$scope.data_wilayah = result.response;
				$scope.$apply();
			},
			error: function(result){
				if(result.statusText!=='abort')
				sweetAlert(result.statusText, result.responseText, "error");
			}
		};
		if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
		$rootScope.ajaxRequest = $.ajax(data);
	},
	$scope.getData_kecamatan = function(){
		id_wilayah = $scope.sync_wilayah['id_wilayah'];
		var data = {
			url: $scope.base_url + 'admin/kecamatan/get_data',
			data: {id_wilayah: id_wilayah},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				$scope.data_kecamatan = result.response.data_kecamatan;
				$scope.$apply();
			},
			error: function(result){
				if(result.statusText!=='abort')
				sweetAlert(result.statusText, result.responseText, "error");
			}
		};
		if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
		$rootScope.ajaxRequest = $.ajax(data);
	},
	$scope.changeTahun = function(data_input) {
		if ($scope.sync_tahun == null) {
			$(document).find('#dt_tgl1').hide();
			$scope.sync_tanggal1 = '';
			$(document).find('#dt_tgl2').hide();
			$scope.sync_tanggal2 = '';
			$(document).find('#dt_bulan').hide();
			$scope.sync_bulan = '';
		} else {
			$(document).find('#dt_bulan').show();
		}
	},
	$scope.changeBulan = function(selectedItem) {
		if ($scope.sync_bulan == '') {
			$(document).find('#dt_tgl1').hide();
			$scope.sync_tanggal1 = '';
			$(document).find('#dt_tgl2').hide();
			$scope.sync_tanggal2 = '';
		} else {
			$(document).find('#dt_tgl1').show();
			$(document).find('#dt_tgl2').show();
		}
	},
	$scope.printChart = function(data) {
		var canvas = document.getElementById(data);
		var img    = canvas.toDataURL("image/png");
		var win = window.open();
		win.document.write("<br><img src='"+ img +"'/>");
		win.document.print();
		win.location.reload();
	}
});