<div id = "module-container">
	<h1>Modules</h1>
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
			<div class = "module-box" onclick="modules.box_click(this)">
				<div class="thumb" style = "background-image: url(<?=base_url() . $module->cover_picture;?>);">

				</div>
				<div class = "mb-title">
					<?=$module->title;?>
				</div>
				<div class="description">
					<?=word_limiter($module->description, 20);?> 
				</div>	
			</div>
		<?php endforeach; ?>			
	</div>
	<div id="list-container">
		<?php foreach ($modules as $module): ?>
			<ul>
				<li>
					<span class= "topic">
						<?=$module->title;?>
					</span>
				</li>
			</ul>	
		<?php endforeach; ?>
	</div>
</div>