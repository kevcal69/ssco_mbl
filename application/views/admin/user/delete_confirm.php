<div id="delete-confirm-container" class="user-container">
	<legend id="delete-legend">Delete User</legend>
	<div id="message-content">
		<p class="warning">Are you sure you want to delete <a href="<?=base_url('admin/user/view/'. $username);?>"><?php echo $username;?></a>?</p>
	</div>
	<?php echo form_open('admin/user/delete/'.$username, array('id' => 'delete-confirm-form'));?>
		<input type="hidden" value="TRUE" name="confirm"/>
		<button class="button-danger" type="submit">Delete</button>
		<a class="button" onClick="history.go(-1);">Cancel</a>
	</form>
</div>