app.controller('report_generated_controller', function($scope, $rootScope, $http){
	$scope.initialForm = function(){
		no_need_waiting();

		var d = new Date();
		$scope.sync_tahun = d.getFullYear();
		$scope.sync_produksi1 = '';
		$scope.sync_produksi2 = '';
		$scope.sync_wilayah1 = '';
		$scope.sync_wilayah2 = '';
		$scope.sync_kecamatan1 = '';
		$scope.sync_kecamatan2 = '';
		$scope.sync_tgl_akhir_pajak1 = '';
		$scope.sync_tgl_akhir_pajak2 = '';
		$scope.sync_tgl_akhir_stnkb1 = '';
		$scope.sync_tgl_akhir_stnkb2 = '';
		$scope.count = 1;

		$scope.data_kolom = [];
		$scope.tampil_kolom = [];
		$scope.dataAll = [];

		$scope.disabled_produksi2 = true;
		$scope.disabled_wilayah2 = true;
		$scope.disabled_kecamatan2 = true;
		$scope.disabled_tgl_akhir_pajak2 = true;
		$scope.disabled_tgl_akhir_stnkb2 = true;

		$('.tanggal').datepicker({
			dateFormat: 'mm-dd'
		});

		$(document).find('#panel_kolom').hide();
		$(document).find('#btnExportExcel').hide();
	},
	$scope.proses = function() {
		var invalid = 0;
		var field = '';
		var first = 0;

		if ($scope.tgl_akhir_pajak1 != null && $scope.tgl_akhir_pajak2 != null) {
			var pajak1, pajak2;
			pajak1 = new Date();
			pajak2 = new Date();
			var tgl_akhir_pajak1 = $scope.sync_tgl_akhir_pajak1;
			var tgl_akhir_pajak2 = $scope.sync_tgl_akhir_pajak2;
			var tgl_akhir_pajak1splt = tgl_akhir_pajak1.split("-");
			var tgl_akhir_pajak2splt = tgl_akhir_pajak2.split("-");
			pajak1.setFullYear($scope.sync_tahun, tgl_akhir_pajak1splt[0], tgl_akhir_pajak1splt[1]);
			pajak2.setFullYear($scope.sync_tahun, tgl_akhir_pajak2splt[0], tgl_akhir_pajak2splt[1]);
		}
		if ($scope.tgl_akhir_stnkb1 != null && $scope.tgl_akhir_stnkb2 != null) {
			var stnkb1, stnkb2;
			stnkb1 = new Date();
			stnkb2 = new Date();
			var tgl_akhir_stnkb1 = $scope.sync_tgl_akhir_stnkb1;
			var tgl_akhir_stnkb2 = $scope.sync_tgl_akhir_stnkb2;
			var tgl_akhir_stnkb1splt = tgl_akhir_stnkb1.split("-");
			var tgl_akhir_stnkb2splt = tgl_akhir_stnkb2.split("-");
			stnkb1.setFullYear($scope.sync_tahun, tgl_akhir_stnkb1splt[0], tgl_akhir_stnkb1splt[1]);
			stnkb2.setFullYear($scope.sync_tahun, tgl_akhir_stnkb2splt[0], tgl_akhir_stnkb2splt[1]);
		}

		if ($scope.sync_produksi1 > $scope.sync_produksi2 || ($scope.sync_produksi1 != null && $scope.sync_produksi2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'PRODUKSI';
			} else {
				field += ', PRODUKSI';
			}
		}
		if ($scope.sync_wilayah1 > $scope.sync_wilayah2 || ($scope.sync_wilayah1 != null && $scope.sync_wilayah2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'WILAYAH';
			} else {
				field += ', WILAYAH';
			}
		}
		if ($scope.sync_kecamatan1 > $scope.sync_kecamatan2 || ($scope.sync_kecamatan1 != null && $scope.sync_kecamatan2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'KECAMATAN';
			} else {
				field += ', KECAMATAN';
			}
		}
		if (pajak1 > pajak2 || ($scope.sync_tgl_akhir_pajak1 != null && $scope.sync_tgl_akhir_pajak2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'TGL AKHIR PAJAK';
			} else {
				field += ', TGL AKHIR PAJAK';
			}
		}
		if (stnkb1 > stnkb2 || ($scope.sync_tgl_akhir_stnkb1 != null && $scope.sync_tgl_akhir_stnkb2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'TGL AKHIR STNK';
			} else {
				field += ', TGL AKHIR STNK';
			}
		}


		if (!Boolean(invalid)) {
			var data = {
				url: $scope.base_url + 'rekapitulasi/report_generated/proses_generated',
				data: {
					sync_tahun: $scope.sync_tahun,
					sync_produksi1: $scope.sync_produksi1,
					sync_produksi2: $scope.sync_produksi2,
					sync_wilayah1: $scope.sync_wilayah1,
					sync_wilayah2: $scope.sync_wilayah2,
					sync_kecamatan1: $scope.sync_kecamatan1,
					sync_kecamatan2: $scope.sync_kecamatan2,
					sync_tgl_akhir_pajak1: $scope.sync_tgl_akhir_pajak1,
					sync_tgl_akhir_pajak2: $scope.sync_tgl_akhir_pajak2,
					sync_tgl_akhir_stnkb1: $scope.sync_tgl_akhir_stnkb1,
					sync_tgl_akhir_stnkb2: $scope.sync_tgl_akhir_stnkb2
				},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					$scope.sync_jumlah = result.response[0]['total'];
					if (result.response[0]['total'] > 0) {
						$(document).find('#panel_kolom').show();
					} else {
						$scope.initialForm();
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
		} else {
			sweetAlert("Error", "Field "+field+" Salah Input", "error");
			$scope.sync_jumlah = '';
		}
	},
	$scope.proses2 = function() {
		var invalid = 0;
		var field = '';
		var first = 0;

		if ($scope.sync_produksi1 > $scope.sync_produksi2 || ($scope.sync_produksi1 != null && $scope.sync_produksi2 == null)) {
			invalid = 1;
			if (first == 0) {
				first = 1;
				field += 'PRODUKSI';
			} else {
				field += ', PRODUKSI';
			}
		}
		
		if (!Boolean(invalid)) {
			var data = {
				url: $scope.base_url + 'rekapitulasi/report_generated/proses_generated2',
				data: {
					sync_tahun: $scope.sync_tahun,
					sync_produksi1: $scope.sync_produksi1,
					sync_produksi2: $scope.sync_produksi2
				},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					$scope.sync_jumlah = result.response[0]['total'];
					if (result.response[0]['total'] > 0) {
						$(document).find('#panel_kolom').show();

						var data = {
							url: $scope.base_url + 'rekapitulasi/report_generated/tampilData2',
							data: {
								sync_tahun: $scope.sync_tahun,
								sync_produksi1: $scope.sync_produksi1,
								sync_produksi2: $scope.sync_produksi2
							},
							type: 'POST',
							dataType: 'json',
							success: function(result){
								data_response = result.response;
								$scope.dataAll = data_response;
								$(document).find('#btnExportExcel').show();
								$scope.$apply();
							},
							error: function(result){
								if(result.statusText!=='abort')
								sweetAlert(result.statusText, result.responseText, "error");
							}
						};
						if(typeof $rootScope.ajaxRequest !== 'undefined') $rootScope.ajaxRequest.abort();
						$rootScope.ajaxRequest = $.ajax(data);

					} else {
						$scope.initialForm();
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
		} else {
			sweetAlert("Error", "Field "+field+" Salah Input", "error");
			$scope.sync_jumlah = '';
		}
	},
	$scope.tampilData = function(data_input) {
		$scope.tampil_kolom = [];
		var kolom = 'sync_kolom';
		for (var i = 1; i <= 12; i++) {
			if (!(angular.isUndefined($scope[kolom + i]) || $scope[kolom + i] == null)) {
				$scope.tampil_kolom.push($scope[kolom + i]);
			}
		}

		if ($scope.tampil_kolom.length < 3) {
			sweetAlert("Error", "Kolom Yang di tampilkan Minimal 3", "error");
		} else {
			var data = {
				url: $scope.base_url + 'rekapitulasi/report_generated/tampilData',
				data: {
					sync_tahun: $scope.sync_tahun,
					sync_produksi1: $scope.sync_produksi1,
					sync_produksi2: $scope.sync_produksi2,
					sync_wilayah1: $scope.sync_wilayah1,
					sync_wilayah2: $scope.sync_wilayah2,
					sync_kecamatan1: $scope.sync_kecamatan1,
					sync_kecamatan2: $scope.sync_kecamatan2,
					sync_tgl_akhir_pajak1: $scope.sync_tgl_akhir_pajak1,
					sync_tgl_akhir_pajak2: $scope.sync_tgl_akhir_pajak2,
					sync_tgl_akhir_stnkb1: $scope.sync_tgl_akhir_stnkb1,
					sync_tgl_akhir_stnkb2: $scope.sync_tgl_akhir_stnkb2
				},
				type: 'POST',
				dataType: 'json',
				success: function(result){
					data_response = result.response;
					$scope.dataAll = data_response;
					$(document).find('#btnExportExcel').show();
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
	},
	$scope.exportExcel = function() {
		$("#tblScan").table2excel({
			filename: "Report Generated System.xls"
		});
	},
	$scope.tanggal = function(argument) {
		$('.tanggal').datepicker({
			dateFormat: 'mm-dd',
			onSelect: function (dateText, inst) {
				target = $(this).attr('data-target');	
				tanggal_select = $(this).datepicker({ dateFormat: "mm-dd" }).val();
				// $(document).find(target).val(tanggal_select);
				$scope[argument] = tanggal_select;
			}
		});
	},
	$scope.change = function(input, value, disable) {
		if ($scope[input] == '') {
			$scope[value] = '';
			$scope[disable] = true;
		} else {
			$scope[disable] = false;
		}
	},
	$scope.getData_Kolom = function(nomer){
		$scope.filter1 = function(item){return (!($scope.sync_kolom1&&$scope.sync_kolom1.id)||item.id !=$scope.sync_kolom1.id);};
		$scope.filter2 = function(item){return (!($scope.sync_kolom2&&$scope.sync_kolom2.id)||item.id!=$scope.sync_kolom2.id);};
		$scope.filter3 = function(item){return (!($scope.sync_kolom3&&$scope.sync_kolom3.id)||item.id !=$scope.sync_kolom3.id);};
		$scope.filter4 = function(item){return (!($scope.sync_kolom4&&$scope.sync_kolom4.id)||item.id!=$scope.sync_kolom4.id);};
		$scope.filter5 = function(item){return (!($scope.sync_kolom5&&$scope.sync_kolom5.id)||item.id !=$scope.sync_kolom5.id);};
		$scope.filter6 = function(item){return (!($scope.sync_kolom6&&$scope.sync_kolom6.id)||item.id!=$scope.sync_kolom6.id);};
		$scope.filter7 = function(item){return (!($scope.sync_kolom7&&$scope.sync_kolom7.id)||item.id !=$scope.sync_kolom7.id);};
		$scope.filter8 = function(item){return (!($scope.sync_kolom8&&$scope.sync_kolom8.id)||item.id!=$scope.sync_kolom8.id);};
		$scope.filter9 = function(item){return (!($scope.sync_kolom9&&$scope.sync_kolom9.id)||item.id !=$scope.sync_kolom9.id);};
		$scope.filter10 = function(item){return (!($scope.sync_kolom10&&$scope.sync_kolom10.id)||item.id!=$scope.sync_kolom10.id);};
		$scope.filter11 = function(item){return (!($scope.sync_kolom11&&$scope.sync_kolom11.id)||item.id !=$scope.sync_kolom11.id);};
		$scope.filter12 = function(item){return (!($scope.sync_kolom12&&$scope.sync_kolom12.id)||item.id!=$scope.sync_kolom12.id);};

		var kolom = 'data_kolom' + nomer;
		$scope[kolom] = [{
			id: "id_kecamatan",
			label: 'Kode Kecamatan'
		}, {
			id: "id_wilayah",
			label: 'Kode Wilayah'
		},{
			id: "no_scan",
			label: 'No. Scan'
		}, {
			id: "no_mesin",
			label: 'No. Mesin'
		}, {
			id: "no_polisi",
			label: 'No. Polisi'
		}, {
			id: "no_rangka",
			label: 'No. Rangka'
		}, {
			id: "user_upload",
			label: 'User Upload'
		}, {
			id: "tgl_scan",
			label: 'Tgl Scan'
		}, {
			id: "tgl_akhir_pajak",
			label: 'Tgl Akhir Pajak'
		}, {
			id: "tgl_akhir_stnkb",
			label: 'Tgl Akhir STNK'
		}, {
			id: "tgl_proses_daftar",
			label: 'Tgl Proses Daftar'
		}, {
			id: "tgl_proses_tetap",
			label: 'Tgl Proses Tetap'
		}, {
			id: "tgl_proses_bayar",
			label: 'Tgl Proses Bayar'
		}, {
			id: "tgl_akhir_pjklm",
			label: 'Tgl Akhir Pajak Lama'
		}, {
			id: "tgl_akhir_pjkbr",
			label: 'Tgl Akhir Pajak Baru'
		}];
	}
});