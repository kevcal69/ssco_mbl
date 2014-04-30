<div id="create-container">
	<h1>Create User</h1>	
	<?php echo form_open('session/login', array('class' => 'form-create'));?>
		<label class = "static">Username</label>
		<input name = "username" value="<?php echo $this->session->flashdata('username'); ?>" type = "text" placeholder = "Username" class="field">
		<?php echo $this->session->flashdata('username_error');?>
		
		<label class = "static">Password</label>
		<input name = "password" value="<?php echo $this->session->flashdata('password'); ?>" type = "password" placeholder = "Password" class="field">
		<?php echo $this->session->flashdata('password_error');?>

		<label class = "static">Role</label>
		<?php 
			$options = array(
				'admin' => 'Admin',
				'trainee' => 'Trainee',
				'content_manager' => 'Content Manager'
				);
			echo form_dropdown('role', $options,'trainee');
		?>
		<?php echo $this->session->flashdata('password_error');?>
		<?php echo form_error('verify_login','<p class="error">','</p>'); ?>
		<input type = "submit" value = "Login" class="field" id = "submit">
	</form>
</div>