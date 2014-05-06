<div class="form-container">
	<h1>Edit User</h1>
	<hr>
	<?php
		echo form_open('admin/user/edit', array('class' => 'form-edit'));
		$users = array('' => 'Select User to Edit') + $users;
	?>
		<div class="control-group">
			<label for="users">Choose User</label>
			<div class="controls">
				<?php echo form_dropdown('users',$users,'class="field"', 'class="field" id="users"'); ?>
				<?php echo form_error('users','<p class="error">','</p>');?>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type = "submit" class="button" id = "user_choose_edit_submit">Edit</button>
				<a class="button" href="<?=base_url('admin/user');?>">Back</a>
			</div>
		</div>
	</form>
</div>
