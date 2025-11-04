<div data-ng-app='simka_bapenda' data-ng-controller='code_askes_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"' class='panel panel-default'>
	<div class="panel panel-body">
		<div class='col-lg-8 col-md-8'>
			<h4>Daftar Kode Akses<br>
				<small>Data Kode Akses Sebagai Level Privilege User Login</small>
			</h4>
			<?= live_search_text('ng-model="search"'); ?>
			<div class="table-responsive">
				<table class='table table-hover table-striped table-condensed'>
					<thead>
						<th class='wid75 bgcl-blue50'>#</th>
						<th class='wid200'>AKSES CONTROL</th>
						<th class='wid100 bgcl-yellow50'>CODE SECRET</th>
						<th class='wid75 bgcl-blue50'>STATUS</th>
					</thead>
					<tbody data-ng-init='getData();'>
						<tr data-ng-if='dataAll.length < 1'>
							<td colspan='10' class='empty-row'>
								Data Tidak Ditemukan<br>
								<small>Semua Data Akses Simka Akan Muncul Disini</small>
							</td>
						</tr>
						<tr data-dir-paginate='val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:10'>
							<td class='wid75 bgcl-blue50 align_center'>
								<a data-ng-click='getData(val.id_akses);' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
								<a data-ng-click='deleteData(val.id_akses);' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
							</td>
							<td class='wid200'>{{val.id_akses}} &bullet; <a>{{val.nama_akses | uppercase}}</a></td>
							<td class='wid100 align_center bgcl-yellow50'><input style='border: none !important; color: {{val.font_color}}; background-color: {{val.color}}' class='align_center' value='{{val.kode_secret}}'/></b></td>
							<td class='wid75 align_center bgcl-blue50'>
								<label class="switch_toogle">
									<input type="checkbox" data-ng-click='toogleStatus(val.id_akses, "status_data", status);' data-ng-model='status' data-ng-checked='val.status_data==1' name='status' value='1'>
									<div class="slider round"></div>
								</label>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
		</div>
		<div class='col-lg-4 col-md-4' class='mrgbt10'>
			<div id='id_akses'>
				<a>ID CODE AKSES</a>
				<div class="input-group wid200">
					<span class="input-group-addon"><span class='glyphicon glyphicon-user'></span></span>
					<input data-ng-model='id_akses' type="text" maxlength='3' name='id_akses' class="form-control" placeholder="ID Kode Akses" autofocus autocomplete="off" required>
				</div>
				<div class="alert alert-danger align-left" role="alert">
		        	<b>ID CODE AKSES diharuskan Maksimal 3 Karakter</b>
		        </div>
			</div>
			<div id='nama_akses'>
				<a>NAMA AKSES</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-user'></span></span>
					<input data-ng-model='nama_akses' type="text" name='nama_akses' class="form-control" placeholder="Masukan Nama Akses" autocomplete="off" required>
				</div>
			</div>
			<div id='kode_secret'>
				<a>CODE AKSES</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<input data-ng-model='kode_secret' type="text" name='kode_secret' class="form-control" placeholder="Masukan Kode Rahasia Akses" autocomplete="off" required>
				</div>
			</div>
			<div id='color'>
				<div class="col-lg-6">
					<a>WARNA BACKGROUND</a>
					<div class="input-group mrgbt10">
						<span class="input-group-addon"><span class='glyphicon glyphicon-tint'></span></span>
						<input data-ng-model='color' type="color" name='color' class="form-control" placeholder="Masukan Warna Untuk Identifiasi" autocomplete="off" required>
					</div>
				</div>
				<div class="col-lg-6">
					<a>WARNA FONT</a>
					<div class="input-group mrgbt10">
						<span class="input-group-addon"><span class='glyphicon glyphicon-tint'></span></span>
						<input data-ng-model='font_color' type="color" name='font_color' class="form-control" placeholder="Masukan Warna Untuk Identifiasi" autocomplete="off" required>
					</div>
				</div>
			</div>
			<div id='css'>
				<a>CSS</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-adjust'></span></span>
					<input data-ng-model='css' type="text" name='css' class="form-control" placeholder="Masukan Kode Css Custom" autocomplete="off" required>
				</div>
			</div>
			<div id='deskripsi'>
				<a>DETAIL CODE AKSES</a>
				<div class="input-group mrgbt10">
					<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
					<textarea class='form-control' rows='5' data-ng-model='deskripsi'></textarea>
				</div>
			</div>
			<div id='code_akses_menu' class='mrgbt10' data-ng-if="dataAksesMenu.length > 0">
				<a>MENU AKSES</a>
				<div data-ng-repeat='vals in dataAksesMenu'>
					<span data-ng-if="vals.mode_menu=='1'"> ---</span>
					<input type='checkbox' data-ng-if="vals.checklist_status==1" checked data-ng-click='removeChoice(vals.id_module, vals.id_code_akses);'>
					<input type='checkbox' data-ng-if="vals.checklist_status==0" data-ng-click='addNewChoice(vals.id_module, id_akses);'>
					 {{vals.nama_module | uppercase}}
				</div>
			</div>
			<input data-ng-click='saveData()' id='savedata' type="submit" class="btn btn-primary btn-block" value="SIMPAN DATA"/>
			<span class="input-group-btn" id='updatedata' >
				<input data-ng-click='saveData("update");' type="submit" class="form-control btn btn-warning" value="UBAH DATA"/>
				<button data-ng-click='initialForm();' class="btn btn-default"><span class='glyphicon glyphicon-refresh'></span></button>
			</span>
		</div>
	</div>
</div>

<?php echo $js; ?>
<?php echo $css; ?>