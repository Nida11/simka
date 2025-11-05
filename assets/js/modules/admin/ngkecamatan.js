app.controller('kecamatan_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.id_kecamatan = '';
		$scope.id_wilayah = '';
		$scope.nama_kecamatan = '';
		$scope.nama_kota = '';
		$scope.data_wilayah = [];
		$scope.dataAll = [];
		$(document).find('#savedata').show();
		$(document).find('#updatedata').hide();
		$(document).find('.select2').trigger('change');
	},
	$scope.getData = function(data_input, id_wil){
		var data = {
			url: $scope.base_url + 'admin/kecamatan/get_data',
			data: {id_kecamatan: data_input, id_wilayah: id_wil},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response.data_kecamatan;
				$scope.data_wilayah = result.response.data_wilayah;
				if(typeof data_input === 'undefined'){
					$scope.dataAll = data_response
				}else{
					$.each(data_response, function(index, value){
						$scope.id_kecamatan = value.id_kecamatan;
						$scope.id_wilayah = value.id_wilayah;
						$scope.nama_kecamatan = value.nama_kecamatan;
						$scope.nama_kota = value.nama_kota;
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
	$scope.deleteData = function(data_input, id_wil){
		if(confirm('Anda Yakin Akan Menghapus Data ini ?')){
			var data = {
				url: $scope.base_url + 'admin/kecamatan/delete_data',
				data: {id_kecamatan: data_input, id_wilayah: id_wil},
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
					$scope.initialForm();
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
				url: $scope.base_url + 'admin/kecamatan/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					id_kecamatan: $scope.id_kecamatan,
					id_wilayah: $scope.id_wilayah['id_wilayah'],
					nama_kecamatan: $scope.nama_kecamatan,
					nama_kota: $scope.nama_kota,
				},
				dataType: 'json',
				success: function(result){
					$scope.initialForm();
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
	$scope.toogleStatus = function(data_input, id_wil, id, level){
		var data = {
			url: $scope.base_url + 'admin/kecamatan/toogle_data',
			type: 'POST',
			data: {
				mode_input: 'update',
				value: (level==true) ? 1 : 0,
				id_kecamatan: data_input,
				id_wilayah: id_wil,
				objectname: id
			},
			dataType: 'json',
			success: function(result){
				$scope.initialForm();
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
});