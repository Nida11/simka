<div data-ng-app='simka_bapenda' data-ng-controller='report_generated_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
	<div class='panel panel-body'>
		<div class='col-lg-12'>
			<h4>Report Generated System<br>
				<small>Filter Data Yang Akan Dicari</small>
			</h4>

			<div class='mrgbt10'>
				<a>DATA TAHUN</a>
				<div class="input-group">
					<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
					<input class='form-control' type="number" name="sync_tahun" data-ng-model='sync_tahun' placeholder='DATA TAHUN'>
				</div>
			</div>

			<div class='col-lg-6' style="padding-left: 0;">
				<div class="mrgbt10">
					<a>PRODUKSI</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_produksi1" data-ng-model='sync_produksi1' ng-change="change('sync_produksi1', 'sync_produksi2', 'disabled_produksi2')" ng-focus="tanggal('sync_produksi1')" placeholder='Awal'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>PRODUKSI</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_produksi2" data-ng-model='sync_produksi2' data-ng-disabled="disabled_produksi2" ng-focus="tanggal('sync_produksi2')" placeholder='Akhir'>
					</div>
				</div>
			</div>

			<div class='col-lg-6' style="padding-left: 0;">
				<div class="mrgbt10">
					<a>WILAYAH</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="sync_wilayah1" data-ng-model='sync_wilayah1' ng-change="change('sync_wilayah1', 'sync_wilayah2', 'disabled_wilayah2')" placeholder='Awal'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>WILAYAH</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="sync_wilayah2" data-ng-model='sync_wilayah2' data-ng-disabled="disabled_wilayah2" placeholder='Akhir'>
					</div>
				</div>
			</div>

			<div class='col-lg-6' style="padding-left: 0;">
				<div class="mrgbt10">
					<a>KECAMATAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="sync_kecamatan1" data-ng-model='sync_kecamatan1' ng-change="change('sync_kecamatan1', 'sync_kecamatan2', 'disabled_kecamatan2')" placeholder='Awal'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>KECAMATAN</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="sync_kecamatan2" data-ng-model='sync_kecamatan2' data-ng-disabled="disabled_kecamatan2" placeholder='Akhir'>
					</div>
				</div>
			</div>

			<div class='col-lg-6' style="padding-left: 0;">
				<div class="mrgbt10">
					<a>AKHIR PAJAK</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_tgl_akhir_pajak1" data-ng-model='sync_tgl_akhir_pajak1' ng-change="change('sync_tgl_akhir_pajak1', 'sync_tgl_akhir_pajak2', 'disabled_tgl_akhir_pajak2')" ng-focus="tanggal('sync_tgl_akhir_pajak1')" placeholder='Awal'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>AKHIR PAJAK</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_tgl_akhir_pajak2" data-ng-model='sync_tgl_akhir_pajak2' ng-focus="tanggal('sync_tgl_akhir_pajak2')" data-ng-disabled="disabled_tgl_akhir_pajak2" placeholder='Akhir'>
					</div>
				</div>
			</div>

			<div class='col-lg-6' style="padding-left: 0;">
				<div class="mrgbt10">
					<a>AKHIR STNK</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_tgl_akhir_stnkb1" data-ng-model='sync_tgl_akhir_stnkb1' ng-change="change('sync_tgl_akhir_stnkb1', 'sync_tgl_akhir_stnkb2', 'disabled_tgl_akhir_stnkb2')" ng-focus="tanggal('sync_tgl_akhir_stnkb1')" placeholder='Awal'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>AKHIR STNK</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_tgl_akhir_stnkb2" data-ng-model='sync_tgl_akhir_stnkb2' ng-focus="tanggal('sync_tgl_akhir_stnkb2')" data-ng-disabled="disabled_tgl_akhir_stnkb2" placeholder='Akhir'>
					</div>
				</div>
			</div>

			<div class='mrgbt10 col-lg-3' style="padding-left: 0; margin-top: 13px;">
				<div class="input-group">
					<span class="input-group-btn">
						<input data-ng-click='proses()' type="submit" class="btn btn-warning" value="PROSES"/>
					</span>
				</div>
			</div>
			<div class='mrgbt10 col-lg-3'>
				<div class="mrgbt10">
					<a>JUMLAH DATA</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='form-control' type="text" name="sync_jumlah" data-ng-model='sync_jumlah' placeholder='Jumlah' readonly>
					</div>
				</div>
			</div>

		</div>
	</div>

	<div class='panel panel-body' id="panel_kolom">
		<div class='col-lg-12'>
			<h4>Report Generated System<br>
				<small>Kolom Yang Akan Ditampilkan</small>
			</h4>

			<div class='col-lg-6' style="padding-left: 0;">
				<div class="mrgbt10">
					<a>KOLOM 1</a>
					<div class="input-group" data-ng-init="getData_Kolom('1');">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom1' ng-options="item as item.label for item in data_kolom1|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('2')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 2</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom2' ng-options="item as item.label for item in data_kolom2|filter:filter1|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('3')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 3</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom3' ng-options="item as item.label for item in data_kolom3|filter:filter2|filter:filter1|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('4')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 4</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom4' ng-options="item as item.label for item in data_kolom4|filter:filter2|filter:filter3|filter:filter1|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('5')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 5</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom5' ng-options="item as item.label for item in data_kolom5|filter:filter2|filter:filter3|filter:filter4|filter:filter1|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('6')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 6</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom6' ng-options="item as item.label for item in data_kolom6|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter1|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('7')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>KOLOM 7</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom7' ng-options="item as item.label for item in data_kolom7|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter1|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('8')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 8</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom8' ng-options="item as item.label for item in data_kolom8|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter1|filter:filter9|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('9')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 9</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom9' ng-options="item as item.label for item in data_kolom9|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter1|filter:filter10|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('10')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 10</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom10' ng-options="item as item.label for item in data_kolom10|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter1|filter:filter11|filter:filter12 track by item.id" data-ng-change="getData_Kolom('11')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 11</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom11' ng-options="item as item.label for item in data_kolom11|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter1|filter:filter12 track by item.id" data-ng-change="getData_Kolom('12')" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
				<div class="mrgbt10">
					<a>KOLOM 12</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<select class='form-control select2' name="sync_kolom[]" data-ng-model='sync_kolom12' ng-options="item as item.label for item in data_kolom12|filter:filter2|filter:filter3|filter:filter4|filter:filter5|filter:filter6|filter:filter7|filter:filter8|filter:filter9|filter:filter10|filter:filter11|filter:filter1 track by item.id" style="width: 100%;">
							<option value="">-- Pilih Kolom --</option>
					    </select>
					</div>
				</div>
			</div>

			<div class="mrgbt10">
				<div class="input-group">
					<span class="input-group-btn">
						<input data-ng-click='tampilData()' type="submit" class="btn btn-warning" value="TAMPILKAN DATA"/>
					</span>
				</div>
			</div>

			<div class='mrgbt10'>
				<hr class='minisolid'>
				<div class="mrgbt10" id="btnExportExcel">
					<div class="input-group">
						<span class="input-group-btn">
							<input data-ng-click='exportExcel()' type="submit" class="btn btn-warning" value="EKSPORT EXCEL"/>
						</span>
					</div>
				</div>
				<div class='clearfix'></div>
                <?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="currentpage=1"'); ?>
                <div class='table-responsive'>
                    <table class='table table-striped table-hover table-condensed' id="tblScan">
                        <thead>
                            <th style="text-align: left;" ng-repeat="item in tampil_kolom">{{item.label}}</th>
                        </thead>
                        <tbody>
                            <tr data-ng-if='dataAll.length < 1'>
                                <td class='empty-row' colspan='10'>Data Scan Belum Di Pilih<br><small>Semua Data Scan Akan Tampil Disini</small></td>
                            </tr>
                            <tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
                            	<td ng-repeat="item in tampil_kolom">{{val[item.id]}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
                </div>
			</div>

		</div>
	</div>
</div>
<?= $js; ?>

<script src="<?php echo base_url('assets/js')?>/table2excel.js" type="text/javascript"></script>