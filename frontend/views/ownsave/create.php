<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Ownsave */

$this->title = 'Create Ownsave';
$this->params['breadcrumbs'][] = ['label' => 'Ownsaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ownsave-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
