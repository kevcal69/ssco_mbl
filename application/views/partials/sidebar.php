<!-- 
<<<<<<< HEAD
	Passing sidebar contents to this view requires one to provide quicklinks and actions arrays.
	Format in controller
		$sidebar_content = array(
			'quicklinks' => array(
				array(
					'content' => 'Users',
					'href' => base_url('admin/user'),
					'active' => TRUE
					),
				array(
					'content' => 'Modules',
					'href' => base_url('admin/module'),
					'active' => FALSE
					)
				),
			'actions' => array(
				array(
					'content' => 'Create User',
					'href' => base_url('admin/user/create'),
					'active' => FALSE
					),
				array(
					'content' => 'View User',
					'href' => base_url('admin/user/view'),
					'active' => FALSE
					)
				)
			);
 -->

<div class="sidebar">
	<ul class="nav nav-pills nav-stacked">
		<li class="header">Quick Links</li>
		<?php foreach ($quicklinks as $link): ?>
		<li <?php if ($link['active'] == TRUE) echo ' class="active"';?>>
			<a href="<?php echo $link['href'];?>"><?php echo $link['content'];?></a>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php if (isset($actions)): ?>
		<ul class="nav nav-pills nav-stacked">
			<li class="header">Actions</li>
			<?php if (isset($search)): ?> 
				<li class = "search"><input type = "text" class = "field" placeholder = "&#xF002; Search for Module"></li>  
			<?php endif;?>
			<?php foreach ($actions as $link): ?>
			<li <?php if ($link['active'] == TRUE) echo ' class="active"';?>>
				<a 
					<?php if(isset($link['href'])): ?>
						href="<?php echo $link['href'];?>" 
					<?php endif;?>
					<?php if(isset($link['extra'])) echo $link['extra'];?>
				>
					<?php echo $link['content'];?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	<?php endif;?>
	<?php if (isset($module_statistics)): ?>
		<ul class="nav nav-pills nav-stacked">
			<li class="header">Statistics</li>
			<li><a><b>Date Enroled:</b><br><i class="fa fa-fw fa-plus"></i> <?php echo format_timestamp($module_statistics['date_enroled'])?></a></li>
			<?php if ($module_statistics['is_completed']):?>
				<li><a><b>Date Completed:</b><br><i class="fa fa-fw fa-check"></i> <?php echo format_timestamp($module_statistics['date_completed'])?></a></li>
				<li><a><b>Rating:</b> <?php echo format_rating($module_statistics['rating'])?></a></li>
				<li><a><b>Times Test Taken:</b> <?php echo $module_statistics['tests_taken']?></a></li>
			<?php endif;?>
		</ul>
	<?php endif;?>
</div>