<!-- <div class="panel panel-warning">
	<div class="panel-heading">
		<h3 class="panel-title">Scheduled Test Notice</h3>
	</div>
	<div class="panel-body">
		A mastery test has been scheduled for the module <?php// echo $module_title?>. You are required to take this exam. Click below to take the test.
	</div>
	<div class="panel-footer">
		<a class="button" href="<?php// echo base_url('trainee/scheduled_test/take/'.$test_id)?>">Take Test</a>
	</div>
</div> -->
<a href="<?php echo base_url('trainee/scheduled_test/take/'.$test_id)?>">
	<div class="notif notif-warning">
		<div class="notif-icon">
			<i class="fa fa-fw fa-exclamation-triangle"></i>
		</div>
		<div class="notif-body">
			A mastery test has been scheduled for a module. You are required to take this exam. Click here to take the test.
		</div>
	</div>
</a>