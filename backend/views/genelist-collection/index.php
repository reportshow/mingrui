<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel apps\models\GenelistCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '基因诊断词条';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genelist-collection-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建诊断信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <style type="text/css">
       .creatorinfo{font-size:8pt;}
       .checkboxFour{width:20px;height:20px;background:#ddd;margin:20px 90px;border-radius:100%;position:relative;-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.5);-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.5);box-shadow:0px 1px 3px rgba(0,0,0,0.5);}.checkboxFour label{display:block;width:16px;height:16px;border-radius:100px;-webkit-transition:all .5s ease;-moz-transition:all .5s ease;-o-transition:all .5s ease;-ms-transition:all .5s ease;transition:all .5s ease;cursor:pointer;position:absolute;top:2px;left:2px;z-index:1;background:#333;-webkit-box-shadow:inset 0px 1px 3px rgba(0,0,0,0.5);-moz-box-shadow:inset 0px 1px 3px rgba(0,0,0,0.5);box-shadow:inset 0px 1px 3px rgba(0,0,0,0.5);}.checkboxFour input[type=checkbox]:checked+label{background:#26ca28;}
	   .checkboxFour input{visibility: hidden}

	   .genelist-collection-index tbody input[type=checkbox]{width: 25px;height: 25px }
	   .genelist-collection-index tbody input:checked{-webkit-appearance:none;background-color: green;
	   	border-radius: 2px;border: 3px solid #0a5}
	   /*input:checked:after{content:"√";font-size:26pt;}*/


	   .doing{
	   	   transform: rotate(-400deg);transition-duration: 4s;background-color:#aaa}

	   	.check{font-size: 20pt;color:green;cursor:pointer;}
	   	.check.fa-check-square{color:#666;}
    </style>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 
             'options'   => ['width' => '50'],],

            ['attribute'=>'used',
              'filter'    => ['1' => '启用', '0' => '未启用'],
              'format'=>'raw',
              'value'=>function($model){ 
              	$checked = $model->used ? 'checked': '';
            	$html = "<input type=checkbox $checked >";

            	if($model->used){ 
                   $html ="<b class='check fa fa-check-square-o' used=1> </b>";
            	}else{ 
            	   $html ="<b class='check fa fa-square-o' used=0> </b>";
            	}
            	return $html;

            }, 'options'   => ['width' => '50']],

            ['attribute' => 'omim', 'options'   => ['width' => '110'],],
            ['attribute'=>'sick','value'=>'info.sick','label'=>'表型吗',],
            ['attribute'=>'gene','value'=>'info.gene',
              'label'=>'基因','options'   => ['width' => '60']],
            'zhenduan:ntext',
            'zhiliao:ntext',
             
            ['attribute'=>'creator_info', 'format'=>'raw',
              'value'=>function($model){ 
            	$html = '<span class=creatorinfo>' . $model->creator_info .'<span>';
            	return $html;

            }, 'options'   => ['width' => '140']],

             
             [
                'attribute' => 'createtimexxxx',
                'label'=>'更新时间',
                'value'=>
                function($model){
                    return  date('Y-m-d',$model->createtime);   //主要通过此种方式实现
                },
                'headerOptions' => ['width' => '100'],
            ],


            ['class' => 'yii\grid\ActionColumn','options'   => ['width' => '90']],
        ],
    ]); ?>
</div>


<script type="text/javascript">
	
	$('tbody tr td b').click(function(){ 
		var This= $(this);
		var id = $(this).parent().parent().attr('data-key');
		//var used = $(this).is(':checked') ? 1 : 0;
		var used = $(this).attr('used')=='1' ? 0 : 1;
		 
		var url ='<?= Yii::$app->urlManager->createUrl(['genelist-collection/used']) ?>' 
		       + '&id='+id + '&used=' +used ;

		$(this).addClass('doing');

		$.ajax({
			url:url,
			success:function(){ 
				This.attr('used',used);
				This.removeClass('fa-check-square-o');
				This.removeClass('fa-square-o');
				if(used){ 
					This.addClass('fa-check-square-o');
				}else{ 
					This.addClass('fa-square-o');
				}
				This.removeClass('doing'); // alert('修改成功');

		    },
		    error:function(){ 
		    	alert('修改失败');
		    }

	    });
	});
</script>


<div class="checkboxFour">
<input type="checkbox" value="1" id="checkboxOneInput" name=""/>
<label for="checkboxOneInput"></label>
</div>