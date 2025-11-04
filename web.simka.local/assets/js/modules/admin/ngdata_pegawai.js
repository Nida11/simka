app.controller('data_pegawai_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.nip = '';
		$scope.id_user = '';
		$scope.id_wilayah = '';
		$scope.nama_pegawai = '';
		$scope.pass = '';
		$scope.foto_pegawai = '';
		$scope.dataAll = [];
		$(document).find('#savedata').show();
		$(document).find('#updatedata').hide();
		$(document).find('#upload_foto').hide();
		$(document).find('.select2').val(null).trigger('change');
	},
	$scope.getData = function(data_input){
		var data = {
			url: $scope.base_url + 'admin/data_pegawai/get_data',
			data: {id_user: data_input},
			type: 'POST',
			dataType: 'json',
				success: function(result){
				data_response = result.response.data_pegawai;
				$scope.data_wilayah = result.response.data_wilayah;
				if(typeof data_input === 'undefined'){
					$scope.dataAll = data_response
				}else{
					$.each(data_response, function(index, value){
						$scope.id_user = value.id_user;
						$scope.id_wilayah = value.id_wilayah;
						$scope.nama_pegawai = value.nama_pegawai;
						$scope.foto_pegawai = value.foto_pegawai;
						$(document).find('#savedata').hide();
						$(document).find('#updatedata').show();
						$(document).find('#upload_foto').show();
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
	$scope.saveData = function(mode){
		try{
			mode_input = (typeof mode === 'undefined' || mode === '') ? 'save' : 'update';
			var data = {
				url: $scope.base_url + 'admin/data_pegawai/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					id_user: $scope.id_user,
					id_wilayah: $scope.id_wilayah['id_wilayah'],
					nama_pegawai: $scope.nama_pegawai,
					pass: $scope.pass
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
	$scope.save_profile = function(mode){
		try{
			mode_input = (typeof mode === 'undefined' || mode === '') ? 'save' : 'update';
			var data = {
				url: $scope.base_url + 'admin/profile/save_profile',
				data: {
					mode_input: mode_input,
					foto_pegawai: $(document).find('#upload_id').val(),
					id_user: $scope.id_user,
				},
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
		}catch(err){
			sweetAlert('Error Pengisian Data', err, "error");
		}
	},
	$scope.toogleStatus = function(data_input, id, level){
		var data = {
			url: $scope.base_url + 'admin/data_pegawai/toogle_data',
			type: 'POST',
			data: {
				mode_input: 'update',
				value: (level==true) ? 1 : 0,
				id_user: data_input,
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