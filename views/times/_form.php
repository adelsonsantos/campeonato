<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Times */
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

<div class="times-form" id="conteudo-index">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($model, 'time_nome')->textInput(['maxlength' => true])->label('Nome do Time') ?>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-4">
                        <?= $form->field($model, 'time_status')->dropDownList([0 => 'Ativo', 1 => 'Inativo'])->label('Status');
                        ?>
                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-lg-12">
                        <?php
                        try {
                            echo $form->field($model, 'image')->widget(FileInput::classname(), [
                                'options' => ['accept' => 'image/*'],
                                'id' => 'time_foto',
                                'language' => 'pt',
                                'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => true,],
                            ])->label('Escudo');
                        } catch (Exception $e) {
                        } ?>
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

    <?php echo $model::find()->orderBy(['time_id'=>SORT_DESC])->one()['time_id'];?>
    <?php ActiveForm::end(); ?>
</div>


