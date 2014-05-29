<div id="mod-content">
	<h1><?=stripslashes($module->title)?></h1>
	<div><p>
		<?=stripslashes($module->description)?>
	</p></div>
	<hr>
	<?php echo generate_toc(stripslashes($module->content))?>
</div>