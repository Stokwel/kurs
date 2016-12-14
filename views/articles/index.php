<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Works', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title:ntext',
            'magazine_title:ntext',
            'keywords:ntext',
            [
                'attribute' => 'description',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    return mb_strimwidth($data->description, 0, 200, '...');
                },
            ],
            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
