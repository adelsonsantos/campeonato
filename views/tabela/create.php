<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tabela */

$this->title = 'Create Tabela';
$this->params['breadcrumbs'][] = ['label' => 'Tabelas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tabela-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
