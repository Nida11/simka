<?php if(DEBUG_MODE=='development'): ?>
<ul>
	<li>Severity: <?php echo $severity; ?></li>
	<li>Message:  <?php echo $message; ?></li>
	<li>Filename: <?php echo $filepath; ?></li>
	<li>Line Number: <?php echo $line; ?></li>
</ul>
<?php else: ?>
	<strong>---Error---</strong> 
	<!--li>Severity: <?php echo $severity; ?></li-->
	<!--li>Message:  <?php echo $message; ?></li-->
	<!--li>Filename: <?php echo $filepath; ?></li-->
	<!--li>Line Number: <?php echo $line; ?></li-->
<?php endif; ?>