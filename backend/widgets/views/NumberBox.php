<!--col numberbox -->
<div class="small-box bg-<?=$model->bgcolor ?>">
    <div class="inner">          
        <h3><?=$model->number ?></h3>
        <p><?=$model->tag ?></p>
    </div>
    <div class="icon">
        <i class="<?=$model->bag ?>"></i>
    </div>
    <div class="small-box-footer" >
    <?php  
    foreach($model->link  as $k=>$link )  { 
     ?>
        <a href='<?=$link  ?>' style='color:#fff'><?=$k?>
          <i class="fa fa-arrow-circle-right">        </i>
        </a>&nbsp;&nbsp;
    <?php
        }
    ?>
    </div>
</div>
<!--./col numberbox -->