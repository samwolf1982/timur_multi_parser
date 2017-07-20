<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserSave */

$this->title = 'Update User Save: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-save-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
