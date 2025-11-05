app.controller('code_askes_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.id_akses = '';
		$scope.nama_akses = '';
		$scope.kode_secret = '';
		$scope.deskripsi = '';
		$scope.color = '#ffffff';
		$scope.font_color = '#ffffff';
		$scope.css = '';
		$scope.dataAksesMenu = [];
		$scope.parameter = [];

		$(document).find('#savedata').show();
		$(document).find('#updatedata').hide();
	},
	$scope.getData = function(data_input){
		var data = {
			url: $scope.base_url + 'admin/code_akses/get_data',
			data: {id_akses: data_input},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				if(typeof data_input === 'undefined'){
					$scope.dataAll = data_response.data1;
				}else{
					$scope.dataAksesMenu = data_response.data2;
					$.each(data_response.data1, function(index, value){
						$scope.id_akses = value.id_akses;
						$scope.nama_akses = value.nama_akses;
						$scope.kode_secret = value.kode_secret;
						$scope.deskripsi = value.deskripsi;
						$scope.color = value.color;
						$scope.font_color = value.font_color;
						$scope.css = value.css;
						$(document).find('#savedata').hide();
						$(document).find('#updatedata').show();
					});
				}
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
				url: $scope.base_url + 'admin/code_akses/delete_data',
				data: {id_akses: data_input},
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
				url: $scope.base_url + 'admin/code_akses/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					id_akses: $scope.id_akses,
					nama_akses: $scope.nama_akses,
					kode_secret: $scope.kode_secret,
					deskripsi: $scope.deskripsi,
					color: $scope.color,
					font_color: $scope.font_color,
					css: $scope.css,
					parameter: JSON.parse(angular.toJson($scope.parameter)),
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
			url: $scope.base_url + 'admin/code_akses/toogle_data',
			type: 'POST',
			data: {
				mode_input: 'update',
				value: (level==true) ? 1 : 0,
				id_akses: data_input,
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
	},
	$scope.addNewChoice = function(id_module, id_code_akses) {
		var newItemNo = $scope.parameter.length+1;
		$scope.parameter.push({'id': 'param'+newItemNo, 'id_module' : id_module, 'id_code_akses' : id_code_akses});
	},
	$scope.removeChoice = function(id_module, id_code_akses){
		var data = {
			url: $scope.base_url + 'admin/modul_akses/delete_module_menu_data',
			data: {
				id_module: id_module,
				id_code_akses: id_code_akses
			},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				$scope.getData(id_code_akses);
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