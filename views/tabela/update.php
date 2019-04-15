<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tabela */

$this->title = 'Update Tabela: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tabelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tabela_id, 'url' => ['view', 'id' => $model->tabela_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tabela-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
