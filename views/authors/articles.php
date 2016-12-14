<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Works';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title:ntext',
            [
                'attribute' => 'description',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    return mb_strimwidth($data->description, 0, 200, '...');
                },
            ],
            [
                'attribute' => 'olympic_id',
                'label' => 'Олимпиада',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    $olympic = $data->olympic;
                    return $olympic->title;
                },
            ],
            [
                'header' => 'Оценка',
                'class' => 'yii\grid\Column',
                'content' => function ($data) {
                    return Html::a($data->rating, \yii\helpers\Url::to(['rating', 'id' => $data->id]));
                },
            ],
        ],
    ]); ?>
</div>
