<div data-ng-app='simka_bapenda' data-ng-controller='modul_akses_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<div class='col-lg-8 col-md-8'>
				<h4>Daftar Modul<br>
					<small>Daftar Modul Yang Ada Di Aplikasi Simka</small>
				</h4>
				<?= live_search_text('ng-model="search"'); ?>
				<div class='table-responsive'>
					<table class='table table-striped table-hover table-condensed'>
						<thead>
							<th class='wid50 bgcl-blue50'>#</th>
							<th class='wid150'>NAMA / CODE MODULE</th>
							<th class='wid80'>ORDER</th>
							<th class='wid40 bgcl-yellow50'>STATUS</th>
							<th class='wid40 bgcl-blue60'>SHOW</th>
						</thead>
						<tbody data-ng-init="getData()">
							<tr data-ng-if='dataAll.length < 1'>
								<td class='empty-row' colspan='10'>Data Modul Akses Unit Kosong<br><small>Semua Data Modul Akses Akan Tampil Disini</small></td>
							</tr>
							<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:150" pagination-id="prodx">
								<td class='align_center bgcl-blue50 wid80'>
									<a data-ng-click='getData(val.id_module)' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
									<a data-ng-click='deleteData(val.id_module)' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
								</td>
								<td class='wid150'>
									<strong data-ng-if="val.mode_menu=='1'"><a>&bullet;&bullet;&bullet; </a></strong>
									<strong data-ng-if="val.mode_menu=='0'"><small>({{val.id_module}})</small></strong>
									<strong data-ng-if="val.mode_menu=='1'"><small>({{val.id_parent_module}})</small></strong>
									<b>{{val.nama_module | uppercase}}</b><br>
									<code>{{val.code_module}}</code><br>
									<small>
										<a>url : <?php echo base_url(); ?><p ng-text-truncate="val.route" ng-tt-chars-threshold="250"></p></a>
									</small>
								</td>
								<td class='wid100 align_center'>
									<a title='Rubah Urutan Data' class='btn btn-xs btn-link' data-ng-click='incrStatus(val.id_module, "sort_order", val.sort_order, "-");'><span class='glyphicon glyphicon-minus'></span></a>
									<input class='align_center' style='width: 30px !important;' type='input' data-ng-value='val.sort_order'>
									<a title='Rubah Urutan Data' class='btn btn-xs btn-link' data-ng-click='incrStatus(val.id_module, "sort_order", val.sort_order, "+");'><span class='glyphicon glyphicon-plus'></span></a>
								</td>
								<td class='wid40 align_center bgcl-yellow50'>
									<label class="switch_toogle">
										<input type="checkbox" data-ng-click='toogleStatus(val.id_module, "status_data", status_data);' data-ng-model='status_data' data-ng-checked="val.status_data=='1'" name='status_data' value='1'>
										<div class="slider round"></div>
									</label>
								</td>
								<td class='wid40 align_center bgcl-blue60'>
									<label class="switch_toogle">
										<input type="checkbox" data-ng-click='toogleStatus(val.id_module, "show_public", show_public);' data-ng-model='show_public' data-ng-checked="val.show_public=='1'" name='show_public' value='1'>
										<div class="slider round"></div>
									</label>
								</td>
							</tr>
						</tbody>
					</table>
					<dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
				</div>
			</div>
			
			<div class='col-lg-4 col-md-4'>
				<div id='nama_module' class='mrgbt10'>
					<a>NAMA MODULE</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<input data-ng-model='nama_module' type='text' class="form-control" placeholder="Nama Module" autofocus></input>
					</div>
				</div>
				<div id='id_parent_module' class='mrgbt10'>
					<a>ID PARENT MODULE</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<select data-ng-model='id_parent_module' class='form-control select2' name='id_parent_module'>
							<option value=''>-- Pilih Nama Parent Module --</option>
							<option data-ng-repeat='vals in dataAll' value='{{vals.id_module}}' data-ng-if="vals.mode_menu=='0'">{{vals.nama_module | uppercase}}</option>
						</select>
					</div>
				</div>
				<div id='code_module' class='mrgbt10'>
					<a>CODE SCRIPT MODULE</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<input data-ng-model='code_module' type='text' class="form-control" placeholder="Code Script Module"></input>
					</div>
				</div>
				<div id='route' class='mrgbt10'>
					<a>ROUTE ADDRESS</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<input data-ng-model='route' type='text' class="form-control" placeholder="Route Address"></input>
					</div>
				</div>
				<div id='sort_order' class='mrgbt10'>
					<a>URUTAN MENU</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<input data-ng-model='sort_order' type='text' class="form-control wid120" placeholder="Urutan"></input>
					</div>
					<div class="alert alert-info align-left" role="alert">
				    	Urutan Diberikan Untuk Module Yang Tidak Mempunyai Parent. Sedangkan Untuk Yang Mempunyai Parent Akan Mengikuti Parentnya.
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
</div>

<?= $css; ?>
<?= $js; ?>