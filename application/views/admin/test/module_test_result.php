<?php if(isset($module_test_result) && !empty($module_test_result)):?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title"><?=$this->mModule->get_title($module_test_result[0]->module_id)?></h3>
	</div>
	<div class="panel-body">
		<?php $var = stats_parser($module_test_result, 'rating')?>
		<?php
			$per = array();
			foreach ($var['percentage_ratings'] as $key => $value) {
				$per[] = round((($value/$var['takers'])*100),1);
				$perVal[] = round(($key*100),3);
			}
		?>
		<script type="text/javascript">
			 var $per = <?php echo json_encode($per);?>;
			 var $perVal = <?php echo json_encode($perVal);?>;
			 $(document).ready(function() {
			 	makepiechart .initialize($per,$perVal);	
			 });
					
		</script>		
		<div class="module-info inner-panel">
			
			<div class="inner-panel-body">
				<div id="thumb" style = "background-image: url(<?=base_url($module_test_result[0]->cover_picture)?>);">
				</div>
				<div class ="info">
					<div class="title">
						<?=$module_test_result[0]->title?>
					</div>
					<div class="description">
						<?=stripslashes(strip_tags(word_limiter($module_test_result[0]->description, 20)))?>
					</div>
					<div class="actions">
						<ul>
							<li><a href="<?php echo base_url('admin/module/view/'.$module_test_result[0]->module_id)?>"> View Module</a></li>
						</ul>
					</div>
					<div class="summary">
						<ul>
							<li>Number of Takers :<?=$var['takers']?></li>
							<li>Overall Percentage Rating :<?=$var['rating_summary']?></li>
						</ul>
					</div>

				</div>

			</div>
		</div>		
		<div id="piechart">		
			<div id="title">Graph Summary</div>
			<canvas id='piechart1' width='200px' height='200px'></canvas>
		 	<div id='legend'></div>
		</div>			
	</div>
</div>	
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Module Test Results</h3>
	</div>
	<div class="panel-body">
		<table id = "module-stat-table">
			<thead>
				<tr>
					<th>Module Test ID</th>
					<th>Date</th>
					<th># : Name</th>
					<th class="collapse nowrap center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($module_test_result as $row): ?>
				<tr>
					<td class = "table-id"><?=$row->id?></td>
					<td class = "table-sw"><?=$row->date?></td>
			    <td><?=$row->trainee_id?> : <?=$row->first_name?>,<?=$row->last_name?></td>
					<td class="collapse nowrap center" id = "more-details" data-id = "<?=$row->id?>"><a href="<?=base_url() . 'admin/test/result/'.$row->id?>" class="actions">Details</a></td>		
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>	
	</div>
</div>
<?php else:?>
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Error</h3>
	</div>
	<div class="panel-body">
	<div class="notif notif-danger">
		<div class="notif-icon">
				<i class="fa fa-fw fa-exclamation-triangle"></i>
		</div>
		<div class="notif-body">
			No Data Found
		</div>
	</div>
	</div>
</div>	
	
<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Module Test Results</h3>
	</div>
	<div class="panel-body">
		<table id = "module-stat-table">
			<thead>
				<tr>
					<th class="collapse nowrap center">Module Test ID</th>
					<th>Date</th>
					<th># : Name</th>
					<th class="collapse nowrap center">Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($module_test_result as $row): ?>
				<tr>
					<td class = "table-id collapse nowrap center"><?=$row->id?></td>
					<td class = "table-sw"><?=$row->date?></td>
			    <td><?=$row->trainee_id?> : <?=$row->first_name?>,<?=$row->last_name?></td>
					<td class="collapse nowrap center" id = "more-details" data-id = "<?=$row->id?>"><a href="<?=base_url() . 'admin/test/result/'.$row->id?>" class="actions">Details</a></td>		
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>	
	</div>
</div>	
<?php endif;?>

