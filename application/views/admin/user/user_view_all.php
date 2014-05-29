<div id="users-container" class="user-container panel">
	<div class="view-title-bar panel-heading">
		<legend id="view-legend">View All Users</legend>
		<div id="button-group">
			<a class="button" onClick="history.go(-1);window.close();">Back</a>
			<a class="button button-primary" href="<?=base_url('admin/user');?>">Home</a>
		</div>
	</div>
	<div class="panel-body">
		<table id="users-table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Role</th>
					<th>Operations</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($users as $index=>$user): ?>
				<tr>
					<td class="collapse nowrap center"><?php echo ($index + 1);?></td>
					<td>
						<a href="view/<?php echo $user['username'];?>">
							<?php echo $user['username'];?>
						</a>
					</td>
			    <td class="collapse nowrap center"><?php echo $user['role'];?></td>
					<td class="collapse nowrap center">
						<a class="text-muted" href="edit/<?php echo $user['username'];?>">
							<i class="fa fa-edit fa-lg" title="Edit"></i>
						</a>
						<a class="text-error" href="delete/<?php echo $user['username'];?>">
							<i class="fa fa-trash-o fa-lg" title="Delete"></i>
						</a>
					</td>
			  </tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>