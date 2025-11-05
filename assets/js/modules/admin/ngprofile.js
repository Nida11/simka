app.controller('profile_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.id_user = '';
		$scope.password_lama = '';
		$scope.password_baru = '';
		$scope.confirm_password = '';
		$scope.getData();
	},
	$scope.getData = function(){
		var data = {
			url: $scope.base_url + 'admin/profile/get_data',
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				$.each(data_response, function(index, value){
					$scope.id_user = value.id_user;
				});
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
	$scope.reset_privileges = function(){
		if(confirm('Apakah Anda Yakin Akan Mereset Privelege Anda Sendiri?')){
			var data = {
				url: $scope.base_url + 'admin/profile/delete_akun',
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
	$scope.save_password = function(){
		try{
			if($scope.password_lama == null) throw new Error('Password Lama Harus Diisi');
			if($scope.password_baru !== $scope.confirm_password) throw new Error('Password Yang Dimasukan Tidak Sama');
			var data = {
				url: $scope.base_url + 'admin/profile/change_password',
				data: {
					password_lama: $scope.password_lama,
					password_baru: $scope.confirm_password
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
	$scope.save_absen = function(mode){
		try{
			mode_input = (typeof mode === 'undefined' || mode === '') ? 'save' : 'update';
			var data = {
				url: $scope.base_url + 'admin/profile/save_data',
				data: {
					mode_input: mode_input,
					id_user: $scope.id_user
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
					foto_pegawai: $(document).find('#upload_id').val()
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
			url: $scope.base_url + 'admin/profile/toogle_data',
			type: 'POST',
			data: {
				mode_input: 'update',
				value: (level==true) ? 1 : 0,
				id_user: data_input,
				objectname: id
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
	}
});