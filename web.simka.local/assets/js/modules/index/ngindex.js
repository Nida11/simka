app.controller('index_controller', function($scope, $http, $window, $rootScope){
	$scope.initialForm = function(){
		$(document).find('.loader_pengumuman').hide();
		$(document).find('.loader_potensi').hide();
		no_need_waiting();
		$scope.dataPengumuman = [];
		$scope.dataPotensiRealisasi= [];
	},
	$scope.getData = function(){
		$scope.getData_pengumuman();
	},
	$scope.getData_pengumuman = function(){
		var data = {
			url: $scope.base_url + 'index/get_data',
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
				$(document).find('.loader_pengumuman').show();
			},
			success: function(result){
				$scope.dataPengumuman = result.response.pengumuman;
				$scope.$apply();
				$(document).find('.loader_pengumuman').hide();
			},
			error: function(result){
				//if(result.statusText!=='abort')
				//sweetAlert(result.statusText, result.responseText, "error");
			}
		};
		if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
		$rootScope.ajaxRequest = $.ajax(data);
	},
	$scope.getData_potensi = function(){
		var data = {
			url: $scope.base_url + 'index/get_data',
			data: {
				bulan: $scope.bulan,
				tahun: $scope.tahun
			},
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
				$(document).find('.loader_potensi').show();
			},
			success: function(result){
				$scope.dataPotensiRealisasi = result.response.pengumuman;
				$scope.$apply();
				$(document).find('.loader_potensi').hide();
			},
			error: function(result){
				//if(result.statusText!=='abort')
				//sweetAlert(result.statusText, result.responseText, "error");
			}
		};
		if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
		$rootScope.ajaxRequest = $.ajax(data);
	},
	$scope.open_modal_content = function(tanggal_input){
		$scope.get_data_rekam_absensi(tanggal_input);
		var option = {
			'backdrop' : false,
		}
		$('#modal_content').modal(option);
	}
});