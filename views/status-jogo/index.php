<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StatusJogoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Status Jogos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-jogo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Status Jogo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'status_jogo_id',
            'status_jogo_dsc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
