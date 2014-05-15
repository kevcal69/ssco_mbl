<div class="panel form-container">
	<div class="panel-heading"><h3 class="panel-title">Enrol in Module</h3></div>
	<div class="panel-body">
		<?php
			echo form_open('trainee/module/enrol', array('class' => 'form-horizontal'));
			$modules = array('' => 'Select Module to Enrol in') + $modules;
		?>
			<div class="control-group">
				<label for="modules">Choose Module</label>
				<div class="controls">
					<?php echo form_dropdown('modules',$modules,'class="field"', 'class="field" id="modules"'); ?>
					<?php echo form_error('modules','<p class="text-error">','</p>');?>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type = "submit" class="button-primary" id = "module_choose_enrol_submit">Enrol</button>
					<a class="button" href="<?=base_url('trainee/module');?>">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>