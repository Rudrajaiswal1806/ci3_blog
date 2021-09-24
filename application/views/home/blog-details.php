<style type="text/css">
  .card{padding: 5px;border:2px solid brown;margin:10px;}
  .card-header{padding:3px;font-weight:bold;}
  .comment-box{border:1px solid grey;padding:5px;margin-top: 5px;}
</style>
<div class="container">
  <div class="row">
    <div class="col-sm-12" id="blog-list">
     
         <?php if(!empty($record)): ?>
        <div class="col-sm-12">
           <div class="card" style="min-height: 600px;">
          <div class="card-header"><?=$record->title;?></div>
          <div class="card-body">
            <?php if(!empty($record->image)): ?>
            <div><img style="width:100%;height: 300px;" src="<?=base_url('blog-img').'/'.$record->image;?>"></div>
          <?php endif; ?>
            <?=$record->content;?>
          </div>
          <div class="card-footer">
            <span>Added On:&nbsp;<?=date('d-M-Y',strtotime($record->created_date));?></span>
            <span>Likes&nbsp;</span>
            <span>Comments:&nbsp;</span>
            <div>
              <p class="like-text"></p>
              <button class="btn btn-sm btn-success like-btn" data-blog-id="<?=$record->id;?>">Like</button>
               <?php if(!isset($mycomment) && empty($mycomment)): ?>
               <button class="btn btn-sm btn-success comment-btn comment-btn" data-title="<?=$record->title;?>" data-blog-id="<?=$record->id;?>">Comment</button>
             <?php endif; ?>
                 <?php if(!empty($mycomment)): ?>
              <div class="col-sm-12">
               
                <p><?=$mycomment->comment;?></p>
                 <button data-comment="<?=$mycomment->comment;?>" class="btn btn-sm btn-success comment-update" data-title="<?=$record->title;?>" data-blog-id="<?=$record->id;?>">Update Comment</button>
                 <button data-comment="<?=$mycomment->comment;?>" class="btn btn-sm btn-danger delete-comment"  data-blog-id="<?=$record->id;?>">Delete</button>
              </div>
              <?php endif; ?>
            </div>

            <div>
            
              <?php if(!empty($all)):foreach($all as $a): ?>
              <div class="col-sm-12">
               <div class="comment-box">
                  <p>User:&nbsp;<?=$a->user_id;?></p>
                <p><?=$a->comment;?></p>
               </div>
              </div>
              <?php endforeach;
                        endif; ?>
            </div>
          </div>
        </div>
        </div>
         <?php endif; ?>
      
     
       
     
    </div>
  </div>
</div>