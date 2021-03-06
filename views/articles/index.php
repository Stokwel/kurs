<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои публикации';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['/authors/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title:ntext',
            [
                'attribute' => 'authors',
                'label' => 'Автор(ы)',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    $user = $data->user;
                    $authors = $user->second_name.' '.$user->first_name;
                    $authors .= $data->authors ? ', '.$data->authors : '';
                    if ($data->userCollaboration) {
                        foreach ($data->userCollaboration as $item) {
                            $authors .= ', '.$item->second_name.' '.$item->first_name;
                        }
                    }

                    return $authors;
                },
                'filter' => User::getUsersList()
            ],
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
