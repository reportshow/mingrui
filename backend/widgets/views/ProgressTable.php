 <?php  
      use yii\helpers\Html;
 ?>
   <div class="table-responsive">
    <table class="table no-margin">
      <thead>
      <tr>
        <th>预约ID</th>
        <th>标题</th>
        <th>操作</th>
        <th>医生</th>
        <th>预约时间</th>
      </tr>
      </thead>
      <tbody> 
      <?php  
         
         $statusCss =['Inactive'=>'default', 'Uploading'=>'warning', 'Approving'=>'primary', 'Delivered'=>'success'];
         $statusText =['Inactive'=>'申请预约', 'Uploading'=>'等待上传', 'Approving'=>'等待定价', 'Delivered'=>'已发布&nbsp;'];

         
         if(count($orders))foreach($orders as  $ord){
           
          //$css = $statusCss[$ord->status] ;
          //$status =  $statusText[$ord->status] ;
           $css = 'success';
           $status = '前往上传';

           $url = Yii::$app->urlManager->createUrl(['/video/create','appment_id'=>$ord->id]);

         ?>
          <tr>
              <td><a href='<?=$url?>' ><?=$ord->id?></a>  </td>
              <td><?=$ord->title ?></td>
              <td><a class="label label-<?=$css ?>" href='<?=$url?>'><?=$status ?></a></td>
              <td> 
                 <?=$ord->doctor_name ?>                 
              </td>
              <td> 
                 <?=date('m/d H:i',$ord->updatetime) ?>                
              </td>
            </tr>
      <?php
      }
      ?>
       
      </tbody>
    </table>
  </div>