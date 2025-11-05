<link href="<?= _ASSETS; ?>dynasoft/Styles/style.css" type="text/css" rel="stylesheet" />
<script src="<?= _ASSETS; ?>dynasoft/Scripts/common.js?t=170607"></script>
<div data-ng-app='simka_bapenda' data-ng-controller='scan_data_controller' data-ng-init='initialForm(); base_url="<?php echo base_url(); ?>"'> 
		<div id="demoContent" class='container'>
			<div class='col-lg-12'>
            <div id='no_polisi' class='col-lg-8 mrgbt10 mrgrg100'>
                <div class="input-group">
                    <span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span> NO POLISI</span>
                    <input class='form-control' type="text" name="no_polisi" press-enter='syncData();' data-ng-model='no_polisi' autofocus='true' placeholder='NOMOR POLISI'>
                    <span class="input-group-addon"><a class='clickable' data-ng-click="syncData();"><span class='glyphicon glyphicon-search'></span> Tekan Enter</a></span>
                </div>
            </div>
			    <div class="col-lg-8 mrgbt10 mrgrg100">
                    <div class="input-group">
                        <span class="input-group-addon"><span class='glyphicon glyphicon-asterisk'></span> WARNA</span>
                        <select class="form-control select2" name="kd_plat" data-ng-model="kd_plat">
                            <option value="" selected="selected">Hitam</option>
                            <option value="2">Merah</option>
                            <option value="3">Kuning</option>
                        </select>
                        <span class="input-group-addon"><a class='clickable' data-ng-click="syncData();"><span class='glyphicon glyphicon-search'></span> Tekan Enter</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class='clearfix'></div>
        <div>
            <div id="DWTcontainer">
                <div id="DWTcontainerTop">
                    <div id="divEdit">
                        <ul class="operateGrp">
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/ShowEditor.png" title= "Show Image Editor" alt="Show Image Editor" id="btnEditor" onclick="btnShowImageEditor_onclick()"/> </li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/RotateLeft.png" title="Rotate Left" alt="Rotate Left" id="btnRotateL"  onclick="btnRotateLeft_onclick()"/> </li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/RotateRight.png" title="Rotate Right" alt="Rotate Right" id="btnRotateR"  onclick="btnRotateRight_onclick()"/> </li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/Rotate180.png" alt="Rotate 180" title="Rotate 180" onclick="btnRotate180_onclick()" /> </li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/Mirror.png" title="Mirror" alt="Mirror" id="btnMirror"  onclick="btnMirror_onclick()"/> </li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/Flip.png" title="Flip" alt="Flip" id="btnFlip" onclick="btnFlip_onclick()"/> </li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/RemoveSelectedImages.png" title="Remove Selected Images" alt="Remove Selected Images" id="DW_btnRemoveCurrentImage" onclick="btnRemoveCurrentImage_onclick();"/></li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/RemoveAllImages.png" title="Remove All Images" alt="Remove All Images" id="DW_btnRemoveAllImages" onclick="btnRemoveAllImages_onclick();"/></li>
                            <li><img src="<?= _ASSETS; ?>dynasoft/Images/ChangeSize.png" title="Change Image Size" alt="Change Image Size" id="btnChangeImageSize" onclick="btnChangeImageSize_onclick();"/> </li>
                            <li> <img src="<?= _ASSETS; ?>dynasoft/Images/Crop.png" title="Crop" alt="Crop" id="btnCrop" onclick="btnCrop_onclick();"/></li>
                        </ul>
                        <div id="ImgSizeEditor" style="visibility:hidden">
                            <ul>
                                <li>
                                    <label for="img_height">New Height :
                                        <input type="text" id="img_height" style="width:50%;" size="10"/>
                                        pixel</label>
                                </li>
                                <li>
                                    <label for="img_width">New Width :&nbsp;
                                        <input type="text" id="img_width" style="width:50%;" size="10"/>
                                        pixel</label>
                                </li>
                                <li>Interpolation method:
                                    <select size="1" id="InterpolationMethod">
                                        <option value = ""></option>
                                    </select>
                                </li>
                                <li style="text-align:center;">
                                    <input type="button" value="   OK   " id="btnChangeImageSizeOK" onclick ="btnChangeImageSizeOK_onclick();"/>
                                    <input type="button" value=" Cancel " id="btnCancelChange" onclick ="btnCancelChange_onclick();"/>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="dwtcontrolContainer"></div>
                    <div id="btnGroupBtm" class="clearfix"></div>
                </div>
                <div id="ScanWrapper">
                    <div id="divScanner" class="divinput">
                        <ul class="PCollapse">
                            <li>
                                <div class="divType">
                                    <div class="mark_arrow expanded"></div>
                                    Konfigurasi Scan</div>
                                <div id="div_ScanImage" class="divTableStyle">
                                    <ul id="ulScaneImageHIDE" >
                                        <li>
                                            <label for="source">
                                            <p>Select Source:</p>
                                            </label>
                                            <select size="1" id="source" style="position:relative;" onchange="source_onchange()">
                                                <option value = ""></option>
                                            </select>
                                        </li>
                                        <li style="display:none;" id="pNoScanner"> <a href="javascript: void(0)" class="ShowtblLoadImage" style="color:#fe8e14" id="aNoScanner">(No TWAIN compatible drivers detected)</a></li>
                                        <li id="divProductDetail"></li>
                                        <li>
                                            <input id="btnScan" class="btnOrg" disabled="disabled" type="button" value="Scan" onclick ="acquireImage();"/>
                                        </li>
                                    </ul>
                                    <div id="tblLoadImage" style="visibility:hidden;"> <a href="javascript: void(0)" class="ClosetblLoadImage"><img src="<?= _ASSETS; ?>dynasoft/Images/icon-ClosetblLoadImage.png" alt="Close tblLoadImage"/></a>
                                        <p>You can Install a Virtual Scanner:</p>
                                        <p><a id="samplesource32bit" href="https://download.dynamsoft.com/tool/twainds.win32.installer.2.1.3.msi">32-bit Sample Source</a> <a id="samplesource64bit" style="display:none;" href="https://download.dynamsoft.com/tool/twainds.win64.installer.2.1.3.msi">64-bit Sample Source</a> from <a target="_blank" href="http://www.twain.org">TWG</a></p>
                                    </div>
                                </div>
                            </li>
                            <li id="liLoadImage">
                                <div class="divType" style="display:none;">
                                    <div class="mark_arrow collapsed"></div>
                                    Load Gambar atau PDF</div>
                                <div id="div_LoadLocalImage" style="display: none" class="divTableStyle">
                                    <ul>
                                        <li class="tc">
                                            <input class="btnOrg" type="button" value="Load" onclick="return btnLoadImagesOrPDFs_onclick()" />
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div id="divUpload" class="divinput mt30" style="position:relative">
                        <ul>
                            <li class="toggle">Dokumen Detail</li>
                            <li>
                                <!-- DRR 12Des18 -->
                                <input type="hidden" data-ng-model='sync_user' id="sync_user" value="<?php echo $this->session->userdata('id_user'); ?>" />
                                <label style='width: 60px'>No.Scan</label> 
                                <input type="text" size="20" id="no_scan" data-ng-model='no_scan' name="no_scan" /><br>
                                <!-- DRR 12Jan19 -->
                                <label style='width: 60px'>No.Pol Format</label> 
                                <input type="text" size="20" id='sync_no_polisi_format' data-ng-model='sync_no_polisi_format' name="sync_no_polisi_format" /><br>
                                <label style='width: 60px'>No.Polisi</label> 
                                <input type="text" size="20" id='sync_no_polisi' data-ng-model='sync_no_polisi' name="sync_no_polisi" /><br>
                                <label style='width: 60px'>Nama</label> 
                                <input type="text" size="20" data-ng-model='sync_nama_pemilik' name="sync_nama_pemilik" /><br>
                                <label style='width: 60px'>No.Rangka</label> 
                                <input type="text" size="20" data-ng-model='sync_no_rangka' name="sync_no_rangka" />
                                <label style='width: 60px'>No.Mesin</label> 
                                <input type="text" size="20" data-ng-model='sync_no_mesin' name="sync_no_mesin" />
                                  <!--<label style='width: 60px'>Kd.Wilayah</label> 
                                <input type="text" size="20" data-ng-model='sync_id_wilayah' name="sync_id_wilayah" />
                                <label style='width: 60px'>Kd.Kecamatan</label> 
                                <input type="text" size="20" data-ng-model='sync_id_kecamatan' name="sync_id_kecamatan" />
                                <label style='width: 60px'>Akhr.Pjk</label> 
                                <input type="text" size="20" data-ng-model='sync_tgl_akhir_pajak' name="sync_tgl_akhir_pajak" />
                                <label style='width: 60px'>Akhr.STNKB</label> 
                                <input type="text" size="20" data-ng-model='sync_tgl_akhir_stnkb' name="sync_tgl_akhir_stnkb" />
                                <label style='width: 60px'>Pros.Daftar</label> 
                                <input type="text" size="20" data-ng-model='sync_tgl_proses_daftar' name="sync_tgl_proses_daftar" />
                                <label style='width: 60px'>Pros.Tetap</label> 
                                <input type="text" size="20" data-ng-model='sync_tgl_proses_tetap' name="sync_tgl_proses_tetap" />
                                <label style='width: 60px'>Pros.Bayar</label> 
                                <input type="text" size="20" data-ng-model='sync_tgl_proses_bayar' name="sync_tgl_proses_bayar" />
                                <label style='width: 60px'>Akhr.Pjklm</label> 
                                <input type="text" size="20" data-ng-model='sync_tgl_akhir_pjklm' name="sync_tgl_akhir_pjklm" />
                                <label style='width: 60px'>Akhr.Pjkbr</label> 
                                <input type="text" size="20" data-ng-model='sync_tgl_akhir_pjkbr' name="sync_tgl_akhir_pjkbr" /> -->
                                <input id='url_local_path' type="hidden" value="D:\simkabapendajabar\<?php echo date('Y') ?>\<?php echo date('m') ?>\<?php echo date('d') ?>\" size="20" data-ng-model='sync_url_local_path' name="sync_url_local_path" />
                            </li>
                            <input type="text" style="display: none;" name="ImageType2" id="ImageType2" data-ng-model="ImageType2"/>
                            <li style="padding-right:0;">
                                <label for="imgTypebmp">
                                    <input type="radio" value="bmp" name="ImageType" data-ng-model="ImageType" id="imgTypebmp" onclick ="rd_onclick('bmp');"/>
                                    BMP</label>
                                <label for="imgTypejpeg">
                                    <input type="radio" value="jpg" name="ImageType" data-ng-model="ImageType" id="imgTypejpeg" onclick ="rd_onclick('jpg');"/>
                                    JPEG</label>
                                <label for="imgTypetiff">
                                    <input type="radio" value="tif" name="ImageType" data-ng-model="ImageType" id="imgTypetiff" onclick ="rdTIFF_onclick();"/>
                                    TIFF</label>
                                <label for="imgTypepng">
                                    <input type="radio" value="png" name="ImageType" data-ng-model="ImageType" id="imgTypepng" onclick ="rd_onclick('png');"/>
                                    PNG</label>
                                <label for="imgTypepdf">
                                    <input type="radio" value="pdf" name="ImageType" data-ng-model="ImageType" id="imgTypepdf" onclick ="rdPDF_onclick();"/>
                                    PDF</label>
                            </li>
                            <li>
                                <label for="MultiPageTIFF">
                                    <input type="checkbox" id="MultiPageTIFF"/>
                                    Multi-Page TIFF</label>
                                <label for="MultiPagePDF">
                                    <input type="checkbox" id="MultiPagePDF"/>
                                    Multi-Page PDF</label>
                            </li>
                            <li style="padding-left:15px;"><span style="font-size:12px">TIFF Compression: </span>
                                <select name="select">
                                    <option value="LZW">LZW</option>
                                    <option value="CITT3">CITT3</option>
                                    <option value="CITT4">CITT4</option>
                                    <option value="RLE">RLE</option>
                                    <option value="None">None</option>
                                </select>
                            </li>
                            <li>
                                <!-- 26Jan19 -->
                                <!--<input id="btnSave" class="btnOrg" type="button" value="Simpan Data" data-ng-click='saveData();' onclick ="saveUploadImage()"/>-->
								<button id="btnSave" class="btnOrg" style="margin-bottom: 15px;" data-ng-click='saveData();' onclick ="saveUploadImage()" data-ng-disabled='btnSaveDisb'>Simpan Data</button>
                                <!-- <input id="btnUpload" class="btnOrg" type="button" value="Upload to Server" onclick ="saveUploadImage('server')"/> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='clearfix'></div>
</div>
<br>
<br>
<br>

<script>
    window['bDWTOnlineDemo'] = true;
</script> 
<script src="<?= _ASSETS; ?>dynasoft/Resources/dynamsoft.webtwain.config.js?t=170607"></script> 
<script src="<?= _ASSETS; ?>dynasoft/Resources/dynamsoft.webtwain.initiate.js?t=170607"></script> 
<!-- <script src="<?= _ASSETS; ?>dynasoft/Resources/addon/dynamsoft.webtwain.addon.pdf.js?t=170607"></script> -->
<script src="<?= _ASSETS; ?>dynasoft/Scripts/online_demo_operation.js?t=<?php echo date('ymdhmis'); ?>"></script>
<script src="<?= _ASSETS; ?>dynasoft/Scripts/online_demo_initpage.js?t=170607"></script>
<script>
var twainsource = document.getElementById("source");          
    if (twainsource) {
        twainsource.options.length = 0;
        twainsource.options.add(new Option("Looking for devices.Please wait.", 0));
        twainsource.options[0].selected = true; 
    }
    $("ul.PCollapse li>div").click(function() {
        if ($(this).next().css("display") == "none") {
            $(".divType").next().hide("normal");
            $(".divType").children(".mark_arrow").removeClass("expanded");
            $(".divType").children(".mark_arrow").addClass("collapsed");
            $(this).next().show("normal");
            $(this).children(".mark_arrow").removeClass("collapsed");
            $(this).children(".mark_arrow").addClass("expanded");
        }
    });
</script> 
<script>
    // Assign the page onload fucntion.
    $(function() {
        pageonload();
    });
</script>

<?= $js; ?>
