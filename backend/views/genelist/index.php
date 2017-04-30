<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel apps\models\MainlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '基因分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainlist-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
         
        <?= Html::a('<b class="fa fa-plus"> </b> 新建大类', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<b class="fa fa-book"> </b> 案例总列表', ['mingrui-doc/index','type'=>'genecase'], ['class' => 'btn btn-warning']) ?>
         <?= Html::a('<b class="fa fa-shopping-cart"> </b> 订单列表', ['genelist-order/index','type'=>'genecase'], ['class' => 'btn btn-info']) ?>
         <?= Html::a('<b class="fa fa-twitter"> </b> 开放词条列表', ['genelist-collection/index'], ['class' => 'btn btn-danger']) ?> 

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            ['attribute'=>'orderby','format'=>'raw',
              'options'   => ['width' => '50'],'value'=>function($model){ 
            	$html ="<input size=2 value='".$model->orderby."' maxlength=2>";
            	return $html;
            }],  
       /*      [ 'attribute'=>'id',
              'options'   => ['width' => '60'],
            ],*/
            'name',
            'name_en',
            'number',
            'description:ntext',


            // 'hassub',
             [ 'attribute'=>'classname',
                'format'=>'raw',
               'label'=>'分类/描述',
                'value'=>function($model){ 
                	 
                	if( $model->hassub ==1   ){ 
                		$label = $model->classname;
                		if(!$label) $label = '---';
                		$url = '../../apps/web/index.php?r=gene/class&classid=' . $model->id;
                		$btnview = Html::a($label, $url, ['class' => 'btn-xs btn-success']);

                		$btnedit = Html::a('上传',['subupload','id'=>$model->id], 
                         	 ['class'=>'btn-xs btn-warning  '   ]);

                		$btnedit .= Html::a('案例',['case','classid'=>$model->id], 
                         	 ['class'=>'btn-xs btn-danger  '   ]);

                	}else{ 
						$url = '../../apps/web/index.php?r=gene/class&classid=' . $model->id;
                         
                         $btnview = Html::a('图文', $url, ['class' => 'btn-xs btn-primary']);

                         $btnedit = Html::a('编辑',['detailedit','id'=>$model->id], 
                         	 ['class'=>'btn-xs btn-warning '  ]);

                	}
                    
                    return $btnview  . $btnedit;

                	//return Html::a('图文',['detailview', 'id' => $model->id],['class' => 'btn-xs btn-primary']);

                },
                'options'   => ['width' => '140'],
             ] ,

            ['class' => 'yii\grid\ActionColumn', 'options'   => ['width' => '80'],],
            
        ],
    ]); ?>
</div>
<script type="text/javascript">
	
	$('.mainlist-index tbody tr td:eq(0) input').blur(function(){ 
		var id = $(this).parent().parent().attr('data-key');
		var url ='<?= Yii::$app->urlManager->createUrl(['genelist/orderchange']) ?>' 
		       + '&id='+id + '&orderby=' + $(this).val() ;
		$.ajax({
			url:url,
			success:function(){ 
				
				alert('修改成功');

		    },
		    error:function(){ 
		    	alert('修改失败');
		    }

	    });
	});
</script>
