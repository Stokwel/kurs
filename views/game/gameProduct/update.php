<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GameProduct */
/* @var $gameModel app\models\Game */


$this->title = 'Update Game: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => (string)$model->_id]];
$this->params['breadcrumbs'][] = 'Update';
$this->registerJsFile('@web/js/game/product-form.js', ['depends' => ['yii\web\YiiAsset']]);
?>
<div class="game-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gameModel' => $gameModel,
        'gameProducts' => $gameProducts,
        'gameProductsDisabled' => $gameProductsDisabled
    ]) ?>

</div>
