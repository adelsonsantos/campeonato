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

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

?>
<div class="usuario-view" id="conteudo-index">

    <div style="text-align: center">
        <h1 class="font-topo">Usuário <?= $model->usuario_nome; ?></h1>
    </div>

    <div class="diarias-view" style=" margin-top: 40px;">
        <table class="diaria">
            <tr class="bordaMenu">
                <th class="borda" style="width: 25%">Nome</th>
                <th class="borda" style="width: 25%">CPF</th>
                <th class="borda" style="width: 25%">Status</th>
                <th class="borda" style="width: 25%">Senha</th>
                <th class="borda" style="width: 25%">Permissão</th>
            </tr>
            <tr>
                <td class="borda" style="width: 25%"><?= $model->usuario_nome; ?></td>
                <td class="borda" style="width: 25%"><?= $model->usuario_login; ?></td>
                <td class="borda" style="width: 25%"><?= "Ativo"; ?></td>
                <td class="borda" style="width: 25%"><?= $model->usuario_senha; ?></td>
                <td class="borda" style="width: 25%"><?= $model->usuario_permissao; ?></td>
            </tr>
        </table>
    </div>
    <br>
    <table class="diaria" style=" width: 100%">
        <tr class="bordaMenu">
            <?php if(Yii::$app->getUser()->id == 1){?>
                <th class="borda" style="text-align: center; width: 33%">
                    <?= Html::a('Alterar', ['update', 'id' => $model->usuario_id], ['class' => 'btn btn-primary']) ?>
                </th>
            <?php }?>

            <?php if(Yii::$app->getUser()->id == 1){?>
            <th class="borda"  style="text-align: center; width: 33%">
                <?= Html::a('Deletar', ['delete', 'id' => $model->usuario_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Tem certeza de que deseja excluir este usuário?',
                        'method' => 'post',
                    ],
                ]) ?>
            </th>
            <?php }?>

            <th class="borda" style="text-align: center; width: 33%">
                <?= Html::a('Voltar', Yii::$app->request->referrer, ['class' => 'btn btn-default']); ?>
            </th>
        </tr>
    </table>
</div>
