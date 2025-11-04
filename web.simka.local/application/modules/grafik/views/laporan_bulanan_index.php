<div data-ng-app='simka_bapenda' data-ng-controller='produksi_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"; is_admin="<?php echo $this->session->userdata('is_admin') ?>"'>
	<div class='panel panel-body'>
		<div class="col-lg-12">
			<h4 id='data_detail_kendaraan'>Laporan Bulanan Produksi<br>
				<small>Bulanan Produksi</small>
			</h4>
			<div class='mrgbt10'>
				<a>DATA TAHUN</a>
				<div class="input-group">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<input class='form-control' type="number" name="sync_tahun" data-ng-model='sync_tahun' placeholder='DATA TAHUN' ng-change="changeTahun()">
				</div>
			</div>
			<div class='mrgbt10' id="dt_bulan">
				<a>DATA BULAN</a>
				<div class="input-group">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<select class='form-control select2' name="sync_bulan" data-ng-model='sync_bulan' ng-change="changeBulan(selectedItem)" style="width: 100%;">
						<option value="">-- Pilih Bulan --</option>
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
				    </select>
				</div>
			</div>
			<div class='col-lg-6' style="padding-left: 0;" id="dt_tgl1">
				<div class="mrgbt10">
					<a>DARI TANGGAL</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="sync_tanggal1" data-ng-model='sync_tanggal1' placeholder='(Optional)'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;" id="dt_tgl2">
				<div class="mrgbt10">
					<a>SAMPAI TANGGAL</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="sync_tanggal2" data-ng-model='sync_tanggal2' placeholder='(Optional)'>
					</div>
				</div>
			</div>
			<div class='mrgbt10'>
				<?php if ($this->session->userdata('is_admin')) {?>
				<a>USER</a>
				<div class="input-group" data-ng-init="getData_user();">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<select class='form-control select2' name="sync_user" data-ng-model='sync_user' ng-options="user.nama_pegawai for user in data_user track by user.id_user">
						<option value="">-- Semua User --</option>
				    </select>
				</div>
				<?php } else { ?>
				<input type="hidden" name="sync_user" data-ng-model='sync_user' ng-init="sync_user='<?php echo $this->session->userdata('id_user') ?>';">
				<?php } ?>
			</div>
			<!-- <div class='mrgbt10'>
				<a>WILAYAH</a>
				<div class="input-group" data-ng-init="getData_wilayah();">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<select class='form-control select2' name="sync_wilayah" data-ng-model='sync_wilayah' data-ng-change='getData_kecamatan()' ng-options="wilayah.nama_wilayah for wilayah in data_wilayah track by wilayah.id_wilayah">
						<option value="">-- Pilih Wilayah --</option>
				    </select>
				</div>
			</div>
			<div class='mrgbt10'>
				<a>KECAMATAN</a>
				<div class="input-group">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<select class='form-control select2' name="sync_kecamatan" data-ng-model='sync_kecamatan' ng-options="kecamatan.nama_kecamatan for kecamatan in data_kecamatan track by kecamatan.id_wilayah">
						<option value="">-- Pilih Kecamatan --</option>
				    </select>
				</div>
			</div> -->
			<div id='button' class='mrgbt10'>
				<span class="input-group-btn" id='updatedata'>
					<input data-ng-click='cariDataLaporan()' type="submit" class="btn btn-warning" value="LIHAT DATA"/>
				</span>
			</div>
		</div>
		<hr class='minisolid'>
		<div class='mrgbt10'>
			<div class='clearfix'></div>
            <?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="currentpage=1"'); ?>
            <div class='table-responsive'>
                <table class='table table-striped table-hover table-condensed' id="tblScan">
                    <thead>
                        <th style="text-align: left;">No</th>
                        <th style="text-align: left;">Hari</th>
                        <th style="text-align: left;">Tanggal</th>
                        <th style="text-align: left;">Jumlah Data Scan</th>
                    </thead>
                    <tbody>
                        <tr data-ng-if='dataAll.length < 1'>
                            <td class='empty-row' colspan='10'>Data Scan Belum Di Pilih<br><small>Semua Data Scan Akan Tampil Disini</small></td>
                        </tr>
                        <tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
                        	<td style="text-align: left;">{{ $index + 1 }}</td>
                            <td style="text-align: left;">{{val.hari}}</td>
                            <td style="text-align: left;">{{val.tanggal}}</td>
                            <td style="text-align: left;">{{val.jumlah}}</td>
                        </tr>
						<tr data-ng-if='dataAll.length > 1'>
							<th colspan="3" style="text-align: center;">Jumlah</th>
							<th style="text-align: left;">{{ getTotal() }}</th>
						</tr>
                    </tbody>
                </table>
                <dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
            </div>
		</div>
	</div>
</div>
<?= $js; ?>