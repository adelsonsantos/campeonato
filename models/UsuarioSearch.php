<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usuario_id', 'usuario_status', 'time_id', 'usuario_acesso'], 'integer'],
            [['usuario_nome', 'usuario_login', 'usuario_senha', 'usuario_foto'], 'safe'],
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
        $query = Usuario::find();

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
            'time_id' => $this->time_id,
            'usuario_acesso' => $this->usuario_acesso,
        ]);

        $query->andFilterWhere(['like', 'usuario_nome', $this->usuario_nome])
            ->andFilterWhere(['like', 'usuario_login', $this->usuario_login])
            ->andFilterWhere(['like', 'usuario_senha', $this->usuario_senha])
            ->andFilterWhere(['like', 'usuario_foto', $this->usuario_foto]);

        return $dataProvider;
    }
}
