<div data-ng-app='simka_bapenda' data-ng-controller='pengumuman_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-default'>
		<div class='panel-body'>
			<div class='col-lg-8 col-md-8'>
				<h4>Daftar Pengumuman<br>
					<small>Master Data Pengumuman Aplikasi SIMKA</small>
				</h4>
				<?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=5;currentpage=1"'); ?>
				<div class='table-responsive'>
					<table class='table table-striped table-hover table-condensed'>
						<thead>
							<th class='wid75 bgcl-blue50'>#</th>
							<th class='wid500 bgcl-yellow50'>DETAIL PENGUMUMAN</th>
							<th class='wid75 bgcl-blue60'>STATUS</th>
						</thead>
						<tbody data-ng-init="getData()">
							<tr data-ng-if='dataAll.length < 1'>
								<td class='empty-row' colspan='10'>Data Master Kegiatan Unit Kosong<br><small>Semua Data Master Kegiatan Unit Akan Tampil Disini</small></td>
							</tr>
							<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
								<td class='align_center bgcl-blue50 wid75'>
									<a data-ng-click='getData(val.id_pengumuman)' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
									<a data-ng-click='deleteData(val.id_pengumuman)' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
								</td>
								<td class='wid500 bgcl-yellow50'>
									<b>{{val.judul_pengumuman | uppercase}}</b><br>
									<a>Diposting pada @{{val.tgl_format | fullFormatDate}}, {{val.tgl_insrow}}</a><br><br>
									<p ng-text-truncate="val.isi_pengumuman | uppercase" ng-tt-chars-threshold="250"></p>
								</td>
								<td class='wid75 align_center bgcl-blue60'>
									<label class="switch_toogle">
										<input type="checkbox" data-ng-click='toogleStatus(val.id_pengumuman, "status_data", status_data);' data-ng-model='status_data' data-ng-checked="val.status_data=='1'" name='status_data' value='1'>
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
				<div id='judul_pengumuman' class='mrgbt10'>
					<a>JUDUL PENGUMUMAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<textarea rows=5 data-ng-model='judul_pengumuman' class="form-control" placeholder="Judul Pengumuman"></textarea>
					</div>
				</div>
				<div id='isi_pengumuman' class='mrgbt10'>
					<a>ISI PENGUMUMAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
						<textarea rows=25 data-ng-model='isi_pengumuman' class="form-control" placeholder="Isi Pengumuman"></textarea>
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