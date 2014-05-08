<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?= base_url() .  'assets/plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js';?>"></script>
<div id ="editor-container">
	<form  action = "<?=site_url('admin/module/modify_module')?>" method = "POST">

			<h2>Create Module</h2>
		<div id="field-container">
			<div id="instruction">
				<h3>Notes & Tips</h3>
				<ul>
					<li>It is highly encourage to use proper tag for better output. Computer code for code snippets, h's for heading, and formatted for text format.</li>
					<li>The editor can directly parse copy pasted items.</li>
					<li>Different text style are found on drop down menus. Full screen mode is in toolbar.</li>
					<li>Always check for the content source found on upper left of the toolbar. Next to source toolbar is the save button</li>
				</ul>

				<button  id="hide-btn" onClick = "hide.notes_tips()" class="button-warning" type = "button">Hide</button>
				
			</div>			
			<div class="control-group">
				<label>Title</label>
				<div class="controls">
					<input id="text" name = "title" value = "<?=stripslashes($module->title)?>" type = "text" placeholder = "Title">
					<input name = "id" value = "<?=stripslashes($module->id)?>" type = "hidden">
				</div>
			</div>

			<div class="control-group">
				<label>Description</label>
				<div class="controls">
					<textarea name = "description" ><?=stripslashes($module->description)?></textarea>	
				</div>
			</div>
			<input type = 'submit' value = "Save" class = "button-info" > 
			
		</div>

	<form  action = "<?=site_url('admin/module/modify_module')?>" method = "POST">
		<input type = "hidden" value = "<?=$module->id?>" name = "id">
		<textarea name="editor1" id="editor1" rows="10" cols="80">
			<?=htmlspecialchars(stripslashes($module->content), ENT_HTML5);?>
		</textarea>
		<!-- <input type = 'submit' value = "Finished Editing" id = "c-module-button"> -->
	            <script>
	                // Replace the <textarea id="editor1"> with a CKEditor
	                // instance, using default configuration.

	                var $hc = $("#editor-container").height();
	                var edi = CKEDITOR.replace( 'editor1', {
			height: $hc,
		} );
	               hljs.initHighlightingOnLoad();
	            </script>			
	</form>	
</div>

