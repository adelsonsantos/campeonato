<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tabela */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #conteudo-index {
        padding-left: 140px;
    }
</style>
<div class="tabela-form" id="conteudo-index">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tabela_id')->textInput() ?>

    <?= $form->field($model, 'time_id')->textInput() ?>

    <?= $form->field($model, 'time_pontos')->textInput() ?>

    <?= $form->field($model, 'time_partidas_jogadas')->textInput() ?>

    <?= $form->field($model, 'time_vitorias')->textInput() ?>

    <?= $form->field($model, 'time_empates')->textInput() ?>

    <?= $form->field($model, 'time_derrotas')->textInput() ?>

    <?= $form->field($model, 'time_gols_marcados')->textInput() ?>

    <?= $form->field($model, 'time_gols_sofridos')->textInput() ?>

    <?= $form->field($model, 'time_gols_saldo')->textInput() ?>

    <?= $form->field($model, 'tabela_turno')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
