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

    <?php $options = [
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
                'filter' => false
            ],
            'created_at'
        ],
    ];

    if (Yii::$app->user->isAdmin()) {
        $options['columns'][] = [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    $icon = $model->deleted ? 'glyphicon glyphicon-eye-open' : 'glyphicon glyphicon-eye-close';
                    $text = $model->deleted ? 'Вы действительно хотите показать эту публикацию?' : 'Вы действительно хотите скрыть эту публикацию?';
                    $url = \yii\helpers\Url::to(['admin/article-delete', 'id' => $model['id']]);

                    return Html::a('<span class="'.$icon.'"></span>', $url, [
                        'title' =>  $model->deleted ? 'Показать' : 'Скрыть',
                        'data-confirm' => $text
                    ]);
                }
            ],
        ];
    }

    ?>

    <?= GridView::widget($options); ?>
</div>