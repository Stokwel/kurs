<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Публикации';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="works-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                    if ($data->collaborations) {
                        $collaboration = $data->collaborations[0];
                        $authors .= ', '.$collaboration->second_name.' '.$collaboration->second_name;
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
                'filter' => false
            ],
            'created_at',
        ],
    ]); ?>
</div>