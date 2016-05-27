<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $gameModel app\models\Game */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Game Product';
$this->params['breadcrumbs'][] = $gameModel->name;
?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Product', ['product-add', 'id' => (string)$gameModel->_id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) use ($gameModel) {
                    return Url::to([
                        'product-'.$action,
                        'id' => (string)$gameModel->_id,
                        'name' => $model->name
                    ]);
                },
                'visibleButtons' => [
                    'view' => false
                ]
            ],
        ],
    ]); ?>
</div>
