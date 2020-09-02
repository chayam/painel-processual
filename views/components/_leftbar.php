<?php 

use yii\helpers\Url;
use app\util\Util;

$painel = Yii::$app->session['painel-req-proc'];
$aberto = isset($painel)?Util::checkValue($painel['aberto']):0;
$analise = isset($painel)?Util::checkValue($painel['analise']):0;
$finalizado = isset($painel)?Util::checkValue($painel['finalizado']):0;

$nomeUser = Util::ajustaNomeLogin(Yii::$app->user->identity->nome);

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to(['/']) ?>" class="brand-link">
        <img src="<?= Yii::$app->request->baseUrl; ?>/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $nomeUser ?></span>
        
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= Url::to(['/']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            In&iacute;cio
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= Url::to(['processo/create']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p>Nova Solicita&ccedil;&atilde;o</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= Url::to(['processo/']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>Buscar processo</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= Url::to(['processo/index','ProcessoSearch'=>['status_id'=>1]]) ?>" class="nav-link">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>Abertos<span class="badge badge-warning right"><?= $aberto ?></span></p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= Url::to(['processo/index','ProcessoSearch'=>['status_id'=>2]]) ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Em An&aacute;lise<span class="badge badge-info right"><?= $analise ?></span></p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="<?= Url::to(['processo/index','ProcessoSearch'=>['status_id'=>3]]) ?>" class="nav-link">
                        <i class="nav-icon fas fa-check"></i>
                        <p> Finalizados <span class="badge badge-success right"><?= $finalizado ?></span></p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>