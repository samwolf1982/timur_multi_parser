<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Roomstoday */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Лента', 'url' => ['rooms/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roomstoday-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'site_id',
            'shortdistrict',
            'phone',
            'price',
            'currency',
            'price_m',
            'count_rooms',
            'square',
            'floor',
            'floors',
            'type',
            'district',
            'street',
            'street2',
            'description:ntext',
            'state',
            'material',
            'own_or_business',
            'manager',
            'coment',
            'url:ntext',
            'site',
            'img:ntext',
            'date',
        ],
    ]) ?>

</div>
