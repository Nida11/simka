app.controller('potensi_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.id_potensi = '';
		$scope.id_wilayah = '';
		$scope.potensi = '';
		$scope.realisasi = '';
		$scope.outofdate = '';
		$scope.periode = '';
		$scope.tahun = '';
		$scope.dataAll = [];
		no_need_waiting();
		$(document).find('.loader_potensi').hide();
		$(document).find('.data_ok').hide();
		$(document).find('#savedata').hide();
		$(document).find('#updatedata').hide();
		$(document).find('#generatedata').hide();
		$(document).find('.select2').val(null).trigger('change');
	},
	$scope.getDataWilayah = function(data_input){
		var data = {
			url: $scope.base_url + 'admin/potensi/get_data_wilayah',
			type: 'POST',
			dataType: 'json',
			beforeSend: function(){
				$(document).find('.loader_potensi').show();
			},
			success: function(result){
				$scope.data_wilayah = result.response;
				$(document).find('.select2').trigger('change');
				$(document).find('.loader_potensi').hide();
				$(document).find('.data_ok').show();
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
	$scope.getData = function(data_input){
		if(typeof data_input === 'undefined'){
			data_input = '';
			id_wilayah_input = $scope.id_wilayah['id_wilayah'];
			button_save = true;
		}else{
			data_input = data_input;
			id_wilayah_input = '';
			button_save = false;
		}
		var data = {
			url: $scope.base_url + 'admin/potensi/get_data',
			data: {
				id_potensi: data_input,
				id_wilayah: id_wilayah_input
			},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				if(data_input === ''){
					$scope.dataAll = data_response
					$(document).find('#savedata').show();
					$(document).find('#generatedata').show();
				}else{
					$.each(data_response, function(index, value){
						$scope.id_potensi = value.id_potensi;
						$scope.id_wilayah = value.id_wilayah;
						$scope.potensi = parseInt(value.potensi);
						$scope.realisasi = value.realisasi;
						$scope.outofdate = value.outofdate;
						$scope.periode = value.periode;
						$scope.tahun = value.tahun;
						$(document).find('#savedata').hide();
						$(document).find('#updatedata').show();
					});
				}
				$(document).find('.select2').trigger('change');
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
	$scope.deleteData = function(data_input){
		if(confirm('Anda Yakin Akan Menghapus Data ini ?')){
			var data = {
				url: $scope.base_url + 'admin/potensi/delete_data',
				data: {id_potensi: data_input},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					sweetAlert({
						title: result.response.type,
						text: result.response.msg,
						type: 'success',
						timer: 2000,
						showConfirmButton: false
					});
					$scope.getData();
				},
				error: function(result){
					if(result.statusText!=='abort')
					sweetAlert(result.statusText, result.responseText, "error");
				}
			};
			if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
			$rootScope.ajaxRequest = $.ajax(data);
		}
	},
	$scope.saveData = function(mode){
		try{
			mode_input = (typeof mode === 'undefined' || mode === '') ? 'save' : 'update';
			var data = {
				url: $scope.base_url + 'admin/potensi/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					id_potensi: $scope.id_potensi,
					id_wilayah: $scope.id_wilayah['id_wilayah'],
					potensi: $scope.potensi,
					realisasi: $scope.realisasi,
					outofdate: $scope.outofdate,
					periode: $scope.periode,
					tahun: $scope.tahun
				},
				dataType: 'json',
				success: function(result){
					$scope.getData();
				},
				error: function(result){
					if(result.statusText!=='abort')
					sweetAlert(result.statusText, result.responseText, "error");
				}
			};
			if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
			$rootScope.ajaxRequest = $.ajax(data);
		}catch(err){
			sweetAlert('Error Pengisian Data', err, "error");
		}
	},
	$scope.generate_tahun = function(){
		try{
			if($scope.tahun == '0') throw new Error('Tahun Harus Diisi');
			var data = {
				url: $scope.base_url + 'admin/potensi/generate_tahun',
				type: 'POST',
				data: {
					id_wilayah: $scope.id_wilayah['id_wilayah'],
					tahun: $scope.tahun
				},
				dataType: 'json',
				success: function(result){
					$scope.getData('', $scope.id_wilayah);
					$(document).find('#savedata').hide();
				},
				error: function(result){
					if(result.statusText!=='abort')
					sweetAlert(result.statusText, result.responseText, "error");
				}
			};
			if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
			$rootScope.ajaxRequest = $.ajax(data);
		}catch(err){
			sweetAlert('Error Pengisian Data', err, "error");
		}
	}
});