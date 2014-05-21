<div class="panel panel-info form-container">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo $title?></h3>
	</div>
	<div class="panel-body">
		<div id="message-content">
			<p><?php echo $message;?></p>
			<p class="error"><?php echo $error;?></p>
		</div>
	</div>
	<div class="panel-footer">
		<a class="button" onClick="window.name='autoreload';history.go(-2);">Back</a>
		<a class="button button-primary" href="<?=base_url('trainee');?>">Home</a>
	</div>
</div>