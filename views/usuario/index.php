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

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';

?>

<div class="usuario-index" id="conteudo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(Yii::$app->getUser()->id == 1){?>
        <p style="text-align: center;">
            <?= Html::a('Cadastrar Usuário', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php }?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'usuario_id',
            'usuario_nome',
            'usuario_status',
            'usuario_login',
            'usuario_acesso',
            //'usuario_foto:ntext',
            //'time_id:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'template' => '{view} {update} {delete} ',
                'buttons' => [
                    'view' => function ($model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-search" style="color: grey; width:20%; font-size: 1.2em; margin-left: 6%"></span>', ['view', 'id' =>$key->usuario_id ],['title' => 'Ver']);
                    },

                    'update' => function ($model, $key) {
                        if(Yii::$app->getUser()->id == 1 || $key->usuario_id == Yii::$app->getUser()->id){
                            return Html::a('<span  class="glyphicon glyphicon-pencil" style="color: darkblue; width:20%; font-size: 1.2em; margin-left: 6%"></span>', ['update', 'id' =>$key->usuario_id ],['title' => 'Alterar']);
                        }
                    },
                    'delete' => function ($model, $key) {
                        if(Yii::$app->getUser()->id == 1){
                            return Html::a('<span class="glyphicon glyphicon-trash" style="color: red; font-size: 1.2em; margin-left: 3%"></span>', ['empenho-liberar', 'id' =>$key->usuario_id],[
                                'title' => 'Deletar'
                            ]);
                        }
                    }
                ]
            ],
        ],
    ]); ?>
</div>


