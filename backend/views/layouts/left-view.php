<?php
use backend\components\Functions;
 
$roletxt = '';
if (Yii::$app->user->can('admin')) {
  $roletxt = '管理员';
}else  if(Yii::$app->user->can('doctor')) {
  $roletxt = '医生';
}else if(Yii::$app->user->can('guest')) {
  $roletxt = '受检者';
}

?>
<style type="text/css">
    .sidebar-menu .treeview-menu{padding-left: 15px}
    .myavatar:hover{border:0px solid #fff;border-radius:32px;-webkit-box-shadow: 0 0 15px #fff;}
    .user-panel .info .roletxt{    font-style: normal;    color: #4489A9;    padding-left: 5px;}
    .siderbar-spliter{position: absolute;top:50%;right:-13px; transform: translateY(-50%); cursor:pointer; transition-duration:0.4s;}
    

     
</style>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel" >
            <a class="pull-left image" href='<?=Functions::url('profile/show')?>' title=''>
                <img src="<?= Yii::$app->user->identity->avatar ?>" class="img-circle myavatar" 
                onerror="this.src='images/user2.png';" alt="User Image"/>
            </a>
            <div class="pull-left info">
            <p><?=$user->nickname;?><span class=roletxt>(<?=$roletxt ?>)</span></p>

                <a href="#" title='查看积分'><i class="fa fa-circle text-success"></i>积分: 0</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form hide">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <div class='siderbar-spliter' data-toggle="offcanvas" title=''><img src='images/siderbar.png'></div>
 <?php

echo dmstr\widgets\Menu::widget([
    'options' => ['class' => 'sidebar-menu'],
    'items'   => $menu,
]);

?>


    <style type="text/css"> 
    .fixedlogo{position:absolute;bottom:50px;color:#333;left:0px;text-align: center; display: none}
    .fixedlogo{transition-delay:0.3s}
    .sidebar-collapse .fixedlogo{ transition-delay: 0s;opacity: 0;}
    @media screen and (max-width:1370px) and (min-width:800px) {
    .fixedlogo{width:200px}
    }
    @media screen and (min-width:1370px) {
    .fixedlogo{width:230px}
    }
    @media screen and (max-width:800px) {
    .fixedlogo{    opacity: 0;}
    .sidebar-open .fixedlogo{width:230px; display: none}
    }

    </style>
    <div  class='fixedlogo'>
        <a href='http://precisionmdx.com/index.html' target="_blank"><img src='images/pdf-logo.png' height=32></a>
    </div>


    </section>


</aside>
<script type="text/javascript">
   if(location.href.indexOf('r=rest-report') > 0 
     || location.href.indexOf('r=vcf') > 0
     || location.href.indexOf('r=reportstore') > 0 
     || location.href.indexOf('index-report') > 0 ){
     $('.sidebar-menu ul').eq(0).addClass('menu-open').show();
   }
    
</script>
