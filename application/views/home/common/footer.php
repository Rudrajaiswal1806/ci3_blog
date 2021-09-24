<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
       	<form method="post" id="save-comment">
       		<div class="form-group">
       			<label>Comment</label>
       			<textarea id="comment-text" name="comment" class="form-control" required=""></textarea>
       		</div>
       		<div class="form-group">
       			<input type="hidden" id="bid" name="id">
       			<input type="hidden" id="update-cmt">
       			<button class="btn btn-success btn-sm">save</button>
       		</div>
       	</form> 
       </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>

<script src="<?=base_url('js/jquery-3.6.0.min.js');?>" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 
<script type="text/javascript">
	$(document).ready(function(){
		$("#reg-email").blur(function(){
			let check_email = $(this).val();
			$("#email-error").text('');
			if(check_email)
			{
				$.ajax({
					data:{check_email:check_email},
					type:'post',
					dataType:'json',
					success:function(data)
					{
						if(data.avl  < 1 )
						{
							$("#email-error").text(data.msg);
							$("#reg-email").val('').focus();
						}
						else{
							$("#email-error").text('');
						}
					}
				})
			}
		});
		$("#reg-cpsw").blur(function(){
			let psw = $("#reg-psw").val();
			let cpsw = $("#reg-cpsw").val();
			if(psw && cpsw)
			{
				if(psw !== cpsw)
				{
					alert('both password not match');
					$("#reg-psw,#reg-cpsw").val('');
					$("#reg-psw").focus();
					return false;
				}
			}
		});
		$("#blog-list").on('click','.delete-comment',function(){
			let bid = $(this).data('blog-id');
			$.ajax({
				data:{bid:bid},
				type:'post',
				dataType:'json',
				success:function(data)
				{
					if(data.msg )
					{
						alert(data.msg);
						location.reload();
					}
				}
			})	
		
		});

		$("#blog-list").on('click','.like-btn',function(){
			let obj=$(this);
			let id = $(this).data('blog-id');
			$.ajax({
				url:"<?=base_url('like-blog');?>",
				data:{id:id},
				type:'post',
				dataType:'json',
				success:function(data)
				{
					if(data.msg )
					{
						alert(data.msg);
					}
				}
			})
		});
		$("#blog-list").on('click','.comment-btn',function(){
			let id = $(this).data('blog-id');
			$("#bid").val(id);
			let title = $(this).data('title');
			if(id)
			{
				$(".modal-title").text(title);
				$("#myModal").modal();
			}
		});
		$("#blog-list").on('click','.comment-update',function(){
			let id = $(this).data('blog-id');
			let comt = $(this).data('comment');
			$("#bid").val(id);
			let title = $(this).data('title');
			$("#update-cmt").val(1);
			if(id)
			{
				$(".modal-title").text(title);
				$("#comment-text").text(comt);
				$("#myModal").modal();
			}
		});
		$("#save-comment").on('submit',function(e){
			e.preventDefault();
			let url = "";
			var update = $("#update-cmt").val();
			if(update)
			{
				url = "<?=base_url('update-comment');?>";
			}
			else{
				url = "<?=base_url('save-comment');?>"
			}

			$.ajax({
				url:url,
				data:$(this).serialize(),
				type:'post',
				dataType:'json',
				success:function(data)
				{
					if(data.msg)
					{
						alert(data.msg);
						$("#myModal").modal('hide');
						$("#save-comment")[0].reset();
						location.reload();
						return false;
					}
				}
			})
		});
	});
</script>