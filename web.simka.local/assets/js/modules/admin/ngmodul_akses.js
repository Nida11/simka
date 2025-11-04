app.controller('modul_akses_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.id_module = '';
		$scope.nama_module = '';
		$scope.id_parent_module = '';
		$scope.code_module = '';
		$scope.route = '';
		$scope.sort_order = 0;
		$scope.dataAll = [];
		$(document).find('#savedata').show();
		$(document).find('#updatedata').hide();
	},
	$scope.getData = function(data_input){
		var data = {
			url: $scope.base_url + 'admin/modul_akses/get_data',
			data: {id_module: data_input},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				if(typeof data_input === 'undefined'){
					$scope.dataAll = data_response
				}else{
					$.each(data_response, function(index, value){
						$scope.id_module = value.id_module;
						$scope.id_parent_module = value.id_parent_module;
						$scope.nama_module = value.nama_module;
						$scope.code_module = value.code_module;
						$scope.route = value.route;
						$scope.sort_order = value.sort_order;
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
				url: $scope.base_url + 'admin/modul_akses/delete_data',
				data: {id_module: data_input},
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
				url: $scope.base_url + 'admin/modul_akses/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					id_module: $scope.id_module,
					id_parent_module: $scope.id_parent_module,
					nama_module: $scope.nama_module,
					code_module: $scope.code_module,
					route: $scope.route,
					sort_order: parseInt($scope.sort_order),
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
			url: $scope.base_url + 'admin/modul_akses/toogle_data',
			type: 'POST',
			data: {
				mode_input: 'update',
				value: (level==true) ? 1 : 0,
				id_module: data_input,
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
	$scope.incrStatus = function(data_input, id, level, level_status){
		level = parseInt(level);
		var data = {
			url: $scope.base_url + 'admin/modul_akses/toogle_data',
			type: 'POST',
			data: {
				mode_input: 'update',
				value: (level_status=='+') ? level+1 : level-1,
				id_module: data_input,
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