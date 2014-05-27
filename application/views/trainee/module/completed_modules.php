<?php if(!isset($no_container) || $no_container !== TRUE):?>
<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Completed Modules</h3>
	</div>
	<div class="panel-body">
<?php endif;?>

		<?php if(isset($completed_modules) && sizeof($completed_modules) > 0):?>
			<?php foreach ($completed_modules as $module): ?>
				<div class="panel">
					<div class="panel-heading">
						<h1 class="panel-title">
							<a href="<?=base_url('trainee/module/view/'.$module->id)?>">
								<?=stripslashes($module->title)?>
							</a>
						</h1>
					</div>
					<div class="panel-body">
						<?=stripslashes(strip_tags(word_limiter($module->description, 50)))?>
					</div>
				</div>
			<?php endforeach; ?>
			<?php if(isset($view_more) && $view_more === TRUE):?>
				<a class="button button-success" href="<?=base_url('trainee/module/view_completed_modules')?>">
					View More Modules
				</a>
			<?php endif;?>
		<?php else:?>
			No completed modules yet.
		<?php endif;?>
		
<?php if(!isset($no_container) || $no_container !== TRUE):?>
	</div>
</div>
<?php endif;?>