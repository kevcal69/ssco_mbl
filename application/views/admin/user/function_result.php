<div id="function-result-container" class="user-container">
	<legend>Function Result</legend>
	<div id="message-content">
		<p><?php echo $message;?></p>
		<p class="error"><?php echo $error;?></p>
	</div>
	<a class="button" onClick="window.name='autoreload';history.go(-2);">Back</a>
	<a class="button button-primary" href="<?=base_url('admin/user/view');?>">View All Users</a>
</div>