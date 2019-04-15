<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campeonato.tabela".
 *
 * @property int $tabela_id
 * @property int $time_id
 * @property int $time_pontos
 * @property int $time_partidas_jogadas
 * @property int $time_vitorias
 * @property int $time_empates
 * @property int $time_derrotas
 * @property int $time_gols_marcados
 * @property int $time_gols_sofridos
 * @property int $time_gols_saldo
 * @property int $tabela_turno
 * @property int $temporada
 * @property int $status
 */
class Tabela extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campeonato.tabela';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tabela_id', 'time_id', 'temporada'], 'required'],
            [['tabela_id', 'time_id', 'time_pontos', 'time_partidas_jogadas', 'time_vitorias', 'time_empates', 'time_derrotas', 'time_gols_marcados', 'time_gols_sofridos', 'time_gols_saldo', 'tabela_turno', 'status', 'temporada' ], 'integer'],
            [['tabela_id'], 'unique'],
            [['time_id'], 'exist', 'skipOnError' => true, 'targetClass' => Times::className(), 'targetAttribute' => ['time_id' => 'time_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tabela_id' => 'Tabela ID',
            'time_id' => 'Time ID',
            'time_pontos' => 'Time Pontos',
            'time_partidas_jogadas' => 'Time Partidas Jogadas',
            'time_vitorias' => 'Time Vitorias',
            'time_empates' => 'Time Empates',
            'time_derrotas' => 'Time Derrotas',
            'time_gols_marcados' => 'Time Gols Marcados',
            'time_gols_sofridos' => 'Time Gols Sofridos',
            'time_gols_saldo' => 'Time Gols Saldo',
            'tabela_turno' => 'Tabela Turno',
            'status' => 'Status',
            'temporada' => 'temporada'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimes()
    {
        return $this->hasOne(Times::className(), ['time_id' => 'time_id']);
    }
}
