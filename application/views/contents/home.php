<div id="module-intro">
	<div id="about">
		<h1>Module-Based Learning</h1>
		<p>SSCO Module-Based Learning is an e-learning tool primarily designed for the new hires of the SSCO department. </p>
		<p>Its goal is to enable the new employees to more effectively learn and understand SSCO’s voluminous training documents by presenting information in easy-to-understand modules which they can take at their own pace.</p>
	</div>
	<div class="panel login-container">
		<div class="panel-heading">
			<h3 class="panel-title">User Login</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open('session/login');?>

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
						<div class="controls">
							<input type="submit" value="Log in" class = "button-primary">
						</div>
					</div>
			</form>
		</div>
	</div>
</div>