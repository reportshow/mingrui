<?php
use backend\components\Functions;
 
?>
<style type="text/css">
    .sidebar-menu .treeview-menu{padding-left: 15px}
    .myavatar:hover{border:0px solid #fff;border-radius:32px;-webkit-box-shadow: 0 0 15px #fff;}

</style>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel" >
            <a class="pull-left image" href='<?=Functions::url('profile/show')?>' title='修改个人资料'>
                <img src="<?= Yii::$app->user->identity->avatar ?>" class="img-circle myavatar" 
                onerror="this.src='images/user2.png';" alt="User Image"/>
            </a>
            <div class="pull-left info">
                <p><?=$user->nickname;?></p>

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

 <?php

echo dmstr\widgets\Menu::widget([
    'options' => ['class' => 'sidebar-menu'],
    'items'   => $menu,
]);

?>

    </section>


</aside>
<script type="text/javascript">
   if(location.href.indexOf('=rest-report') > 0){
     $('.sidebar-menu ul').eq(0).addClass('menu-open').show();
   }
    
</script>
