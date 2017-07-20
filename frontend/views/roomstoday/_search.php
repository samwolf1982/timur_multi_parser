<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RoomstodaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roomstoday-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'site_id') ?>

    <?= $form->field($model, 'shortdistrict') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'price_m') ?>

    <?php // echo $form->field($model, 'count_rooms') ?>

    <?php // echo $form->field($model, 'square') ?>

    <?php // echo $form->field($model, 'floor') ?>

    <?php // echo $form->field($model, 'floors') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'street2') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'material') ?>

    <?php // echo $form->field($model, 'own_or_business') ?>

    <?php // echo $form->field($model, 'manager') ?>

    <?php // echo $form->field($model, 'coment') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'site') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
