<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JogosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jogos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jogo_id') ?>

    <?= $form->field($model, 'time_id_casa') ?>

    <?= $form->field($model, 'placar_casa') ?>

    <?= $form->field($model, 'time_id_visitante') ?>

    <?= $form->field($model, 'placar_visitante') ?>

    <?php // echo $form->field($model, 'jogo_turno') ?>

    <?php // echo $form->field($model, 'status_jogo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
