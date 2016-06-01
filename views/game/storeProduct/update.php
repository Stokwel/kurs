<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\GameProduct */
/* @var $gameModel app\models\Game */


$this->title = 'Update Store Product';
$this->params['breadcrumbs'][] = ['label' => 'Store product', 'url' => Url::to(['store-products', 'id' => (string)$gameModel->_id])];
$this->params['breadcrumbs'][] = $gameModel->name;
?>
<div class="game-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gameModel' => $gameModel,
        'gameProducts' => $gameProducts,
    ]) ?>

</div>
