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
 * @property mixed $storeProducts
 * @property mixed $products
 */
class Game extends \yii\mongodb\ActiveRecord
{
    protected $productsHash = [];
    protected $storeProductsHash = [];

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
            'storeProducts',
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
            [['storeProducts', 'products'], 'safe'],
            [['storeProducts', 'products'], 'default', 'value' => []],
            [['_id', 'name', 'title'], 'safe', 'on' => 'search']
        ];
    }

    public static function findOne($condition)
    {
        /** @var  $model Game */
        $model = parent::findOne($condition);

        if ($model) {
            foreach ($model->products as $product) {
                $model->productsHash[ $product['name'] ] = $product;
            }
            foreach ($model->storeProducts as $product) {
                $model->storeProductsHash[$product['name'].'_'.$product['store']] = $product;
            }
        }

        return $model;
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
            'storeProducts' => 'Store products',
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
        if (isset($this->productsHash[$gpModel->name])) {
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
            $this->productsHash[$gpModel->name] = $gpModel->toArray();
            $this->setAttributes(['products' => array_values($this->productsHash)]);
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
            if (isset($this->productsHash[$gpModel->name])) {
                $gpModel->addError('name', 'Такой продукт уже существует!');

                return false;
            }
        }

        if (!isset($this->productsHash[$nameForUpdate])) {
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
            unset($this->productsHash[$name]);
            $this->productsHash[$nameForUpdate] = $gpModel->toArray();
            $this->setAttributes(['products' => array_values($this->productsHash)]);
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
        if (!isset($this->productsHash[$gpModel->name])) {

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
            unset($this->productsHash[$gpModel->name]);
            $this->setAttributes(['products' => array_values($this->productsHash)]);
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
        if (!$this->products || !isset($this->productsHash[$name])) {
            return null;
        }

        $gpModel = new GameProduct();
        $gpModel->setAttributes($this->productsHash[$name], false);
        $gpModel->package = $this->getPackageProducts($gpModel, $loadPackageModel);

        return $gpModel;
    }

    /**
     * @param bool $loadPackageModel
     * @return GameProduct[]
     */
    public function getProductsAll($loadPackageModel = false)
    {
        if (!$this->productsHash) {
            return [];
        }

        $products = [];
        foreach ($this->productsHash as $product) {
            $gpModel = new GameProduct();
            $gpModel->setAttributes($product, false);
            $gpModel->package = $this->getPackageProducts($gpModel, $loadPackageModel);

            $products[] = $gpModel;
        }

        return $products;
    }


    /**
     * @return integer
     */
    public function getProductsCount()
    {
        return count($this->products);
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

    /**
     * Save Store Product to Mongo
     * @param $spModel StoreProduct
     * @param string $name - Name of Store Product
     * @param string $store - Store of Store Product
     * @return boolean
     */
    public function saveStoreProduct(StoreProduct $spModel, $name = null, $store = null)
    {
        if (!$spModel->validate()) {
            return false;
        }

        if ($name) {
            return $this->updateStoreProduct($spModel, $name, $store);
        } else {
            return $this->insertStoreProduct($spModel);
        }
    }

    /**
     * Insert New Store Product to Mongo
     * @param $spModel StoreProduct
     * @return boolean
     */
    public function insertStoreProduct(StoreProduct $spModel)
    {
        if (isset($this->storeProductsHash[$spModel->name.'_'.$spModel->store])) {
            $spModel->addError('name', 'Такой продукт уже существует!');

            return false;
        }

        $result = $this->updateAll([
            '$push' => [
                'storeProducts' => $spModel->toArray()
            ],
        ], [
            '_id' => (string)$this->_id,
        ]);

        if ($result) {
            $this->storeProductsHash[$spModel->name.'_'.$spModel->store] = $spModel->toArray();
            $this->setAttributes(['storeProducts' => array_values($this->storeProductsHash)]);
        }

        return $result;
    }

    /**
     * Update Store Product to Mongo
     * @param $spModel StoreProduct
     * @param string $name - Name of Store Product
     * @param string $store - Store of Store Product
     * @return boolean
     */
    public function updateStoreProduct(StoreProduct $spModel, $name, $store)
    {
        $nameForUpdate = $spModel->name;
        $storeForUpdate = $spModel->store;

        if ($spModel->name !== $name || $spModel->store !== $store) {
            $nameForUpdate = $name;
            $storeForUpdate = $store;
            if (isset($this->storeProductsHash[$spModel->name.'_'.$spModel->store])) {
                $spModel->addError('name', 'Такой продукт уже существует!');

                return false;
            }
        }

        if (!isset($this->storeProductsHash[$nameForUpdate.'_'.$storeForUpdate])) {
            $spModel->addError('name', 'Такого продукта не существует!');

            return false;
        }


        $result = $this->updateAll([
            '$set' => [
                'storeProducts.$' => $spModel->toArray()
            ],
        ], [
            '_id' => (string)$this->_id,
            'storeProducts.name' => $nameForUpdate
        ]);

        if ($result) {
            unset($this->storeProductsHash[$name.'_'.$store]);
            $this->storeProductsHash[$nameForUpdate.'_'.$storeForUpdate] = $spModel->toArray();
            $this->setAttributes(['storeProducts' => array_values($this->storeProductsHash)]);
        }

        return $result;
    }

    /**
     * Delete Store Product from Mongo
     * @param $spModel StoreProduct
     * @return boolean
     */
    public function deleteStoreProduct(StoreProduct $spModel)
    {
        if (!isset($this->storeProductsHash[$spModel->name.'_'.$spModel->store])) {

            return false;
        }

        $result = $this->updateAll([
            '$pull' => [
                'storeProducts' => [
                    'name' => $spModel->name
                ]
            ],
        ], [
            '_id' => (string)$this->_id,
        ]);

        if ($result) {
            unset($this->storeProductsHash[$spModel->name.'_'.$spModel->store]);
            $this->setAttributes(['storeProducts' => array_values($this->storeProductsHash)]);
        }

        return $result;
    }

    /**
     * @param string $store - Name of Store
     * @param string $name - Name of Store Product
     * @param string $store - Store of Store Product
     * @param bool $loadGameProductModel
     * @return StoreProduct
     */
    public function getStoreProductOne($name, $store, $loadGameProductModel = false)
    {
        if (!isset($this->storeProductsHash[$name.'_'.$store])) {
            return null;
        }

        $product = $this->storeProductsHash[$name.'_'.$store];
        if ($loadGameProductModel) {
            $product['gameProduct'] = $this->getProductOne($product['gameProduct']);
        }
        $spModel = new StoreProduct();
        $spModel->setAttributes($product, false);

        return $spModel;
    }

    /**
     * @param string $store - Name of Store
     * @param bool $loadGameProductModel
     * @return StoreProduct[]
     */
    public function getStoreProducts($store = null, $loadGameProductModel = false)
    {
        if (!$this->storeProductsHash) {
            return [];
        }

        $products = [];
        foreach ($this->storeProductsHash as $product) {
            if (!$store || $store == $product['store']) {
                if ($loadGameProductModel) {
                    $product['gameProduct'] = $this->getProductOne($product['gameProduct']);
                }

                $spModel = new StoreProduct();
                $spModel->setAttributes($product, false);

                $products[] = $spModel;
            }
        }

        return $products;
    }

    /**
     * @return integer
     */
    public function getStoreProductsCount()
    {
        return count($this->storeProducts);
    }
}
