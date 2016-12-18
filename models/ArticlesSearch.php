<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * WorksSearch represents the model behind the search form about `app\models\Works`.
 * @property integer $confirmed
 */
class ArticlesSearch extends Articles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'deleted'], 'integer'],
            [['title', 'description', 'magazine_title', 'keywords'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Articles::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Articles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->user_id) {
            $query->leftJoin('collaboration c', 'c.user_id='.$this->user_id.' AND article_id=articles.id');
        }

        if (isset($params['ArticlesSearch']['confirmed'])) {
            if ($params['ArticlesSearch']['confirmed']) {
                $query->where(['and', ['or', 'c.confirmed='.$params['ArticlesSearch']['confirmed'], 'c.confirmed IS NULL'], ['or', 'articles.user_id='.$this->user_id, 'c.user_id='.$this->user_id]]);
            } else {
                $query->where(['and', ['and', 'c.confirmed='.$params['ArticlesSearch']['confirmed'], 'c.confirmed IS NOT NULL'], ['or', 'articles.user_id='.$this->user_id, 'c.user_id='.$this->user_id]]);
            }
        } else {
            $query->filterWhere([
                'articles.user_id' => $this->user_id
            ])->orFilterWhere([
                'c.user_id' => $this->user_id
            ]);
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere([
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'magazine_title', $this->magazine_title]);



        return $dataProvider;
    }
}
