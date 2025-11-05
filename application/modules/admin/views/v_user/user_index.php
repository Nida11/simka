<div data-ng-app='simka_bapenda' data-ng-controller='user_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"' class='panel panel-default'>
	<div class="panel panel-body">
		<h4>Daftar Akses User<br>
			<small>Data Akses User Eremunerasi RSUP dr. Hasan Sadikin Bandung</small>
		</h4>
		<?= live_search_text('ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=20; currentpage=1"', ''); ?>
		<div class="table-responsive">
			<table class='table table-hover table-striped'>
				<thead>
					<th class='wid30 bgcl-blue50'>#</th>
					<th class='wid300 bgcl-yellow50'>IDENTITAS<br>LOGIN TERAKHIR</th>
					<th class='wid150 '>LEVEL<br>AKSES <a class='btn btn-link btn-xs' href='<?php echo base_url(); ?>admin/code_akses'><span class='glyphicon glyphicon-plus'></span></a></th>
					<th class='wid50 bgcl-blue60'>STATUS<br>ADMIN</th>
					<th class='wid50 bgcl-blue50'>STATUS<br>AKSES</th>
					<th class='wid50 bgcl-yellow50'>SCAN<br>LOCAL</th>
					<th class='wid50 bgcl-yellow60'>SCAN<br>UPLOAD</th>
				</thead>
				<tbody data-ng-init='getData();'>
					<tr data-ng-if='dataAll.length < 1'>
						<td colspan='10' class='empty-row'>
							Data Tidak Ditemukan<br>
							<small>Semua Data Akses Aplikasi SImka Akan Muncul Disini</small>
						</td>
					</tr>
					<tr data-dir-paginate='val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage' current-page='currentpage' pagination-id="prodx">
						<td class='wid30 bgcl-blue50 align_center'>
							<a data-ng-click='deleteData(val.id_user);' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
						</td>
						<td class='wid300 bgcl-yellow50'>
							<strong>{{val.id_user}} &bullet; <a>{{val.nama_pegawai}}</a></strong><br>
							<a>{{val.id_wilayah}} &bullet; {{val.nama_wilayah}}</a><br>
							<small>Login Menggunakan : <br><i>{{val.last_login_details}}</i></small>
						</td>
						<td class='wid150'>
							<a>{{val.id_akses}} &bullet; {{val.nama_akses | uppercase}}</a><br>
							<span class='glyphicon glyphicon-arrow-right'></span> 
							<input class='wid50 align_center' data-ng-model='id_akses' data-ng-value='val.id_akses'>
							<button data-ng-click='saveData_simple(val.user_id, "level_akses", id_akses)' data-ng-model='id_akses' title='Update Data' class='btn btn-xs btn-default'>
								<span class='glyphicon glyphicon-ok'></span>
							</button>
							<br>
							<small>Login Dari : <br><i>{{val.last_login_ip}}</i> - {{val.last_login}}</small>
						</td>
						<td class='wid50 align_center bgcl-blue60'>
							<label class="switch_toogle">
								<input type="checkbox" data-ng-click='toogleStatus(val.id_user, "is_admin", is_admin);' data-ng-model='is_admin' data-ng-checked='val.is_admin==1' name='is_admin' value='1'>
								<div class="slider round"></div>
							</label>
						</td>
						<td class='wid50 align_center bgcl-blue50'>
							<label class="switch_toogle">
								<input type="checkbox" data-ng-click='toogleStatus(val.id_user, "status_data", status_data);' data-ng-model='status_data' data-ng-checked='val.status_data==1' name='status_data' value='1'>
								<div class="slider round"></div>
							</label>
						</td>
						<td class='wid50 align_center bgcl-yellow50'>
							<label class="switch_toogle">
								<input type="checkbox" data-ng-click='toogleStatus(val.id_user, "scan_local", scan_local);' data-ng-model='scan_local' data-ng-checked='val.scan_local==1' name='scan_local' value='1'>
								<div class="slider round"></div>
							</label>
						</td>
						<td class='wid50 align_center bgcl-yellow60'>
							<label class="switch_toogle">
								<input type="checkbox" data-ng-click='toogleStatus(val.id_user, "scan_upload", scan_upload);' data-ng-model='scan_upload' data-ng-checked='val.scan_upload==1' name='scan_upload' value='1'>
								<div class="slider round"></div>
							</label>
						</td>
					</tr>
				</tbody>
			</table>
			<dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
		</div>
	</div>
</div>

<?php echo $js; ?>
<?php echo $css; ?>