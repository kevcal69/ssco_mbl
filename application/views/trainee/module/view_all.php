<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">All Modules</h3>
	</div>
		<?php $this->load->view('module/module_list_admin',array('modules' => $modules, 'panelbody_only' => TRUE));?>
</div>