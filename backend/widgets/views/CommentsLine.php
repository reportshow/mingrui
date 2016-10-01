<?php
use backend\widgets\VoiceShow;

if(!function_exists('commentLineShowTxt')){
   function commentLineShowTxt($content){
    $js = json_decode($content);
    if ($js) {
        if(is_object($js)   ) 

        foreach ($js as $res => $voice) {
           echo VoiceShow::widget(['voice'=>$voice]); ;
        }         
    }else{
         echo "<div class='direct-chat-text'> $content </div>";
    }
  
} 
}


if($model['position'] != 'right'){
    

?>
<!-- Message. Default to the left -->
<div class="direct-chat-msg">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left">
            <?=$model->creator->nickname?>
        </span>
        <span class="direct-chat-timestamp pull-right">
           <?=date('Y-m-d H:i:s',$model->createtime) ?>
        </span>
    </div>
    <!-- /.direct-chat-info -->
    <img alt="Message User Image" class="direct-chat-img" src="<?=$model->creator->avatar?>" onerror="this.src='images/user2.png';">
        <!-- /.direct-chat-img -->
        
            <?php
              commentLineShowTxt($model->content);
            ?>
         
        <!-- /.direct-chat-text -->
     
</div>
<!-- /.direct-chat-msg -->
<?php

}else{ //right     
 

?>
<!-- Message to the right -->
<div class="direct-chat-msg right">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-right">
            <?=$model->creator->nickname?>
        </span>
        <span class="direct-chat-timestamp pull-left">
             <?=date('Y-m-d H:i:s',$model->createtime) ?>
        </span>
    </div>
    <!-- /.direct-chat-info -->
    <img alt="Message User Image" class="direct-chat-img" src="<?=$model->creator->avatar?>" 
       onerror="this.src='images/user.png';">
        <!-- /.direct-chat-img -->
        
           <?php
            commentLineShowTxt($model->content);
           ?>
         
        <!-- /.direct-chat-text -->
     
</div>
<!-- /.direct-chat-msg -->
<?php
}
?>