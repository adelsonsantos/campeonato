<style>
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
         padding-left: 140px;
     }
</style>

<?php
/**
 * Created by PhpStorm.
 * User: adelson
 * Date: 24/03/2019
 * Time: 22:40
 */

use yii\helpers\Html;

$semifinalistas = \app\models\Tabela::find()->joinWith('times')->orderBy(
    [
        'time_pontos' => SORT_DESC,
        'time_partidas_jogadas' => SORT_DESC,
        'time_vitorias' => SORT_DESC,
        'time_empates' => SORT_DESC,
        'time_derrotas' => SORT_DESC,
        'time_gols_marcados' => SORT_DESC,
        'time_gols_sofridos' => SORT_DESC,
        'time_gols_saldo' => SORT_DESC
    ]
)->asArray()->limit(4)->all();
/*
echo "<pre>";
print_r($semifinalistas);*/
?>
<div id="conteudo-index">

    <table width="100%" id="jogos">
        <tr>
            <th style="text-align:center">Semifinal</th>
        </tr>
    </table>

    <div class="row" style="margin-top: 100px;">
        <div class="col-lg-6">
            <div class="row" style="margin-top: -10%; margin-left: 5px;  font-weight: bold;">JOGOS A</div>
            <table id="jogos" style="width:100%;" class="table table-dark">
                <tr>

                    <th style="text-align:center">Casa</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">vs</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">Visitante</th>
                </tr>
                <tr>
                    <td><?= Html::img('data:image/png;base64,' . $semifinalistas[0]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center">1</td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center">1</td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[3]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                </tr>
                <tr>
                    <td><?= Html::img('data:image/png;base64,' . $semifinalistas[3]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center">0</td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center">3</td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[0]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                </tr>
            </table>
        </div>


        <div class="col-lg-6">
            <div class="row" style="margin-top: -10%; margin-left: 5px;  font-weight: bold;">JOGOS B</div>
            <table id="jogos" style="width:100%;" class="table table-dark">
                <tr>

                    <th style="text-align:center">Casa</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">vs</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">Visitante</th>
                </tr>


                <tr>
                    <td><?= Html::img('data:image/png;base64,' . $semifinalistas[1]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center">2</td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center">0</td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[2]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>

                </tr>
                <tr>
                    <td><?= Html::img('data:image/png;base64,' . $semifinalistas[2]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center">0</td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center">2</td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[1]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                </tr>

            </table>
            <div class="row" style="margin-left: 5px; margin-top: -10px; text-align: center; font-weight: bold;">
                Pênaltis: JUVENTUS 4 X 5 BAHIA
            </div>
        </div>
    </div>

    <br>


    <table width="100%" id="jogos">
        <tr>
            <th style="text-align:center">Final</th>
        </tr>
    </table>

    <div class="row" style="margin-top: 100px;">
        <div class="col-lg-6" style="margin-left: 30%;">
            <div class="row" style="margin-top: -10%; margin-left: 5px;  font-weight: bold;">JOGOS</div>
            <table id="jogos" style="width:50%;" class="table table-dark">
                <tr>

                    <th style="text-align:center">Casa</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">vs</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">Visitante</th>
                </tr>
                <tr>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[1]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center">2</td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center">1</td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[0]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                </tr>
                <tr>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[0]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center">0</td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center">1</td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[1]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                </tr>
            </table>
        </div>
    </div>


    //


    <table width="100%" id="jogos">
        <tr>
            <th style="text-align:center">3° Lugar</th>
        </tr>
    </table>

    <div class="row" style="margin-top: 100px;">
        <div class="col-lg-6" style="margin-left: 30%;">
            <div class="row" style="margin-top: -10%; margin-left: 5px;  font-weight: bold;">JOGOS</div>
            <table id="jogos" style="width:50%;" class="table table-dark">
                <tr>

                    <th style="text-align:center">Casa</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">vs</th>
                    <th style="text-align:center">Placar</th>
                    <th style="text-align:center">Visitante</th>
                </tr>
                <tr>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[2]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center"></td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center"></td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[3]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                </tr>
                <tr>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[3]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                    <td style="text-align:center"></td>
                    <td style="text-align:center"><?= " vs " ?></td>
                    <td style="text-align:center"></td>
                    <td style="text-align:center"><?= Html::img('data:image/png;base64,' . $semifinalistas[2]['times']['time_foto'],
                            ['width' => '50px', 'height' => '50px']) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>