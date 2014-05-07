<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
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
	<form  action = "<?=site_url('admin/module/create_module')?>" method = "POST">
		<div id="field-container">
			<input type = "text" placeholder = "Titlte" class = "fields">
			<input type = "text" placeholder = "Description" class = "fields">	
		</div>
		<textarea name="editor1" id="editor1" rows="10" cols="80">
		<h1>Title goes here~~</h1>
		<div>Description</div>
		<h2>Sub Titles</h2>
		</textarea>
		<!-- <input type = 'submit' value = "Create Module" id = "c-module-button"> -->
	            <script>
	                // Replace the <textarea id="editor1"> with a CKEditor
	                // instance, using default configuration.

	                var $hc = $("#editor-container").height();
	                var edi = CKEDITOR.replace( 'editor1', {
			height: $hc,
		} );
	            </script>		
	</form>	
</div>

