<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<?php if($this->session->flashdata('alert')): ?>
<p class="alert text-error"><?=$this->session->flashdata('alert')?>s</p>
<?php endif; ?>

<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Create Module</h3>
	</div>
	<div class="panel-body" id = "create-mod">
		<div class="notif notif-primary">
			<div class="notif-icon">
				<i class="fa fa-fw fa-exclamation-triangle"></i>
			</div>
			<div class="notif-body">
				Notes & Tips
				<ul>
					<li>It is highly encourage to use proper tag for better output. Computer code for code snippets, h's for heading, and formatted for text format.</li>
					<li>The editor can directly parse copy pasted items.</li>
					<li>Different text style are found on drop down menus. Full screen mode is in toolbar.</li>
					<li>Always check for the content source found on upper left of the toolbar. Next to source toolbar is the save button</li>				
					<li>Always check for the source</li>
					<li>Be sure to delete the initial content</li>
					<li>Choices are found below check the checkbox if the choice is an answer</li>
				</ul>				
			</div>
		</div>
		<form  action = "<?=site_url('admin/module/create_module')?>" method = "POST" name = "question">
			<div id="field-container">
				<input type = "text" name = "question[title]"placeholder = "Module Title?" class = "qfield" />
						<div class="controls">
							<textarea name = "description" id = "description" placholder = "Description">
								<span style="color: rgb(128, 128, 128);">Description only (not the entire module content)</span>
							</textarea>	
							<script type="text/javascript">
								CKEDITOR.replace( 'description', {
									resize_enabled : false,
									removePlugins : 'autosave',				
									toolbar: [
										[ 'Source','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
										{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
										'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
										{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
									],
								});
							</script>					
						</div>		
			</div>
			<div id="editor-container">
				<textarea name="editor1" id="editor1" rows="10" cols="80">
					<span style="color: rgb(128, 128, 128);">(Module Content)</span>
				</textarea>
				<script>
					var $hc = $("#editor-container").height();
					var edi = CKEDITOR.replace( 'editor1', {
					height: $hc,
				} );
				</script>				
			</div>
			<button type = "button" class = "button-info float-r" id ="next-content">Next</button>
		</form>

	</div>
</div>