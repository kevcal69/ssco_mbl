<div id="header">
	<div id="logo-block">
		<a href="<?= base_url()?>">
			<p id="ssco">SSCO</p>
			<p id="mbl">Module-based Learning</p>
		</a>
	</div>
	<div id="navigation">
		<a href="">ABOUT</a>
		<span class="pipe-separator">|</span>
		<a href="">RESOURCES</a>
	</div>
	<?php if ($username == 'sally'): ?>
	<div id="user">
		<span id = "current-user"></span>
	</div>
</div>