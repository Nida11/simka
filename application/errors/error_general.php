<!DOCTYPE html>
<html lang="en">
	<head>
		<title>500 - Error General</title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png?ca=<?php echo date('dmY'); ?>" type="image/x-icon"/>
		<link rel="stylesheet" href="<?php echo _CSS; ?>error.css">
	</head>

	<body>
		<div id="clouds">
	        <div class="cloud x1"></div>
	        <div class="cloud x1_5"></div>
	        <div class="cloud x2"></div>
	        <div class="cloud x3"></div>
	        <div class="cloud x4"></div>
	        <div class="cloud x5"></div>
	    </div>
	    <div class='c'>
	        <div class='_404'>500</div>
	        <div class='_1'><?php echo $heading; ?></div>
	        <?php if(DEBUG_MODE=='development'): ?>
	        	<div class='_2'><small><?php echo $message; ?></small></div>
	        <?php endif; ?>
	        <br>
	        <div class='_2'><a href='#' onclick="history.back(-1);">Kembali Ke Halaman Sebelumnya</a></div>
	    </div>
	</body>
</html>