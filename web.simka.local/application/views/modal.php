<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<span class="modal-title"><?php echo $title; ?></span>
</div><!-- /.modal-header -->

<?php echo $form_open; ?>

	<div class="modal-body">
		<?php echo $body; ?>
	</div><!-- /.modal-body -->

	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo preset_message('cancel_btn'); ?></button>
		<button type="button" class="btn btn-primary modal_save_button"><span class="glyphicon glyphicon-floppy-saved"></span> <?php echo preset_message('save_data_btn'); ?></button>
	</div><!-- /. modal-footer -->

<?php echo $form_close; ?>

<script type="text/javascript">
	$('.chosen').chosen({allow_single_deselect: true});
</script>
