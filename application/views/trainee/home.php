<div id="home-container">
	<?php $this->load->view('trainee/module/current_modules',array('current_modules' => $current_modules));?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Available Modules</h3>
		</div>
		<?php $this->load->view('module/module_list_admin',array('modules' => $available_modules, 'panelbody_only' => TRUE));?>
	</div>
</div>