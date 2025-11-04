app.controller('scan_data_controller', function($scope, $rootScope, $http, $filter){
	$scope.initialForm = function(){
		//DRR 23Jan19
		// $scope.sync_no_scan = '';
		$scope.no_scan = '';
		$scope.sync_id_wilayah = '';
		$scope.sync_id_kecamatan = '';
		$scope.no_polisi = '';
		$scope.sync_no_polisi = '';
		$scope.sync_no_polisi_format = '';
		$scope.sync_no_mesin = '';
		$scope.sync_no_rangka = '';
		$scope.sync_nama_pemilik = '';
		$scope.sync_tgl_akhir_pajak = '';
		$scope.sync_tgl_akhir_stnkb = '';
		$scope.sync_tgl_proses_daftar = '';
		$scope.sync_tgl_proses_tetap = '';
		$scope.sync_tgl_proses_bayar = '';
		$scope.sync_tgl_akhir_pjklm = '';
		$scope.sync_tgl_akhir_pjkbr = '';
		// 26Jan19
		$scope.btnSaveDisb = true;
		// $scope.ImageType2 = '';

		$scope.dataAll = [];
		$scope.data_wilayah = [];
		$scope.data_kecamatan = [];
		no_need_waiting();
	},
	// DRR 12Des18
	$scope.saveData = function(mode){
		try{
			mode_input = (typeof mode === 'undefined' || mode === '') ? 'save' : 'update';

			var data = {
				url: $scope.base_url + 'scan_data/insert_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					no_scan: $scope.no_scan,
					id_wilayah: $scope.sync_id_wilayah,
					id_kecamatan: $scope.sync_id_kecamatan,
					no_polisi: $scope.sync_no_polisi,
					no_polisi_format: $scope.sync_no_polisi_format,
					no_mesin :$scope.sync_no_mesin,
					no_rangka : $scope.sync_no_rangka,
					nama_pemilik : $scope.sync_nama_pemilik,
					file_image: document.getElementById("url_local_path").value,
					tgl_akhir_pajak: $scope.sync_tgl_akhir_pajak,
					tgl_akhir_stnkb: $scope.sync_tgl_akhir_stnkb,
					tgl_proses_daftar: $scope.sync_tgl_proses_daftar,
					tgl_proses_tetap: $scope.sync_tgl_proses_tetap,
					tgl_proses_bayar: $scope.sync_tgl_proses_bayar,
					tgl_akhir_pjklm: $scope.sync_tgl_akhir_pjklm,
					tgl_akhir_pjkbr: $scope.sync_tgl_akhir_pjkbr,
					ImageType2: document.getElementById("ImageType2").value
				},
				dataType: 'json',
				success: function(result){
					//DRR 7Feb19
					// $scope.initialForm();
					$scope.$apply();
					// 26Jan19
					// sweetAlert({
					// 	title: result.response.type,
					// 	text: result.response.msg,
					// 	type: 'success',
					// 	timer: 2000,
					// 	showConfirmButton: false
					// });
					// window.setTimeout(function(){ 
					//     location.reload();
					// } ,2000);
					// location.reload();
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
	$scope.syncData = function(){
		var data = {
			url: $scope.base_url + 'scan_data/identitas_kendaraan/sync_data',
			// 20Feb19
			data: {
				no_polisi: $scope.no_polisi,
				kd_plat: $scope.kd_plat
			},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response.data_simka;
				//DRR 23Jan19
				if (result.response.length === undefined || result.response.length > 0) {
					if (data_response.length > 0){
						$.each(data_response, function(index, value){

							$scope.sync_no_polisi = value.no_polisi;

							// DRR 12Jan19
							var nopol = value.no_polisi;
							// var nopolSplit = nopol.split(" ");
							// var nopolHuruf = nopolSplit[1].match(/([a-zA-Z]+)/);
							// var nopolAngka = nopolSplit[1].match(/(\d+)/);
							// $scope.sync_no_polisi_format = nopolSplit[0] + '-' + nopolAngka[0] + '-' + nopolHuruf[0];
							var nopolSplit = nopol.replace(/\ /g, "");
							var nopolHuruf = nopolSplit.match(/([a-zA-Z]+)/);
							var nopolAngka = nopolSplit.match(/(\d+)/);
							var nopolHuruf2 = '';
							if (nopolHuruf[0].substr(1) != '') {
								nopolHuruf2 = '-' + nopolHuruf[0].substr(1);
							}
							$scope.sync_no_polisi_format = nopolSplit[0].substr(0,1) + '-' + nopolAngka[0] + nopolHuruf2;

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
							$scope.sync_url_path = value.url_path;
							$scope.sync_nama_singkat = value.nama_singkat;
							$scope.ImageType2  = 'png';
							// 26Jan19
							$scope.btnSaveDisb = false;
							// $scope.sync_url_local_path = value.url_local_path;

							// no_polisi_trim = $filter('removeSpaces')(value.no_polisi);
							// $scope.no_scan = value.kd_wil + value.kd_kecamatan + no_polisi_trim;
							
							// DRR 12Des18
							var d = new Date();
							if (d.getMinutes() < 10) {
								$menit = '0' + d.getMinutes();
							} else {
								$menit = d.getMinutes();
							}
							if (d.getSeconds() < 10) {
								$detik = '0' + d.getSeconds();
							} else {
								$detik = d.getSeconds();
							}
							$scope.no_scan = d.getFullYear() + '' + (d.getMonth() + 1) + '' + d.getDate() + '-' + d.getHours() + '' + $menit + '' + $detik;
						});
						$(document).find('#savedata').show();
						animate_to_top('#divScanner');
						$scope.$apply();
					} else {
						// throw new Error('Data Tidak DiTemukan Di Pusat Data');
						sweetAlert("Kosong", "Data Tidak DiTemukan Di Pusat Data", "error");
					}
				} else {
					$scope.initialForm();
					sweetAlert("Kosong", "Data Tidak DiTemukan Di Pusat Data", "error");
				}
			},
			error: function(result){
				if(result.statusText!=='abort')
				sweetAlert(result.statusText, result.responseText, "error");
			}
		};
		if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
		$rootScope.ajaxRequest = $.ajax(data);
	},
	//DRR 12Des18
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
	}
});
