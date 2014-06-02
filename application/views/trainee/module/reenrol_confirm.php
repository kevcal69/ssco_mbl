<div class="panel panel-warning form-container">
	<div class="panel-heading">
		<h3 class="panel-title">Reenrol in <?php echo $module_title?></h3>
	</div>
	<div class="panel-body">
		<div id="message-content">
			<p>You have already enroled in the 
				"<a href="<?=base_url('trainee/module/view/'. $module_id);?>"><?php echo $module_title;?></a>"
				 module in the past.<br>
				Do you want to reenrol in the module? Doing so will reset your progress.
			</p>
		</div>
	</div>
	<div class="panel-footer">
		<?php echo form_open('trainee/module/enrol/'.$module_id, array('id' => 'reenrol-confirm-form'));?>
			<input type="hidden" value="TRUE" name="reenrol-confirm"/>
			<button class="button-warning" type="submit">Reenrol</button>
			<a class="button" onClick="history.go(-1);window.close();">Cancel</a>
		</form>
	</div>
</div>