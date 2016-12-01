<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Olympics */

$this->title = 'Create Olympics';
$this->params['breadcrumbs'][] = ['label' => 'Olympics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="olympics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
