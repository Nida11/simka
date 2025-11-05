<?php if($this->session->userdata('foto_pegawai')): ?>
<style type="text/css">
  .auth.user_image_container{
    background-image: url("<?php echo base_url(); ?>public/foto_pegawai/<?php echo $this->session->userdata('foto_pegawai'); ?>") !important;
    background-position: center;
  }
</style>
<?php endif; ?>

<div class='fullscreen-bg'>
  <video autoplay muted loop id="myVideo" class="fullscreen-bg__video">
    <source src="<?= _ASSETS; ?>videos/background.webm" type="video/mp4">
  </video>
</div>
<div id='loading-overlay-layer' class='hidden-print'>
  <div class="progress progress-striped progress-bar-warning active">
    <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
      <span class="sr-only">Loading</span>
    </div>
    <img src='<?php echo _IMG_LOADER; ?>ajax-loader.gif'/>
  </div>
</div>

<div class="container">

  <div class="auth notification_container">
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
          <strong><?php echo $this->session->flashdata('header'); ?></strong><br>
          <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
          Masukan Password anda dengan benar<br/>
          Jika Anda Belum Terdaftar Silahkan Hubungi<br/>
          <b>TIM IT SUPPORT & ADMINISTRATOR</b>
        </div>
    <?php endif; ?>
  </div>

  <div class="auth panel_container" ng-app="simka_bapenda">
    <div class="panel panel-primary shdw5-black">
      <div class="panel-heading auth image_container align_center">
        <strong>AUTHENTIFIKASI PENGGUNA</strong><br>
        <small>Pastikan anda terdaftar dan user anda sudah aktif</small>
      </div>
      <div class="panel-body">
        <div class='auth user_image_container'></div>
        <form class='form_natural normal_form' name='form' action='<?php echo base_url(); ?>auth/validation_password' method='POST'>
          <div class="alert alert-info align_center" role="alert">
            <a><?php echo strtoupper($this->session->userdata('id_user')); ?></a><br>
            <strong><?php echo strtoupper($this->session->userdata('nama_pegawai')); ?></strong>
            <br>&bullet;&bullet;&bullet;<br>
            <a>(<?php echo strtoupper($this->session->userdata('id_wilayah')); ?>)</a><br>
            <strong><?php echo strtoupper($this->session->userdata('nama_wilayah')); ?></strong>
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="auth_username"><span class='glyphicon glyphicon-certificate'></span></span>
            <input type="password" name='p' class="form-control" placeholder="Masukan Password" aria-describedby="auth_password" autofocus>
          </div>
          <div class="alert alert-primary align-left" role="alert">
            Masukan Password Dengan Benar
          </div>
          <?php if($this->session->userdata('tampilan_akses')): ?>
            <div class="alert alert-danger align_center" role="alert">
              <b>Anda Belum Terdaftar Dalam Akses Control APLIKASI SIMKA.</b><br><br>
              Kami Butuh User Akses Anda, Silahkan Masukan <b>KODE AKSES</b><br><br>
              <input class='form-control align_center' type="text" name="c" placeholder="Kode Akses"><br>
              <small>
                <b>Proses Ini Hanya 1 Kali Saja, Untuk Menentukan Akses Control Anda</b>. Jika Akses Control Tidak Sesuai, Silahkan Hubungi Administrator.
              </small>
            </div>
          <?php endif;?>
          <br>
          <a href='<?php echo base_url(); ?>auth/logout'>Ini Bukan Akun Saya</a>
          <input class='btn btn-xs btn-primary pull-right' type='submit' name='submit' value='Lanjutkan >'/>
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