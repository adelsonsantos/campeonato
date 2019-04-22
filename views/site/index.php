<?php

/* @var $this yii\web\View */

use app\models\Jogos;
use yii\helpers\Html;

$this->title = 'Campeonato PES Narandiba';


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
)->asArray()->where(['temporada' => 2])->all();

$jogos = Jogos::find()->joinWith(
    [
        'timecasa' => function ($q) {
            $q->from('campeonato.times tms');
        }
    ])->joinWith([
    'timevisitante' => function ($q) {
        $q->from('campeonato.times tme');
    }])->asArray()->where(['status_jogo' => 2])->andWhere(['temporada' => 2])->orderBy(['jogo_data' => SORT_DESC])->limit(5)->all();


$idTime = \app\models\Usuario::find()->where(['usuario_id'=>Yii::$app->getUser()->id])->one()->time_id;

$meusJogos = Jogos::find()->joinWith(
    [
        'timecasa' => function ($q) {
            $q->from('campeonato.times tms');
        }
    ])->joinWith([
    'timevisitante' => function ($q) {
        $q->from('campeonato.times tme');
    }])->asArray()->where(['status_jogo' => 2])->andWhere(['time_id_casa' => $idTime])->orWhere(['time_id_visitante' => $idTime])->andWhere(['temporada' => 2])->orderBy(['jogo_data' => SORT_DESC])->limit(5)->all();


?>

<style>
    #classificacao table {
        font-family: arial, sans-serif;
        border-collapse: collapse;

        font-weight: bold;
    }

    #classificacao td, th {
        border: 1px solid #949090;
        text-align: left;
        padding: 5px;
        font-weight: bold;
        font-size: 25px;
    }

    #classificacao tr:nth-child(even) {
        background-color: #dddddd;
    }

    #classificacao th, .table-dark thead th {
        border-color: white;
        color: white;
        background-color: #222;
    }


    #jogos table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        font-weight: bold;
    }

    #jogos td, th {
        border: 1px solid #949090;
        text-align: left;
        padding: 5px;
        font-weight: bold;
        font-size: 25px;
    }

    #jogos tr:nth-child(even) {
        background-color: rgba(221, 221, 221, 0.42);
    }

    #jogos th, .table-dark thead th {
        border-color: white;
        color: white;
        background-color: #989898;
    }

    #conteudo-index {
        padding-left: 130px;
    }

    #conteudo-itemm {
        min-width: 250px;
        max-width: 800px;
        margin-top: 10px;
    }
    #conteudo-item {
        min-width: 440px;
        max-width: 250px;
        margin-top: 10px;
    }
</style>
<div class="row" id="conteudo-index">
    <?php if(!empty($tabela)){?>
    <div class="col-lg-8" id="conteudo-itemm">
        <div class="row" style=" margin-left: 5px;  font-weight: bold;">CLASSIFICAÇÃO</div>
        <table id="classificacao" style="width:100%;">
            <tr>
                <th width="5px"></th>
                <th width="5px">#</th>
                <th>Clube</th>
                <th style="text-align:center">Pts</th>
                <th style="text-align:center">PJ</th>
                <th style="text-align:center">VIT</th>
                <th style="text-align:center">EM</th>
                <th style="text-align:center">DE</th>
                <th style="text-align:center">GP</th>
                <th style="text-align:center">GC</th>
                <th style="text-align:center">SG</th>
            </tr>
            <?php
            $corClassificado = "#0af107";
            $corPadrao = "#909090";
            $corRebaixado = "#e60101";
            $contadorCor = 0;

            foreach ($tabela as $value) {
                $contadorCor++;
                if($contadorCor <= 4){
                    $cor = $corClassificado;
                }elseif($contadorCor < 11 ){
                    $cor = $corPadrao;
                }else{
                    $cor = $corRebaixado;
                }



                ?>
                <tr>
                    <td width="5px" style="background-color: <?php echo $cor; ?>"></td>
                    <td width="5px" > <?php echo $contadorCor; ?></td>
                    <td style="white-space: nowrap;"><?= Html::img('data:image/png;base64,' . $value['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) . "  " . $value['times']['time_nome'] ?></td>
                    <td style="text-align:center"><?= $value['time_pontos'] ?></td>
                    <td style="text-align:center"><?= $value['time_partidas_jogadas'] ?></td>
                    <td style="text-align:center"><?= $value['time_vitorias'] ?></td>
                    <td style="text-align:center"><?= $value['time_empates'] ?></td>
                    <td style="text-align:center"><?= $value['time_derrotas'] ?></td>
                    <td style="text-align:center"><?= $value['time_gols_marcados'] ?></td>
                    <td style="text-align:center"><?= $value['time_gols_sofridos'] ?></td>
                    <td style="text-align:center"><?= $value['time_gols_saldo'] ?></td>
                </tr>
            <?php }
            ?>
        </table>
    </div>
    <?php }

    if(!empty($jogos)){?>
    <div class="col-xs-4" id="conteudo-item">
        <div class="row" style=" margin-left: 5px;  font-weight: bold;">ULTIMOS 5 JOGOS</div>
        <table id="jogos" class="table table-dark">
            <tr>

                <th style="text-align:center">Casa</th>
                <th style="text-align:center">Placar</th>
                <th style="text-align:center">vs</th>
                <th style="text-align:center">Placar</th>
                <th style="text-align:center">Visitante</th>
            </tr>
            <?php
            foreach ($jogos as $value) { ?>
                <tr>
                    <td><?= Html::img('data:image/png;base64,' . $value['timecasa']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center"><?= $value['placar_casa'] ?></td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center"><?= $value['placar_visitante'] ?></td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $value['timevisitante']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>

                </tr>
            <?php }
            ?>
        </table>
    </div>
    <?php }?>

    <?php
    if(!empty($meusJogos)){?>
    <div class="col-xs-4" id="conteudo-item">
        <div class="row" style="margin-left: 5px;  font-weight: bold;">MEUS ULTIMOS 5 JOGOS</div>
        <table id="jogos"  class="table table-dark">
            <tr>

                <th style="text-align:center">Casa</th>
                <th style="text-align:center">Placar</th>
                <th style="text-align:center">vs</th>
                <th style="text-align:center">Placar</th>
                <th style="text-align:center">Visitante</th>
            </tr>
            <?php
            foreach ($meusJogos as $value) { ?>
                <tr>
                    <td><?= Html::img('data:image/png;base64,' . $value['timecasa']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center"><?= $value['placar_casa'] ?></td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center"><?= $value['placar_visitante'] ?></td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $value['timevisitante']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>

                </tr>
            <?php }
            ?>
        </table>
    </div>
    <?php }?>
</div>