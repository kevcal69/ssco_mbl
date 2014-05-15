<div id="home-container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Current Module</h3>
		</div>
		<div class="panel-body">
			<?php if(isset($current_modules)):?>
				<?php foreach ($current_modules as $module): ?>
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="<?=base_url('trainee/module/view/'.$module->id)?>">
									<?=stripslashes($current_modules->title)?>
								</a>
							</h1>
						</div>
						<div class="panel-body">
							<?=stripslashes(strip_tags(word_limiter($current_modules->description, 50)))?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else:?>
				<p>No currently enroled modules.</p>
			<?php endif;?>
		</div>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Available Modules</h3>
		</div>
		<div class="panel-body">
			<?php if(isset($available_modules)):?>
				<?php foreach ($available_modules as $index => $module): ?>
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="<?=base_url('trainee/module/view/'.$module->id)?>">
									<?=stripslashes($module->title)?>
								</a>
							</h1>
						</div>
						<div class="panel-body">
							<?=stripslashes(strip_tags(word_limiter($module->description, 50)))?>
						</div>
					</div>
				<?php endforeach; ?>
				<a class="button button-info" href="<?=base_url('trainee/module/view')?>">
					View More Modules
				</a>
			<?php else:?>
				<p>No modules available for enrolment.</p>
			<?php endif;?>
		</div>
	</div>
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title">Completed Modules</h3>
		</div>
		<div class="panel-body">
			<?php if(isset($completed_modules)):?>
				<?php foreach ($completed_modules as $module): ?>
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title">
								<a href="<?=base_url('trainee/module/view/'.$module->id)?>">
									<?=stripslashes($module->title)?>
								</a>
							</h1>
						</div>
						<div class="panel-body">
							<?=stripslashes(strip_tags(word_limiter($module->description, 50)))?>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else:?>
				<p>No completed modules yet.</p>
			<?php endif;?>
		</div>
	</div>
</div>