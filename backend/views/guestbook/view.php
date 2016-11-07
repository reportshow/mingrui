<?php

use backend\widgets\Comments;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Summary;
/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '在线留言'  ; 
$this->params['breadcrumbs'][] = $this->title;
?>
 


 

<div class="row">
          
        <div class="col-md-8">          
              <?=Comments::widget([
                  'action'=>'guestbook/send-comment',              
                  'id'       => $id,
                  'title'=>'您的意见或关系的问题',
              ])?>
        </div> 
</div>
 
<script type="text/javascript">
  $(function(){
    $('.direct-chat-messages').css('height','auto');
    $('.direct-chat-messages').css('min-height','400px');
  });
</script>
 
