<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Olympics */

$this->title = 'Update Olympics: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Olympics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="olympics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
