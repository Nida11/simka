<div data-ng-app='simka_bapenda' data-ng-controller='potensi_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-default'>
		<div class='panel-body' data-ng-init="getDataWilayah();">
			<div class='well well-lg'>
				<h4>Pilih Wilayah Kerja<br>
					<small>PIlih Id Wilayah Untuk Dapat Menampikan Data Potensi</small>
				</h4>
				<div>
					<div class="input-group">
						<span class="input-group-addon">
							ID Wilayah
						</span>
						<select class='form-control select2' ng-model="id_wilayah" ng-options="wilayah.nama_wilayah for wilayah in data_wilayah track by wilayah.id_wilayah">
					      <option value="">-- Pilih Wilayah --</option>
					    </select>
						<span class="input-group-addon">
							<a class='clickable' data-ng-click="getData();"><span class='glyphicon glyphicon-search'></span> Pilih Data</a>
						</span>
					</div>
					<small>
						Status: 
						<span class='loading_bar loader_potensi'><img src='<?php echo _IMG_LOADER; ?>loader-lite-red.gif'/> Loading Data Wilayah</span>
						<span class='data_ok'><span class='glyphicon glyphicon-ok'></span> Data Ready</span>
					</small>
				</div>
			</div>
			<div class='col-lg-8 col-md-8'>
				<h4>Daftar Potensi<br>
					<small>Master Data Potensi per-Wilayah</small>
				</h4>
				<?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=12;currentpage=1"'); ?>
				<div class='table-responsive'>
					<table class='table table-striped table-hover table-condensed'>
						<thead>
							<th class='wid80 bgcl-blue50'>#</th>
							<th class='wid100 bgcl-blue60'>PERIODE<br>KERJA</th>
							<th class='wid200 bgcl-yellow50'>WILAYAH<br>KERJA</th>
							<th class='wid100 bgcl-blue60'>&Sigma; JLH <br>POTENSI</th>
						</thead>
						<tbody>
							<tr data-ng-if='dataAll.length < 1'>
								<td class='empty-row' colspan='10'>Data Potensi per-Wilayah Kosong<br><small>Semua Data Potensi per-Wilayah Akan Tampil Disini</small></td>
							</tr>
							<tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
								<td class='align_center bgcl-blue50 wid50'>
									<a data-ng-click='getData(val.id_potensi, val.id_wilayah)' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
									<a data-ng-click='deleteData(val.id_potensi, val.id_wilayah)' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a>
								</td>
								<td class='align_center'>{{val.periode}} - {{val.tahun}}</td>
								<td>{{val.id_wilayah}} &bullet; <b>{{val.nama_wilayah}}</b></td>
								<td class='align_center'>{{val.potensi}}</td>
							</tr>
						</tbody>
					</table>
					<dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
				</div>
			</div>
			
			<div class='col-lg-4 col-md-4'>
				<div id='periode' class='mrgbt10'>
					<a>PERIODE</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-time'></span></span>
						<?php echo get_bulan('periode', '', 'form-control select2', '', 'data-ng-model="periode"', ''); ?>
					</div>
				</div>
				<div id='tahun' class='mrgbt10'>
					<a>TAHUN PERIODE</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-time'></span></span>
						<?php echo get_tahun('tahun', '', 'form-control select2', '', 'data-ng-model="tahun"', ''); ?>
					</div>
					<span class='pull-right'><a id='generatedata' data-ng-click="generate_tahun();" class='btn btn-link btn-xs'>Generate Data 1 Tahun</a></span>
				</div>
				<div class='clearfix'></div>
				<div id='potensi' class='mrgbt10'>
					<a>POTENSI</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control align_right wid150' type="number" name="potensi" data-ng-model="potensi">
					</div>
				</div>
				<input type='hidden' data-ng-model='id_potensi' data-ng-value='val.id_potensi'>
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