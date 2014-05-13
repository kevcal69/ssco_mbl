<div class="user-container panel">
	<div class="panel-heading"><h3 class="panel-title">Create User</h3></div>
	<div class="panel-body">
		<?php echo form_open('admin/user/create', array('class' => 'form-horizontal', 'id' => 'create-form'));?>

			<div class="control-group">
				<label for="username">Username</label>
				<div class="controls">
					<input id="username" name = "username" value="<?php echo set_value('username'); ?>" type = "text" placeholder = "Username" class="field">
					<?php echo form_error('username','<p class="error">','</p>');?>
					<?php echo form_error('unique_username','<p class="error">','</p>'); ?>
				</div>
			</div>

			<div class="control-group">
				<label for="password">Password</label>
				<div class="controls">
					<input id = "password" name = "password" value="<?php echo set_value('password'); ?>" type = "password" placeholder = "Password" class="field">
					<?php echo form_error('password','<p class="error">','</p>');?>
				</div>
			</div>

			<div class="control-group">
				<label for="role">Role</label>
				<div class="controls">
					<select id = "role" name="role" class="field" onchange="trainee.toggle()">
						<option value="" style='display:none;' disabled selected>Select a Role</option>
						<option value="admin" <?php echo set_select('role', 'admin'); ?>>Admin</option>
						<option value="trainee" <?php echo set_select('role', 'trainee'); ?>>Trainee</option>
						<option value="content_manager" <?php echo set_select('role', 'content_manager'); ?>>Content Manager</option>
					</select>
					<?php echo form_error('role','<p class="error">','</p>');?>
				</div>
			</div>

			<div class="control-group trainee-name">
				<label for="role">First Name</label>
				<div class="controls">
					<input id="first_name" name = "first_name" value="<?php echo set_value('first_name'); ?>" type = "text" placeholder = "First Name" class="field">
				</div>
			</div>

			<div class="control-group trainee-name">
				<label for="role">Last Name</label>
				<div class="controls">
					<input id="last_name" name = "last_name" value="<?php echo set_value('last_name'); ?>" type = "text" placeholder = "Last Name" class="field">
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<button type = "submit" class="button-primary" id = "user_create_submit">Create</button>
					<a type="button" class="button" href="<?php echo base_url('admin/user');?>">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>
