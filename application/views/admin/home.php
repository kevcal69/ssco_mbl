<?php if (isset($scheduled_tests)):?>
	<?php foreach ($scheduled_tests as $test):?>
		<?php echo $this->load->view('admin/test/scheduled_test_notice',$test);?>
	<?php endforeach;?>
<?php endif;?>
<div id="options-container">
	<div class="options">
		<a href = "<?=base_url() . 'admin/user';?>">
			<div class="thumb" style = "background-image: url(<?=base_url() . 'assets/images/admin/user.png';?>);" >

			</div>
			<div class ="text-options">
				<div class="action">
					Users
				</div>
				<div class="des">
					Add, View, Edit and Delete Users
				</div>
			</div>
		</a>
	</div>
	<div class="options">
		<a href = "<?=base_url() . 'admin/module';?>">
			<div class="thumb" style = "background-image: url(<?=base_url() . 'assets/images/admin/modules.png';?>);"></div>
			<div class="text-options">
				<div class="action">
					Modules
				</div>
				<div class="des">
					Create, View, and Edit Modules
				</div>
			</div>
		</a>
	</div>
	<div class="options" >
		<a href = "<?=base_url() . 'admin/test';?>">	
			<div class="thumb" style = "background-image: url(<?=base_url() . 'assets/images/admin/test.png';?>);">
			</div>
			<div class="text-options">
				<div class="action">
					Tests
				</div>
				<div class="des">
					Tests and Test Results
				</div>	
			</div>
		</a>
	</div>
	<div class="options" >
		<a href = "<?=base_url() . 'admin/test';?>">	
			<div class="thumb" style = "background-image: url(<?=base_url() . 'assets/images/admin/trainee.png';?>);">
			</div>
			<div class="text-options">
				<div class="action">
					Trainees
				</div>
				<div class="des">
					Trainee Enrolment and Test Results
				</div>	
			</div>
		</a>
	</div>
</div>


