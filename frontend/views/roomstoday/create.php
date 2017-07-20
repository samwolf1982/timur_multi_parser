<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Roomstoday */

$this->title = 'Создать';
$this->params['breadcrumbs'][] = ['label' => 'Лента', 'url' => ['rooms/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomstoday-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
