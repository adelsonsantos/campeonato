<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StatusJogo */

$this->title = 'Update Status Jogo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Status Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->status_jogo_id, 'url' => ['view', 'id' => $model->status_jogo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="status-jogo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
