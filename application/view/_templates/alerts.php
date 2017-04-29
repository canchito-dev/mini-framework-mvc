		<div class="alert alert-<?php echo isset($type) ? $type : '';?> alert-dismissible <?php echo !isset($hide) ? 'hidden' : ''; ?>" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong><?php echo isset($type) ? ucfirst($type) : ''; ?>!</strong> <?php echo isset($message) ? $message : ''; ?>
		</div>