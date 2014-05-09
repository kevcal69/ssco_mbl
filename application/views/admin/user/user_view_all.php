<div id="users-container" class="user-container">
	<div class="view-title-bar">
		<legend id="view-legend">View All Users</legend>
		<a class="button button-primary" href="<?=base_url('admin/user');?>">Home</a>
		<a class="button" onClick="history.go(-1);">Back</a>
	</div>
	<table>
		<thead>
			<tr>
				<th></th>
				<th>Username</th>
				<th>Role</th>
				<th>Operations</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $index=>$user): ?>
			<tr>
				<td><?php echo ($index + 1);?></td>
				<td>
					<a href="view/<?php echo $user['username'];?>">
						<?php echo $user['username'];?>
					</a>
				</td>
		    <td><?php echo $user['role'];?></td>
				<td>
					<a href="edit/<?php echo $user['username'];?>">
						<i class="fa fa-edit fa-lg" title="Edit"></i>
					</a>
					<a href="delete/<?php echo $user['username'];?>">
						<i class="fa fa-trash-o fa-lg" title="Delete"></i>
					</a>
				</td>
		  </tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>