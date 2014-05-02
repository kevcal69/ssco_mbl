<div class="form-container">
	<h1>Edit User</h1>	
	<?php echo form_open('admin/user/edit', array('class' => 'form-edit'));?>
		<label class = "static">Choose User to Edit</label>
		<?php echo form_dropdown('users',$users,,'class="field"'); ?>
		<?php echo form_error('users','<p class="error">','</p>');?>
		<input type = "submit" value = "Edit" class="field" id = "submit">
	</form>
</div>
