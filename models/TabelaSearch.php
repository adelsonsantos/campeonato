<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tabela;

/**
 * TabelaSearch represents the model behind the search form of `app\models\Tabela`.
 */
class TabelaSearch extends Tabela
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tabela_id', 'time_id', 'temporada', 'time_pontos', 'time_partidas_jogadas', 'time_vitorias', 'time_empates', 'time_derrotas', 'time_gols_marcados', 'time_gols_sofridos', 'time_gols_saldo', 'tabela_turno', 'status'], 'integer'],
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
        $query = Tabela::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'tabela_id' => $this->tabela_id,
            'time_id' => $this->time_id,
            'time_pontos' => $this->time_pontos,
            'time_partidas_jogadas' => $this->time_partidas_jogadas,
            'time_vitorias' => $this->time_vitorias,
            'time_empates' => $this->time_empates,
            'time_derrotas' => $this->time_derrotas,
            'time_gols_marcados' => $this->time_gols_marcados,
            'time_gols_sofridos' => $this->time_gols_sofridos,
            'time_gols_saldo' => $this->time_gols_saldo,
            'tabela_turno' => $this->tabela_turno,
            'temporada' => $this->temporada,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
