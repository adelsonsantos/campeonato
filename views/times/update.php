<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Times */

$this->title = 'Alterando de Times {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Times', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->time_id, 'url' => ['view', 'id' => $model->time_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="times-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
