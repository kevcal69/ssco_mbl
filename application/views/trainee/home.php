<div id="home-container">
	<?php $this->load->view('trainee/module/current_modules',array('current_modules' => $current_modules));?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Available Modules</h3>
		</div>
		<?php $this->load->view('module/module_list_admin',array('modules' => $available_modules, 'panelbody_only' => TRUE));?>
		<div class="panel-footer">
			<a class="button button-info" href="<?=base_url('trainee/module/view')?>">
				View All Modules
			</a>
		</div>
	</div>
</div>