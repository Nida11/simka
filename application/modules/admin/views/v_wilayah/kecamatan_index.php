<div data-ng-app='simka_bapenda' data-ng-controller='kecamatan_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<div class='col-lg-8 col-md-8'>
				<h4>Daftar Kecamatan<br>
					<small>Master Data & Konfigurasi Kecamatan di Aplikasi SIMKA</small>
				</h4>
				<?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=25;currentpage=1"'); ?>
				<div class='table-responsive'>
					<table class='table table-striped table-hover table-condensed'>
						<thead>
							<th class='wid50 bgcl-blue50'>#</th>
							<th class='wid200 bgcl-blue60'>DETAIL NAMA<br>WILAYAH</th>
							<th class='wid150 bgcl-yellow50'>DETAIL<br>KECAMATAN</th>
							<th class='wid50 bgcl-blue60'>STATUS<br>DATA</th>
						</thead>
						<tbody data-ng-init="getData()">
							<tr data-ng-if='dataAll.length < 1'>
								<td class='empty-row' colspan='10'>Data Master Kecamatan Kosong<br><small>Semua Data Master Kecamatan Akan Tampil Disini</small></td>
							</tr>
							<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
								<td class='align_center bgcl-blue50 wid50'>
									<a data-ng-click='getData(val.id_kecamatan, val.id_wilayah)' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
									<a data-ng-click='deleteData(val.id_kecamatan, val.id_wilayah)' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
								</td>
								<td class='wid100 bgcl-blue60'>
									{{val.id_wilayah}} &bullet; 
									<a><b>{{val.nama_singkat | uppercase}}</b></a><br>
									<b>{{val.nama_wilayah | uppercase}}</b>
								</td>
								<td class='wid100 bgcl-yellow50'>
									{{val.id_wilayah}}-<b>{{val.id_kecamatan}}</b> &bullet; 
									<a><b>{{val.nama_kecamatan | uppercase}}</b></a><br>
									Kota: {{val.nama_kota | uppercase}}
								</td>
								<td class='wid50 align_center bgcl-blue60'>
									<label class="switch_toogle">
										<input type="checkbox" data-ng-click='toogleStatus(val.id_kecamatan, val.id_wilayah, "status_data", status_data);' data-ng-model='status_data' data-ng-checked="val.status_data=='1'" name='status_data' value='1'>
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
				<div id='id_kecamatan' class='mrgbt10'>
					<a>ID KECAMATAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="id_kecamatan" data-ng-model='id_kecamatan' placeholder='Id Kecamatan'>
					</div>
				</div>
				<div id='id_wilayah' class='mrgbt10'>
					<a>ID WILAYAH</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' ng-model="id_wilayah" ng-options="wilayah.nama_wilayah for wilayah in data_wilayah track by wilayah.id_wilayah">
					      <option value="">-- Pilih Wilayah --</option>
					    </select>
						<!-- <input class='form-control' type="text" name="id_wilayah" data-ng-model='id_wilayah' placeholder='Id Wilayah'> -->
					</div>
				</div>
				<div id='nama_kecamatan' class='mrgbt10'>
					<a>NAMA KECAMATAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<textarea rows='3' class='form-control' name="nama_kecamatan" data-ng-model='nama_kecamatan' placeholder='Nama Kecamatan'></textarea>
					</div>
				</div>
				<div id='nama_kota' class='mrgbt10'>
					<a>NAMA KOTA</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<textarea rows='3' class='form-control' name="nama_kota" data-ng-model='nama_kota' placeholder='Nama Kota'></textarea>
					</div>
				</div>
				<input data-ng-click='saveData()' id='savedata' type="submit" class="btn btn-primary btn-block" value="SIMPAN DATA"/>
				<span class="input-group-btn" id='updatedata' >
					<input data-ng-click='saveData("update");' type="submit" class="form-control btn btn-warning" value="UBAH DATA"/>
					<button data-ng-click='initialForm();' class="btn btn-default"><span class='glyphicon glyphicon-refresh'></span></button>
				</span>
				<hr class='minisolid'>
				<a href='<?php echo base_url(); ?>admin/wilayah'>Master & Konfigurasi Wilayah <span class='glyphicon glyphicon-chevron-right'></span></a>
			</div>
		</div>
	</div>
</div>

<?= $js; ?>