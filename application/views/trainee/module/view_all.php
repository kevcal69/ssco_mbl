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