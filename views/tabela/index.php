<style>
    #conteudo-index {
        padding-left: 140px;
    }
</style>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabelaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tabelas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tabela-index" id="conteudo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tabela', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tabela_id',
            'time_id',
            'time_pontos',
            'time_partidas_jogadas',
            'time_vitorias',
            'temporada',
            //'time_derrotas',
            //'time_gols_marcados',
            //'time_gols_sofridos',
            //'time_gols_saldo',
            //'tabela_turno',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
