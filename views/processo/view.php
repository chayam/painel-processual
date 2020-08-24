<?php

use yii\widgets\DetailView;
use yii\helpers\Url;
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detalhamento</h1>
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
                    <a href="<?= Url::to(['processo/']) ?>" class="btn btn-primary"><i class="fas fa-list"></i></a>
                    <a href="<?= Url::to(['processo/update', 'id' => $model->id]) ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                </p>
                <div class="card">

                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'assunto',
                            'status',
                            'numero',
                            [
                                'label' => utf8_encode('Descrição'),
                                'attribute' => 'descricao',
                            ],
                            [
                                'label' => utf8_encode('Observação'),
                                'attribute' => 'observacao',
                            ],
                            [
                                'label' => utf8_encode('Data de criação'),
                                'attribute' => 'dt_criacao',
                                'value' => function($data){
                                    return Yii::$app->formatter->asDatetime($data->dt_criacao,'medium');
                                },
                            ]
                        ],
                    ])
                    ?>

                </div>
            </div>
        </div>
        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->