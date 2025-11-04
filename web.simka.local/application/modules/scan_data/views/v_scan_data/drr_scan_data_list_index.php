<div data-ng-app='simka_bapenda' data-ng-controller='scan_data_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'>
    <div class='panel panel-default'>
        <div class='panel-body'>
            <div class="col-lg-8 col-md-8">
                <h4>List Scan Data<br>
                    <small>Daftar Data Hasil Scan Dokumen Kendaraan</small>
                </h4>
                <div class='well well-lg'>
                    <div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                Data Tahun
                            </span>
                            <input id='tgl_scan' class='form-control tanggal' type="text" name="tgl_scan" data-ng-model='tgl_scan'>
                            <span class="input-group-addon">
                                <a class='clickable' data-ng-click="getData()"><span class='glyphicon glyphicon-search'></span> Pilih Data</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class='clearfix'></div>
                <?= live_search_text('data-ng-model="search"', 'data-ng-model="perpage" data-ng-init="perpage=10;currentpage=1"'); ?>
                <div class='table-responsive'>
                    <table class='table table-striped table-hover table-condensed'>
                        <thead>
                            <th class='wid50 bgcl-blue50'>#</th>
                            <th class='wid80 bgcl-yellow50'>NOMOR<br>POLISI<br></th>
                            <th class='wid200 bgcl-blue60'>DETAIL<br>KENDARAN</th>
                            <th class='wid200'>DETAIL<br>WILAYAH</th>
                            <th class='wid120 bgcl-blue60'>DATA SCAN</th>
                        </thead>
                        <tbody data-ng-init="getData()">
                            <tr data-ng-if='dataAll.length < 1'>
                                <td class='empty-row' colspan='10'>Data Scan Kosong<br><small>Semua Data Scan Akan Tampil Disini</small></td>
                            </tr>
                            <tr data-dir-paginate="val in dataAll | filter:search | orderBy:sortKey:reverse | itemsPerPage:perpage track by val.no_scan" current-page='currentpage' pagination-id="prodx">
                                <td class='wid50 align_center bgcl-blue60'>
                                    {{val.sort_order}}
                                </td>
                                <!-- DRR 12Jan19 -->
                                <td class='wid75 bgcl-yellow50 align_center'>{{val.no_polisi_format}}</td>
                                <td class='wid300 bgcl-blue50'>
                                    <b>{{val.nama_pemilik  | uppercase}}</b><br>
                                    No. Scan : <b>{{val.no_scan}}</b><br>
                                    TGL. Akhir Pajak : <b>{{val.tgl_akhir_pajak}}</b><br>
                                    TGL. Akhir Pajak STNKB : <b>{{val.tgl_akhir_stnkb}}</b><br>
                                    TGL. Proses Tetap : <b>{{val.tgl_proses_tetap}}</b><br>
                                    TGL. Akhir Pajak Lama : <b>{{val.tgl_akhir_pjklm}}</b><br>
                                    TGL. Akhir Pajak Baru : <b>{{val.tgl_akhir_pjkbr}}</b>
                                </td>
                                <td class='wid80'>
                                    {{val.id_wilayah}}<br>
                                    <b>{{val.nama_wilayah}}</b><br>
                                    {{val.nama_kecamatan}}<br>
                                    {{val.nama_kota}}
                                </td>
                                <td class='align_center bgcl-blue50 wid120'>
                                    <!-- <a title='Edit Data' data-ng-click='getData(val.no_scan)' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-ok'></span></a>
                                    <a title='Hapus Data' data-ng-click='deleteData(val.no_scan, val.no_polisi, val.no_mesin, val.no_rangka, val.id_wilayah, val.id_kecamatan, val.nama_pemilik, val.tgl_akhir_pajak, val.tgl_akhir_stnkb, val.tgl_proses_daftar, val.tgl_proses_tetap, val.tgl_proses_bayar, val.tgl_akhir_pjklm, val.tgl_akhir_pjkbr)' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-remove'></span></a> -->
                                    
                                    <!-- DRR 7Feb19 -->
                                    <!-- <div data-ng-init="getDataScan(val.no_scan)">
                                        <div data-ng-repeat="val2 in dataAllRaw">
                                            <b><a href="javascript:void(0)" data-ng-click='getDataScan(val.no_scan, val2.no_scan_multiple)' data-toggle="modal" data-target="#exampleModal">{{val.no_polisi}}{{val2.no_scan_multiple}}</a></b>
                                        </div>
                                    </div> -->
                                    <div data-ng-repeat="val2 in getDataScanMultiple(val.no_scan)">
                                        <b><a href="#" data-ng-click='getData(val.no_scan, val2.no_scan_multiple)' data-toggle="modal" data-target="#exampleModal">{{val.no_polisi}}{{val2.no_scan_multiple}}</a></b>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <dir-pagination-controls pagination-id="prodx" boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php echo base_url().VIEWPATH;?>dir_pagination.tpl.html"></dir-pagination-controls>
                </div>
            </div>

            <div class='col-lg-4 col-md-4'>
                <div id='no_scan' class='mrgbt10'>
                    <a>NO SCAN</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
                        <input class='form-control' type="text" name="no_scan" data-ng-model='no_scan' placeholder='No Scan' readonly>
                    </div>
                </div>
                <div id='no_polisi' class='mrgbt10'>
                    <a>NOMOR POLISI</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="no_polisi" data-ng-model='no_polisi' placeholder='No Polisi' readonly>
                    </div>
                </div>
                <div id='nama_pemilik' class='mrgbt10'>
                    <a>NAMA PEMILIK</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="nama_pemilik" data-ng-model='nama_pemilik' placeholder='Nama Pemilik' readonly>
                    </div>
                </div>
                <div id='id_wilayah' class='mrgbt10'>
                    <a>ID WILAYAH</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="id_wilayah" data-ng-model='id_wilayah' placeholder='ID Wilayah' readonly>
                    </div>
                </div>
                <div id='id_kecamatan' class='mrgbt10'>
                    <a>ID KECAMATAN</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="id_kecamatan" data-ng-model='id_kecamatan' placeholder='ID Kecamatan' readonly>
                    </div>
                </div>
                <div id='tgl_akhir_pajak' class='mrgbt10'>
                    <a>TGL. AKHIR PAJAK</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="tgl_akhir_pajak" data-ng-model='tgl_akhir_pajak' placeholder='Tanggal Akhir Pajak' readonly>
                    </div>
                </div>
                <div id='tgl_akhir_stnkb' class='mrgbt10'>
                    <a>TGL. AKHIR PAJAK STNKB</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="tgl_akhir_stnkb" data-ng-model='tgl_akhir_stnkb' placeholder='Tanggal Akhir Pajak STNKB' readonly>
                    </div>
                </div>
                <div id='tgl_proses_daftar' class='mrgbt10'>
                    <a>TGL. PROSES DAFTAR</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="tgl_proses_daftar" data-ng-model='tgl_proses_daftar' placeholder='Tanggal Proses Daftar' readonly>
                    </div>
                </div>
                <div id='tgl_proses_tetap' class='mrgbt10'>
                    <a>TGL. PROSES TETAP</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="tgl_proses_tetap" data-ng-model='tgl_proses_tetap' placeholder='Tanggal Proses Tetap' readonly>
                    </div>
                </div>
                <div id='tgl_proses_bayar' class='mrgbt10'>
                    <a>TGL. PROSES BAYAR</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="tgl_proses_bayar" data-ng-model='tgl_proses_bayar' placeholder='Tanggal Proses Bayar' readonly>
                    </div>
                </div>
                <div id='tgl_akhir_pjklm' class='mrgbt10'>
                    <a>TGL. AKHIR PAJAK LAMA</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="tgl_akhir_pjklm" data-ng-model='tgl_akhir_pjklm' placeholder='Tanggal Akhir Pajak Lama' readonly>
                    </div>
                </div>
                <div id='tgl_akhir_pjkbr' class='mrgbt10'>
                    <a>TGL. AKHIR PAJAK BARU</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-search'></span></span>
                        <input class='form-control' type="text" name="tgl_akhir_pjkbr" data-ng-model='tgl_akhir_pjkbr' placeholder='Tanggal Akhir Pajak Baru' readonly>
                    </div>
                </div>
                <!-- <div id='nama_wilayah' class='mrgbt10'>
                    <a>NAMA WILAYAH</a>
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span></span>
                        <textarea rows='5' class='form-control' name="nama_wilayah" data-ng-model='nama_wilayah' placeholder='Nama Wilayah'></textarea>
                    </div>
                </div> -->
                <!-- <span class="input-group-btn" id='updatedata'>
                    <input data-ng-click='saveData("update");' type="submit" class="form-control btn btn-warning" value="UBAH DATA"/>
                </span> -->
                <hr class='minisolid'>
                <!-- DRR 22Des18 -->
                <!-- <div class="mrgbt10">
                    <div class="input-group">
                        <div id="gambar_raw"></div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<?= $css; ?>
<?= $js; ?>

<script type="text/javascript">
    $('.tanggal').datepicker({
        dateFormat: 'dd-mm-yy',
        onSelect: function (dateText, inst) {
            target = $(this).attr('data-target');   
            tanggal_select = $(this).datepicker({ dateFormat: "dd-mm-yy" }).val();
            $(document).find(target).val(tanggal_select);
        }
    });

    function printDiv(divName) {
         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }
</script>
