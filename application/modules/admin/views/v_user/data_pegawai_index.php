<style type="text/css">
	.image_container{
		background-image: url('<?php echo base_url(); ?>assets/img/component/avatar_2x.png');
		background-repeat: no-repeat;
		background-size: cover !important;
		background-position: center;
		display: block;
		height: 150px;
		width: 150px;
		overflow: hidden;
		border-radius: 50%;
		margin-left: auto;
		margin-right: auto;
		z-index: 100;
  	}
</style>

<div data-ng-app='remunerasi' data-ng-controller='data_pegawai_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"' class='panel panel-default'>
	<div class="panel panel-body">
		<div class='col-lg-8'>
			<h4>Daftar Data Pegawai<br>
				<small>Data Dasar Pegawai Bapenda Jawa Barat Pengguna Aplikasi SIMKA</small>
			</h4>
			<?= live_search_text('ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=15; currentpage=1"'); ?>
			<div class="table-responsive">
				<table class='table table-hover table-striped table-condensed'>
					<thead>
						<th class='wid40 bgcl-blue50'>#</th>
						<th colspan='2'>DETAIL<br>IDENTITAS PEGAWAI</th>
						<th class='wid100 bgcl-yellow60'>RST<br>PSSWD</th>
						<th class='wid40 bgcl-yellow50'></th>
					</thead>
					<tbody data-ng-init='getData();'>
						<tr data-ng-if='dataAll.length < 1'>
							<td colspan='10' class='empty-row'>
								Data Tidak Ditemukan<br>
								<small>Semua Data Akses ERemunerasi Akan Muncul Disini</small>
							</td>
						</tr>
						<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
							<td class='wid40 bgcl-blue50 align_center'>
								<a title='Updata Data' data-ng-click='getData(val.id_user);' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
							</td>
							<td class='wid300'>
								<small>
									ID USER : <input class='wid200' data-ng-value="val.id_user">
								</small><br>
								<textarea class='wid300' rows='4'>{{val.nama_pegawai | uppercase}}</textarea><br>
								<small>
									PWD : <input class='wid200' data-ng-value="val.pass"></input>
								</small><br>
							</td>
							<td class='wid300 bgcl-yellow50'>
								<small>
									ID WILAYAH : <input class='wid200' data-ng-value="val.id_wilayah">
								</small><br>
								<textarea class='wid300' rows='4'>{{val.nama_wilayah | uppercase}}</textarea><br>
								<small>
									PWD : <input class='wid200' data-ng-value="val.real_pass"></input>
								</small>
							</td>
							<td class='wid100 align_center bgcl-yellow60'>
								<label title='Reset Password' class="switch_toogle">
									<input type="checkbox" data-ng-click='toogleStatus(val.id_user, "must_change", must_change_toogle);' data-ng-model='must_change_toogle' data-ng-checked='val.must_change=="1"' name='must_change_toogle' value='1'>
									<div class="slider round"></div>
								</label>
							</td>
							<td class='wid40 align_center bgcl-yellow50'>
								<a target='_blank' data-ng-if="val.foto_pegawai!==null" href='<?php echo base_url(); ?>uploads/foto_pegawai/{{val.foto_pegawai}}'><span class='glyphicon glyphicon-picture'></span></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
		</div>
		<div class='col-lg-4' class='mrgbt10'>
			<div data-ng-if="foto_pegawai" class='image_container' style='background-image: url("<?php echo base_url(); ?>uploads/foto_pegawai/{{foto_pegawai}}") !important;'></div>
			<div data-ng-if="!foto_pegawai" class='image_container' style='background-image: url("<?php echo base_url(); ?>assets/img/component/avatar_2x.png") !important;'></div>
			<hr>
			<div id='nip'>
				<a>NIP</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-user'></span></span>
					<input data-ng-model='nip' type="text" maxlength='18' name='nip' class="form-control" placeholder="NIP Pegawai" autofocus autocomplete="off" required>
				</div>
			</div>
			<div id='id_user' class='mrgbt10'>
				<a>ID USER</a>
				<div class="input-group">
					<span class="input-group-addon"><span class='glyphicon glyphicon-user'></span></span>
					<input data-ng-model='id_user' type="text" name='id_user' class="form-control" placeholder="ID User" autofocus autocomplete="off" required>
				</div>
			</div>
			<div id='nama_pegawai'>
				<a>NAMA PEGAWAI</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-user'></span></span>
					<input data-ng-model='nama_pegawai' type="text" name='nama_pegawai' class="form-control" placeholder="Masukan Nama Pegawai" autocomplete="off" required>
				</div>
			</div>
			<div id='id_wilayah'>
				<a>ID WILAYAH</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<select class='form-control select2' ng-model="id_wilayah" ng-options="wilayah.nama_wilayah for wilayah in data_wilayah track by wilayah.id_wilayah">
				      <option value="">-- Pilih Wilayah --</option>
				    </select>
				</div>
			</div>
			<div id='pass'>
				<a>PASSWORD BARU</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
					<input data-ng-model='pass' type="text" name='pass' class="form-control" placeholder="Masukan Kode Rahasia Akses" autocomplete="off" required>
				</div>
			</div>
			<input data-ng-click='saveData()' id='savedata' type="submit" class="btn btn-primary btn-block" value="SIMPAN DATA"/>
			<span class="input-group-btn" id='updatedata' >
				<input data-ng-click='saveData("update");' type="submit" class="form-control btn btn-warning" value="UBAH DATA"/>
				<button data-ng-click='initialForm();' class="btn btn-default"><span class='glyphicon glyphicon-refresh'></span></button>
			</span>
			<hr>
			<div id='deskripsi' class='mrgbt10'>
				<a>UPLOAD FOTO PEGAWAI</a>
				<div class='dropzone'></div>
				<input type='hidden' id='upload_id' data-ng-model='foto_pegawai'/>
				<input type='hidden' id='id_pegawai_hidden' data-ng-model='nip'"/>
				<input id='upload_foto' data-ng-click="save_profile('update', nip);" type="submit" class="btn btn-info btn-block" value="SIMPAN FOTO PROFILE"/>
			</div>
			<i><b>Catatan</b>: Upload Foto dapat diakses jika data sudah tersimpan terlebih dahulu. / Berjalan Pada Proses Edit Data Pegawai</i>
		</div>
	</div>
</div>

<?php echo $js; ?>
<?php echo $css; ?>

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