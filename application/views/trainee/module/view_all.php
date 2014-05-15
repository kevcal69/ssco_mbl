<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">All Modules</h3>
	</div>
	<div class="panel-body">
		<?php foreach ($modules as $module): ?>
			<div class="panel">
				<div class="panel-heading">
					<h1 class="panel-title"><a href="<?=base_url('trainee/module/view/'.$module->id)?>"><?=stripslashes($module->title)?></a></h1>
				</div>
				<div class="panel-body">
					<?=stripslashes(strip_tags(word_limiter($module->description, 50)))?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>