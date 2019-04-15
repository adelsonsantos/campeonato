<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabelaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tabela-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tabela_id') ?>

    <?= $form->field($model, 'time_id') ?>

    <?= $form->field($model, 'time_pontos') ?>

    <?= $form->field($model, 'time_partidas_jogadas') ?>

    <?= $form->field($model, 'time_vitorias') ?>

    <?php // echo $form->field($model, 'time_empates') ?>

    <?php // echo $form->field($model, 'time_derrotas') ?>

    <?php // echo $form->field($model, 'time_gols_marcados') ?>

    <?php // echo $form->field($model, 'time_gols_sofridos') ?>

    <?php // echo $form->field($model, 'time_gols_saldo') ?>

    <?php // echo $form->field($model, 'tabela_turno') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
