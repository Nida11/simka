<div data-ng-app='simka_bapenda' data-ng-controller='overview_potensi_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-body'>
		<div class='col-lg-6'>
			<h4><a>Summary</a> &bullet; Scan Data<br>
				<small>Jumlah Pencapain Scan Data Wilayah /bulan</small>
			</h4>
			<canvas id="line" class="chart chart-line" chart-data="data" chart-labels="labels" chart-series="series" chart-options="options" chart-dataset-override="datasetOverride" chart-click="onClick"></canvas>
		</div>
		<div class='col-lg-6'>
			<h4><a>Summary</a> &bullet; Scan Data - Kecamatan<br>
				<small>Jumlah Pencapain Scan Data Per-Kecamatan /bulan</small>
			</h4>
			<canvas id="base" class="chart-bar" chart-data="data" chart-labels="labels" chart-colors="colors" chart-dataset-override="datasetOverride_kecamatan"></canvas> 
		</div>
	</div>
</div>
<?= $js; ?>