<div id="delete-confirm-container" class="panel panel-danger user-container">
	<div class="panel-heading">
		<h3 class="panel-title">Delete User</h3>
	</div>
	<div class="panel-body">
		<div id="message-content">
			<p>Are you sure you want to delete <a href="<?=base_url('admin/user/view/'. $username);?>"><?php echo $username;?></a>?</p>
			<p>Deleting users will also  from the database.</p>
		</div>
	</div>
	<div class="panel-footer">
		<?php echo form_open('admin/user/delete/'.$username, array('id' => 'delete-confirm-form'));?>
			<input type="hidden" value="TRUE" name="confirm"/>
			<button class="button-danger" type="submit">Delete</button>
			<a class="button" onClick="history.go(-1);window.close();">Cancel</a>
		</form>
	</div>
</div>