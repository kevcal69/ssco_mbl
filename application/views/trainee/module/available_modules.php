<?php if(!isset($no_container) || $no_container !== TRUE):?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Available Modules</h3>
	</div>
	<?php if (!isset($module_table) || $module_table !== TRUE):?>
		<div class="panel-body">
	<?php endif;?>
<?php endif;?>

		<?php if (!isset($module_table) || $module_table !== TRUE):?>
			<?php if(isset($available_modules) && sizeof($available_modules) > 0):?>
				<?php foreach ($available_modules as $index => $module): ?>
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
				<?php if(!isset($no_container) || $no_container !== TRUE):?>
					<a class="button button-info" href="<?=base_url('trainee/module/view_available_modules')?>">
						View More Modules
					</a>
				<?php endif;?>
			<?php else:?>
				No modules available for enrolment.
			<?php endif;?>

		<?php else:?>
			<?php echo $this->load->view('module/module_list_admin',array('modules' => $available_modules, 'panelbody_only' => TRUE))?>
		<?php endif;?>

<?php if(!isset($no_container) || $no_container !== TRUE):?>
	<?php if (!isset($module_table) || $module_table !== TRUE):?>
		</div>
	<?php endif;?>
</div>
<?php endif;?>