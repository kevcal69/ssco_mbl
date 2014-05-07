<div class="title-bar">
	<div class="title-container">
		<div class="title">
			<h1>
				Module List
			</h1>			
		</div>

		<?php if ($this->session->userdata('role')): ?>
			<a href="<?=base_url() . 'admin/module/create'?>">
				<?php if ($this->session->userdata('role') === "admin" or $this->session->userdata('role') === "content_manager"): ?>
					<div id="module-add">
						<img src="<?=base_url().'assets/images/admin/add-icon.png'?>">
						<span>Create Module</span>
					</div>									
				<?php endif; ?>
			</a>
		<?php endif; ?>

	</div>
</div>
<?=$this->load->view('module/module_list_admin');?>