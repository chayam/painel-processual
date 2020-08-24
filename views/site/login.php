<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

$this->registerJsFile('@web/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/js/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="login-logo">
    <a href="#"><b>Frontend</b>PHP</a>
</div>
<!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">Fa&ccedil;a o login</p>

        <?php
        $form = ActiveForm::begin([
                    'id' => 'login-form',
        ]);
        ?>

            <?= $form->field($model, 'username', ['template' => '
        <div class="input-group mb-3">
                 {input} 
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-key"></span>
                     </div>
                 </div>
                 {error}
        </div>'])->textInput(['placeholder'=>'CPF (123.456.789-10)', 'required' => true]) ?>
        
            <?= $form->field($model, 'password', ['template' => '
        <div class="input-group mb-3">
            {input}
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            {error}
        </div>'])->passwordInput(['placeholder'=>'Senha', 'required' => true]) ?>
        
        
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>

        <p class="mb-0">
            <a href="<?= Url::to(['site/registro']) ?>" class="text-center">Criar uma nova conta</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
<?= $this->render('@app/views/components/_chayam') ?>
