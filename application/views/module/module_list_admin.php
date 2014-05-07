<div id = "module-container">
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
				<?php if ($this->session->userdata('role')): ?>
					<?php if ($this->session->userdata('role') === "admin"): ?>
						<div class="actions grid ">
							<ul>
								<a href="<?=base_url() . 'admin/module/view/'.$module->id?>"><li>View</li></a>
								<a href="<?=base_url() . 'admin/module/modify/'.$module->id?>"><li>Modify</li></a>
								<a href="<?=base_url() . 'admin/module/delete/'.$module->id?>"><li>Delete</li></a>
							</ul>
						</div>	
						<?php elseif ($this->session->userdata('role') === "trainee"): ?>
						<div class="actions grid ">
							<ul>
								<li>View</li>
								<li>Modify</li>
								<li>Delete</li>
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
				<div class="thumb" style = "background-image: url(<?=base_url() . $module->cover_picture;?>);">
					<img src="">

				</div>
				<div class = "mb-title">
					<?=$module->title;?>
				</div>
				<div class="description">
					<?=strip_tags(word_limiter($module->description, 20));?> 
				</div>

			</div>
		<?php endforeach; ?>			
	</div>
	<div id="list-container">
		<?php foreach ($modules as $module): ?>
			<ul>
				<li>
					<span class= "topic">
						<img id ="arrow" src="<?=base_url() . 'assets/images/module/module_default/arrow.png'?>">
						<?=$module->title;?>
					</span>
				</li>
			</ul>	
		<?php endforeach; ?>
	</div>
</div>