<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnijorgeUsuario;

/**
 * UnijorgeUsuarioSearch represents the model behind the search form of `app\models\UnijorgeUsuario`.
 */
class UnijorgeUsuarioSearch extends UnijorgeUsuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'usuario_status'], 'integer'],
            [['usuario_nome', 'usuario_cpf', 'usuario_senha', 'usuario_foto'], 'safe'],
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
        $query = UnijorgeUsuario::find();

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
            'usuario_id' => $this->usuario_id,
            'usuario_status' => $this->usuario_status,
        ]);

        $query->andFilterWhere(['like', 'usuario_nome', $this->usuario_nome])
            ->andFilterWhere(['like', 'usuario_cpf', $this->usuario_cpf])
            ->andFilterWhere(['like', 'usuario_senha', $this->usuario_senha])
            ->andFilterWhere(['like', 'usuario_foto', $this->usuario_foto]);

        return $dataProvider;
    }
}
