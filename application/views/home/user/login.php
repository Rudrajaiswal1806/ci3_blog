<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success"><?=$this->session->flashdata('success');?></div>
			<?php endif; ?>
			<?php if($this->session->flashdata('error')): ?>
				<div class="alert alert-danger"><?=$this->session->flashdata('error');?></div>
			<?php endif; ?>
			<form method="post">
				<div class="form-group">
					<label>Email Id</label>
					<input type="email" class="form-control" name="email" required="">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" required="" class="form-control">
				</div>
				
				<div class="form-group">
					<button class="btn btn-md" name="save">Login</button>
					<a href="<?=base_url('register');?>">Register</a>
				</div>
			</form>
		</div>
	</div>
</div>