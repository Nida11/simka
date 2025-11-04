<div data-ng-app='simka_bapenda' data-ng-controller='identitas_kendaraan_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<div class='well well-lg'>
				<h4 id='data_cari_data'>Pencarian Data<br>
					<small>Isi Parameter Pencarian Untuk Pencarian Yang Lebih Spesifik</small>
				</h4>
				<div class='col-lg-6 col-md-6'>
					<div class="input-group" data-ng-init="getData_wilayah();">
						<span class="input-group-addon addon-lg180">
							KODE WILAYAH
						</span>
						<select class='form-control select2' data-ng-change='getData_kecamatan()' ng-model="id_wilayah" ng-options="wilayah.nama_wilayah for wilayah in data_wilayah track by wilayah.id_wilayah">
							<option value="">-- Pilih Wilayah --</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon addon-lg180">
							KODE KECAMATAN
						</span>
						<select class='form-control select2' ng-model="id_kecamatan" ng-options="kecamatan.nama_kecamatan for kecamatan in data_kecamatan track by kecamatan.id_wilayah">
							<option value="">-- Pilih Kecamatan --</option>
						</select>
					</div>
					<div class="input-group">
						<span class="input-group-addon addon-lg180">
							NOMOR POLISI
						</span>
						<input autofocus='true' class='form-control' type="text" name="no_polisi" data-ng-model='no_polisi'>
					</div>
				</div>
				<div class='col-lg-6 col-md-6'>
					<div class="input-group">
						<span class="input-group-addon addon-lg180">
							TGL AKHIR PAJAK
						</span>
						<input id='tgl_akhir_pajak' class='form-control tanggal' type="text" name="tgl_akhir_pajak" data-ng-model='tgl_akhir_pajak'>
					</div>
					<div class="input-group">
						<span class="input-group-addon addon-lg180">
							TGL AKHIR STNK
						</span>
						<input id='tgl_akhir_stnk' class='form-control tanggal' type="text" name="tgl_akhir_stnk" data-ng-model='tgl_akhir_stnk'>
					</div>
					<div class="input-group">
						<span class="input-group-addon addon-lg180">
							NAMA PEMILIK
						</span>
						<input class='form-control' type="text" name="nama_pemilik" data-ng-model='nama_pemilik'>
					</div>
					<br>
					<a class='pull-right btn btn-primary' data-ng-click="getData();"><span class='glyphicon glyphicon-search'></span> CARI DATA</a>
				</div>
				<div class='clearfix'></div>
			</div>
			
			
			<h4 id="data_identitas_kendaraan">Data Identitas Kendaraan<br>
				<small>Master Data Identitas Kendaraan dari Proses Alih Media Aplikasi SIMKA</small>
			</h4>
			<?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=10;currentpage=1"'); ?>
			<div class='table-responsive'>
				<table class='table table-striped table-hover table-condensed'>
					<thead>
						<th class='wid200 bgcl-blue60' colspan='5'>DETAIL IDENTITAS KENDARAAN</th>
					</thead>
					<tbody data-ng-init="getData()">
						<tr data-ng-if='dataAll.length < 1'>
							<td class='empty-row' colspan='10'>Data Identitas Kendaraan Kosong<br>
								<small>Semua Data Identitas Kendaraan Akan Tampil Disini</small><br>
								<br>
								&bullet; &bullet; &bullet;<br>
								<br>
								<a class='clickable' data-ng-click='syncData(no_polisi, "")'>
									Cari Data Langsung Ke Pusat Data<br>
									<small>(Masukan No. Polisi Telebih Dahulu)</small><br>
									<small>Catatan: Jika Data Tidak Ditemukan Pada Basis Data SIMKA</small>
								</a>
								
							</td>
						</tr>
						<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
							<td class='align_center bgcl-blue50 wid50'>
								<a title='Syncronize Data' data-ng-click='syncData(val.no_polisi, val.id_identitas_kendaraan)' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-refresh'></span></a>
								<a title='Scan Dokumen' class='btn btn-xs btn-default'><span class='glyphicon glyphicon-save'></span></a>
							</td>
							<td class='wid80 align_center'>
								<b>{{val.no_polisi}}</b>
							</td>
							<td class='wid200 bgcl-blue50'>
								<b>{{val.nama_pemilik | uppercase}}</b><br>
								No. Mesin : <b>{{val.no_mesin | uppercase}}</b><br>
								No. Rangka : <b>{{val.no_rangka}}</b><br>
							</td>
							<td class='wid300'>
								<b>{{val.nama_wilayah | uppercase}}</b><br>
								Tgl. Akhir Pajak : <b>{{val.tgl_akhir_pajak}}</b><br>
								Tgl. Akhir Stnk : <b>{{val.tgl_akhir_stnkb}}</b><br>
							</td>
							<td class='align_center bgcl-blue50 wid50'>
								
							</td>
						</tr>
					</tbody>
				</table>
				<dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
			</div>
			<hr>
			<div>
				<h4 id='data_detail_kendaraan'>Data Detail Kendaraan<br>
					<small>Data Kendaraan Sinkron dari Pusat Data Bapenda Jawa Barat</small>
				</h4>
				<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'>
					<div id='no_polisi' class='mrgbt10'>
						<a>NOMOR POLISI</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
							<input class='form-control' type="text" name="sync_no_polisi" data-ng-model='sync_no_polisi' placeholder='NOMOR POLISI'>
						</div>
					</div>
					<div id='nama_pemilik' class='mrgbt10'>
						<a>NAMA PEMILIK</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
							<input class='form-control' type="text" name="sync_nama_pemilik" data-ng-model='sync_nama_pemilik' placeholder='NAMA PEMILIK'>
						</div>
					</div>
					<div id='no_mesin' class='mrgbt10'>
						<a>NOMOR MESIN</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_no_mesin" data-ng-model='sync_no_mesin' placeholder='NOMOR MESIN'>
						</div>
					</div>
					<div id='no_rangka' class='mrgbt10'>
						<a>NOMOR RANGKA</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_no_rangka" data-ng-model='sync_no_rangka' placeholder='NOMOR RANGKA'>
						</div>
					</div>
					<div id='id_wilayah' class='mrgbt10'>
						<a>ID WILAYAH</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_id_wilayah" data-ng-model='sync_id_wilayah' placeholder='ID WILAYAH'>
						</div>
					</div>
				</div>
				<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'>
					<div id='id_kecamatan' class='mrgbt10'>
						<a>ID KECAMATAN</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_id_kecamatan" data-ng-model='sync_id_kecamatan' placeholder='ID KECAMATAN'>
						</div>
					</div>
					<div id='tgl_akhir_pajak' class='mrgbt10'>
						<a>TGL. AKHIR PAJAK</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_akhir_pajak" data-ng-model='sync_tgl_akhir_pajak' placeholder='TGL. AKHIR PAJAK'>
						</div>
					</div>
					<div id='tgl_akhir_stnkb' class='mrgbt10'>
						<a>TGL. AKHIR STNKB</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_akhir_stnkb" data-ng-model='sync_tgl_akhir_stnkb' placeholder='TGL. AKHIR STNKB'>
						</div>
					</div>
					<div id='tgl_proses_daftar' class='mrgbt10'>
						<a>TGL. PROSES DAFTAR</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_proses_daftar" data-ng-model='sync_tgl_proses_daftar' placeholder='TGL. PROSES DAFTAR'>
						</div>
					</div>
					<div id='tgl_proses_daftar' class='mrgbt10'>
						<a>TGL. PROSES DAFTAR</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_proses_daftar" data-ng-model='sync_tgl_proses_daftar' placeholder='TGL. PROSES DAFTAR'>
						</div>
					</div>
				</div>
				<div class='col-lg-4 col-md-4 col-sm-6 col-xs-6'>
					<div id='tgl_proses_tetap' class='mrgbt10'>
						<a>TGL. PROSES TETAP</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_proses_tetap" data-ng-model='sync_tgl_proses_tetap' placeholder='TGL. PROSES TETAP'>
						</div>
					</div>
					<div id='tgl_proses_bayar' class='mrgbt10'>
						<a>TGL. PROSES BAYAR</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_proses_bayar" data-ng-model='sync_tgl_proses_bayar' placeholder='TGL. PROSES BAYAR'>
						</div>
					</div>
					<div id='tgl_akhir_pjklm' class='mrgbt10'>
						<a>TGL. AKHIR PAJAK LAMA</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_akhir_pjklm" data-ng-model='sync_tgl_akhir_pjklm' placeholder='TGL. AKHIR PAJAK LAMA'>
						</div>
					</div>
					<div id='tgl_akhir_pjkbr' class='mrgbt10'>
						<a>TGL. AKHIR PAJAK BARU</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input class='form-control' type="text" name="sync_tgl_akhir_pjkbr" data-ng-model='sync_tgl_akhir_pjkbr' placeholder='TGL. AKHIR PAJAK BARU'>
						</div>
					</div>
					<br>
					<div id='button' class='mrgbt10 align_center'>
						<span class="input-group-btn" id='updatedata' >
							<input data-ng-click='saveData("update");' type="submit" class="btn btn-warning" value="SIMPAN DATA BARU"/>
							<button data-ng-click='initialForm();' class="btn btn-default"><span class='glyphicon glyphicon-refresh'></span> SINKRON DATA</button>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $css; ?>
<?= $js; ?>

<script type="text/javascript">
	$('.tanggal').datepicker({
		dateFormat: 'dd-mm-yy',
		onSelect: function (dateText, inst) {
			target = $(this).attr('data-target');	
			tanggal_select = $(this).datepicker({ dateFormat: "dd-mm-yy" }).val();
			$(document).find(target).val(tanggal_select);
		}
	});
</script>