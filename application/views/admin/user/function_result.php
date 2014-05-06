<div id="function-result-container">
	<h1>Function Result</h1>
	<hr>
	<div id="message-content">
		<p><?php echo $message;?></p>
		<p class="error"><?php echo $error;?></p>
	</div>
	<a class="button" href="<?=base_url('admin/user/view');?>">View All Users</a>
	<a class="button" onClick="window.name='autoreload';history.go(-2);">Back</a>
</div>