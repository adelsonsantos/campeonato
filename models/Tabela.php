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
                ->orderBy(['jogo_data' => SORT_ASC])
                ->limit($limit)
                ->all();

     return $meusJogos;
    }

    public function getCorUltimosJogos($timeId, $temporada, $statusJogo, $limite){
        $sql = "select 
            j.jogo_id,
            j.time_id_casa,
            j.placar_casa,
            j.time_id_visitante,
            j.placar_visitante,
            j.jogo_data,
            t1.time_nome as casa,
            t2.time_nome as visitante,
            CASE
            WHEN j.time_id_casa       = ".$timeId." and j.placar_casa   >  j.placar_visitante THEN '#3AA757' 
            WHEN j.time_id_visitante  = ".$timeId." and j.placar_casa   <  j.placar_visitante THEN '#3AA757'
            WHEN j.time_id_casa       = ".$timeId." and j.placar_casa   =  j.placar_visitante THEN '#5d5f61'
            WHEN j.time_id_visitante  = ".$timeId." and j.placar_casa   =  j.placar_visitante THEN '#5d5f61'
            WHEN j.time_id_casa       = ".$timeId." and j.placar_casa   <  j.placar_visitante THEN '#EA4335'
            WHEN j.time_id_visitante  = ".$timeId." and j.placar_casa   >  j.placar_visitante THEN '#EA4335'
            ELSE '#9AA0A6'
        END AS cor
        from jogos j 
        join times t1 on j.time_id_casa = t1.time_id
        join times t2 on j.time_id_visitante = t2.time_id
        WHERE status_jogo = $statusJogo and (j.time_id_casa = $timeId or j.time_id_visitante = $timeId) and temporada = $temporada
        order by j.jogo_data desc
        LIMIT $limite";

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql)->queryAll();
      //  $result = $command->queryAll();
       // $list = Yii::app()->db->createCommand($sql)->queryAll();

        return $command;
    }

    function retornaCorNaTabelaClassificacao($contadorCor)
    {
        $corClassificado = "#0af107";
        $corPadrao = "#909090";
        $corRebaixado = "#e60101";
        if ($contadorCor <= 4) {
            $cor = $corClassificado;
        } elseif ($contadorCor < 11) {
            $cor = $corPadrao;
        } else {
            $cor = $corRebaixado;
        }
        return $cor;
    }
}


/*
 * <?php // cadastra todos os jogos de todos os times
    $times = array(
        1 => array( 'id'=>1, 'name' => 'abp'),
        2 => array( 'id'=>2, 'name' => 'ble'),
        3 => array( 'id'=>3, 'name' => 'bah')
    );
    $jogo = array( 0 => Array
        (
            'time_casa_id' => 1,
            'time_nome' => 'abp--',
            'time_visitante_id' => 2,
            'time_nome_visitante' => 'ble--'
        ));
    foreach ($times as $time) {
        foreach ($times as $time2) {
            if($time['id'] != $time2['id']){
                foreach ($jogo as $jg){
                    if(($jg['time_casa_id'] != $time['id']) && ($jg['time_visitante_id'] != $time2['id'])){
                        $jogo[] =  array('time_casa_id' => $time['id'], 'time_nome'=>$time['name'], 'time_visitante_id'=>$time2['id'], 'time_nome_visitante'=>$time2['name']);
                    }
                }
            }
        }
    }

    echo "<pre>";
    print_r($jogo);
//// fiim

<?php
    $contador = 0;
    $times = array(
        1 => array( 'id'=>1, 'name' => 'abp'),
        2 => array( 'id'=>2, 'name' => 'ble'),
        3 => array( 'id'=>3, 'name' => 'bah'),
        4 => array( 'id'=>4, 'name' => 'vit')
    );

    $turno = 1;
    $jogo = array();
    foreach ($times as $time) {
        foreach ($times as $time2) {
            if($time['id'] != $time2['id']){
                $contador++;

               if(count($times) <= $contador){
                   if(count($times)+1 == $contador){
                       $turno = 1;
                   }else{
                       $turno = 2;
                   }
               }
                $jogo[] =  array('time_casa_id' => $time['id'], 'time_nome'=>$time['name'], 'time_visitante_id'=>$time2['id'], 'time_nome_visitante'=>$time2['name'], 'turno'=> $turno);

            }
        }
    }

    echo "<pre>";
   // print_r($jogo);

    foreach ($jogo as $item){
        if($item['time_nome'] == 'vit' || $item['time_nome_visitante'] == 'vit'){
            print_r($item);
        }
    }
    ?>



$('#conteudo_principal').bind('mousewheel', function(e){

             if($('#preenchimento-massa').offset().top <= 194){
                 $("#botao-fixo").css({ top: '43px' });
                 $("#preenchimento-massa").css({ top: '60px' });
             }else{
                 $("#preenchimento-massa").css({ top: '10px' });
                 $("#botao-fixo").css({ top: '0' });
             }
    });

*/