<div id="function-result-container" class="panel panel-info user-container">
	<div class="panel-heading">
		<h3 class="panel-title">Function Result</h3>
	</div>
	<div class="panel-body">
		<div id="message-content">
			<p><?php echo $message;?></p>
			<p class="error"><?php echo $error;?></p>
		</div>
	</div>
	<div class="panel-footer">
		<a class="button" onClick="window.name='autoreload';history.go(-2);">Back</a>
		<a class="button button-primary" href="<?=base_url('admin/user/view');?>">View All Users</a>
	</div>
</div>