<div class="panel panel-warning form-container">
	<div class="panel-heading">
		<h3 class="panel-title">Retake test for <?php echo $module_title?></h3>
	</div>
	<div class="panel-body">
		<div id="message-content">
			<p>You have already taken the test for the "
				<a href="<?=base_url('trainee/module/view/'. $module_id);?>">
					<?php echo $module_title;?>
				</a>" module in the past.<br><br>
				Do you want to retake the test? The test results will be recorded.
			</p>
		</div>
	</div>
	<div class="panel-footer">
		<?php echo form_open('trainee/test/take/'.$module_id, array('id' => 'retake-confirm-form'));?>
			<input type="hidden" value="TRUE" name="retake-confirm"/>
			<button class="button-warning" type="submit">Retake</button>
			<a class="button" href="<?=base_url('trainee/module/view/'. $module_id);?>">Cancel</a>
		</form>
	</div>
</div>