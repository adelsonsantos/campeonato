<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tabela */

$this->title = $model->tabela_id;
$this->params['breadcrumbs'][] = ['label' => 'Tabelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tabela-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->tabela_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->tabela_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tabela_id',
            'time_id:datetime',
            'time_pontos:datetime',
            'time_partidas_jogadas:datetime',
            'time_vitorias:datetime',
            'time_empates:datetime',
            'time_derrotas:datetime',
            'time_gols_marcados:datetime',
            'time_gols_sofridos:datetime',
            'time_gols_saldo:datetime',
            'tabela_turno',
            'status',
        ],
    ]) ?>

</div>
