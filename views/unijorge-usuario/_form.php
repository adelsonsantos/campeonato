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
</style>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\UnijorgeUsuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unijorge-usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <?= $form->field($model, 'usuario_nome')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'usuario_nome')->widget(MaskedInput::className(), [
                                'mask' => '999.999.999-99',
                            ]) ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-5">
                            <?= $form->field($model, 'usuario_senha')->passwordInput(['rows' => 6]) ?>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-4">
                            <?= $form->field($model, 'usuario_senha_repeat')->passwordInput(['rows' => 6]) ?>
                        </div>
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
