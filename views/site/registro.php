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

<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg">Cadastrar um novo membro</p>

        <?php
        $form = ActiveForm::begin([
                    'id' => 'registro-form',
        ]);
        ?>
        <?= $form->field($model, 'nome', ['template' => '
            <div class="input-group mb-3">
                 {input} 
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-user"></span>
                     </div>
                 </div>
                 {error}
          </div>'])->textInput(['placeholder' => 'NOME', 'required' => true]) ?>

        <?= $form->field($model, 'cpf', ['template' => '
            <div class="input-group mb-3">
                 {input} 
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-key"></span>
                     </div>
                 </div>
                 {error}
          </div>'])->textInput(['placeholder' => utf8_encode('CPF'), 'required' => true]) ?>
        <?= $form->field($model, 'email', ['template' => '
            <div class="input-group mb-3">
                 {input} 
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-envelope"></span>
                     </div>
                 </div>
                 {error}
          </div>'])->textInput(['placeholder' => 'E-MAIL', 'required' => true]) ?>
        <?= $form->field($model, 'senha', ['template' => '
            <div class="input-group mb-3">
                 {input} 
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-lock"></span>
                     </div>
                 </div>
                 {error}
          </div>'])->passwordInput(['placeholder' => 'SENHA', 'required' => true]) ?>
        <?= $form->field($model, 'confirmasenha', ['template' => '
            <div class="input-group mb-3">
                 {input} 
                 <div class="input-group-append">
                     <div class="input-group-text">
                         <span class="fas fa-lock"></span>
                     </div>
                 </div>
                 {error}
          </div>'])->passwordInput(['placeholder' => 'CONFIRME A SENHA', 'required' => true]) ?>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
            <!-- /.col -->
        </div>
        <?php ActiveForm::end(); ?>

        <a href="<?= Url::to(['site/login']) ?>" class="text-center">J&aacute; tenho conta</a>
    </div>
    <!-- /.form-box -->
</div><!-- /.card -->
<?= $this->render('@app/views/components/_chayam') ?>
<?php 
if (Yii::$app->session->hasFlash('erro')) {
    $msg = Yii::$app->session->getFlash('erro');
    $this->render('@app/views/components/_erroHttp',['msg'=>$msg]);
}
?>