<div id="module-intro">
	<div id="about">
		<h1>Module-Based Learning</h1>
		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
	</div>
	<div id="login-container">
		<h1>User Login</h1>	
		<?php echo form_open('session/login', array('class' => 'form-login'));?>
			<label class = "static">Username</label>
			<input name = "username" value="<?php echo $this->session->flashdata('username'); ?>" type = "text" placeholder = "Username" class="field">
			<?php echo $this->session->flashdata('username_error');?>
			
			<label class = "static">Password</label>
			<input name = "password" value="<?php echo $this->session->flashdata('password'); ?>" type = "password" placeholder = "Password" class="field">
			<?php echo $this->session->flashdata('password_error');?>

			<?php echo form_error('verify_login','<p class="error">','</p>'); ?>
			<p>Ask admin for credentials!</p>
			<input type = "submit" value = "Login" class="field" id = "submit">
		</form>
	</div>
</div>
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
			<div class = "module-box">
				<div class="thumb" style = "background-image: url(<?=base_url() . $module->cover_picture;?>);">
					<img src="">

				</div>
				<div class = "mb-title">
					<?=$module->title;?>
				</div>
				<div class="description">
					<?=word_limiter($module->description, 25);?> 
				</div>
				<div class = "mb-more">
					More 
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
						-<?=$module->title;?>
					</span>
				</li>
			</ul>	
		<?php endforeach; ?>
	</div>
</div>