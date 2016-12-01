<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Olympics */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Olympics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="olympics-view">

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
            'title:ntext',
            'desctiption:ntext',
            'from_ts',
            'to_ts',
            'teacher_id',
        ],
    ]) ?>

</div>
