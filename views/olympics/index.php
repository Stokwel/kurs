<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OlympicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Olympics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="olympics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Olympics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title:ntext',
            'desctiption:ntext',
            'from_ts:date',
            'to_ts:date',
            [
                'attribute' => 'teacher_id',
                'label' => 'Преподаватель',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    $teacher = $data->teacher;
                    return $teacher->second_name.' '.$teacher->first_name;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
