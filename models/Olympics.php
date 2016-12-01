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
            [['title', 'desctiption', 'from_ts', 'to_ts'], 'required'],
            [['title', 'desctiption'], 'string'],
            [['from_ts', 'to_ts'], 'integer'],
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
        ];
    }
}
