<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Games';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Game', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            '_id',
            'name',
            'title',
            [
                'header' => 'Manage',
                'class' => 'yii\grid\Column',
                'content' => function ($model, $key, $index, $column) {
                    $content = Html::a('Manage GP', Url::to([
                        'products',
                        'id' => (string)$model->_id
                    ]), [
                        'class' => 'btn btn-success',
                        'style' => 'margin-right: 10px;'
                    ]);
                    $content .= Html::a('Manage SP', Url::to([
                        'store-products',
                        'id' => (string)$model->_id
                    ]), ['class' => 'btn btn-success']);

                    return $content;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => false
                ]
            ],
        ],
    ]); ?>
</div>
