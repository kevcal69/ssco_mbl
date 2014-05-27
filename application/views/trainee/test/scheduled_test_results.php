<?php if (sizeof($scheduled_test_results) > 0): ?>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Module</th>
				<th>Date</th>
				<th>Rating</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($scheduled_test_results as $result):?>
				<tr>
					<td class="collapse nowrap center"><?php echo $result->test_id?></td>
					<td><?php echo $this->module_model->get_title($result->module_id)?></td>
					<td><?php echo format_timestamp($result->date)?></td>
					<td class="collapse nowrap center"><?php echo format_rating($result->rating)?></td>
					<td class="collapse nowrap center"><a class="button button-primary table-button" href="<?php echo base_url('trainee/scheduled_test/result/'.$result->id)?>">View Result</a></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
<?php else:?>
	No entries.
<?php endif;?>