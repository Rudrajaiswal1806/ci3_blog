<style type="text/css">
  .card{padding: 5px;border:2px solid brown;margin:10px;}
  .card-header{padding:3px;font-weight:bold;}
</style>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
         <?php if(!empty($record)):foreach($record as $row): ?>
        <div class="col-sm-4">
           <div class="card">
          <div class="card-header"><?=$row->title;?></div>
          <div class="card-body">
            <?=$row->content;?>
          </div>
          <div class="card-footer">
            <span>Category:&nbsp;<?=$row->category;?></span>
            <span>Date:&nbsp;<?=date('d-M-Y',strtotime($row->created_date));?></span>
            
            <a class="btn btn-sm" href="<?=base_url('blog-details').'/'.$row->id;?>">Details</a>
          </div>
        </div>
        </div>
         <?php endforeach; endif; ?>
      </div>
     
       
     
    </div>
  </div>
</div>