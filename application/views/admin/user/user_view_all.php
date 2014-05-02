<div id="users-container">
	<table>
		<tr>
			<th></th>
			<th>Username</th>
			<th>Role</th>
			<th></th>
		</tr>
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
			</td>
	  </tr>
	<?php endforeach ?>
	</table>
</div>