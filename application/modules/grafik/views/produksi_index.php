<div data-ng-app='simka_bapenda' data-ng-controller='produksi_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"; is_admin="<?php echo $this->session->userdata('is_admin') ?>"'>
	<div class='panel panel-body'>
		<div class="col-lg-12">
			<h4 id='data_detail_kendaraan'>Laporan Grafik Produksi<br>
				<small>Data Produksi</small>
			</h4>
			<div class='mrgbt10'>
				
				<?php if ($this->session->userdata('is_admin')) {?>
				<a>USER</a>
				<div class="input-group" data-ng-init="getData_user();">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<select class='form-control select2' name="sync_user" data-ng-model='sync_user' ng-options="user.nama_pegawai for user in data_user track by user.id_user">
						<option value="">-- Pilih User --</option>
				    </select>
				</div>
				<?php } else { ?>
				<input type="hidden" name="sync_user" data-ng-model='sync_user' ng-init="sync_user='<?php echo $this->session->userdata('id_user') ?>';">
				<?php } ?>
			</div>
			<div class='mrgbt10'>
				<a>DATA TAHUN</a>
				<div class="input-group">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<input class='form-control' type="number" name="sync_tahun" data-ng-model='sync_tahun' placeholder='DATA TAHUN' ng-change="changeTahun()">
				</div>
			</div>
			<div class='col-lg-6' style="padding-left: 0;">
				<div class="mrgbt10">
					<a>DATA BULAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_bulan1" data-ng-model='sync_bulan1' ng-change="change('sync_bulan1', 'sync_bulan2', 'disabled_bulan2')" ng-focus="tanggal('sync_bulan1')" placeholder='Awal'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>DATA BULAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_bulan2" data-ng-model='sync_bulan2' data-ng-disabled="disabled_bulan2" ng-focus="tanggal('sync_bulan2')" placeholder='Akhir'>
					</div>
				</div>
			</div>
			<!-- <div class='mrgbt10' id="dt_bulan">
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
			</div> -->
			<div id='button' class='mrgbt10'>
				<span class="input-group-btn" id='updatedata' >
					<input data-ng-click='cariData()' type="submit" class="btn btn-warning mrgrg10" value="LIHAT DATA"/>
					<?php if ($this->session->userdata('is_admin')) {?>
					<input data-ng-click='cariSemuaData()' type="submit" class="btn btn-warning" value="LIHAT SEMUA USER"/>
					<?php }?>
				</span>
			</div>
		</div>
		<hr class='minisolid'>
		<div class='col-lg-12'>
			<h4><a>Summary</a> &bullet; Scan Data <span id="nm_user"></span><br>
				<small>Jumlah Pencapain Scan Data</small>
			</h4>
			<div id='button' class='mrgbt10'>
				<button class="btn btn-warning" id="printChart1" data-ng-click='printChart("produksi")'>PRINT LAPORAN</button>
				<button class="btn btn-warning" id="printChart2" data-ng-click='printChart("produksi2")'>PRINT LAPORAN</button>
			</div>
			<canvas id="produksi" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick"></canvas>
			<canvas id="produksi2" class="chart-horizontal-bar" chart-data="data2" chart-labels="labels2" chart-series="series" chart-options="options2" chart-dataset-override="datasetOverride2" chart-click="onClick" height="300"></canvas>
		</div>
	</div>
</div>
<?= $js; ?>