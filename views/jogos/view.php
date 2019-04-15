<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $model->jogo_id;

?>
<style>
    table.diaria {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th.borda {
        border: 0.5px solid #b5b5b5;
        text-align: left;
        padding: 8px;
    }
    tr.bordaMenu {
        background-color: #cecece;
    }
    tr:nth-child(even) {
        background-color: #ffffff;
    }
    .font-topo {
        font-size: 20px;
        font-weight: bold;
    }

    #conteudo-index {
        padding-left: 140px;
    }
</style>
<?php


/* @var $this yii\web\View */
/* @var $model app\models\jogos */

?>
<div class="usuario-view" id="conteudo-index">

    <div style="text-align: center">
        <h1 class="font-topo">Jogo <?= $model->jogo_id; ?></h1>
    </div>

    <div class="diarias-view" style=" margin-top: 40px;">
        <table class="diaria">
            <tr class="bordaMenu">
                <th class="borda" style="width: 25%">Time da Casa</th>
                <th class="borda" style="width: 25%">Placar casa</th>
                <th class="borda" style="width: 25%">Placar Visitante</th>
                <th class="borda" style="width: 25%">Time visitante</th>
            </tr>
            <tr>
                <td class="borda" style="width: 25%"><?= Html::img('data:image/png;base64,' .\app\models\Times::find()->select('time_foto')->where(['time_id' => $model->time_id_casa])->one()->time_foto ,
                        ['width' => '50px', 'height' => '50px'])." ".\app\models\Times::find()->select('time_nome')->where(['time_id' => $model->time_id_casa])->one()->time_nome; ?></td>
                <td class="borda" style="width: 25%"><?= $model->placar_casa; ?></td>
                <td class="borda" style="width: 25%"><?= $model->placar_visitante; ?></td>
                <td class="borda" style="width: 25%"><?= Html::img('data:image/png;base64,' .\app\models\Times::find()->select('time_foto')->where(['time_id' => $model->time_id_visitante])->one()->time_foto ,
                        ['width' => '50px', 'height' => '50px'])." ".\app\models\Times::find()->select('time_nome')->where(['time_id' => $model->time_id_visitante])->one()->time_nome; ?></td>
            </tr>
        </table>
    </div>
    <br>
    <table class="diaria" style=" width: 100%">
        <tr class="bordaMenu">


            <?php if(Yii::$app->getUser()->id == 1){ ?>
                <th class="borda" style="text-align: center; width: 33%">
                    <?= Html::a('Alterar', ['update', 'id' => $model->time_id_casa], ['class' => 'btn btn-primary']) ?>
                </th>
            <?php } ?>


            <?php if(Yii::$app->getUser()->id == 1){ ?>
            <th class="borda"  style="text-align: center; width: 33%">
                <?= Html::a('Deletar', ['delete', 'id' => $model->time_id_casa], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Tem certeza de que deseja excluir este usuário?',
                        'method' => 'post',
                    ],
                ]) ?>
            </th>
            <?php } ?>
            <th class="borda" style="text-align: center; width: 33%">
                <?= Html::a('Voltar', Yii::$app->request->referrer, ['class' => 'btn btn-default']); ?>
            </th>
        </tr>
    </table>
</div>

