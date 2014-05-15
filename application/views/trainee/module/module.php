<div id="module-home-container">
	<?php $this->load->view('trainee/module/current_modules',array('current_modules' => $current_modules));?>
	<?php $this->load->view('trainee/module/available_modules',array('available_modules' => $available_modules));?>
	<?php $this->load->view('trainee/module/completed_modules',array('completed_modules' => $completed_modules));?>
</div>