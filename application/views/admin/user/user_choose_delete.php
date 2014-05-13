<div class="panel user-container">
	<div class="panel-heading">
		<h3 class="panel-title">Delete User</h3>
	</div>
	<div class="panel-body">
		<?php
			echo form_open('admin/user/delete', array('class' => 'form-horizontal'));
			$users = array('' => 'Select User to Delete') + $users;
		?>
			<div class="control-group">
				<label for="users">Choose User</label>
				<div class="controls">
					<?php echo form_dropdown('users',$users,'class="field"', 'class="field" id="users"'); ?>
					<?php echo form_error('users','<p class="text-error">','</p>');?>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type = "submit" class="button-danger" id = "user_choose_delete_submit">Delete</button>
					<a class="button" href="<?=base_url('admin/user');?>">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>