
<div class='container deep_container'>

    <?php if($this->session->flashdata('info')): ?>
      <div class="alert alert_index alert-info">
        <strong><?php echo $this->session->flashdata('header'); ?></strong><br>
        <span><?php echo $this->session->flashdata('info'); ?></span>
      </div><!-- /.alert alert-info-->
    <?php endif; ?>

    <?php if($this->session->flashdata('warning')): ?>
      <div class="alert alert_index alert-warning">
        <strong><?php echo $this->session->flashdata('header'); ?></strong><br>
        <span><?php echo $this->session->flashdata('warning'); ?></span>
      </div><!-- /.alert alert-warning-->
    <?php endif; ?>

    <?php if($this->session->flashdata('success')): ?>
      <div class="alert alert_index alert-success">
        <strong><?php echo $this->session->flashdata('header'); ?></strong><br>
        <span><?php echo $this->session->flashdata('success'); ?></span>
      </div><!-- /.alert alert-success-->
    <?php endif; ?>

    <?php if(validation_errors()): ?>
      <div class="alert alert-danger">
        <strong><h3>Proses Input Data Salah</h3></strong><hr>
        <span><?php echo validation_errors(); ?></span>
      </div><!-- /.alert alert-warning-->
    <?php endif; ?>