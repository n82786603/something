<?php

namespace app\models\books;

use app\interfaces\enum\ITables;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\books\Model;

/**
 * Search represents the model behind the search form about `app\models\books\Model`.
 * @property integer $release_date_end;
 * @property integer $release_date_start;
 */
class Search extends Model
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'release_date', 'created_at', 'updated_at'], 'integer'],
            [['name', 'author', 'preview_path' ,'release_date_start','release_date_end'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Model::find();

        $query->joinWith(['authorModel']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->getSort()
            ->attributes['author'] = [
            'asc' => [
                ITables::AUTHORS . '.first_name' => SORT_ASC,
                ITables::AUTHORS . '.last_name' => SORT_ASC
            ],
            'desc' => [
                ITables::AUTHORS . '.first_name' => SORT_DESC,
                ITables::AUTHORS . '.last_name' => SORT_DESC
            ],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'author_id' => $this->author_id,
            'release_date' => $this->release_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ILIKE', 'name', $this->name])
            ->andFilterWhere(['ILIKE', 'preview_path', $this->preview_path])
            ->andWhere(
                ITables::AUTHORS . '.first_name ILIKE \'%' . $this->author . '%\' OR ' .
                ITables::AUTHORS . '.last_name ILIKE \'%' . $this->author . '%\''
            );

        if($this->release_date_start && $this->release_date_end){
            $this->release_date_start = strtotime($this->release_date_start);
            $this->release_date_end = strtotime($this->release_date_end);
            if($this->release_date_start === $this->release_date_end){
                $this->release_date_end += 24 * 60 * 60;
            }
            $query->andWhere('release_date BETWEEN ' . (int)$this->release_date_start . ' AND ' . (int)$this->release_date_end);
        }

        return $dataProvider;
    }
}
