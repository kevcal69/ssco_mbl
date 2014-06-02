<?php if(!isset($no_container) || $no_container !== TRUE):?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Current Modules</h3>
	</div>
	<div class="panel-body">
<?php endif;?>

		<?php if(isset($current_modules) && sizeof($current_modules) > 0):?>
			<?php foreach ($current_modules as $module): ?>
				<div class="panel">
					<div class="panel-heading">
						<h1 class="panel-title">
							<a href="<?=base_url('trainee/module/view/'.$module->id)?>">
								<?=stripslashes($module->title)?>
							</a>
							<a class="button button-primary table-button float-r" href="<?=base_url('trainee/module/view/'.$module->id)?>">
								View Module
							</a>
						</h1>
					</div>
					<div class="panel-body">
						<?=stripslashes(strip_tags(word_limiter($module->description, 50)))?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else:?>
			No currently enroled modules.
		<?php endif;?>
		
<?php if(!isset($no_container) || $no_container !== TRUE):?>
	</div>
</div>
<?php endif;?>