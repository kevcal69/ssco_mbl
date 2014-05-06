<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<div id ="editor-container">
	<form  action = "<?=site_url('module/modify')?>" method = "POST">
		<textarea name="editor1" id="editor1" rows="10" cols="80">
			<?=$module->content;?>
		</textarea>
		<input type = 'submit' value = "Finished Editing" id = "c-module-button">
	            <script>
	                // Replace the <textarea id="editor1"> with a CKEditor
	                // instance, using default configuration.
	                CKEDITOR.replace( 'editor1' );
	            </script>		
	</form>	
</div>

