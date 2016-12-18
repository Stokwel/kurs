<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teachers".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $user_id
 * @property integer $confirmed
 */
class Collaboration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'collaboration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'user_id'], 'required'],
            [['article_id', 'user_id', 'confirmed'], 'integer'],
        ];
    }

    static public function getNonConfirmed($userId)
    {
        $query = self::find();

        $query->leftJoin('articles', 'collaboration.user_id='.$userId.' AND article_id=articles.id');
        $query->where(['and', 'confirmed=0', 'articles.deleted=0']);

        return $query->all();
    }

}
