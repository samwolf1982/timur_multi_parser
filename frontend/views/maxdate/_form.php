<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Maxdate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maxdate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dt')->textInput() ?>

    <?= $form->field($model, 'max_id')->textInput() ?>

    <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
