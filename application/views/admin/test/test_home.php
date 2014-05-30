<?php if (!empty($scheduled_test)): ?>
<div class="panel">
	<div class="panel-heading">
	<span class="close-panel"><i class = "fa fa-times fa-fw"></i></span>
		<h3 class="panel-title">Scheduled Test</h3>
	</div>
	<div class="panel-body">
		<?php foreach ($scheduled_test as $test): ?>
			<div class="notif notif-warning">
				<div class="notif-icon">
					<button type = "button" class = "button-danger table-button" id = "stop"  data-tid = "<?=$test->id?>" data-mid = "<?=$test ->module_id?>"><i class="fa fa-fw fa-thumb-tack"></i>Stop the Test</button>
				</div>
				<div class="notif-body">
					Module No: <?=$test ->module_id?> : 
				</div>
			</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif; ?>

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Search Module</h3>
	</div>
	<div class="panel-body input-module">
		<div class="controls">		
			<input list="module-list" name="module" class="qfield" id="module-search" placeholder="Enter Module Title" />
			<datalist id="module-list">
				<?php foreach ($modules as $module):?>
					<option value="<?=$module->title?>">
				<?php endforeach;?>
			</datalist>
			<hr/>
		</div>	
		<div class="results-field">
			

		</div>	
	</div>
	<div class="panel-footer">
			<table class="module-stat-table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Module Title</th>
						<th class="collapse nowrap center">Category</th>
						<th class="collapse nowrap center">Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($modules as $module): ?>
					<tr>
						<td class="collapse nowrap center"><?=$module->id?></td>
						<td>
							<?=$module->title?>
						</td>
				    <td class="collapse nowrap center">SSCO</td>
						<td class="collapse nowrap center">
							
							<a href = "<?=base_url('admin/test/module_test_view/'.$module->id)?>" class = "actions"><span>Module Test Results</span></a>
							<a href = "<?=base_url('admin/test/schedule_test_view/'.$module->id)?>" class = "actions"><span>Schedule Test Results</span></a>
							<a href = "<?=base_url('admin/question/test_set_up/'.$module->id)?>" class = "actions"><span>Set up a Scheduled Test</span></a>
						
						</td>
				  </tr>
				<?php endforeach ?>
				</tbody>
			</table>		
	</div>
</div>

