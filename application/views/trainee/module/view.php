<?php if (isset($completed)):?>
	<div class="panel panel-success">
		<div class="panel-heading">
			<span class="close-panel"><i class = "fa fa-times fa-fw"></i></span>
			<h3 class="panel-title">Module Completed</h3>
		</div>
		<div class="panel-body">
			You have completed this module. You can reenrol or retake the test for this module by clicking on the link in the sidebar.
		</div>
	</div>
<?php elseif (isset($enroled)):?>
	<div class="panel panel-info">
		<div class="panel-heading">
			<span class="close-panel"><i class = "fa fa-times fa-fw"></i></span>
			<h3 class="panel-title">Enroled in Module</h3>
		</div>
		<div class="panel-body">
			You are currently enroled in this module. You can take the test for this module by clicking on the link in the sidebar.
		</div>
	</div>
<?php else:?>
	<div class="panel panel-warning">
		<div class="panel-heading">
			<span class="close-panel"><i class = "fa fa-times fa-fw"></i></span>
			<h3 class="panel-title">Not Enroled in Module</h3>
		</div>
		<div class="panel-body">
			You are currently not enroled in this module. You can enrol in this module by clicking on the link in the sidebar.
		</div>
	</div>
<?php endif;?>
<div id="mod-content">
	<h1><?=stripslashes($module->title)?></h1>
	<div><p>
		<?=stripslashes($module->description)?>
	</p></div>
	<hr>
	<?php echo generate_toc(stripslashes($module->content))?>
</div>