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
			<?php if (isset($module_search) && $module_search === TRUE): ?>
				<li class="sidebar-search">
					<a>
						<?php echo form_open('search',array('class' => 'form-inline'));?>
							<input type="text" name = "search" class="sidebar-searchbox" placeholder="Search Module"><input type="submit" class="sidebar-search-icon" value="&#xF002;">
						</form>
					</a>
				</li>
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