<?php

use backend\widgets\CKeditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */
/* @var $form yii\widgets\ActiveForm */

 
?>

<div class="mingrui-doc-form">
     <h1><?=$model->name ?></h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'upload']]);?>

    <?=$form->field($model, 'classname')->textInput(['maxlength' => true])?> 
    <?php
//=$form->field($model, 'description')->textarea(['rows' => 6])
?>


     <?php
          
            echo $form->field($model, 'detail[]')->widget(FileInput::classname(), [
                'options'       => ['multiple' => false, 'accept' => '*.csv/*.csv'],
                'pluginOptions' => [
                    'showUpload' => true,
                    'showPreview' => false,
                ],
            ])->label('选择csv文件');
        

?>



    <div class="form-group">
        <?=Html::submitButton( '  提 交  '  , ['class' =>  'btn btn-success'  ])?>
    </div>


    <?php ActiveForm::end();?>



<p class='text-red'>请将表格文件存为csv格式!!<br>数据从第二行起</p>
模板示例：<table border="1" width="100%">
<tr> 
<th width="170">疾病大类</th><th>疾病大类基因数</th><th>疾病名（中文）</th><th>疾病名（英文）</th>
<th>基因</th><th>遗传方式</th><th>OMIM号</th><th>疾病背景</th> <th>外显子数</th><th>DM</th><th>refseq</th>
</tr> 
<tr>
 <td>EYE01-视网膜色素变性</td><td>64</td><td>视网膜色素变性 1</td><td>Retinitis pigmentosa 1	</td>
 <td>RP1</td><td>AD,AR</td><td>180100</td><td>	</td> <td> 4</td><td> 73</td><td>NM_006269</td>  
</tr>
<tr>
 <td> &nbsp;</td><td> </td><td> </td><td> 	</td>
 <td> </td><td> </td><td> </td><td>	</td> <td>  </td><td>  </td><td> </td>  
</tr>
<tr>
 <td> &nbsp;</td><td> </td><td> </td><td> 	</td>
 <td> </td><td> </td><td> </td><td>	</td> <td>  </td><td>  </td><td> </td>  
</tr>


</table>



</div>
