<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserSave */

$this->title = 'Create User Save';
$this->params['breadcrumbs'][] = ['label' => 'User Saves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-save-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
