<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UnijorgeUsuario */

$this->title = 'Alterar Usuário:';
$this->params['breadcrumbs'][] = ['label' => 'Unijorge Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unijorge-usuario-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
