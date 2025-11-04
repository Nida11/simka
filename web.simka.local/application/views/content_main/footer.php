       </div>
    </div>

    <!-- loading bar kiri -->
    <div id='loading_panel' class='hidden-print'>
        <img src='<?php echo _IMG_LOADER; ?>ajax-loader.gif'/> 
        <a href='#' class='cancel_ajax'> <span class='glyphicon glyphicon-remove'></span></a>
    </div>

    <!-- loading bar tengah -->
    <div id='loading_panel_lite' class='hidden-print'>
        <img src='<?php echo _IMG_LOADER; ?>ajax-loader-lite.gif'/> Mohon Menunggu  <small><a data-ng-click='abort_ajax()' class='btn btn-xs btn-link'><span class='glyphicon glyphicon-remove'></span> Batalkan</a></small>
    </div>

    <!-- loading overlay -->
    <div id='loading-overlay-layer' class='hidden-print'>
      <div class="progress progress-striped progress-bar-warning active">
        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
          <span class="sr-only">Loading</span>
        </div>
      </div>
    </div>

    <!-- modal -->
    <div id="modal" class="modal fade hidden-print" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        </div>
      </div>
    </div>

    <!-- scroll top -->
    <div class='scroll_top hidden-print'>
      <a id='to-top' href='javascript:void(0);'><span class='glyphicon glyphicon-chevron-up'></span></a>
    </div>

    <!-- running text -->
    <div class='running_text'></div>

    <div id="footer" class='hidden-print hidden-md hidden-sm hidden-xs'>
      <div class="container">
        <div class='pull-left'>
          <p class="text-muted credit">
            <img height='46px;' title='Jabar Juara' alt='jabar' src='<?php echo _IMG_LOGO; ?>logo_jabar.png' style='margin-right: 10px;'/>
          </p>
        </div>
        <div></div>
        <div class="pull-right">
          <p class="credit">
            <img height='55px;' title='badan pendapatan daerah' alt='bapenda' src='<?= _IMG_LOGO.'logo_bapenda_text.png'; ?>'/>
          </p>
        </div>
        <p class="credit hidden-xs hidden-sm text-muted credit"><?php echo $footer; ?></p>
      </div>
    </div>

    <!-- loading custom -->
    <div id='loading_custom'></div>
    <div id='loading_custom_detail'></div>
  </body>
</html>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
      </div>
      <div class="modal-body">
        <div id="gambar_raw"></div>
      </div>
      <div class="modal-footer">
        <form action="" method="post" id="formDownloadScan">
          <input type="hidden" name="image_contents" id="image_contents">
          <input type="hidden" name="no_scan" id="DownloadNo_scan">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" id="btnDownloadScan" value="Download">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="printDiv('gambar_raw')">Print!</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo _JS; ?>default.js"></script>


