<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "olympics".
 *
 * @property integer $id
 * @property string $title
 * @property string $desctiption
 * @property integer $from_ts
 * @property integer $to_ts
 * @property integer $teacher_id
 */
class Olympics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'olympics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'desctiption', 'from_ts', 'to_ts', 'teacher_id'], 'required'],
            [['title', 'desctiption'], 'string'],
            ['teacher_id', 'integer'],
            ['from_ts', 'date', 'timestampAttribute' => 'from_ts', 'format' => 'dd-MM-yyyy'],
            ['to_ts', 'date', 'timestampAttribute' => 'to_ts', 'format' => 'dd-MM-yyyy'],
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
            'desctiption' => 'Desctiption',
            'from_ts' => 'From Ts',
            'to_ts' => 'To Ts',
            'teacher_id' => 'Teacher ID',
        ];
    }

    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['id' => 'teacher_id']);
    }
}
