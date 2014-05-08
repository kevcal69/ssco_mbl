
	<h1>
		Module List
	</h1>	

<?php if ($this->session->userdata('role')): ?>
	<a href="<?=base_url() . 'admin/module/create'?>">
		<?php if ($this->session->userdata('role') === "admin" or $this->session->userdata('role') === "content_manager"): ?>
			
			<button class = "button-warning" id = "module-add">Create Module</button>
			
		<?php endif; ?>
	</a>
<?php endif; ?>


<?=$this->load->view('module/module_list_admin');?>