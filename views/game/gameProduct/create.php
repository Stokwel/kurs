<?php

use yii\helpers\Html;
use \yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\GameProduct */
/* @var $gameModel app\models\Game */

$this->title = 'Create Game Product';
$this->params['breadcrumbs'][] = ['label' => 'Game Product', 'url' => Url::to(['products', 'id' => (string)$gameModel->_id])];
$this->params['breadcrumbs'][] = $gameModel->name;
$this->registerJsFile('@web/js/game/product-form.js', ['depends' => ['yii\web\YiiAsset']]);
?>
<div class="game-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'gameModel' => $gameModel,
        'gameProducts' => $gameProducts,
        'gameProductsDisabled' => $gameProductsDisabled
    ]) ?>

</div>
