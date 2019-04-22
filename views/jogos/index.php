<style>
    .table.table-striped tbody tr:hover {
        background: #c4e5ff;
    }

    .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
        color: #000000;
        background-color: #dcdedd;
        font-weight: bold;
    }

    a {
        color: #5979c1;
        text-decoration: none;
    }

    a:hover {
        color: white;
        text-decoration: none;
    }

    .nav-stacked > li + li {
        margin-left: 0;
        font-family: Arial, "Helvetica Neue", Helvetica, Arial, sans-serif;
        border-bottom: 1px solid #dadada;
        border-left: 1px solid #dadada;
        border-right: 1px solid #dadada;
    }

    #itens:hover {
        background-color: #d4d4d4;
    }

    .font-topo {
        font-size: 20px;
        font-weight: bold;
    }


    #w0-filters {
        background-color: rgba(220, 222, 221, 0);
    }

    .table thead tr {
        background-color: #dcdedd;
    }

    .tambem {
        text-align: right;
    }

    .font-topo {
        font-size: 20px;
        font-weight: bold;
    }

    #w0-filters {
        background-color: rgba(220, 222, 221, 0);
    }

    .table thead tr {
        background-color: #222;
        color:white;
    }

    .tambem {
        text-align: right;
    }

    #conteudo-index {
        padding-left: 140px;
    }
</style>
<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JogosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$model = new \app\models\Usuario();
?>

<div class="jogos-index" id="conteudo-index">

    <?php if($model->validaPermissao()){ ?>
        <p style="text-align: center">
            <?= Html::a('Cadastrar Time', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php }?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=> 'time_id_casa',
                'value'    => 'timecasa.time_nome',
                'filter'   => Html::activeDropDownList($searchModel, 'time_id_casa', ArrayHelper::map(\app\models\Times::find()->asArray()->orderBy('time_nome')->all(), 'time_id', 'time_nome'), array('class'=>'form-control', 'prompt' => ' '))
            ],
            'placar_casa',
            [
                'attribute'=> 'time_id_visitante',
                'value'    => 'timevisitante.time_nome',
                'filter'   => Html::activeDropDownList($searchModel, 'time_id_visitante', ArrayHelper::map(\app\models\Times::find()->asArray()->orderBy('time_nome')->all(), 'time_id', 'time_nome'), array('class'=>'form-control', 'prompt' => ' '))
            ],
            'placar_visitante',
            [
                'attribute'=> 'status_jogo',
                'value'    => 'status.status_jogo_dsc',
                'filter'   => Html::activeDropDownList($searchModel, 'status_jogo', ArrayHelper::map(\app\models\StatusJogo::find()->asArray()->orderBy('status_jogo_dsc')->all(), 'status_jogo_id', 'status_jogo_dsc'), array('class'=>'form-control', 'prompt' => ' '))
            ],
            'jogo_turno',
            'temporada',
            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '{view} {update} {delete} ',
                'buttons' => [
                    'view' => function ($model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-search" style="color: grey; width:20%; font-size: 1.2em; margin-left: 6%"></span>', ['view', 'id' =>$key->jogo_id ],['title' => 'Ver']);
                    },

                    'update' => function ($model, $key) {
                    $model = new \app\models\Usuario();
                    if($model->validaPermissao()){
                            return Html::a('<span  class="glyphicon glyphicon-pencil" style="color: darkblue; width:20%; font-size: 1.2em; margin-left: 6%"></span>', ['update', 'id' =>$key->jogo_id ],['title' => 'Alterar']);
                        }
                    },
                    'delete' => function ($model, $key) {
                    $model = new \app\models\Usuario();
                    if($model->validaPermissao()){
                            return Html::a('<span class="glyphicon glyphicon-trash" style="color: red; font-size: 1.2em; margin-left: 3%"></span>', ['empenho-liberar', 'id' =>$key->jogo_id],[
                                'title' => 'Deletar'
                            ]);
                        }
                    }
                ]
            ]
        ],
    ]); ?>
</div>