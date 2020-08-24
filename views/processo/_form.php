<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\util\ServiceAssunto;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Processo */
/* @var $form yii\widgets\ActiveForm */

$assuntos = ArrayHelper::getColumn(ArrayHelper::index(ServiceAssunto::listaAssunto(), 'id'), 'descricao');
?>

<div class="card-body">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'assunto_id', ['template' => '
        <div class="form-group"> 
                 {input}
                 {error}
        </div>'])->dropDownList($assuntos, ['prompt' => '- selecione -', 'required' => true]) ?>
            <?= $form->field($model, 'descricao', ['template' => '
        <div class="input-group mb-3"> 
                 <div class="input-group-append">
                     <span class="input-group-text"><i class="far fa-comment-alt"></i></span>
                 </div>
                 {input}
                 {error}
        </div>'])->textInput(['placeholder' => utf8_encode('Descrição'), 'required' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'observacao', ['template' => '
         <div class="form-group">
            {input}
          </div>
          {error}
        </div>'])->textarea(['placeholder' => utf8_encode('Observação'), 'rows' => 6, 'required' => true]) ?>
        </div>
    </div>

    <div class="card-footer">

        <?php
        $class = ($this->context->action->id == 'create')?'btn btn-success':'btn btn-primary';
        $buttonName = ($this->context->action->id == 'create')?'CRIAR' : 'ATUALIZAR';
        echo Html::submitButton($buttonName, ['class' => $class])
        ?>
    </div>

</div>

<?php ActiveForm::end(); ?>
<?php 
if (Yii::$app->session->hasFlash('erro')) {
    $msg = Yii::$app->session->getFlash('erro');
    $this->render('@app/views/components/_erroHttp',['msg'=>$msg]);
}
?>
