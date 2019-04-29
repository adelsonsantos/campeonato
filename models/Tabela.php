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
            [['tabela_id', 'time_id', 'time_pontos', 'time_partidas_jogadas', 'time_vitorias', 'time_empates', 'time_derrotas', 'time_gols_marcados', 'time_gols_sofridos', 'time_gols_saldo', 'tabela_turno', 'status', 'temporada'], 'integer'],
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

    public function getJogosVisitante()
    {
        return $this->hasMany(Jogos::className(), ['time_id_visitante' => 'time_id']);
    }

    public function getJogosCasa()
    {
        return $this->hasMany(Jogos::className(), ['time_id_casa' => 'time_id']);
    }

    public function getUltimosJogos($statusJogo, $temporada, $limit){
        $jogos = Jogos::find()->joinWith(
            [
                'timecasa' => function ($q) {
                    $q->from('campeonato.times tms');
                }
            ])->joinWith([
                'timevisitante' => function ($q) {
                    $q->from('campeonato.times tme');
            }]) ->asArray()
                ->where(['status_jogo' => $statusJogo])
                ->andWhere(['temporada' => $temporada])
                ->orderBy(['jogo_data' => SORT_DESC])
                ->limit($limit)
                ->all();

        return $jogos;
    }

    public function getTabelaPorTemporada($temporadaId)
    {
        $tabela = \app\models\Tabela::find()->joinWith('times')->orderBy(
            [
                'time_pontos' => SORT_DESC,
                'time_partidas_jogadas' => SORT_DESC,
                'time_vitorias' => SORT_DESC,
                'time_empates' => SORT_DESC,
                'time_derrotas' => SORT_DESC,
                'time_gols_marcados' => SORT_DESC,
                'time_gols_sofridos' => SORT_DESC,
                'time_gols_saldo' => SORT_DESC,
                'times.time_nome' => SORT_ASC
            ]
        )->asArray()->where(['temporada' => $temporadaId])->all();

        return $tabela;
    }

    public function getMeusUltimosJogos($statusJogo, $temporada, $limit){
        $idTime = \app\models\Usuario::find()->where(['usuario_id'=>Yii::$app->getUser()->id])->one()->time_id;

        $meusJogos = Jogos::find()->joinWith(
            [
                'timecasa' => function ($q) {
                    $q->from('campeonato.times tms');
                }
            ])->joinWith([
                'timevisitante' => function ($q) {
                    $q->from('campeonato.times tme');
            }]) ->asArray()
                ->where(['status_jogo' => $statusJogo])
                ->andWhere(['time_id_casa' => $idTime])
                ->orWhere(['time_id_visitante' => $idTime])
                ->andWhere(['temporada' => $temporada])
                ->orderBy(['jogo_data' => SORT_DESC])
                ->limit($limit)
                ->all();

     return $meusJogos;
    }


}


$tt = "select j.jogo_id,
j.time_id_casa,
j.placar_casa,
j.time_id_visitante,
j.placar_visitante,
j.jogo_data,
t1.time_nome,
t2.time_nome
from jogos j 
join times t1 on j.time_id_casa = t1.time_id
join times t2 on j.time_id_visitante = t2.time_id
WHERE status_jogo = 2 and (j.time_id_casa = 1 or j.time_id_visitante = 1) and temporada = 2";