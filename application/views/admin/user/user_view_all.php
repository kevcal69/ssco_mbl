<div id="users-container">
	<div>
		<h1>View All Users</h1>
		<a class="button" onClick="history.go(-1);">Back</a>
		<a class="button" href="<?=base_url('admin/user');?>">Home</a>
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
						edit
					</a>
					<a href="delete/<?php echo $user['username'];?>">
						delete
					</a>
				</td>
		  </tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>