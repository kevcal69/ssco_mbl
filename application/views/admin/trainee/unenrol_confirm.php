<div class="panel panel-danger form-container">
	<div class="panel-heading">
		<h3 class="panel-title">Unenrol in <?php echo $module_title?></h3>
	</div>
	<div class="panel-body">
		<div id="message-content">
			<p>Are you sure you want to unenrol trainee "<?php echo $trainee?>" from the "
				<a href="<?=base_url('trainee/module/view/'. $module_id);?>">
					<?php echo $module_title;?>
				</a>" module?
			</p>
		</div>
	</div>
	<div class="panel-footer">
		<?php echo form_open('admin/trainee/unenrol/'.$trainee_id.'/'.$module_id, array('id' => 'enrol-confirm-form'));?>
			<input type="hidden" value="TRUE" name="confirm"/>
			<button class="button-danger" type="submit">Unenrol</button>
			<a class="button" onClick="history.go(-1);window.close();">Cancel</a>
		</form>
	</div>
</div>