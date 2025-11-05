app.controller('produksi_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.dataAll = [];
		$scope.data_user = [];
		$scope.series = [];
		$scope.labels = [];
		$scope.labels2 = [];
		$scope.data = [[[]]];
		$scope.data2 = [[[]]];

		$scope.disabled_bulan2 = true;
		$('.tanggal').datepicker({
			dateFormat: 'mm-dd'
		});

		// if ("<?php echo $this->session->userdata('is_admin')?>") {
		// 	$scope.sync_user = "<?php echo $var ?>";
		// }
		no_need_waiting();
		$(document).find('#dt_bulan').hide();
		$(document).find('#dt_tgl1').hide();
		$(document).find('#dt_tgl2').hide();
		$(document).find('#produksi').hide();
		$(document).find('#produksi2').hide();
		$(document).find('#printChart1').hide();
		$(document).find('#printChart2').hide();
	},
	$scope.getData_user = function(data_input){
		var data = {
			url: $scope.base_url + 'grafik/produksi/get_data_user',
			type: 'POST',
			dataType: 'json',
			success: function(result){
				$scope.data_user = result.response;
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
	$scope.cariData = function(data_input) {
		var invalid = 0;
		var field = '';
		var first = 0;

		if ($scope.sync_bulan1 != null && $scope.sync_bulan2 != null) {
			var bulan1, bulan2;
			bulan1 = new Date();
			bulan2 = new Date();
			var sy_bulan1 = $scope.sync_bulan1;
			var sy_bulan2 = $scope.sync_bulan2;
			var sync_bulan1splt = sy_bulan1.split("-");
			var sync_bulan2splt = sy_bulan2.split("-");
			bulan1.setFullYear($scope.sync_tahun, sync_bulan1splt[0], sync_bulan1splt[1]);
			bulan2.setFullYear($scope.sync_tahun, sync_bulan2splt[0], sync_bulan2splt[1]);
		}

		if (bulan1 > bulan2 || ($scope.sync_bulan1 != null && $scope.sync_bulan2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'DATA BULAN';
			} else {
				field += ', DATA BULAN';
			}
		}

		if (!Boolean(invalid)) {
			var uri;
			if ($scope.is_admin == 1) {
				uri = $scope.base_url + 'grafik/produksi/get_data_chart/' + $scope.sync_user['id_user'];
			} else {
				uri = $scope.base_url + 'grafik/produksi/get_data_chart/' + $scope.sync_user;
			}

			var data = {
				//url: $scope.base_url + 'grafik/produksi/get_data_chart/' + $scope.sync_user['id_user'],
				url: uri,
				data: {
					sync_tahun: $scope.sync_tahun,
					sync_bulan1: $scope.sync_bulan1,
					sync_bulan2: $scope.sync_bulan2
					// sync_bulan: $scope.sync_bulan,
					// sync_tanggal1: $scope.sync_tanggal1,
					// sync_tanggal2: $scope.sync_tanggal2
				},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					$scope.series.length = 0;
					$scope.labels.length = 0;
					$scope.data[0].length = 0;

					if ($scope.is_admin == 1) {
						$("#nm_user").html("Oleh : <b>"+ $scope.sync_user['nama_pegawai'] +"</b>");
					}

					data_response = result.response;
					if (data_response.length > 0){
						$.each(data_response, function(index, value){
							$scope.series.push('Total');
							$scope.labels.push(value.tgl_edit);
							$scope.data[0].push(value.total);
						});
					}

					$scope.onClick = function (points, evt) {
						console.log(points, evt);
					};
					$scope.datasetOverride = [
						{yAxisID: 'y-axis-1' }
						// { yAxisID: 'y-axis-2' }
					];
					$scope.options = {
						events: false,
						tooltips: {
							enabled: false
						},
						hover: {
							animationDuration: 0
						},
						animation: {
							duration: 1,
							onComplete: function () {
								var chartInstance = this.chart,
								ctx = chartInstance.ctx;
								ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
								ctx.textAlign = 'center';
								ctx.textBaseline = 'bottom';

								this.data.datasets.forEach(function (dataset, i) {
									var meta = chartInstance.controller.getDatasetMeta(i);
									meta.data.forEach(function (bar, index) {
										var data = dataset.data[index];
										ctx.fillText(data, bar._model.x, bar._model.y - 5);
									});
								});
							}
						},
						scales: {
							yAxes: [
								{
								  id: 'y-axis-1',
								  type: 'linear',
								  display: true,
								  position: 'left',
								  ticks: {
								  		beginAtZero: true
						      		}
								}
								// },
								// {
								//   id: 'y-axis-2',
								//   type: 'linear',
								//   display: true,
								//   position: 'left'
								// }
							]
						}
					};
					$(document).find('#produksi').show();
					$(document).find('#produksi2').hide();
					$(document).find('#printChart1').show();
					$(document).find('#printChart2').hide();
					$scope.$apply();
				},
				error: function(result){
					if(result.statusText!=='abort')
					sweetAlert(result.statusText, result.responseText, "error");
				}
			};
			if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
			$rootScope.ajaxRequest = $.ajax(data);
		} else {
			sweetAlert("Error", "Field "+field+" Salah Input", "error");
		}
	},
	$scope.cariSemuaData = function(data_input) {
		var invalid = 0;
		var field = '';
		var first = 0;

		if ($scope.sync_bulan1 != null && $scope.sync_bulan2 != null) {
			var bulan1, bulan2;
			bulan1 = new Date();
			bulan2 = new Date();
			var sy_bulan1 = $scope.sync_bulan1;
			var sy_bulan2 = $scope.sync_bulan2;
			var sync_bulan1splt = sy_bulan1.split("-");
			var sync_bulan2splt = sy_bulan2.split("-");
			bulan1.setFullYear($scope.sync_tahun, sync_bulan1splt[0], sync_bulan1splt[1]);
			bulan2.setFullYear($scope.sync_tahun, sync_bulan2splt[0], sync_bulan2splt[1]);
		}

		if (bulan1 > bulan2 || ($scope.sync_bulan1 != null && $scope.sync_bulan2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'DATA BULAN';
			} else {
				field += ', DATA BULAN';
			}
		}

		if (!Boolean(invalid)) {
			var data = {
				url: $scope.base_url + 'grafik/produksi/get_data_chart/',
				data: {
					sync_tahun: $scope.sync_tahun,
					sync_bulan1: $scope.sync_bulan1,
					sync_bulan2: $scope.sync_bulan2
				},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					$scope.series.length = 0;
					$scope.labels2.length = 0;
					$scope.data2[0].length = 0;

					data_response = result.response;
					if (data_response.length > 0){
						$.each(data_response, function(index, value){
							$scope.series.push('Total');
							$scope.labels2.push(value.nama_pegawai);
							$scope.data2[0].push(value.total);
						});
					}

					$scope.onClick = function (points, evt) {
						console.log(points, evt);
					};
					$scope.datasetOverride2 = [
						{
							hoverBackgroundColor: "rgba(255,99,132,0.4)",
		        			hoverBorderColor: "rgba(255,99,132,1)"
						}
					];
					$scope.options2 = {
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
					$(document).find('#produksi').hide();
					$(document).find('#produksi2').show();
					$(document).find('#printChart1').hide();
					$(document).find('#printChart2').show();
					$scope.$apply();
				},
				error: function(result){
					if(result.statusText!=='abort')
					sweetAlert(result.statusText, result.responseText, "error");
				}
			};
			if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
			$rootScope.ajaxRequest = $.ajax(data);
		} else {
			sweetAlert("Error", "Field "+field+" Salah Input", "error");
		}
	},
	$scope.cariDataLaporan = function(data_input) {
		var invalid = 1;

		if (typeof $scope.sync_bulan !== "undefined" && $scope.sync_tahun != null) {
			invalid = 0;
		}

		if (!Boolean(invalid)) {
			var uri;
			if ($scope.is_admin == 1) {
				var sc_user;
				if (typeof $scope.sync_user === 'undefined' || $scope.sync_user == null) {
					sc_user = '';
				} else {
					sc_user = $scope.sync_user['id_user'];
				}
				uri = $scope.base_url + 'grafik/laporan_bulanan/get_data_laporan/' + sc_user;
			} else {
				uri = $scope.base_url + 'grafik/laporan_bulanan/get_data_laporan/' + $scope.sync_user;
			}

			var data = {
				// url: $scope.base_url + 'grafik/laporan_bulanan/get_data_laporan/',
				url: uri,
				data: {
					sync_tahun: $scope.sync_tahun,
					sync_bulan: $scope.sync_bulan,
					sync_tanggal1: $scope.sync_tanggal1,
					sync_tanggal2: $scope.sync_tanggal2
				},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					data_response = result.response;
					$scope.dataAll = data_response;
					$scope.$apply();
				},
				error: function(result){
					if(result.statusText!=='abort')
					sweetAlert(result.statusText, result.responseText, "error");
				}
			};

			if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
			$rootScope.ajaxRequest = $.ajax(data);
		} else {
			sweetAlert("Error", "Harap Isi Tahun/Bulan", "error");
		}
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
	$scope.tanggal = function(argument) {
		$('.tanggal').datepicker({
			dateFormat: 'mm-dd',
			onSelect: function (dateText, inst) {
				target = $(this).attr('data-target');	
				tanggal_select = $(this).datepicker({ dateFormat: "mm-dd" }).val();
				// $(document).find(target).val(tanggal_select);
				$scope[argument] = tanggal_select;
			}
		});
	},
	$scope.change = function(input, value, disable) {
		if ($scope[input] == '') {
			$scope[value] = '';
			$scope[disable] = true;
		} else {
			$scope[disable] = false;
		}
	},
	$scope.printChart = function(data) {
		var canvas = document.getElementById(data);
		var img    = canvas.toDataURL("image/png");
		var win = window.open();
		win.document.write("<br><img src='"+ img +"'/>");
		win.document.print();
		win.location.reload();
	},
	$scope.getTotal = function(){
		var total = 0;
		for(var i = 0; i < $scope.dataAll.length; i++){
			var data = $scope.dataAll[i];
			total += parseInt(data.jumlah);
		}
		return total;
	}
});