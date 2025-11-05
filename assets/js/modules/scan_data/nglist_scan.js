app.controller('scan_data_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		$scope.no_scan = '';
		$scope.id_wilayah = '';
		$scope.id_kecamatan = '';
		$scope.no_polisi = '';
		$scope.no_scan = '';
		$scope.no_mesin = '';
		$scope.no_rangka = '';
		$scope.nama_pemilik = '';
		$scope.tgl_akhir_pajak = '';
		$scope.tgl_akhir_stnkb = '';
		$scope.tgl_proses_daftar = '';
		$scope.tgl_proses_tetap = '';
		$scope.tgl_proses_bayar = '';
		$scope.tgl_akhir_pjklm = '';
		$scope.tgl_akhir_pjkbr = '';
		$scope.dataAll = [];
		// DRR 7Feb19
		$scope.dataAllRaw = [];
		$(document).find('#updatedata').hide();
	},
	$scope.getData = function(data_input, no_scan_multiple){
		var data = {
			url: $scope.base_url + 'scan_data/drr_get_data_scan',
			data: {
				no_scan: data_input,
				tgl_scan: $scope.tgl_scan
			},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				if(typeof data_input === 'undefined'){
					$scope.dataAll = data_response;
					$scope.getDataScan('');
				}else{
					$.each(data_response, function(index, value){
						// DRR 12Jan19
						$scope.no_scan = value.no_polisi + '-' + value.no_scan;
						$scope.no_polisi = value.no_polisi_format;
						$scope.nama_pemilik = value.nama_pemilik;
						$scope.id_wilayah = value.id_wilayah;
						$scope.id_kecamatan = value.id_kecamatan;
						$scope.tgl_akhir_pajak = value.tgl_akhir_pajak;
						$scope.tgl_akhir_stnkb = value.tgl_akhir_stnkb;
						$scope.tgl_proses_daftar = value.tgl_proses_daftar;
						$scope.tgl_proses_tetap = value.tgl_proses_tetap;
						$scope.tgl_proses_bayar = value.tgl_proses_bayar;
						$scope.tgl_akhir_pjklm = value.tgl_akhir_pjklm;
						$scope.tgl_akhir_pjkbr = value.tgl_akhir_pjkbr;

						// DRR 7Feb19
						$scope.getDataScan(value.no_scan, no_scan_multiple);
						// DRR 22Des18
						// $("#exampleModalLabel").html(value.no_polisi+"-"+value.no_scan);
						// $("#btnDownloadScan").attr("href", $scope.base_url + "scan_data/drr_download_image");
						// $("#formDownloadScan").attr("action", $scope.base_url + "scan_data/drr_download_image");
						// $("#image_contents").val(value.img_raw);
						// $("#DownloadNo_scan").val(value.no_polisi+"-"+value.no_scan);
						// $("#gambar_raw").html("<a href='data:image/jpg;base64,"+value.img_raw+"' target='_blank'><img width='100%' src='data:image/jpg;base64,"+value.img_raw+"'></a>");
						// $(document).find('#updatedata').show();
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
	// DRR 7Feb19
	$scope.getDataScan = function(no_scan, data_input){
		var data = {
			url: $scope.base_url + 'scan_data/drr_get_data_scan_raw',
			data: {
				no_scan: no_scan,
				no_scan_multiple: data_input
			},
			type: 'POST',
			dataType: 'json',
			success: function(result){
				data_response = result.response;
				if(typeof data_input === 'undefined') {
					$scope.dataAllRaw = data_response;
				}else{
					$.each(data_response, function(index, value){
						// DRR 7Feb19
						$("#exampleModalLabel").html(value.no_scan_multiple);
						$("#formDownloadScan").attr("action", $scope.base_url + "scan_data/drr_download_image");
						$("#image_contents").val(value.img_raw);
						$("#DownloadNo_scan").val(value.no_scan_multiple);
						$("#gambar_raw").html("<a href='data:image/jpg;base64,"+value.img_raw+"' target='_blank'><img width='100%' src='data:image/jpg;base64,"+value.img_raw+"'></a>");
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
	// DRR 7Feb19
	$scope.getDataScanMultiple = function(no_scan){
        var result = [];
        for(var i = 0 ; i < $scope.dataAllRaw.length ; i++){
            if(no_scan === $scope.dataAllRaw[i].no_scan){
                result.push($scope.dataAllRaw[i]);
            }
        }
        // console.log(parentId)
        return result;
    },
	$scope.deleteData = function(no_scan, no_polisi, no_mesin, no_rangka, id_wilayah, id_kecamatan, nama_pemilik, tgl_akhir_pajak, tgl_akhir_stnkb, tgl_proses_daftar, tgl_proses_tetap, tgl_proses_bayar, tgl_akhir_pjklm, tgl_akhir_pjkbr){
		if(confirm('Anda Yakin Akan Menghapus Data ini ?')){
			var data = {
				url: $scope.base_url + 'scan_data/deleteScan',
				data: {
					no_scan: no_scan,
					no_polisi: no_polisi,
					no_mesin: no_mesin,
					no_rangka: no_rangka,
					id_wilayah: id_wilayah,
					id_kecamatan: id_kecamatan,
					nama_pemilik: nama_pemilik,
					tgl_akhir_pajak: tgl_akhir_pajak,
					tgl_akhir_stnkb: tgl_akhir_stnkb,
					tgl_proses_daftar: tgl_proses_daftar,
					tgl_proses_tetap: tgl_proses_tetap,
					tgl_proses_bayar: tgl_proses_bayar,
					tgl_akhir_pjklm: tgl_akhir_pjklm,
					tgl_akhir_pjkbr: tgl_akhir_pjkbr
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
		}
	},
	$scope.saveData = function(mode){
		try{
			mode_input = (typeof mode === 'undefined' || mode === '') ? 'save' : 'update';
			var data = {
				url: $scope.base_url + 'scan_data/save_data',
				type: 'POST',
				data: {
					mode_input: mode_input,
					no_scan: $scope.no_scan,
					id_wilayah: $scope.id_wilayah,
					id_kecamatan: $scope.id_kecamatan,
					no_polisi: $scope.no_polisi,
					nama_pemilik : $scope.nama_pemilik,
					tgl_akhir_pajak: $scope.tgl_akhir_pajak,
					tgl_akhir_stnkb: $scope.tgl_akhir_stnkb,
					tgl_proses_daftar: $scope.tgl_proses_daftar,
					tgl_proses_tetap: $scope.tgl_proses_tetap,
					tgl_proses_bayar: $scope.tgl_proses_bayar,
					tgl_akhir_pjklm: $scope.tgl_akhir_pjklm,
					tgl_akhir_pjkbr: $scope.tgl_akhir_pjkbr,
				},
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
	}
});