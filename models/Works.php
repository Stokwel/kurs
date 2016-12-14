<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "works".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $olympic_id
 * @property integer $user_id
 * @property double $rating
 * @property integer $rating_count
 */
class Works extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'works';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'olympic_id', 'user_id'], 'required'],
            [['title', 'description'], 'string'],
            [['olympic_id', 'user_id', 'rating_count'], 'integer'],
            [['rating'], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'olympic_id' => 'Olympic ID',
        ];
    }

    public function getOlympic()
    {
        return $this->hasOne(Olympics::className(), ['id' => 'olympic_id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $ratingCount = $this->getOldAttribute('rating_count');
            $rating = (($this->getOldAttribute('rating') * $ratingCount) + $this->rating) / ($ratingCount + 1);
            $this->rating = round($rating, 2);
            $this->rating_count = $ratingCount + 1;
            return true;
        } else {
            return false;
        }
    }
}
