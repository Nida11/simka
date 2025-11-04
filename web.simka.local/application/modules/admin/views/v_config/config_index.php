<div data-ng-app='simka_bapenda' data-ng-controller='admin_config_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"' class='panel panel-default'>
	<div class='panel-body'>
		<div class='col-lg-12'>
			<h4>Input Konfigurasi Aplikasi<br>
				<small>Masukan Data Konfigurasi Aplikasi Yang Digunakan</small>
			</h4>
			<?php if(count($ini_array) > 0): ?>
			<form action='<?php echo base_url(); ?>admin/config/save_config' method='POST'>
				<?php foreach($ini_array as $key=>$value): ?>
					<div id='deskripsi'>
						<a><?php echo strtoupper($key); ?></a>
						<div class="input-group mrgbt10">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input type="text" name='<?php echo $key; ?>' value='<?php echo $value; ?>' class="form-control">
						</div>
					</div>
				<?php endforeach; ?>
				<input id='savedata' type="submit" class="btn btn-primary btn-block mrgtp10" value="SIMPAN DATA"/>
			</form>
			<?php else: ?>
			<div>
				Tidak Ada Data Konfigurasi
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php echo $js; ?>