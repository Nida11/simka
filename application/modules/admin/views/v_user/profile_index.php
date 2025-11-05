<?php $foto_pegawai = ($this->session->userdata('foto_pegawai')) ? $this->session->userdata('foto_pegawai') : 'avatar.png'  ?>
<style type="text/css">
	.image_container{
		background-image: url("<?php echo base_url(); ?>public/foto_pegawai/<?php echo $foto_pegawai; ?>") !important;
		background-repeat: no-repeat;
		background-size: cover !important;
		background-position: center;
		display: block;
		height: 150px;
		width: 150px;
		overflow: hidden;
		border-radius: 50%;
		margin-top: -20px;
		margin-left: auto;
		margin-right: auto;
		z-index: 100;
  	}
</style>

<div data-ng-app='remunerasi' data-ng-controller='profile_controller' data-ng-init='base_url="<?php echo base_url(); ?>";initialForm()'>
	<div class='panel panel-default'>
		<div class='panel-heading image_container'></div>
			<div class='panel-body'>			
				<h4 class='align_center'>Profile Anda<br>
					<small>
						<?php echo $this->session->userdata('id_user'); ?> &bullet; <?php echo $this->session->userdata('nip'); ?><br>
						<a><strong><?php echo strtoupper($this->session->userdata('nama_pegawai')); ?></strong></a><br>
						<strong><?php echo $this->session->userdata('nama_wilayah'); ?></strong><br>
					</small>
				</h4>
				<hr>
				<div class='col-lg-4 col-md-4 col-sm-4'>
					<h4>Rubah Password<br>
						<small>Rubah Password Anda Secara Berkala, Rahasiakan dan Pilihlah Password Yang Mudah Di ingat</small>
					</h4>
					<div id='pasword_lama' class='mrgbt10'>
						<a>PASSWORD LAMA</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input autofocus data-ng-model='password_lama' type='password' class="form-control" placeholder="Password Lama"></input>
						</div>
					</div>
					<hr>
					<div id='password_baru' class='mrgbt10'>
						<a>PASSWORD BARU</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input autofocus data-ng-model='password_baru' type='password' class="form-control" placeholder="Password Baru"></input>
						</div>
					</div>
					<div id='confirm_password_baru' class='mrgbt10'>
						<a>CONFIRM PASSWORD BARU</a>
						<div class="input-group">
							<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
							<input autofocus data-ng-model='confirm_password' type='password' class="form-control" placeholder="Ulangi Password Baru"></input>
						</div>
					</div>
					<input data-ng-click='save_password();' id='savedata' type="submit" class="btn btn-primary btn-block" value="RUBAH PASSWORD"/>
				</div>

				<div class='col-lg-4 col-md-4 col-sm-4'>
					<h4>Upload Foto Profile<br>
						<small>
							Upload Foto Profile Dengan Format JPG, PNG
						</small>
						<div class='dropzone'></div>
						<input type='hidden' id='upload_id' data-ng-model='foto_pegawai'/>
						<input type='hidden' id='id_pegawai_hidden' data-ng-model='nip'/>
						<input data-ng-click="save_profile('update');" type="submit" class="btn btn-info btn-block" value="SIMPAN FOTO PROFILE"/>
					</h4>
				</div>

				<div class='col-lg-4 col-md-4 col-sm-4'>
					<h4>Reset User Privileges<br>
						<small>Silahkan Submit Reset User Privileges, Jika Anda Merasa User Ini Tidak Sesuai Dengan Hak Akses Anda Seharusnya</small>
					</h4>
					<input dtype="submit" data-ng-click='reset_privileges();'; class="btn btn-danger btn-block" value="RESET USER PRIVILEGES"/>
				</div>
			</div>
	</div></div>
</div>

<?= $css; ?>
<?= $js; ?>

<script type="text/javascript">
	Dropzone.autoDiscover = false;
	var id_pegawai = $(document).find('#id_pegawai_hidden').val();
	var md = new Dropzone(".dropzone", {
		url: "<?php echo base_url(); ?>admin/profile/upload_profile/" + id_pegawai,
		addRemoveLinks: true,
		maxFiles: 1,
		maxfilesexceeded: function(file) {
			this.removeAllFiles();
			this.addFile(file);
		}
	});
	md.on("complete", function (file, response) {
		console.log(response);
	});
	md.on('success', function (file, response){
		result = response;
		$(document).find('#upload_id').val(result);
	});
	md.on('error', function (file, response){
		$.notify("Terjadi Kesalahan Dalam Unggah Berkas Ke Repository\nPesan Kesalahan : " + response, {className: 'warn'});
	});
</script>