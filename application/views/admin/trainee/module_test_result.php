<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">
			User Information
		</h3>
	</div>
	<div class="panel-body">

		<div class="table vertical-headings test-result-table">
			<div class="tr">
				<div class="th">Id</div>
				<div class="td"><?=$tid?></div>
			</div>
			<div class="tr">
				<div class="th">First Name</div>
				<div class="td"><?=$user_info['first_name']?></div>
			</div>
			<div class="tr">
				<div class="th">Last Name</div>
				<div class="td"><?=$user_info['last_name']?></div>
			</div>
		</div>

	</div>
</div>
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Search Module</h3>
	</div>
	<div class="panel-body input-module-trainee">
		<div class="controls">		
			<input list="module-list" data-tid = "<?=$tid?>"name="module" class="qfield" id="module-search" placeholder="Enter Module Title" />
			<datalist id="module-list">
				<?php foreach ($modules as $module):?>
					<option value="<?=$module->title?>"></option>
				<?php endforeach;?>
			</datalist>
			<hr/>
		</div>	
		<div class="results-field">
			

		</div>	
	</div>
</div>

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
					<th class="collapse nowrap center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($module_test_result as $row): ?>
				<tr>
					<td class = "table-id"><?=$row->id?></td>
					<td class = "table-sw"><?=$row->date?></td>
			    <td><?=$row->module_id?> : <?=$row->title?></td>
					<td class="collapse nowrap center" id = "more-details" data-id = "<?=$row->id?>"><a href="<?=base_url() . 'admin/test/result/'.$row->id?>">More Details</a></td>		
			  </tr>
			<?php endforeach ?>
			</tbody>
		</table>	
	</div>
</div>