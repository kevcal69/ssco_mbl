<div id="view-container">
	<div>
		<h1><?php echo $username;?></h1>
		<a class="button" onClick="history.go(-1);">Back</a>
		<a class="button" href="<?=base_url('admin/user/edit/'.$username);?>">Edit</a>
	</div>
	<hr>
	<div id="profile-content">
		<div class="control-group">
			<label class="label">Username</label>
			<label class="value"><?php echo $username;?></label>
		</div>
		<div class="control-group">
			<label class="label">Role</label>
			<label class="value"><?php echo $role;?></label>
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