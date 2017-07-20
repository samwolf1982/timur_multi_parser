<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Rooms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rooms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'site_id')->textInput() ?>

    <?= $form->field($model, 'shortdistrict')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_m')->textInput() ?>

    <?= $form->field($model, 'count_rooms')->textInput() ?>

    <?= $form->field($model, 'square')->textInput() ?>

    <?= $form->field($model, 'floor')->textInput() ?>

    <?= $form->field($model, 'floors')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'coment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'own_or_business')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>
    
     <?=  $form->field($model, 'state')->dropDownList([
    'Перезвонить' => 'Перезвонить',
    'Не сотрудничает' => 'Не сотрудничает',
    'Продано'=>'Продано',
    
    'Что-то еще'=>'Что-то еще',
]) ?>

    <?php // $form->field($model, 'coment')->textInput(['maxlength' => true]) ?>
            
    <?php  // $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>



    
    <div class="form-group">
    
    <?php 
                if ( empty($model->manager) ||$model->manager=='********' || $model->manager==Yii::$app->user->identity->username ){    ?>
                    
                         <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>  
                    
             <?php   }
                else{
                    
                }
      ?>
    
 
    </div>

    <?php ActiveForm::end(); ?>

</div>
