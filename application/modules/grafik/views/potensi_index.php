<div data-ng-app='simka_bapenda' data-ng-controller='potensi_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-body'>
		<div class="col-lg-12">
			<h4 id='data_detail_kendaraan'>Laporan Potensi Wilayah<br>
				<small>Potensi Wilayah</small>
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
					<input data-ng-click='cariData()' type="submit" class="btn btn-warning" value="LIHAT DATA"/>
				</span>
			</div>
		</div>
		<hr class='minisolid'>
		<div class='col-lg-12'>
			<h4><a>Grafik Potensi</a> &bullet; Tanggal Akhir Pajak Scan Data <?php echo date('Y') ?><br>
				<small>Jumlah Pencapain</small>
			</h4>
			<div id='button' class='mrgbt10'>
				<button class="btn btn-warning" id="printChart1" data-ng-click='printChart("produksi")'>PRINT LAPORAN</button>
			</div>
			<canvas id="produksi" class="chart-horizontal-bar" chart-data="data" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick"></canvas>
		</div>
		<div class='col-lg-12'>
			<h4><a>Grafik Potensi</a> &bullet; Tanggal Akhir STNKPB Scan Data <?php echo date('Y') ?><br>
				<small>Jumlah Pencapain</small>
			</h4>
			<div id='button' class='mrgbt10'>
				<button class="btn btn-warning" id="printChart2" data-ng-click='printChart("produksi2")'>PRINT LAPORAN</button>
			</div>
			<canvas id="produksi2" class="chart-horizontal-bar" chart-data="data2" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick"></canvas>
		</div>
	</div>
</div>
<?= $js; ?>