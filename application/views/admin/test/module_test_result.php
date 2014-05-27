<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Module Test Result</h3>
	</div>
	<div class="panel-body">
		<table id = "module-stat-table">
			<thead>
				<tr>
					<th>Module Test ID</th>
					<th>Date</th>
					<th># : Module Title</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($module_test_result as $row): ?>
				<tr>
					<td class = "table-id"><?=$row->id?></td>
					<td class = "table-sw"><?=$row->date?></td>
			    		<td><?=$row->module_id?> : <?=$row->title?></td>
					<td  id = "more-details" data-id = "<?=$row->id?>"><a href="<?=base_url() . 'admin/test/result/'.$row->id?>">More Details</a></td>

								
			  </tr>
			<?php endforeach ?>
			</tbody>
		</table>	
	</div>
	<div class="panel-footer">Panel footer</div>
</div>