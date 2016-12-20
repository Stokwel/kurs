<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Неподтвержденные соавторства';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['/authors/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title:ntext',
            [
                'attribute' => 'user_id',
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
                }
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
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{confirm}{view}',
                'buttons' => [
                    'confirm' => function ($url, $model) {
                        $url = \yii\helpers\Url::to(['authors/confirm', 'id' => $model['id']]);

                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                            'title' => 'Подтвердить',
                            'data-confirm' => 'Вы действительно хотите подтвердить соавторство в это публикации?'
                        ]);
                    },
                    'view' => function ($url, $model) {
                        $url = \yii\helpers\Url::to(['articles/view', 'id' => $model['id']]);

                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => 'View'
                        ]);
                    }
                ],
            ]
        ],
    ]); ?>
</div>
