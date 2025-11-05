<div data-ng-app='simka_bapenda' data-ng-controller='scan_data_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<div class='well well-lg'>
				<h4>Pencarian Data<br>
					<small>Isi Parameter Pencarian Untuk Pencarian Yang Lebih Spesifik</small>
				</h4>
				<div class='col-lg-6 col-md-6'>
					<div class="input-group" data-ng-init="getData_wilayah();">
						<span class="input-group-addon addon-lg180">
							KODE WILAYAH
						</span>
						<select class='form-control select2' data-ng-change='getData_kecamatan()' data-ng-model="id_wilayah" data-ng-options="wilayah.nama_wilayah for wilayah in data_wilayah track by wilayah.id_wilayah">
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
				</div>
				<div class='col-lg-6 col-md-6'>
					<div class="input-group">
						<span class="input-group-addon addon-lg180">
							NOMOR POLISI
						</span>
						<input class='form-control' type="text" name="no_polisi" data-ng-model='no_polisi'>
					</div>
					<div class="input-group">
						<span class="input-group-addon addon-lg180">
							TGL UPLOAD
						</span>
						<input class='tanggal form-control' type="text" name="tgl_upload" data-ng-model='tgl_upload'>
					</div>
					<br>
					<a class='pull-right btn btn-primary'><span class='glyphicon glyphicon-search'></span> CARI DATA</a>
				</div>
				<div class='clearfix'></div>
			</div>
			
			<h4>List Scan Data<br>
				<small>Daftar Data Hasil Scan Dokumen Kendaraan</small>
			</h4>
			<div class='clearfix'></div>
			<?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=1;currentpage=1"'); ?>
			<div class='table-responsive'>
				<table class='table table-striped table-hover table-condensed'>
					<thead>
						<th class='wid50 bgcl-blue50'>#</th>
						<th class='wid80 bgcl-yellow50'>NOMOR<br>POLISI<br></th>
						<th class='wid200 bgcl-blue60'>DETAIL<br>KENDARAN</th>
						<th class='wid300 bgcl-blue60'>DETAIL<br>WILAYAH</th>
					</thead>
					<tbody>
						<tr data-ng-if='dataAll.length < 1'>
							<td class='empty-row' colspan='10'>Data Scan Dokumen Kosong<br>
								<small>Semua Data Scan Dokumen Akan Tampil Disini</small><br>
								&bullet; &bullet; &bullet;<br>
								<span>Cari Data ke API Puslia Jabar</span><br>
								<a data-ng-click='syncData(val.no_polisi, val.id_identitas_kendaraan)' class='btn btn-xs btn-primary'>SYNC Data {{no_polisi}}</a>
							</td>
						</tr>
						<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
							<td class='align_center bgcl-blue50 wid50'>
								<a title='SYNC Data PUSLIA' data-ng-click='syncData(val.no_polisi, "");' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-refresh'></span></a>
							</td>
							<td class='wid80 align_center'>
								<label class='fnt16'>{{val.no_polisi}}</label>
							</td>
							<td class='wid200 bgcl-blue50'>
								<b>{{val.nama_pemilik | uppercase}}</b><br>
								No. Mesin : <a><b>{{val.no_mesin | uppercase}}</b></a><br>
								No. Rangka : <b>{{val.no_rangka}}</b>
							</td>
							<td class='wid300'>
								&bullet; <b>{{val.id_wilayah}}</b><br>
								&bullet; <a><b>{{val.nama_singkat | uppercase}}</b></a><br>
							</td>
						</tr>
					</tbody>
				</table>
				<dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
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