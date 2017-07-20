<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Maxdate */

$this->title = 'Create Maxdate';
$this->params['breadcrumbs'][] = ['label' => 'Maxdates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maxdate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
