<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $price
 * @property integer $teacher_id
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'price', 'teacher_id'], 'required'],
            [['title', 'description'], 'string'],
            [['price', 'teacher_id'], 'integer'],
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
            'price' => 'Price',
            'teacher_id' => 'Teacher ID',
        ];
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teacher_id']);
    }
}
