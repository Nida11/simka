<div id='loading-overlay-layer' class='hidden-print'>
  <div class="progress progress-striped progress-bar-warning active">
    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
      <span class="sr-only">Loading</span>
    </div>
    <img src='<?php echo _IMG_LOADER; ?>ajax-loader.gif'/>
  </div>
</div>

<!--<div class='fullscreen-bg'>
  <video autoplay muted loop id="myVideo" class="fullscreen-bg__video">
    <source src="<?= _ASSETS; ?>videos/background.webm" type="video/mp4">
  </video>
</div>-->
<div class="container">      
  <div class="auth notification_container">
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
          <strong><?php echo $this->session->flashdata('header'); ?></strong><br>
          <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
          Masukan Username anda dengan benar<br/>
          Jika Anda Belum Terdaftar Silahkan Hubungi<br/>
          <b>TIM IT SUPPORT & ADMINISTRATOR</b>
        </div>
    <?php endif; ?>
  </div>

  <div class="auth panel_container" ng-app="simka_bapenda">
    <div class="panel panel-primary shdw5-black">
      <div class="panel-heading auth image_container align_center">
        <strong>AUTHENTIFIKASI PENGGUNA</strong><br>
        <small>Pastikan Anda Terdaftar dan Username Anda Aktif</small>
      </div>
      <div class="panel-body">
        <div class='auth user_image_container'></div>
        <form class='form_natural normal_form' name='form' action='<?php echo base_url(); ?>auth/validation_user' method='POST'>
          <div class="alert alert-default align-center" role="alert">
            <b>Hallo, Selamat Datang</b><br>
            Masukan Username Dengan Benar</a>
          </div>
          <div class="input-group mrgbt10">
            <span class="input-group-addon" id="auth_username"><span class='glyphicon glyphicon-user'></span></span>
            <input type="text" name='u' class="form-control" placeholder="Masukan Username" aria-describedby="auth_username" autofocus autocomplete="off">
          </div>
          <input class='btn btn-primary pull-right' type='submit' name='submit' value='Lanjutkan >'/>
        </form>
      </div>
    </div>
  </div>
  <div class='auth register_container'>
    <div class='auth logo_title_bottom'>
      <?php echo $this->config->item('footer_credit'); ?>
    </div>
    <div class='auth logo_bottom'>
      <p class="credit">
        <img height='46px;' title='Provinsi Jawa Barat' alt='jabar' src="<?php echo _IMG_LOGO; ?>logo_jabar.png">
        <img height='60px;' title='Badan Pendapatan Daerah' alt='bapenda' src='<?php echo _IMG_LOGO; ?>logo_bapenda_text.png'/>
      </p>
    </div>
  </div>
</div>

<?php echo $css; ?>
<script type="text/javascript" src="<?= _JS; ?>default.js"></script>
