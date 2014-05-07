<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<script src="<?= base_url() .  'assets/plugins/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js';?>"></script>
<div id="instruction">
	<h3>Notes & Tips</h3>
	<ul>
		<li>Use h1 or heading 1 for title (always put title on first) and h2 for subtopics. Texts found next to h1 will be considered as module description until a subtopic is found.</li>
		<li>The editor can directly parse copy pasted items.</li>
		<li>Different text style are found on drop down menus. Full screen mode is in toolbar.</li>
		<li>Always check for the content source found on upper left of the toolbar. Next to source toolbar is the save button</li>
	</ul>
	<div id="hide" onclick = "hide.notes_tips()">
		Hide
	</div>
		
</div>
<div id ="editor-container">
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

