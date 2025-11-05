  <?php 
    $level_akses = $this->session->userdata('level_akses'); 
    $is_admin = ($this->session->userdata('is_admin') && $this->session->userdata('is_admin') == 1) ? true : false;
    $check_menu_level = ($is_admin) ? false : true;
    $menu = get_menu($level_akses);
  ?>

  <style type="text/css">
    .content_banner-header{
      background-color: <?php echo $this->session->userdata('color'); ?> !important;
    }
  </style>

  <body data-ng-app='simka_bapenda'>
    <noscript>
      <div class="alert alert-danger">
        <strong>Oopps...Error</strong><br>
        <span><?php echo preset_message('error_java_script'); ?></span>
      </div>
    </noscript>

    <div id='wrap'>
      <div id='search_bar' class="navbar navbar-default">
        <div class='container'>
          <div class="navbar-header">
            <a href="<?php echo base_url(); ?>dashboard.html" class="navbar-brand navbar-brand-default"><img width='90px' src='<?php echo _IMG_LOGO.'logo_bapenda_text.png'; ?>'></a>
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href='<?php echo base_url(); ?>'>BERANDA</a></li>
            <?php $i = 0; ?> 
            <?php foreach($menu as $value): ?>
            <?php if($value['checklist_status'] == '1'): ?>
            <?php if($value['mode_menu'] == '0'): ?>
            <?php if($i > 0): ?>
                  </ul>
                  </li>
            <?php endif; ?>
            <?php $i++; ?>
                  <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php echo strtoupper($value['nama_module']); ?> <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu">
            <?php else: ?>
                  <li><a href="<?php echo base_url(); ?><?php echo $value['route']; ?>"><?php echo strtoupper($value['nama_module']); ?></a></li>
            <?php endif;?>
            <?php endif;?>
            <?php endforeach; ?>
            </ul>
            </li>
            </ul>
         
          <?php if($this->session->userdata('is_logged_in') == '1'): ?>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span class='glyphicon glyphicon-user'></span> HELLO, USER ALIH MEDIA <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo base_url(); ?>admin/profile">PROFILE</a></li>
                  <li class='divider'></li>
                
                <?php if($is_admin): ?>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/config">SETTING APLIKASI</a></li>
                  <li class='divider'></li>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/user">LOGIN AKSES</a></li>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/modul_akses">MODUL AKSES</a></li>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/code_akses">LEVEL AKSES</a></li>
                  <li class='divider'></li>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/wilayah">DATA WILAYAH</a></li>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/kecamatan">DATA KECAMATAN</a></li>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/data_pegawai">DATA PEGAWAI</a></li>
                  <li><a target='blank' href="<?php echo base_url(); ?>admin/pengumuman">DATA PENGUMUMAN</a></li>
                  <li class='divider'></li>
                <?php endif; ?>

                  <li><a href="<?php echo base_url(); ?>auth/logout" onclick="return confirm('Anda yakin akan logout dari session login anda ?');">LOGOUT</a></li>
                </ul>
              </li>
            </ul>
          <?php endif; ?>

          </div>
        </div>
      </div>