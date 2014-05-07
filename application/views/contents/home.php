<div id="module-intro">
	<div id="about">
		<h1>Module-Based Learning</h1>
		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
		<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
	</div>		
	<?php echo form_open('session/login', array('class' => 'login-container'));?>
		<fieldset>
		<legend><h3>User Login</h3></legend>

			<div class="control-group">
				<div class="controls">
					<input id="username" name = "username" type = "text" value="<?php echo $this->session->flashdata('username'); ?>"  placeholder = "Username" class="field">
					<?php echo $this->session->flashdata('username_error');?>		
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<input id="password" name = "password" type = "password" value="<?php echo $this->session->flashdata('password'); ?>" placeholder = "Password" class="field">
					<?php echo $this->session->flashdata('password_error');?>
					<?php echo form_error('verify_login','<p class="text-error">','</p>'); ?>			
				</div>
			</div>

			<div class="control-group">
				<label for = "password"></label>
				<div class="controls">
					<input type="submit" value="Log in" class = "button-success">	
				</div>
			</div>

		</fieldset>

	</form>
</div>

<?=$this->load->view('module/module_list');?>