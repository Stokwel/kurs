<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Store;

/* @var $this yii\web\View */
/* @var $model app\models\StoreProduct */
/* @var $gameModel app\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-md-6">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'store')->dropDownList(Store::$available) ?>

    <?= $form->field($model, 'gameProduct')->dropDownList($gameProducts, ['prompt' => 'Select Game Product']) ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'storeId') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= Html::checkbox('consumable', $model->consumable, ['label' => 'Consumable']) ?>

    <?= $form->field($model, 'price') ?>


    <div class="form-group">
        <?= Html::submitButton(!$model->name ? 'Create' : 'Update', ['class' => !$model->name ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?=Html::a('Cancel', Url::to([
            'store-products',
            'id' => (string)$gameModel->_id
        ]), [
            'class' => 'btn btn-default',
            'style' => 'margin-right: 10px;'
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>