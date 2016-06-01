<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\mongodb\Query;
use yii\web\UploadedFile;

/**
 * @property mixed      $name
 * @property mixed      $description
 * @property mixed    $isPackage
 * @property mixed      $image
 * @property mixed      $data
 */
class GameProduct extends \yii\base\Model
{
    public $name;
    public $description;
    public $isPackage;
    public $image;
    public $data;
    public $package;

    public function load($data, $formName = null)
    {
        $result = parent::load($data, $formName);

        if ($result) {
            $attributes = [
                'isPackage' => (string)(int)!empty($data['isPackage']),
                'package' => []
            ];

            if (!empty($data['isPackage']) && !empty($data['package'])) {
                foreach ($data['package'] as $name => $count) {
                    if ($count) {
                        $attributes['package'][] = ['name' => $name, 'count' => $count];
                    }
                }
            }

            $this->setAttributes($attributes);
        }

        return $result;
    }

    public function uploadImage()
    {
        $upload = UploadedFile::getInstance($this, 'image');
        if (!$upload) {
            return true;
        }

        $this->deleteImage();

        $name   = md5(time()) . '.' . $upload->getExtension();
        if ($upload->saveAs(Yii::getAlias('@webroot/media/' . $name))) {
            $this->setAttributes(['image' => $name], false);
        } else {
            $this->addError('image', 'Не удалось сохранить картинку!');

            return false;
        }

        return true;
    }

    public function deleteImage()
    {
        $imagePath = Yii::getAlias('@webroot/media/' . $this->image);
        if (is_file($imagePath)) {
            unlink($imagePath);
        }
    }

    public function isImageExist()
    {
        return is_file(Yii::getAlias('@webroot/media/' . $this->image));
    }

    public function getImageUrl()
    {
        return Yii::getAlias('@web/media/' . $this->image);
    }

    public function isCanBePackage($attribute, $params)
    {
        if ($this->$attribute) {
            $q = new Query();
            $count = $q->from(Game::collectionName())->where([
                'products.package' => [
                    '$elemMatch' => [
                        'name' => $this->name
                    ]
                ]
            ])->count();

            if ($count) {
                $this->addError($attribute, 'Продукт не может быть пакетом, так как сам является частью пакета!');
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'name',
            'description',
            'isPackage',
            'image',
            'data',
            'package'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'data'], 'required'],
            ['isPackage', 'in', 'range' => [0, 1]],
            ['isPackage', 'isCanBePackage'],
			[['name', 'description'], 'string', 'length' => [0, 255]],
			['data', 'string', 'length' => [0 , 1024]],
            ['package', 'default', 'value' => []],
            ['image', 'image', 'extensions' => 'jpeg, jpg, png, gif', 'on' => 'insert,update'],

			//['package', 'safe', 'on' => 'insert,update'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'description' => 'Description',
            'isPackage' => 'Is package',
            'image' => 'Image',
            'data' => 'Data'
        ];
    }
}
