<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Works */

$this->title = 'Оценить работу: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Оценить работы', 'url' => ['works']];
?>
<div class="works-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
