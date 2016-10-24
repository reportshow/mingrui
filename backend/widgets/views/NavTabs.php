 <?php
$positionTxt = 'pull-'.$model->position;
$headerPosition = $model->position=='right' ? 'pull-left' : 'pull-right';

 ?><div class="nav-tabs-custom">
    <ul class="nav nav-tabs <?=$positionTxt?>">
      <?php 
      foreach($model->data as $key => $val){
         $active = !empty($val['active']) && $val['active'] ?'active':'';
        ?> 
      <li class="<?=$active?>"><a href="#tab<?=$key?>" data-toggle="tab"><?=$val['name']?></a></li> 
       <?php
       }
       ?>
      <li class="dropdown hide">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
          Dropdown <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
          <li role="presentation" class="divider"></li>
          <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
        </ul>
      </li>
      <li class="<?=$headerPosition ?> header"><i class="fa fa-<?=$model->icon?>"></i><?=$model->header?></li>
    </ul>
    
    <div class="tab-content">
      <?php  foreach($model->data as $key => $val){
         $active = !empty($val['active']) && $val['active'] ?'active':'';
      ?>
      <div class="tab-pane <?=$active?>" id="tab<?=$key?>">
         <?=$val['content']?>
      </div> 
      <!-- /.tab-pane -->
      <?php
      }
      ?>
    </div>
    <!-- /.tab-content -->
  </div>
  <!-- nav-tabs-custom -->