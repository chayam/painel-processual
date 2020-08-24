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
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= Yii::$app->name ?></title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/dist/css/adminlte.min.css">
        
        <!-- Alert -->
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/toastr/toastr.min.css">
        <link rel="stylesheet" href="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!--<? php $this->head() ?>-->
    </head>
    <body class="hold-transition login-page">
        <?php $this->beginBody() ?>
        <div class="login-box">
            <?= $content; ?>
        </div>
        <!-- /.login-box -->


        <!-- jQuery -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/dist/js/adminlte.min.js"></script>
        
         <!-- Alert -->
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/toastr/toastr.min.js"></script>
        <script src="<?= Yii::$app->request->baseUrl; ?>/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
