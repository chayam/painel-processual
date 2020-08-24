<?php

namespace app\controllers;

use Yii;
use app\models\Processo;
use app\models\ProcessoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\httpclient\Client;
use app\util\ServiceProcesso;
use app\util\ServicePainel;

/**
 * ProcessoController implements the CRUD actions for Processo model.
 */
class ProcessoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Processo models.
     * @return mixed
     */
    public function actionIndex()
    {
        try 
        {
            $searchModel = new ProcessoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
            
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('erro', 'Ocorreu um erro! <br/>Por favor aguarde ou entre em contato com administrador!');
            return $this->render('index', [
                'searchModel' => null,
                'dataProvider' => null,
            ]);
        }

    }

    /**
     * Displays a single Processo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Processo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Processo();
        $model->requerente_id = Yii::$app->user->identity->id;
        try 
        {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $dados = (array) $model->attributes;
            unset($dados['id']);
            unset($dados['dt_criacao']);
            unset($dados['numero']);
            unset($dados['usuario_id']);
            unset($dados['status_id']);
            
            $response = ServiceProcesso::create($dados);
            $response2 = ServicePainel::dashboard();
            if($response && $response2)
            {
                return $this->redirect(['view', 'id' => $response['id']]);
            }else{
                throw new \Exception('Desculpe ocorreu um erro', 400);
            }
        }
            
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('erro', 'Ocorreu um erro! <br/>Por favor aguarde ou entre em contato com administrador!');
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Processo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new Processo;
        $model->attributes = (array) $this->findModel($id);
        
        try 
        {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) 
            {
                $dados = (array) $model->attributes;
                unset($dados['dt_criacao']);
                $response = ServiceProcesso::update($dados);
                $response2 = ServicePainel::dashboard();
                if($response && $response2)
                {
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    throw new \Exception('Desculpe ocorreu um erro', 400);
                }
            }
            
        } catch (\Exception $e) {
            var_dump($e->getMessage());exit;
            Yii::$app->session->setFlash('erro', 'Ocorreu um erro! <br/>Por favor aguarde ou entre em contato com administrador!');
        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Processo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Processo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Processo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
            ->setUrl(Yii::$app->params['endpoint'].'processo/detalhe')
            ->setContent(json_encode(['id' => $id]))
            ->send();
        if ($response->isOk) {
            return (object) $response->data;
        }
        

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
