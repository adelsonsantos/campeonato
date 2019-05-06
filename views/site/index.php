<?php

/* @var $this yii\web\View */

use app\models\Jogos;
use yii\helpers\Html;
include_once "style.php";
$this->title = 'Campeonato PES Narandiba';

$tabelaClass = new \app\models\Tabela();

$tabela = $tabelaClass->getTabelaPorTemporada(2);
$jogos = $tabelaClass->getUltimosJogos(2, 2, 5);
$meusJogos = $tabelaClass->getMeusUltimosJogos(2, 2, 5);
$res = $tabelaClass->getCorUltimosJogos(2, 2, 2, 5);
/*
echo "<pre>";
print_r($res);
die;*/


$teste = "
select DISTINCT
ta.tabela_id, 
ta.time_id,
ta.time_pontos,
j1.jogo_id,
j1.time_id_casa,
j1.placar_casa,
j1.time_id_visitante,
j1.placar_visitante

from tabela ta 
join times ti on ti.time_id = ta.time_id
join jogos j1 on ti.time_id = j1.time_id_casa
join jogos j2 on ti.time_id = j2.time_id_visitante
where ta.temporada = 2 and ta.time_id = 1 and j1.temporada = 2 and j2.temporada = 2
order by j1.jogo_data desc";
?>
<div class="row" id="conteudo-index">
    <?php /**
     * @param $contadorCor
     * @param $corClassificado
     * @param $corPadrao
     * @param $corRebaixado
     * @return mixed
     */


    if(!empty($tabela)){?>
    <div class="col-lg-12" id="conteudo-itemm">
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
                <th style="text-align:center">Ult. Jogos</th>
            </tr>
            <?php

            $contadorCor = 0;

            foreach ($tabela as $value) {
                $contadorCor++;
                $cor = $tabelaClass->retornaCorNaTabelaClassificacao($contadorCor); ?>
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
                    <?php $dadosUltimosJogos = $tabelaClass->getCorUltimosJogos($value['time_id'], 2, 2, 5); ?>
                    <td style="text-align:center; white-space: nowrap;">
                        <?php foreach ($dadosUltimosJogos as $item){
                            echo "<span title='" . $item['casa'] ." ". $item['placar_casa']." vs " . $item['placar_visitante'] ." ". $item['visitante'] ."' class='glyphicon glyphicon-record' style='margin-left: 7px; color:".$item['cor']."'></span>";
                        }?>
                    </td>
                </tr>
            <?php }
            ?>
        </table>
    </div>
    <?php }

    if(!empty($jogos)){?>
    <div class="col-xs-4" id="conteudo-item">
        <div class="row" style=" margin-left: 55px;  font-weight: bold;">ULTIMOS 5 JOGOS</div>
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