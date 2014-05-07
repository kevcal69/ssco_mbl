<div id="module-intro">
	<div id="about">
		<h1>Module-Based Learning</h1>
		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
		<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
	</div>
	<div id="login-container">
		<h1>User Login</h1>	
		<?php echo form_open('session/login', array('class' => 'form-login'));?>
			<div class="field-wrapper">
				<label class = "static">Username</label>
				<input name = "username" value="<?php echo $this->session->flashdata('username'); ?>" type = "text" placeholder = "Username" class="field">
				<?php echo $this->session->flashdata('username_error');?>				
			</div>

			
			<div class="field-wrapper">
				<label class = "static">Password</label>
				<input name = "password" value="<?php echo $this->session->flashdata('password'); ?>" type = "password" placeholder = "Password" class="field">
					<?php echo $this->session->flashdata('password_error');?>
					<?php echo form_error('verify_login','<p class="err">','</p>'); ?>		
			</div>
			<div class="field-wrapper" id = "sub">	
				<p>Ask admin for credentials!</p>		
				<input type = "submit" value = "Login" class="field" id = "submit">	
			</div>
		</form>
	</div>
</div>

<?=$this->load->view('module/module_list');?>