<link href="<?= _CSS; ?>appscan/Styles/style.css" type="text/css" rel="stylesheet">
<div class='panel panel-body'>
<div id="ScanWrapper" style="">



<div id="divScanner" class="divinput">

<ul>

    <li><i class="icon-print"></i>&nbsp;&nbsp;<b>Custom Scan</b></li>

    <li style="padding-left:12px;"><span style="font-size:12px">Select Scanner</span>&nbsp;:&nbsp;<select size="1" id="source"><option value=""></option></select></li>

    <li id="pNoScanner" style="padding-left:12px;">

        <a href="javascript: void(0)" class="ShowtblLoadImage" style="font-size: 11px;" id="aNoScanner">

        <b>What if you don't have a scanner connected:</b>

    	</a>

    </li>

    <li style="padding-left:12px;">

        	<input type="checkbox" id="ShowUI">If Show UI&nbsp;

        	<input type="checkbox" id="ADF">ADF&nbsp;

        	<input type="checkbox" id="Duplex">Duplex

    </li>

    <li style="padding-left:12px;">

        <label for="DiscardBlank"><input type="checkbox" id="DiscardBlank">If Discard Blank Images</label></li>

    <li style="padding-left:15px;"><span style="font-size:12px">Pixel Type&nbsp;:&nbsp;</span>

        <input type="radio" id="BW" name="PixelType">B&amp;W&nbsp;

        <input type="radio" checked="checked" id="Gray" name="PixelType">Gray&nbsp;

        <input type="radio" id="RGB" name="PixelType">Color&nbsp;</li>

    <li style="padding-left:15px;">

        <span style="font-size:12px">Resolution&nbsp;:&nbsp;</span><select size="1" style="width:80px" id="Resolution"><option value=""></option></select></li>

    <li style="text-align:center;">

        <input id="btnScan" class="bigbutton" type="button" value="Scan" onclick="btnScan_onclick();"></li>

</ul>

</div>



<div id="divBlank" style="height:20px">

<ul>

    <li></li>

</ul>

</div>



<div id="tblLoadImage" style="visibility:hidden;">

<ul>

    <li><b>You can:</b><a href="javascript: void(0)" style="text-decoration:none; padding-left:200px" class="ClosetblLoadImage">X</a></li>

</ul>

<div style="background-color:#f0f0f0; padding:5px;">

<ul>

    <li><img alt="arrow" src="appscan/Images/arrow.gif" width="9" height="12"><b>Install a Virtual Scanner:</b></li>

    <li style="text-align:center;"><a id="32bitsamplesource" href="http://www.dynamsoft.com/demo/DWT5/Sources/twainds.win32.installer.2.1.3.msi">32-bit Sample Source</a>

        <a id="64bitsamplesource" style="display:none;" href="http://www.dynamsoft.com/demo/DWT5/Sources/twainds.win64.installer.2.1.3.msi">64-bit Sample Source</a></li>

</ul>

</div>



<ul>

    <li><b>Or you can:</b></li>

</ul>

<div style="background-color:#f0f0f0; padding:5px;">

<ul>

    <li><img alt="arrow" src="appscan/Images/arrow.gif" width="9" height="12"><b>Load a sample Image:</b></li>

    <li style="text-align:center"><input id="btnLoad" class="bigbutton" type="button" style="width:180px;" value="Load Image" onclick="return btnLoad_onclick()"></li>

</ul>

</div>

</div>



<div id="divEdit" class="divinput" style="display:none">

<ul>

    <li><img alt="arrow" src="appscan/Images/arrow.gif" width="9" height="12"><b>Edit Image</b></li>

    <li style="padding-left:9px;">

        <input type="button" value="Show Image Editor" id="btnEditor" onclick="return btnShowImageEditor_onclick()"></li>

    <li style="padding-left:9px;">

        <input type="button" value="Rotate Right" id="btnRotateR" onclick="return btnRotateRight_onclick()">

        <input type="button" value="Rotate Left" id="btnRotateL" onclick="return btnRotateLeft_onclick()"></li>

    <li style="padding-left:9px;">

        <input type="button" value="Mirror" id="btnMirror" onclick="return btnMirror_onclick()">

        <input type="button" value="Flip" id="btnFlip" onclick="return btnFlip_onclick()">

        <input type="button" value="Crop" id="btnCrop" onclick="btnCrop_onclick();"></li>

    <li style="padding-left:9px; height:20px;">

        <input type="button" value="Change Image Size" id="btnChangeImageSize" onclick="return btnChangeImageSize_onclick();" style="float:left"></li>

</ul>

No. Scan:

<div id="ImgSizeEditor" style="visibility:hidden; text-align:left;">	

<ul>

    <li><label for="img_height"><b>New Height :</b>

        <input type="text" id="img_height" style="width:50%;" size="10">pixel</label></li>

    <li><label for="img_width"><b>New Width :</b>&nbsp;

        <input type="text" id="img_width" style="width:50%;" size="10">pixel</label></li>

    <li>Interpolation method:

        <select size="1" id="InterpolationMethod"><option value=""></option></select></li>

    <li style="text-align:center;">

        <input type="button" value="   OK   " id="btnChangeImageSizeOK" onclick="return btnChangeImageSizeOK_onclick();">

        <input type="button" value=" Cancel " id="btnCancelChange" onclick="return btnCancelChange_onclick();"></li>

</ul>

</div>

<div id="Crop" style="visibility:hidden ;">	

<div style="width:50%; height:100%; float:left; text-align:left;">

<ul>

    <li><label for="img_left"><b>left: </b>

        <input type="text" id="img_left" style="width:50%;" size="4"></label></li>

    <li><label for="img_top"><b>top: </b>

        <input type="text" id="img_top" style="width:50%;" size="4"></label></li>

    <li style="text-align:center;">

        <input type="button" value="  OK  " id="btnCropOK" onclick="return btnCropOK_onclick()"></li>

</ul>

</div>

<div style="width:50%; height:100%; float:left; text-align:right;">

<ul>

    <li><label for="img_right"><b>right : </b>

        <input type="text" id="img_right" style="width:50%;" size="4"></label></li>

    <li><label for="img_bottom"><b>bottom:</b>

        <input type="text" id="img_bottom" style="width:50%;" size="4"></label></li>

    <li style=" text-align:center;">

        <input type="button" value="Cancel" id="cancelcrop" onclick="return btnCropCancel_onclick()"></li>

</ul>

</div>

</div>

</div>



<div id="divSave" class="divinput">



<ul>

    <li><i class="icon-picture"></i>&nbsp;&nbsp;<b>Save Image</b>

      <label for="txt_fileNameforSave"></label>

    </li>

    <li style="padding-left:2px;">

	<form action="" method="post">

	  <table width="235" height="126" border="0">

        <tbody><tr>

          <th width="105">NO_SCAN</th>

          <th width="120" scope="col"><input readonly="true" type="text" size="20" id="txt_fileNameforSave" name="noscan" value=""></th>

        </tr>

        <tr>

          <th scope="col"><div align="left">NO_POLISI </div></th>

          <th scope="col"><input name="nopol" type="text" id="txt_no_polisi" size="20" maxlength="15" value=""></th>

        </tr>

        <tr>

          <th scope="col"><div align="left">NAMA </div></th>

          <th scope="col"><input name="nama" type="text" id="txt_nama" size="20" value=""></th>

        </tr>

        <tr>

          <th scope="col"><div align="left">MASA_BERLAKU </div></th>

          <th scope="col"><input name="masa_berlaku" type="text" id="txt_masa_berlaku" size="20" value=""></th>

        </tr>

        <tr>

          <th scope="col"><div align="left">NO_MESIN</div></th>

          <th scope="col"><input name="no_mesin" type="text" id="txt_no_mesin" size="20" value=""></th>

        </tr>

        <tr>

          <th scope="col"><div align="left">NO RANGKA </div></th>

          <th scope="col"><input name="no_rangka" type="text" id="txt_no_rangka" size="20" value=""></th>

        </tr>

        <tr>

          <th scope="col"><div align="left">KECAMATAN </div></th>

          <th scope="col"><input name="kecamatan" type="text" id="txt_kecamatan" size="20" value=""></th>

        </tr>

        <tr>

          <th scope="col"><div align="left">TGL_MUTASI</div></th>

          <th scope="col"><input name="tgl_mutasi" type="text" id="txt_tglmutasi" size="20" value=""></th>

        </tr>

		 <tr>

          <th scope="col"><div align="left">PATH</div></th>

          <th scope="col">

          <input name="tgldaftar" type="hidden" id="txt_tgldaftar" size="20" value="">

          <input name="tgltetap" type="hidden" id="txt_tgltetap" size="20" value="">

          <input name="tglbayar" type="hidden" id="txt_tglbayar" size="20" value="">

          <input name="tglap" type="hidden" id="txt_tglakhirpajak" size="20" value="">

          <input name="tglapl" type="hidden" id="txt_tglakhirpajakl" size="20" value="">

          <input name="tglapb" type="hidden" id="txt_tglakhirpajakb" size="20" value="">

          <input name="txtpath" type="text" id="txt_path" size="20" value="">

          </th>

        </tr>

      </tbody></table>

	  </form></li>

      <label for="txt_fileNameforSave"></label>

    <li style="padding-left:12px;">

            <input disabled="disabled" type="radio" value="bmp" name="imgType_save" id="imgTypebmp" onclick="rdsave_onclick();">BMP

		    <input disabled="disabled" type="radio" value="jpg" name="imgType_save" id="imgTypejpeg" onclick="rdsave_onclick();">JPEG

		    <input type="radio" value="tif" name="imgType_save" id="imgTypetiff" checked="checked" onclick="rdTIFFsave_onclick();">TIFF

		    <input disabled="disabled" type="radio" value="png" name="imgType_save" id="imgTypepng" onclick="rdsave_onclick();">PNG

		    <input disabled="disabled" type="radio" value="pdf" name="imgType_save" id="imgTypepdf" onclick="rdPDFsave_onclick();">PDF

    </li>

    <li style="padding-left:12px;">

    	<input type="checkbox" id="MultiPageTIFF_save" checked="checked">Multi-Page TIFF

        <input disabled="disabled" type="checkbox" id="MultiPagePDF_save">Multi-Page PDF

    </li>

    <li style="padding-left:15px;"><span style="font-size:12px">TIFF Conpres&nbsp;:&nbsp;</span>

        <select name="select">

            <option value="LZW">LZW</option>

            <option value="CITT3">CITT3</option>

            <option value="CITT4">CITT4</option>

            <option value="RLE">RLE</option>

            <option value="None">None</option>

        </select>

    </li>

    <li style="padding-left:15px; text-align:center">

        <input id="btnSave" type="button" class="bigbutton" value="Save" onclick="return btnSave_onclick()">

    </li>

    <li>

	  

</li></ul>

</div>



<div id="divUpload" class="divinput" style="">

<ul>

    <li></li>

    </ul>

<ul style="display:none;">

    <li><img alt="arrow" src="appscan/Images/arrow.gif" width="9" height="12"><b>Upload Image</b></li>

    <li style="padding-left:9px;">

        <label for="txt_fileName">File Name: <input type="text" size="20" id="txt_fileName"></label></li>

    <li style="padding-left:9px;">

        <!--<label for="imgTypebmp2">

            <input type="radio" value="bmp" name="ImageType" id="imgTypebmp2" onclick ="rd_onclick();"/>BMP</label>-->

	    <label for="imgTypejpeg2">

		    <input type="radio" value="jpg" name="ImageType" id="imgTypejpeg2" checked="checked" onclick="rd_onclick();">JPEG</label>

	    <label for="imgTypetiff2">

		    <input type="radio" value="tif" name="ImageType" id="imgTypetiff2" onclick="rdTIFF_onclick();">TIFF</label>

	    <label for="imgTypepng2">

		    <input type="radio" value="png" name="ImageType" id="imgTypepng2" onclick="rd_onclick();">PNG</label>

	    <label for="imgTypepdf2">

		    <input type="radio" value="pdf" name="ImageType" id="imgTypepdf2" onclick="rdPDF_onclick();">PDF</label></li>

    <li style="padding-left:9px;">

        <label for="MultiPageTIFF"><input type="checkbox" id="MultiPageTIFF">Multi-Page TIFF</label>

        <label for="MultiPagePDF"><input type="checkbox" id="MultiPagePDF">Multi-Page PDF </label></li>

    <li style="text-align: center">

        <input id="btnUpload" type="button" value="Upload Image" onclick="return btnUpload_onclick()"></li>

</ul>

</div>



</div>