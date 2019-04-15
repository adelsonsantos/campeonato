<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Jogos */

$this->title = 'Cadastrar Jogos';
?>
<div class="jogos-create">

    <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
