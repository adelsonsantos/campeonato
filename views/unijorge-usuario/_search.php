<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UnijorgeUsuarioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unijorge-usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'usuario_nome') ?>

    <?= $form->field($model, 'usuario_status') ?>

    <?= $form->field($model, 'usuario_cpf') ?>

    <?= $form->field($model, 'usuario_senha') ?>

    <?php // echo $form->field($model, 'usuario_foto') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
