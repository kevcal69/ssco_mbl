<div id="profile-container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Personal Information</h3>
		</div>
		<div class="panel-body">
			<div class="form-horizontal">
				<div class="control-group">
					<label class="label">First Name</label>
					<label class="value"><?php echo $name['first_name']?></label>
				</div>
				<div class="control-group">
					<label class="label">Last Name</label>
					<label class="value"><?php echo $name['last_name']?></label>
				</div>
				<div class="control-group">
					<label class="label">Username</label>
					<label class="value"><?php echo $name['username']?></label>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Statistics</h3>
		</div>
		<div class="panel-body">
			<div class="form-horizontal">
				<div class="control-group">
					<label class="label">Modules Enroled</label>
					<label class="value"><?php echo $statistics['num_modules_enroled']?></label>
				</div>
				<div class="control-group">
					<label class="label">Modules Completed</label>
					<label class="value"><?php echo $statistics['num_modules_completed']?></label>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Enroled Modules (<?php echo (sizeof($current_modules) + sizeof($completed_modules))?>)</h3>
		</div>
		<div class="panel-body">	
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Current Modules (<?php echo sizeof($current_modules)?>)</h3>
				</div>
				<div class="panel-body">
					<?php $this->load->view('trainee/module/current_modules',array('current_modules' => $current_modules,'no_container' => TRUE));?>
				</div>
				<div class="panel-footer">Total: <?php echo sizeof($current_modules)?></div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Completed Modules (<?php echo sizeof($completed_modules)?>)</h3>
				</div>
				<div class="panel-body">
					<?php $this->load->view('trainee/module/completed_modules',array('completed_modules' => $completed_modules,'no_container' => TRUE));?>
				</div>
				<div class="panel-footer">Total: <?php echo sizeof($completed_modules)?></div>
			</div>
		</div>
		<div class="panel-footer">Total: <?php echo (sizeof($current_modules) + sizeof($completed_modules))?></div>
	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Evaluation Tests (0) - UNDER CONSTRUCTION</h3>
		</div>
		<div class="panel-body">
			No scheduled tests taken.
		</div>
	</div>
</div>