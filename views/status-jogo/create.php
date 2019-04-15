<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StatusJogo */

$this->title = 'Create Status Jogo';
$this->params['breadcrumbs'][] = ['label' => 'Status Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-jogo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
