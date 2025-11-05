<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo (isset($title)) ? $browser_title.' - '.$title : $browser_title ; ?></title>
    <meta charset="utf-8">
<!--     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
    <meta name="description" content="<?php echo $mini_description; ?>">
    <meta name="author" content="<?php echo $author; ?>">
    <meta name="keywords" content="<?= $keyword; ?>">
    <meta name="theme-color" content="#4C8AFF">
    <meta name="msapplication-navbutton-color" content="#4C8AFF">
    <meta name="apple-mobile-web-app-status-bar-style" content="#4C8AFF">
    <meta name="robots" content="index,nofollow"> 
    <meta http-equiv="expires" content="Sun, 01 Jan 2014 00:00:00 GMT"/>
    <meta http-equiv="pragma" content="no-cache" />

    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png?ca=<?php echo date('dmYhmis'); ?>" type="image/x-icon"/>
    <link rel="alternate" href="<?= base_url(); ?>" hreflang="id" />

    <link rel="stylesheet" href="<?= _CSS; ?>component/bootstrap.css">
    <link rel="stylesheet" href="<?= _CSS; ?>component/datepicker.css" >
    <link rel="stylesheet" href="<?= _CSS; ?>component/dropzone.css" >
    <link rel="stylesheet" href="<?= _CSS; ?>component/jquery-select2.css" >
    <link rel="stylesheet" href="<?= _CSS; ?>component/jquery-toast.css" >
    <link rel="stylesheet" href="<?= _CSS; ?>component/jquery-sweetalert.css" >
    <link rel="stylesheet" href="<?= _CSS; ?>component/timeline.css"> 
    <link rel="stylesheet" href="<?= _CSS; ?>default.css?ca=<?php echo date('dmYhmis'); ?>" >
    
    <script type="text/javascript" src="<?= _JS; ?>init.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-ui.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/bootstrap.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-tablesorter.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-tablecomponent.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-dropzone.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-select2.min.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-push_notification.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-timeago.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-toast.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-peity.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-sweetalert.min.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/jquery-showpassword.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/chart.js"></script>

    <script type="text/javascript" src="<?= _JS; ?>component/graphics/dx.chartjs.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/graphics/globalize.min.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/graphics/knockout-2.2.1.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>ajax_load.js"></script>

    <script type="text/javascript" src="<?= _JS; ?>component/angular.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-pdf.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-pdf.worker.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-pagination.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-barcode.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-qrcode.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-mooscape-qrcode.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-text-truncate.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>component/angular-chart.js"></script>
    <script type="text/javascript" src="<?= _JS; ?>ng_simka.js"></script>
  </head>

<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
