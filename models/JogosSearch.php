<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jogos;

/**
 * JogosSearch represents the model behind the search form of `app\models\Jogos`.
 */
class JogosSearch extends Jogos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jogo_id', 'time_id_casa', 'temporada', 'jogo_data', 'placar_casa', 'time_id_visitante', 'placar_visitante', 'jogo_turno', 'status_jogo'], 'integer'],
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
        $query = Jogos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             //$query->where(['temporada' => 2]);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'jogo_id' => $this->jogo_id,
            'time_id_casa' => $this->time_id_casa,
            'placar_casa' => $this->placar_casa,
            'time_id_visitante' => $this->time_id_visitante,
            'placar_visitante' => $this->placar_visitante,
            'jogo_turno' => $this->jogo_turno,
            'status_jogo' => $this->status_jogo,
            'jogo_data' => $this->jogo_data,
            'temporada' => $this->temporada
        ]);

        return $dataProvider;
    }
}
