<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CoursesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
            'price',
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
