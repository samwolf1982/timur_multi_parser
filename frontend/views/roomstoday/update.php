<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Roomstoday */

$this->title = 'Update Roomstoday: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roomstodays', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roomstoday-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
