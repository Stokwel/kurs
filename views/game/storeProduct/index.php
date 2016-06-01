<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use app\models\Store;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $gameModel app\models\Game */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Product';
$this->params['breadcrumbs'][] = $gameModel->name

?>
<div class="game-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Product', ['store-product-add', 'id' => (string)$gameModel->_id], ['class' => 'btn btn-success']) ?>
    </p>

    <ul class="nav nav-tabs">
    <?php $active = false; $style = []; foreach (Store::$available as $key => $store): ?>
        <?php
            $style[$key] = '';
            if (!$active && !empty($storeProducts[$key])) {
                $style[$key] = 'active in';
                $active = true;
            }
        ?>
        <li role="presentation" class="<?=!empty($style[$key]) ? 'active': ''?>"><a href="#<?=$key?>" data-toggle="tab"><?=$store?></a></li>
    <?php endforeach; ?>
    </ul>

    <div class="tab-content">
    <?php foreach (Store::$available as $key => $store): ?>
        <div role="tabpanel" class="tab-pane fade <?=!empty($style[$key]) ? 'active in': ''?>" id="<?=$key?>">
        <?= GridView::widget([
            'dataProvider' => new ArrayDataProvider([
                'allModels' => $storeProducts[$key]
            ]),
            'columns'      => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function ($action, $model, $key, $index) use ($gameModel) {
                        return Url::to([
                            'store-product-'.$action,
                            'id' => (string)$gameModel->_id,
                            'name' => $model->name,
                            'store' => $model->store
                        ]);
                    },
                    'visibleButtons' => [
                        'view' => false
                    ]
                ],
            ],
        ]); ?>
        </div>
    <?php endforeach; ?>
    </div>
</div>
