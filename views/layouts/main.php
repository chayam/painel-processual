<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?php $this->registerCsrfMetaTags() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title><?= Yii::$app->name ?></title>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/dist/css/adminlte.min.css">
        
        <!-- Alert -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <meta charset="<?= Yii::$app->charset ?>">
        <?php $this->head() ?>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <?php $this->beginBody() ?>

        <div class="wrapper">
            <!-- Navbar -->
            <?= $this->render('@app/views/components/_navbar') ?>

            <!-- Main Sidebar Container -->
            <?= $this->render('@app/views/components/_leftbar') ?>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?= $content ?>
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <?= $this->render('@app/views/components/_footer') ?>

        </div>


        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <!--<script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
        <!-- overlayScrollbars -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/dist/js/adminlte.js"></script>
        
        <!-- Alert -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/toastr/toastr.min.js"></script>
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
