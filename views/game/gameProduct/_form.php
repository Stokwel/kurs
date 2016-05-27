<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\GameProduct */
/* @var $gameModel app\models\Game *
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'data')->textarea() ?>

    <?php if ($model->isImageExist()): ?>
        <?= Html::img($model->getImageUrl(), ['style' => 'max-width: 100px; max-height: 100px;']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= Html::checkbox('isPackage', $model->isPackage, ['id' => 'isPackage', 'label' => 'Is package']) ?>
    <?= Html::error($model, 'isPackage', ['tag' => 'span style="color:#a94442"']) ?>

    <div id="packageContent" class="control-group" style="<?= $model->isPackage ? '' : 'display: none;'?>">
        <div class="controls">
            <?= Html::dropDownList('', '', $gameProducts, [
                'prompt' => 'Select Game Product',
                'id' => 'gameProduct',
                'options' => $gameProductsDisabled
            ]) ?>
            <?= Html::textInput('', '', [
                'placeholder' => 'Input game product count',
                'id'          => 'gameProductCount'
            ]) ?>
            <?= Html::button('Add', [
                'id' => 'addToPackage'
            ]) ?>

            <table class="table" id="package">
                <tr>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Action</th>
                </tr>
                <?php
                    if ($model->package):
                        foreach ($model->package as $item):
                ?>
                        <tr>
                            <td><?=$item['name']?></td>
                            <td>
                                <?=Html::textInput('package['.$item['name'].']', $item['count'])?>
                            </td>
                            <td>
                                <?=Html::button('Delete', ['class' => 'deleteExist btn btn-danger'])?>
                            </td>
                        </tr>
                <?php
                        endforeach;
                    endif;
                ?>
            </table>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(!$model->name ? 'Create' : 'Update', ['class' => !$model->name ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?=Html::a('Cancel', Url::to([
            'products',
            'id' => (string)$gameModel->_id
        ]), [
            'class' => 'btn btn-default',
            'style' => 'margin-right: 10px;'
        ]); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>