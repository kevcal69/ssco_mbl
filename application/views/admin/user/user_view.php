<div id="view-container" class="user-container">
	<div class="view-title-bar">
		<legend id="view-legend"><?php echo $username;?></legend>
		<a class="button button-danger" href="<?=base_url('admin/user/delete/'.$username);?>">Delete</a>
		<a class="button button-primary" href="<?=base_url('admin/user/edit/'.$username);?>">Edit</a>
		<a class="button" onClick="history.go(-1);">Back</a>
	</div>
	<hr>
	<div id="profile-content" class="form-horizontal">
		<div class="control-group">
			<label class="label">Username</label>
			<label class="value"><?php echo $username;?></label>
		</div>
		<div class="control-group">
			<label class="label">Role</label>
			<?php if ($role === 'admin'): ?>
				<label class="value">Admin</label>
			<?php elseif ($role === 'trainee'): ?>
				<label class="value">Trainee</label>
			<?php elseif ($role === 'content_manager'): ?>
				<label class="value">Content Manager</label>
			<?php endif; ?>
		</div>
		<?php if (isset($first_name)): ?>
			<div class="control-group">
				<label class="label">First Name</label>
				<label class="value"><?php echo $first_name;?></label>
			</div>
		<?php endif;?>
		<?php if (isset($last_name)): ?>
			<div class="control-group">
				<label class="label">Last Name</label>
				<label class="value"><?php echo $last_name;?></label>
			</div>
		<?php endif;?>
	</div>
</div>