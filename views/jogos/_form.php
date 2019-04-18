<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */
/* @var $form yii\widgets\ActiveForm */
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

<div class="jogos-form" id="conteudo-index">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-3">
                        <?= $form->field($model, 'time_id_casa')->dropDownList(ArrayHelper::map(\app\models\Times::find()->asArray()->orderBy('time_nome')->all(), 'time_id', 'time_nome'))->label('Time da Casa'); ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'placar_casa')->textInput(['type' => 'number']) ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'placar_visitante')->textInput(['type' => 'number']) ?>
                    </div>
                    <div class="col-sm-3">
                        <?= $form->field($model, 'time_id_visitante')->dropDownList(ArrayHelper::map(\app\models\Times::find()->asArray()->orderBy('time_nome')->all(), 'time_id', 'time_nome'))->label('Time Visitante');
                        ?>
                    </div>

                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-sm-2">
                        <?= $form->field($model, 'jogo_turno')->dropDownList([1 => ' 1° ', 2 => ' 2° '])->label('Turno'); ?>
                    </div>
                    <div class="col-sm-2">
                        <?= $form->field($model, 'status_jogo')->dropDownList([
                                1 => 'A Realizar',
                                2 => 'Realizado',
                                3 => 'Cancelado'
                            ]
                        )->label('Status'); ?>
                    </div>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($model, 'temporada')->textInput(['type' => 'number'])->label('Temporada'); ?>
                </div>
            </div>
        </div>
    </div>

    <table class="diaria" style=" width: 100%">
        <tr class="bordaMenu">
            <th class="borda" style="text-align: center; width: 50%">
                <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
            </th>
            <th class="borda" style="text-align: center; width: 50%">
                <?= Html::a('Voltar', Yii::$app->request->referrer, ['class' => 'btn btn-default']); ?>
            </th>
        </tr>
    </table>

    <?php ActiveForm::end(); ?>
</div>



