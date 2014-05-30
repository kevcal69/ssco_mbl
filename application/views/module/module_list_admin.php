<?php if (!isset($panelbody_only) OR $panelbody_only !== TRUE):?>
<div class="panel">
	<div class="panel-heading">
		<h3 class="panel-title" id="module-list-panel-title">Module List : List View</h3>
	</div>
<?php endif;?>
	<div id = "module-container" class = "panel-body">
		<div id = "module-liststyle">
			<div class="liststyles">
				<img src="<?=base_url().'assets/images/landing/list.png'?>" alt ="list" onclick = "modules.toggle_to_list()">
			</div>
			<div class="liststyles">
				<img src="<?=base_url().'assets/images/landing/grid.png'?>" alt ="grid" onclick = "modules.toggle_to_grid()">

			</div>
		</div>
		<div id="grid-container">
			<?php foreach ($modules as $module): ?>
				<div class = "module-box">
					<div class="thumb" style = "background-image: url(<?=base_url() . $module->cover_picture;?>);"></div>
					<div class = "mb-title">
						<?=character_limiter($module->title,25);?>
					</div>
					<div class="description">
						<?=stripslashes(strip_tags(word_limiter($module->description, 20)))?>
					</div>
					<?php if ($this->session->userdata('role')): ?>
						<?php if ($this->session->userdata('role') === "admin"): ?>
							<div class="actions grid ">
								<ul>
									<li><a href="<?=base_url() . 'admin/module/view/'.$module->id?>"><button type="button" class = "button-primary">View</button></a></li>
									<li><a href="<?=base_url() . 'admin/question/create/'.$module->id?>"><button type="button" class = "button-info">Test Q</button></a></li>
									<li><a href="<?=base_url() . 'admin/module/modify/'.$module->id?>"><button type="button" class = "button-warning">Modify</button></a></li>
									<li><a href="<?=base_url() . 'admin/module/delete/'.$module->id?>" onClick="if(confirm('Do you really want to delete this module?'))return true; else return false;"><button type="button" class = "button-danger">Delete</button></a></li>

								</ul>
							</div>	
							<?php elseif ($this->session->userdata('role') === "trainee"): ?>
							<div class="actions grid ">
								<ul>
									<li><a class="button" href="<?=base_url('trainee/module/view/'.$module->id)?>">View</a></li>
									<li><a class="button button-primary" href="<?=base_url('trainee/module/enrol/'.$module->id)?>">Enrol</a></li>
								</ul>
							</div>	
							<?php elseif ($this->session->userdata('role') === "content_manager"): ?>
							<div class="actions grid ">
								<ul>
									<li>View</li>
									<li>Modify</li>
									<li>Delete</li>
								</ul>
							</div>
						<?php endif; ?>
					<?php endif; ?>

				</div>

			<?php endforeach; ?>
		</div>
		<div id="list-container">
			<table class="module-table-admin">
				<thead>
					<tr>
						<th>ID</th>
						<th>Module Title</th>
						<th>Category</th>
						<th>Actions</th>
						<th style="display:none;">Description</th>
						<th style="display:none;">Content</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($modules as $module): ?>
					<tr>
						<td class="collapse nowrap center"><?=$module->id?></td>
						<td>
							<?=$module->title?>
						</td>
				    		<td>SSCO</td>
						<?php if ($this->session->userdata('role')): ?>
							<?php if ($this->session->userdata('role') === "admin"): ?>
								<td>
									<div class="actions">
										<span><a href="<?=base_url() . 'admin/module/view/'.$module->id?>" class = "text-primary text-size-s3">View</a></span>
										<span><a href="<?=base_url() . 'admin/question/create/'.$module->id?>" class = "text-info text-size-s3">Test Q</a></span>
										<span><a href="<?=base_url() . 'admin/module/modify/'.$module->id?>" class = "text-warning text-size-s3">Modify</a></span>
										<span><a href="<?=base_url() . 'admin/module/delete/'.$module->id?>" class = "text-error text-size-s3" onClick="if(confirm('Do you really want to delete this module?'))return true; else return false;">Delete</a></span>
									</div>
								</td>
							<?php elseif ($this->session->userdata('role') === "trainee"): ?>
								<td class="collapse nowrap center">
									<a class="button table-button" href="<?=base_url('trainee/module/view/'.$module->id)?>" class = "text-info text-size-s3">View</a>
									<a class="button button-primary table-button" href="<?=base_url('trainee/module/enrol/'.$module->id)?>" class = "text-primary text-size-s3">Enrol</a>
								</td>
							<?php endif; ?>
						<?php endif; ?>
						<td style="display:none;"><?=stripslashes(strip_tags($module->description))?></td>
						<td style="display:none;"><?=stripslashes($module->content)?></td>
				  </tr>
				<?php endforeach ?>
				</tbody>
			</table>			
		</div>
	</div>
<?php if (!isset($panelbody_only) OR $panelbody_only !== TRUE):?>
</div>
<?php endif; ?>
