<script src="<?= base_url() . 'assets/plugins/ckeditor/ckeditor.js'; ?>"></script>
<script src="<?= base_url() . 'assets/plugins/ckeditor/adapters/jquery.js'; ?>"></script>
<?php if($this->session->flashdata('alert')): ?>
<p class="alert text-error"><?=$this->session->flashdata('alert')?>s</p>
<?php endif; ?>
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title">Modify Module: <?=$module->title?></h3>
	</div>
	<form enctype='multipart/form-data' action = "<?=site_url('admin/module/modify_module')?>" method = "POST" name = "question">
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
					<li>Tags can be found at the bottom.</li>
					<li>Include your title in your tags. Preferable separate per space</li>
				</ul>				
			</div>
		</div>
			<div id="field-container">
				<input type = "text" name = "title" value = "<?=stripslashes($module->title)?>" placeholder = "Module Title?" class = "qfield" />
				<input name = "id" value = "<?=stripslashes($module->id)?>" type = "hidden">
						<textarea name = "description" id = "description" placholder = "Description">
							<?=stripslashes($module->description)?>
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
				<div id="cover-picture-container" class="panel">
					<div class="center panel-body">
						<img id="cover-picture-preview" src="<?php echo base_url($module->cover_picture);?>" title="cover picture"/>
						<?php if ($this->session->flashdata('cover_pic_errors')):?>
							<?php foreach ($this->session->flashdata('cover_pic_errors') as $error):?>
								<?php echo $error;?>
							<?php endforeach;?>
						<?php endif;?>
					</div>
				</div>
				<div class="button-group  float-l">
					<label class="button">
						<input id="cover-picture-upload" type="file" name="cover-picture-upload" accept="image/*"/>
						Cover Picture
					</label>
				</div>
			</div>

			<div id="editor-container">
				<textarea name="editor1" id="editor1" rows="10" cols="80">
					<?=htmlspecialchars(stripslashes($module->content), ENT_HTML5);?>
				</textarea>
				<script>
					var $hc = $("#editor-container").height();
					var edi = CKEDITOR.replace( 'editor1', {
					height: $hc,
				} );
				</script>				
			</div>
			<button type = "button" class = "button-info float-r" id ="next-content">Next</button>
		</div>
		<div class="panel-footer tags-section">
				<span>TAGS :</span>
				<input type = "text" id = "tag-input" list = "tag-list" placeholder = "Place tag and press enter (5 maximum tags)" class = "field tag-field" />
				<datalist id="tag-list">
					<?php foreach ($taglist as $tagli):?>
						<option value="<?=$tagli->tags?>"></option>
					<?php endforeach;?>
				</datalist>		
				<div class = "tag-list">
					<?php foreach ($tags as $tag): ?>
						<button type = "button" class = "button-warning button-tags table-button">
						<?=$tag->tags?><input  type = "hidden" value = "<?=$tag->tags?>" name = "tags[]">
						<i class = "fa fa-times-circle fa-fw close-parent"></i>
						</button>
					<?php endforeach; ?>
				</div>
		</div>
	</form>
</div>

