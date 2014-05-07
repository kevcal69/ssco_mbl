<div id="header">
	<div id="logo-block">
		<a href="<?= base_url()?>">
			<p id="ssco">SSCO</p>
			<p id="mbl">Module-based Learning</p>
		</a>
	</div>
	<div class="pull-right">
		<div id="navigation">
			<a href="">ABOUT</a>
			<span class="pipe-separator">|</span>
			<a href="">RESOURCES</a>
		</div>
		<?php if ($this->session->userdata('username')): ?>
			<div id="user">
				<span id = "current-user"><?=$this->session->userdata('username')?></span>
				<a href="<?=base_url()  . 'session/logout'?>">Logout</a>
			</div>
		<?php endif; ?>
	</div>

	<div id="bread-crumbs">
		<span><?=$bc?></span>
	</div>
</div>