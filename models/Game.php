<?php

//http://ubs.nevosoft.local/api/v1/?game=com.nevosoft.mylittleplanet&action=product.list

namespace app\models;

use Yii;

/**
 * This is the model class for collection "game".
 *
 * @property \MongoId|string $_id
 * @property mixed $name
 * @property mixed $title
 * @property mixed $stores
 * @property mixed $products
 */
class Game extends \yii\mongodb\ActiveRecord
{
    private $_productNameIndex = [];

    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['test', 'game'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'name',
            'title',
            'stores',
            'products',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','title'], 'required'],
            [['name', 'title'], 'string', 'length' => [0, 255]],
            [['stores', 'products'], 'safe'],
            [['stores', 'products'], 'default', 'value' => []],
            [['_id', 'name', 'title'], 'safe', 'on' => 'search']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'stores' => 'Stores',
            'products' => 'Products',
        ];
    }

    public function beforeDelete()
    {
        $products = $this->getProductsAll();
        foreach ($products as $gpModel) {
            $gpModel->deleteImage();
        }

        return true;
    }

    /**
     * @param bool $force
     * @return array
     */
    private function _getProductNameIndex($force = false)
    {
        if (!$this->_productNameIndex || $force) {
            $this->_productNameIndex = [];
            $key = 0; // Отдельный кей СПЕЦИАЛЬНО!
            foreach ($this->products as $product) {
                $this->_productNameIndex[$product['name']] = $key;
                $key++;
            }
        }

        return $this->_productNameIndex;
    }

    /**
     * Save Game Product to Mongo
     * @param $gpModel GameProduct
     * @param string $name - Name of Game Product
     * @return boolean
     */
    public function saveGameProduct(GameProduct $gpModel, $name = null)
    {
        if (!$gpModel->validate()) {
            return false;
        }

        if (!$gpModel->uploadImage()) {
            return false;
        }

        if ($name) {
            return $this->updateGameProduct($gpModel, $name);
        } else {
            return $this->insertGameProduct($gpModel);
        }
    }
    
    /**
     * Insert New Game Product to Mongo
     * @param $gpModel GameProduct
     * @return boolean
     */
    public function insertGameProduct(GameProduct $gpModel)
    {
        if ($this->isExistProduct($gpModel->name)) {
            $gpModel->addError('name', 'Такой продукт уже существует!');

            return false;
        }

        $result = $this->updateAll([
            '$push' => [
                'products' => $gpModel->toArray()
            ],
        ], [
            '_id' => (string)$this->_id
        ]);

        if ($result) {
            $products = $this->products;
            $products[] = $gpModel->toArray();
            $this->setAttributes(['products' => $products]);
        }

        return $result;
    }

    /**
     * Update Game Product to Mongo
     * @param $gpModel GameProduct
     * @param string $name - Name of Game Product
     * @return boolean
     */
    public function updateGameProduct(GameProduct $gpModel, $name)
    {
        $nameForUpdate = $gpModel->name;

        if ($gpModel->name !== $name) {
            $nameForUpdate = $name;
            if ($this->isExistProduct($gpModel->name)) {
                $gpModel->addError('name', 'Такой продукт уже существует!');

                return false;
            }
        }

        if (!$this->isExistProduct($name)) {
            $gpModel->addError('name', 'Такого продукта не существует!');

            return false;
        }

        $result = $this->updateAll([
            '$set' => [
                'products.$' => $gpModel->toArray()
            ],
        ], [
            '_id' => (string)$this->_id,
            'products.name' => $nameForUpdate
        ]);

        if ($result) {
            $products = $this->products;
            $productNameIndex = $this->_getProductNameIndex();
            $products[$productNameIndex[$nameForUpdate]] = $gpModel->toArray();
            $this->setAttributes(['products' => $products]);
            $this->_getProductNameIndex(true);
        }
    
        return $result;
    }

    /**
     * Delete Game Product from Mongo
     * @param $gpModel GameProduct
     * @return boolean
     */
    public function deleteGameProduct(GameProduct $gpModel)
    {
        if (!$this->isExistProduct($gpModel->name)) {

            return false;
        }

        $result = $this->updateAll([
            '$pull' => [
                'products' => [
                    'name' => $gpModel->name
                ]
            ],
        ], [
            '_id' => (string)$this->_id,
        ]);

        if ($result) {
            $gpModel->deleteImage();
            $products = $this->products;
            $productNameIndex = $this->_getProductNameIndex();
            unset($products[$productNameIndex[$gpModel->name]]);
            $this->setAttributes(['products' => $products]);
            $this->_getProductNameIndex(true);
        }

        return $result;
    }


    /**
     * @param string $name - Name of Game Product
     * @param bool $loadPackageModel
     * @return GameProduct
     */
    public function getProductOne($name, $loadPackageModel = false)
    {
        if (!$this->products || !$this->isExistProduct($name)) {
            return null;
        }

        $productNameIndex = $this->_getProductNameIndex();

        $gpModel = new GameProduct();
        $gpModel->setAttributes($this->products[$productNameIndex[$name]], false);
        $gpModel->package = $this->getPackageProducts($gpModel, $loadPackageModel);

        return $gpModel;
    }

    /**
     * @param bool $loadPackageModel
     * @return GameProduct[]
     */
    public function getProductsAll($loadPackageModel = false)
    {
        if (!$this->products) {
            return [];
        }

        $products = [];
        foreach ($this->products as $product) {
            $gpModel = new GameProduct();
            $gpModel->setAttributes($product, false);
            $gpModel->package = $this->getPackageProducts($gpModel, $loadPackageModel);

            $products[] = $gpModel;
        }

        return $products;
    }

    /**
     * @param GameProduct $gpModel
     * @param bool        $loadPackageModel
     *
     * @return array|GameProduct[]
     */
    public function getPackageProducts(GameProduct $gpModel, $loadPackageModel = false)
    {
        if (!$gpModel->isPackage || !$gpModel->package) {
            return [];
        }

        if (!$loadPackageModel) {
            return $gpModel->package;
        }

        $packageProducts = [];
        foreach ($gpModel->package as $name => $count) {
            $product = $this->getProductOne($name, $loadPackageModel);
            if ($product) {
                $packageProducts[$name] = $product;
            }
        }

        return $packageProducts;
    }


    public function isExistProduct($name)
    {
        $productNameIndex = $this->_getProductNameIndex();

        return isset($productNameIndex[$name]);
    }

    /**
     * @param bool $loadPackageModel
     * @return GameProduct[]
     */
    public function getStoreProductsAll()
    {
        if (!$this->products) {
            return [];
        }

        $products = [];
        foreach ($this->products as $product) {
            $gpModel = new GameProduct();
            $gpModel->setAttributes($product, false);
            $gpModel->package = $this->getPackageProducts($gpModel, $loadPackageModel);

            $products[] = $gpModel;
        }

        return $products;
    }
}
