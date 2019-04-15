<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<?php
    if(!Yii::$app->user->isGuest){
        require_once "main.css.php";
        require_once "main.js.php";
    ?>
    <table class="menu">
        <tr class="menu">
            <th class="menu" style="text-align: center"> <img src="<?php echo Yii::$app->request->baseUrl . '../../image/LOGOPES2.jpg'; ?>" style="width: 10%; margin-bottom: 10px; margin-top: 10px"></th>
        </tr>
    </table>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse ',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Início', 'url' => ['/site/index']],
            ['label' => 'Jogos', 'url' => ['/jogos/index']],
            ['label' => 'Elimiatóras', 'url' => ['/jogos/eliminatoria']],
            ['label' => 'Times', 'url' => ['/times/index']],
            Yii::$app->user->isGuest ? (
            ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Sair',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>
    <!------ Include the above in your HEAD tag ---------->

    <div id="wrapper" class="active" >

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul id="sidebar_menu" class="sidebar-nav">
                <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
            </ul>
            <ul class="sidebar-nav" id="sidebar">
                <li><?= Html::a('Jogos <span class="sub_icon glyphicon glyphicon-asterisk"></span>', ['jogos/index'], []); ?></li>
                <li><?= Html::a('Times <span class="sub_icon glyphicon glyphicon-list"></span>', ['times/index'], []); ?></li>
                <li><?= Html::a('Semifinal <span class="sub_icon glyphicon glyphicon-random"></span>', ['/jogos/eliminatoria'], []); ?></li>
                <li><?= Html::a('Usuários <span class="sub_icon glyphicon glyphicon-user"></span>', ['usuario/index'], []); ?></li>

            </ul>
        </div>

        <!-- Page content -->
        <div id="page-content-wrapper">
            <!-- Keep all page content within the page-content inset div! -->
            <div class="page-content inset">
                <div class="row">
                    <div class="col-md-12">
                        <p class="well lead">Bem Vindo Sr. <?php print_r(\app\models\Usuario::find()->select('usuario_nome')->where(['usuario_id' => Yii::$app->getUser()->id])->one()->usuario_nome);?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= $content ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
}
else
{ ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
    <?php $this->endBody() ?>
    <?php $this->endPage();
}?>


