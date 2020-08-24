<?php

use yii\helpers\Url;

?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Atualizar Solicita&ccedil;&atilde;o</h1>
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
                </p>
                <div class="card">

                        <?=
                        $this->render('_form', [
                            'model' => $model,
                        ])
                        ?>
                    
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
