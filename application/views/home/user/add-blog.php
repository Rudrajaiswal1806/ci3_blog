<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?php if($this->session->flashdata('success')): ?>
				<div class="alert alert-success"><?=$this->session->flashdata('success');?></div>
			<?php endif; ?>
			<?php if($this->session->flashdata('error')): ?>
				<div class="alert alert-danger"><?=$this->session->flashdata('error');?></div>
			<?php endif; ?>
			<form method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Category Title</label>
					<select class="form-control" name="cate_id" required="">
						<option>select</option>
						<?php if(!empty($category)):foreach($category as $c): ?>
							<option value="<?=$c->id;?>"><?=$c->title;?></option>
						<?php endforeach;endif; ?>
					</select>
				</div>
			<div class="form-group">
				<label>Blog Title</label>
				<input type="text" name="title" class="form-control" >
			</div>
			<div class="form-group">
				<label>Content</label>
				<textarea class="form-control" name="content" cols="10" rows="10" required=""></textarea>
			</div>

			<div class="form-group">
				<label>Image</label>
				<input type="file" name="image" class="form-control">
			</div>
				<div class="form-group">
					<button class="btn btn-md" value="1" name="save">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>