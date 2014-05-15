<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">Module List : Grid View</h3>
	</div>
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
					<div class="thumb" style = "background-image: url(<?=base_url() . $module->cover_picture;?>);">
						<img src="">

					</div>
					<div class = "mb-title">
						<?=$module->title;?>
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
									<li><a href="<?=base_url() . 'admin/module/delete/'.$module->id?>"><button type="button" class = "button-danger">Delete</button></a></li>

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
						<?php endif; ?>
					<?php endif; ?>				

				</div>

			<?php endforeach; ?>			
		</div>
		<div id="list-container">
			<ul>
				<?php foreach ($modules as $module): ?>
						<li class = "list-box">
							<div class="thumb" style = "background-image: url(<?=base_url() . $module->cover_picture;?>);"></div>				
							<div class = "mb-title">
								<p = "m-title" class = "text-primary">
									<?=$module->title;?>
								</p>
								<p = "m-category" class = "text-warning text-size-s1">
									SSCO
								</p>
							</div>		
							<div class="actions">
								<span><a href="<?=base_url() . 'admin/module/view/'.$module->id?>" class = "text-primary text-size-s3">View</a></span>
								<span><a href="<?=base_url() . 'admin/question/create/'.$module->id?>" class = "text-info text-size-s3">Test Q</a></span>
								<span><a href="<?=base_url() . 'admin/module/modify/'.$module->id?>" class = "text-warning text-size-s3">Modify</a></span>
								<span><a href="<?=base_url() . 'admin/module/delete/'.$module->id?>" class = "text-error text-size-s3">Delete</a></span>
							</div>			

						</li>
					
				<?php endforeach; ?>
			</ul>	
		</div>
	</div>
</div>
