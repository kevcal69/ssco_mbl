<div id="create-container">
	<h1>Create User</h1>
	<hr>
	<?php echo form_open('admin/user/create', array('class' => 'form-create'));?>
		<label for="username">Username</label>
		<input id="username" name = "username" value="<?php echo set_value('username'); ?>" type = "text" placeholder = "Username" class="field">
		<?php echo form_error('username','<p class="error">','</p>');?>
		<?php echo form_error('unique_username','<p class="error">','</p>'); ?>
		
		<label for="password">Password</label>
		<input id = "password" name = "password" value="<?php echo set_value('password'); ?>" type = "password" placeholder = "Password" class="field">
		<?php echo form_error('password','<p class="error">','</p>');?>

		<label for="role">Role</label>
		<select id = "role" name="role" class="field">
			<option value="" style='display:none;' disabled selected>Select a Role</option>
			<option value="admin" <?php echo set_select('role', 'admin'); ?>>Admin</option>
			<option value="trainee" <?php echo set_select('role', 'trainee'); ?>>Trainee</option>
			<option value="content_manager" <?php echo set_select('role', 'content_manager'); ?>>Content Manager</option>
		</select>
		<?php echo form_error('role','<p class="error">','</p>');?>
		<input type = "submit" value = "Create" class="field" id = "submit">
	</form>
</div>