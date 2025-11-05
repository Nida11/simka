<div data-ng-app='simka_bapenda' data-ng-controller='admin_config_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"' class='panel panel-default'>
	<div class='panel-body'>
		<div class='col-lg-12'>
			<?php
$tgl1 = "2013-01-23";// pendefinisian tanggal awal
$tgl2 = date('Y-m-d', strtotime('-1 days', strtotime(date('Y-m-d')))); //operasi penjumlahan tanggal sebanyak 6 hari
echo $tgl2; //print tanggal
            ?>
		</div>
	</div>
</div>
<?php echo $js; ?>
