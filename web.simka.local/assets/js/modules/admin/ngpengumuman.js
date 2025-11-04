app.controller('pengumuman_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.id_pengumuman = '';
		$scope.judul_pengumuman = '';
		$scope.isi_pengumuman = '';
		$scope.dataAll = [];
		$(document).find('#savedata').show();
		$(document).find('#updatedata').hide();
	},
	$scope.getData = function(data_input){
		var data = {
			url: $scope.base_url + 'admin/pengumuman/get_data',
			data: {id_pengumuman: data_input},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				if(typeof data_input === 'undefined'){
					$scope.dataAll = data_response
				}else{
					$.each(data_response, function(index, value){
						$scope.id_pengumuman = value.id_pengumuman;
						$scope.judul_pengumuman = value.judul_pengumuman;
						$scope.isi_pengumuman = value.isi_pengumuman;
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
				url: $scope.base_url + 'admin/pengumuman/delete_data',
				data: {id_pengumuman: data_input},
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
				url: $scope.base_url + 'admin/pengumuman/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					id_pengumuman: $scope.id_pengumuman,
					judul_pengumuman: $scope.judul_pengumuman,
					isi_pengumuman: $scope.isi_pengumuman
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
	$scope.toogleStatus = function(data_input, id, level){
		var data = {
			url: $scope.base_url + 'admin/pengumuman/toogle_data',
			type: 'POST',
			data: {
				mode_input: 'update',
				value: (level==true) ? 1 : 0,
				id_pengumuman: data_input,
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