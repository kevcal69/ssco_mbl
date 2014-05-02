<div class="form-container">
	<h1>Edit User</h1>	
	<?php echo form_open('admin/user/edit/'.$username, array('class' => 'form-create'));?>
		<label class = "static">Username</label>
		<input name = "username" value="<?php echo set_value('username',$username); ?>" type = "text" placeholder = "Username" class="field">
		<?php echo form_error('username','<p class="error">','</p>');?>
		<?php echo form_error('unique_new_username','<p class="error">','</p>');?>
		
		<label class = "static">Password</label>
		<input name = "password" value="<?php echo set_value('password',$password); ?>" type = "password" placeholder = "Password" class="field">
		<?php echo form_error('password','<p class="error">','</p>');?>

		<label class = "static">Role</label>
		<!-- <select name="role" class="field">
			<option value="" style='display:none;' disabled selected>Select a Role</option>
			<option value="admin" <?php echo set_select('role', 'admin'); ?>>Admin</option>
			<option value="trainee" <?php echo set_select('role', 'trainee'); ?>>Trainee</option>
			<option value="content_manager" <?php echo set_select('role', 'content_manager'); ?>>Content Manager</option>
		</select> -->
		<?php
			$selectname = 'role';
			$roles = array(
					'admin' => 'Admin',
					'trainee' => 'Trainee',
					'content_manager' => 'Content Manager'
				);
			echo form_dropdown($selectname, $roles, set_value($selectname,$$selectname), 'class="field"');
		?>
		<?php echo form_error('role','<p class="error">','</p>');?>
		<p>
			Retrieved password is already hashed.	New passwords will be hashed when updated.
		</p>
		<input type = "submit" value = "Edit" class="field" id = "submit">
	</form>
</div>