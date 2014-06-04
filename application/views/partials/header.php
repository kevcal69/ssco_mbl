<div id="header">
	<div id="logo-block">
		<a href="<?= base_url()?>">
			<p id="ssco">SSCO</p>
			<p id="mbl">Module-based Learning</p>
		</a>
	</div>
	<div class="pull-right">
		<?php if ($this->session->userdata('username')): ?>
			<div id="user">
				<span id = "current-user"><?=$this->session->userdata('username')?></span>
				<a class="button table-button" href="<?=base_url()  . 'session/logout'?>">Logout</a>
			</div>
		<?php endif; ?>
	</div>

	<div id="bread-crumbs">
		<span><?php echo set_breadcrumb(); ?></span>
	</div>
</div>