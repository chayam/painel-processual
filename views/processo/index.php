<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$assuntos = ArrayHelper::map($dataProvider->getModels(), 'assunto_id', 'assunto');
$status = ArrayHelper::map($dataProvider->getModels(), 'status_id', 'status');
?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Listagem de processos</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-12">
                <p>
                    <a href="<?= Url::to(['processo/']) ?>" class="btn btn-default"><i class="fas fa-sync-alt"></i></a>
                    <a href="<?= Url::to(['processo/create']) ?>" class="btn btn-success"><i class="fas fa-plus"></i></a>
                </p>
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">

                            <?php
                            if (!Yii::$app->session->hasFlash('erro')) {
                                echo GridView::widget([
                                    'dataProvider' => $dataProvider,
                                    'filterModel' => $searchModel,
                                    'columns' => [
                                        [
                                            'label' => 'Assunto',
                                            'attribute' => 'assunto_id',
                                            'value' => 'assunto',
                                            'filter' => Html::activeDropDownList($searchModel, 'assunto_id', $assuntos, ['prompt' => utf8_encode('- Selecione -'), 'class' => 'form-control'])
                                        ],
                                        [
                                            'label' => 'Status',
                                            'attribute' => 'status_id',
                                            'value' => 'status',
                                            'filter' => Html::activeDropDownList($searchModel, 'status_id', $status, ['prompt' => utf8_encode('- Selecione -'), 'class' => 'form-control'])
                                        ],
                                        'numero',
                                        [
                                            'label' => 'Descricao',
                                            'attribute' => 'descricao',
                                        ],
                                        [
                                            'label' => 'Observacao',
                                            'attribute' => 'observacao',
                                        ],
                                        [
                                            'class' => 'app\grid\ActionColumn',
                                            'template' => '{view} {update}',
                                        ],
                                    ],
                                ]);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

<?php
if (Yii::$app->session->hasFlash('erro')) {
    $msg = Yii::$app->session->getFlash('erro');
    $this->render('@app/views/components/_erroHttp', ['msg' => $msg]);
}
?>
