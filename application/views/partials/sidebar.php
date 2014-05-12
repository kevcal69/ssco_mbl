<!-- 
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
			<?php foreach ($actions as $link): ?>
			<li <?php if ($link['active'] == TRUE) echo ' class="active"';?>>
				<a href="<?php echo $link['href'];?>"><?php echo $link['content'];?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	<?php endif;?>
</div>