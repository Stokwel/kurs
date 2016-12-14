<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "works".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $user_id
 * @property integer $created_at
 * @property string $keywords
 * @property string $magazine_title
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'user_id', 'keywords', 'magazine_title'], 'required'],
            [['title', 'description', 'keywords', 'magazine_title'], 'string'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'magazine_title' => 'Название журнала',
            'created_at' => 'Дата добавления',

        ];
    }

    public function getOlympic()
    {
        return $this->hasOne(Olympics::className(), ['id' => 'olympic_id']);
    }

    public function beforeSave($insert)
    {
        return true;
    }
}
