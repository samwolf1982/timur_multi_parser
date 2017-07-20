<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MaxdateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maxdates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maxdate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Maxdate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dt',
            'max_id',
            'site',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
