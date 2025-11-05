app.controller('identitas_kendaraan_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.id_identitas_kendaraan = '';
		$scope.no_polisi = '';
		$scope.no_mesin = '';
		$scope.no_rangka = '';
		$scope.id_wilayah = '';
		$scope.id_kecamatan = '';
		$scope.nama_pemilik = '';

		$scope.dataAll = [];
		$scope.data_wilayah = [];
		$scope.data_kecamatan = [];
		no_need_waiting();
		$(document).find('.loader_potensi').hide();
		$(document).find('.data_ok').hide();
		$(document).find('#savedata').hide();
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
		id_wilayah = $scope.id_wilayah['id_wilayah'];
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
	$scope.getData = function(data_input){
		if(typeof data_input === 'undefined'){
			data_input = {
				id_wilayah: $scope.id_wilayah['id_wilayah'],
				id_kecamatan: $scope.id_kecamatan['id_kecamatan'],
				no_polisi: $scope.no_polisi,
				tgl_akhir_pajak: $(document).find('#tgl_akhir_pajak').val(),
				tgl_akhir_stnk: $(document).find('#tgl_akhir_stnk').val(),
				nama_pemilik: $scope.nama_pemilik,
			};
			detail_input = false;
		}else{
			data_input = {
				id_identitas_kendaraan: data_input
			};
			detail_input = true;
		}
		var data = {
			url: $scope.base_url + 'scan_data/identitas_kendaraan/get_data',
			data: data_input,
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				if(!detail_input){
					$scope.dataAll = data_response
				}else{
					$.each(data_response, function(index, value){
						$scope.id_identitas_kendaraan = value.id_identitas_kendaraan;
						$scope.no_polisi = value.no_polisi;
						$scope.no_mesin = value.no_mesin;
						$scope.no_rangka = value.no_rangka;
						$scope.id_wilayah = value.id_wilayah;
						$scope.id_kecamatan = value.id_kecamatan;
						$scope.nama_pemilik = value.nama_pemilik;
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
	$scope.syncData = function(data_input, id_data){
		if(confirm('Anda Yakin Akan Koneksi Ke Pusat Data ?')){
			var data = {
				url: $scope.base_url + 'scan_data/identitas_kendaraan/sync_data',
				data: {no_polisi: data_input, id_identitas_kendaraan: id_data},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					data_response = result.response.data_simka;
					if (data_response.length > 0){
						$.each(data_response, function(index, value){
							$scope.sync_no_polisi = value.no_polisi;
							$scope.sync_no_mesin = value.no_mesin;
							$scope.sync_no_rangka = value.no_rangka;
							$scope.sync_id_wilayah = value.kd_wil;
							$scope.sync_id_kecamatan = value.kd_kecamatan;
							$scope.sync_nama_pemilik = value.nm_pemilik;
							$scope.sync_tgl_akhir_pajak = value.tg_akhir_pajak;
							$scope.sync_tgl_akhir_stnkb = value.tg_akhir_stnkb;
							$scope.sync_tgl_proses_daftar = value.tg_pros_daftar;
							$scope.sync_tgl_proses_tetap = value.tg_pros_tetap;
							$scope.sync_tgl_proses_bayar = value.tg_pros_bayar;
							$scope.sync_tgl_akhir_pjklm = value.tg_akhir_pjklm;
							$scope.sync_tgl_akhir_pjkbr = value.tg_akhir_pjkbr;
						});
						$(document).find('#savedata').show();
						animate_to_top('#data_detail_kendaraan');
						$scope.$apply();
					}else{
						throw new Error('Data Tidak DiTemukan Di Pusat Data');
					}
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
				url: $scope.base_url + 'scan_data/identitas_kendaraan/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					id_identitas_kendaraan: $scope.id_identitas_kendaraan,
					no_polisi: $scope.no_polisi,
					no_mesin: $scope.no_mesin,
					no_rangka: $scope.no_rangka,
					id_wilayah: $scope.id_wilayah,
					id_kecamatan: $scope.id_kecamatan,
					nama_pemilik: $scope.nama_pemilik,
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
	}
});