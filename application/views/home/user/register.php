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
					<input type="email" id="reg-email" class="form-control" name="email" required="">
					<span id="email-error" style="color: red;"></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input id="reg-psw" type="password" name="password" required="" class="form-control">
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input id="reg-cpsw" type="password" name="cpassword" required="" class="form-control">
				</div>
				<div class="form-group">
					<button class="btn btn-md" value="1" name="save">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>