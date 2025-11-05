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
					<a>TANGGAL PRODUKSI</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_produksi1" data-ng-model='sync_produksi1' ng-change="change('sync_produksi1', 'sync_produksi2', 'disabled_produksi2')" ng-focus="tanggal('sync_produksi1')" placeholder='Awal'>
					</div>
				</div>
			</div>
			<div class="col-lg-6" style="padding-right: 0;">
				<div class="mrgbt10">
					<a>TANGGAL PRODUKSI</a>
					<div class="input-group">
						<span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
						<input class='tanggal form-control' type="text" name="sync_produksi2" data-ng-model='sync_produksi2' data-ng-disabled="disabled_produksi2" ng-focus="tanggal('sync_produksi2')" placeholder='Akhir'>
					</div>
				</div>
			</div>

			<div class='mrgbt10 col-lg-3' style="padding-left: 0; margin-top: 13px;">
				<div class="input-group">
					<span class="input-group-btn">
						<input data-ng-click='proses2();' type="submit" class="btn btn-warning" value="PROSES"/>
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
                            <th style="text-align: left;">No</th>
							<th style="text-align: left;">Tgl. Scan</th>
							<th style="text-align: left;">No. Scan</th>
                            <th style="text-align: left;">Nama</th>
                            <th style="text-align: left;">No. Polisi</th>
                            <th style="text-align: left;">No. Mesin</th>
                            <th style="text-align: left;">Tahun Masa Berlaku</th>
                        </thead>
                        <tbody>
                            <tr data-ng-if='dataAll.length < 1'>
                                <td class='empty-row' colspan='10'>Data Scan Belum Di Pilih<br><small>Semua Data Scan Akan Tampil Disini</small></td>
                            </tr>
                            <tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage" current-page='currentpage' pagination-id="prodx">
                            	<td style="text-align: left;">{{ $index + 1 }}</td>
								<td style="text-align: left;">{{val.tgl_scan}}</td>
								<td style="text-align: left;">{{val.no_scan}}</td>
	                            <td style="text-align: left;">{{val.nama_pemilik}}</td>
	                            <td style="text-align: left;">{{val.no_polisi}}</td>
	                            <td style="text-align: left;">{{val.no_mesin}}</td>
	                            <td style="text-align: left;">{{val.tgl_akhir_pajak}}</td>
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