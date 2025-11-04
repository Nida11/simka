<?php if(isset($content_search) && !is_bool($content_search)): ?>
	<div id='search_bar' class="content_banner-search hidden-print">
		<div class='container'>
			<?php echo $content_search; ?>
		</div>
	</div>
	<div class='clearfix'></div>
<?php endif; ?>

<?php if(isset($content_banner) && !is_bool($content_banner)): ?>
	<div class="content_banner-header hidden-print">
		<div class='container'>
			<?php echo $content_banner; ?>
		</div>
	</div>
	<div class='clearfix'></div>
<?php endif; ?>