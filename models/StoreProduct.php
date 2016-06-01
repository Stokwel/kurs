<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\mongodb\Query;
use yii\web\UploadedFile;

/**
 * @property mixed      $name
 * @property mixed      $gameProduct
 * @property mixed      $storeId
 * @property mixed      $title
 * @property mixed      $description
 * @property mixed      $consumable
 * @property mixed      $price
 */
class StoreProduct extends \yii\base\Model
{
    public $name;
    public $gameProduct;
    public $storeId;
    public $title;
    public $description;
    public $consumable;
    public $price;
    public $store;

    public function load($data, $formName = null)
    {
        $result = parent::load($data, $formName);

        if ($result) {
            $attributes = [
                'consumable' => (string)(int)!empty($data['consumable']),
            ];

            $this->setAttributes($attributes, false);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'name',
            'gameProduct',
            'storeId',
            'title',
            'description',
            'consumable',
            'price',
            'store'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'gameProduct', 'storeId', 'title', 'description', 'price', 'store'], 'required'],
            ['consumable', 'in', 'range' => [0, 1]],
            [['name', 'title', 'description', 'price', 'storeId'], 'string', 'length' => [0, 255]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'gameProduct' => 'Game Product',
            'storeId' => 'Store Id',
            'title' => 'Title',
            'description' => 'Description',
            'consumable' => 'Consumable',
            'price' => 'Price',
            'store' => 'Store',
        ];
    }
}
