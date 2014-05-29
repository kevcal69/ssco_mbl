<div id="module-intro">
	<div id="about">
		<h1>Module-Based Learning</h1>
		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
		<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
	</div>				
</div>

<?php if (!empty($scheduled_test)): ?>
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3 class="panel-title">Scheduled Test</h3>
	</div>
	<div class="panel-body">
		<?php foreach ($scheduled_test as $test): ?>
			<div class="notif notif-info">
				<div class="notif-icon">
					<button type = "button" class = "button-danger flaot-r" id = "stop"  data-tid = "<?=$test->id?>" data-mid = "<?=$test ->module_id?>"><i class="fa fa-fw fa-thumb-tack"></i>Stop the Test</button>
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
		User Stats
	</div>
	<div class="panel-body">
		<table id = "users-stat-table">
			<thead>
				<tr>
					<th>Trainee ID</th>
					<th>Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($user_stats as $user_stat): ?>
				<tr>
					<td><?=$user_stat['user_id']?> : <?=$user_stat['first_name']?> <?=$user_stat['last_name']?></td>
			    		<td>SSCO</td>
					<td>
						<div><a href="<?=base_url() . 'admin/trainee/module_test_view/'.$user_stat['user_id']?>">Module Test Result</a></div>
						<div><a href="<?=base_url() . 'admin/trainee/schedule_test_view/'.$user_stat['user_id']?>" >Scheduled Test Result</a></div>
					</td>
			  </tr>
			<?php endforeach ?>
			</tbody>
		</table>		
	</div>
</div>


