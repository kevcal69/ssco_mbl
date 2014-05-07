<div class="form-container">
	<h1>Edit User</h1>	
	<hr>
	<?php echo form_open('admin/user/edit/'.$username, array('class' => 'form-create', 'id' => 'edit-form'));?>
		<div class="control-group">
			<label for = "username">Username</label>
			<div class="controls">
				<input id="username" name = "username" value="<?php echo set_value('username',$username); ?>" type = "text" placeholder = "Username" class="field">
				<?php echo form_error('username','<p class="error">','</p>');?>
				<?php echo form_error('unique_new_username','<p class="error">','</p>');?>
			</div>
		</div>
		
		<div class="control-group">
			<label for = "password">Password</label>
			<div class="controls">
				<input id="password" name = "password" value="<?php echo set_value('password',$password); ?>" type = "password" placeholder = "Password" class="field">
				<?php echo form_error('password','<p class="error">','</p>');?>
			</div>
		</div>

		<div class="control-group">
			<label for = "role">Role</label>
			<div class="controls">
				<?php
					$selectname = 'role';
					$roles = array(
							'admin' => 'Admin',
							'trainee' => 'Trainee',
							'content_manager' => 'Content Manager'
						);
					echo form_dropdown($selectname, $roles, set_value($selectname,$$selectname), 'class="field" id="role" onchange="trainee.toggle()"');
				?>
				<?php echo form_error('role','<p class="error">','</p>');?>
			</div>
		</div>

		<div class="control-group trainee-name">
			<label for="role">First Name</label>
			<div class="controls">
				<input id="first_name" name = "first_name" value="<?php echo set_value('first_name', $first_name); ?>" type = "text" placeholder = "First Name" class="field">
			</div>
		</div>

		<div class="control-group trainee-name">
			<label for="role">Last Name</label>
			<div class="controls">
				<input id="last_name" name = "last_name" value="<?php echo set_value('last_name', $last_name); ?>" type = "text" placeholder = "Last Name" class="field">

				<?php echo form_error('last_name','<p class="error">','</p>');?>
			</div>
		</div>

		<div class="control-group">
			<div class="controls">
				<p class="notice">
					Retrieved password is already hashed.<br>
					New passwords will be hashed when updated.<br>
				</p>
				<button type = "submit" class="button" id = "user_edit_submit">Edit</button>
				<a class="button" onClick="history.go(-1);return true;">Back</a>
			</div>
		</div>
	</form>
</div>