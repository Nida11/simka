<div data-ng-app='simka_bapenda' data-ng-controller='wilayah_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<div class='col-lg-8 col-md-8'>
				<h4>Daftar Wilayah Kerja<br>
					<small>Master Data & Konfigurasi Wilayah Kerja di Aplikasi SIMKA</small>
				</h4>
				<?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=25;currentpage=1"'); ?>
				<div class='table-responsive'>
					<table class='table table-striped table-hover table-condensed'>
						<thead>
							<th class='wid75 bgcl-blue50'>#</th>
							<th class='wid75 bgcl-yellow50'>KODE<br>WILAYAH</th>
							<th class='wid300 bgcl-blue60'>DETAIL NAMA<br>WILAYAH</th>
							<th class='wid80'>SORT<br>ORDER</th>
							<th class='wid75 bgcl-blue60'>STATUS<br>DATA</th>
						</thead>
						<tbody data-ng-init="getData()">
							<tr data-ng-if='dataAll.length < 1'>
								<td class='empty-row' colspan='10'>Data Master Wilayah Kosong<br><small>Semua Data Master Wilayah Akan Tampil Disini</small></td>
							</tr>
							<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
								<td class='align_center bgcl-blue50 wid75'>
									<a title='Edit Data' data-ng-click='getData(val.id_wilayah)' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
									<a title='Hapus Data' data-ng-click='deleteData(val.id_wilayah)' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
								</td>
								<td class='wid75 bgcl-yellow50 align_center'>{{val.id_wilayah}}</td>
								<td class='wid300 bgcl-blue50'>
									<a><b>{{val.nama_singkat | uppercase}}</b></a><br>
									<b>{{val.nama_wilayah}}</b><br>
									<a>url local: <?php echo URL_LOCAL_PARENT; ?>{{val.url_path}}</a>
								</td>
								<td class='wid80 align_center'>
									<a title='Rubah Urutan Data' class='btn btn-xs btn-link' data-ng-click='incrStatus(val.id_wilayah, "sort_order", val.sort_order, "-");'><span class='glyphicon glyphicon-minus'></span></a>
									<input class='align_center' style='width: 30px !important;' type='input' data-ng-value='val.sort_order'>
									<a title='Rubah Urutan Data' class='btn btn-xs btn-link' data-ng-click='incrStatus(val.id_wilayah, "sort_order", val.sort_order, "+");'><span class='glyphicon glyphicon-plus'></span></a>
								</td>
								<td class='wid75 align_center bgcl-blue60'>
									<label title='Rubah Status Data' class="switch_toogle">
										<input type="checkbox" data-ng-click='toogleStatus(val.id_wilayah, "status_data", status_data);' data-ng-model='status_data' data-ng-checked="val.status_data=='1'" name='status_data' value='1'>
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
				<div id='id_wilayah' class='mrgbt10'>
					<a>ID WILAYAH</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="id_wilayah" data-ng-model='id_wilayah' placeholder='Id Wilayah'>
					</div>
				</div>
				<div id='nama_wilayah' class='mrgbt10'>
					<a>NAMA WILAYAH</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<textarea rows='5' class='form-control' name="nama_wilayah" data-ng-model='nama_wilayah' placeholder='Nama Wilayah'></textarea>
					</div>
				</div>
				<div id='nama_singkat' class='mrgbt10'>
					<a>NAMA SINGKAT</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<input class='form-control' type="text" name="nama_singkat" data-ng-model='nama_singkat' placeholder='Nama Singkat'>
					</div>
				</div>
				<hr class='minisolid'>
				<div id='url_path' class='mrgbt10'>
					<a>URL PATH LOCAL PC</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<input class='form-control' type="text" name="url_path" data-ng-model='url_path' placeholder='URL PATH Local PC'>
					</div>
					<span id="helpBlock" class="help-block">
						<b>Catatan :</b><br>
						Masukan Folder Penyimpanan File Scan di Local PC Setempat.<br>
						url_path Tidak Perlu Menyertakan Full Pathnya<br>
						Cukup Nama Folder Saja. Hindari Penggunaan <b>Spasi</b><br>
						Default Path Berada Di <a title='Rubah Konfigurasi System' href='<?php base_url(); ?>admin/config'><?php echo URL_LOCAL_PARENT;?></a>
					</span>
				</div>
				<input data-ng-click='saveData()' id='savedata' type="submit" class="btn btn-primary btn-block" value="SIMPAN DATA"/>
				<span class="input-group-btn" id='updatedata' >
					<input data-ng-click='saveData("update");' type="submit" class="form-control btn btn-warning" value="UBAH DATA"/>
					<button data-ng-click='initialForm();' class="btn btn-default"><span class='glyphicon glyphicon-refresh'></span></button>
				</span>
				<hr class='minisolid'>
				<a href='<?php echo base_url(); ?>admin/kecamatan'><span class='glyphicon glyphicon-chevron-left'></span> Master & Konfigurasi Kecamatan</a>
			</div>
		</div>
	</div>
</div>

<?= $js; ?>