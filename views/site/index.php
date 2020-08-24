<?php

use app\util\Util;
use yii\helpers\Url;


$this->registerJsFile('@web/adminlte/dist/js/demo.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/adminlte/plugins/chart.js/Chart.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/adminlte/plugins/raphael/raphael.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/adminlte/plugins/jquery-mapael/jquery.mapael.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/adminlte/plugins/jquery-mapael/maps/usa_states.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$painel = Yii::$app->session['painel-req-proc'];
$aberto = isset($painel) ? Util::checkValue($painel['aberto']) : 0;
$analise = isset($painel) ? Util::checkValue($painel['analise']) : 0;
$finalizado = isset($painel) ? Util::checkValue($painel['finalizado']) : 0;

$qtdGeral = ($aberto + $analise + $finalizado);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Vis&atilde;o Gerencial</h1>
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
            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
                <a href="<?= Url::to(['processo/index', 'ProcessoSearch' => ['status_id' => 1]]) ?>" style="color: inherit;">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-eye"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Aberto</span>
                            <span class="info-box-number"><?= $aberto ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
                <!-- /.info-box -->
            </div>

            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
                <a href="<?= Url::to(['processo/index', 'ProcessoSearch' => ['status_id' => 2]]) ?>" style="color: inherit;">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Em An&aacute;lise</span>
                            <span class="info-box-number"><?= $analise ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>


            <!-- /.col -->
            <div class="col-12 col-sm-4 col-md-4">
                <a href="<?= Url::to(['processo/index', 'ProcessoSearch' => ['status_id' => 3]]) ?>" style="color: inherit;">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Finalizados</span>
                            <span class="info-box-number"><?= $finalizado ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Quantitativo por ano</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">Total: <?= $qtdGeral ?></span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="visitors-chart" height="200" width="393" class="chartjs-render-monitor" style="display: block; width: 393px; height: 200px;"></canvas>
                        </div>

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quantitativo por assunto</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="chart-responsive">
                                    <canvas id="pieChart" height="150"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->
<?php
if (Yii::$app->session->hasFlash('erro')) {
    $msg = Yii::$app->session->getFlash('erro');
    $this->render('@app/views/components/_erroHttp',['msg'=>$msg]);
}

if (!empty($painel) && !empty($painelReqAno) && !empty($painelReqAssunto)) {

    $this->registerJs("
        $(function () {

  'use strict'

  //---------------------------
  //- END MONTHLY SALES CHART -
  //---------------------------

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: " . $painelReqAssunto['assunto'] . ",
      datasets: [
        {
          data: " . $painelReqAssunto['qtds'] . ",
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

  //-----------------
  //- END PIE CHART -
  //-----------------


})
        "
    );
    $this->registerJs("
        $(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var visitorsChart  = new Chart($('#visitors-chart'), {
    data   : {
      labels  : " . $painelReqAno['ano'] . ",
      datasets: [{
        type                : 'line',
        data                : " . $painelReqAno['qtd'] . ",
        backgroundColor     : 'transparent',
        borderColor         : '#007bff',
        pointBorderColor    : '#007bff',
        pointBackgroundColor: '#007bff',
        fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 10
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
})
        "
    );
}
?>