<?php

use yii\helpers\Html;
?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        
        <li class="nav-item">
            <?=
            Html::a('<i class="fas fa-sign-out-alt"></i> Sair', ['site/logout'], [
                'data' => [
                    'confirm' => 'Voce deseja sair do sistema?',
                    'method' => 'post'
                ]
            ]);
            ?>
        </li>
    </ul>
</nav>
<!-- /.navbar -->