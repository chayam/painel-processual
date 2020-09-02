<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\util\ServicePainel;
use app\util\ServiceRequerente;
use app\models\Requerente;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    
    public function actionIndex()
    {
        $response = ServicePainel::dashboard();
        if(!$response){
            Yii::$app->session->setFlash('erro', 'Ocorreu um erro! <br/>Por favor aguarde ou entre em contato com administrador!');
            return $this->render('index');
        }
        
        return $this->render('index',$response);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main_login';
        
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/index']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionRegistro()
    {
        $this->layout = 'main_login';
        $model = new Requerente();
        try 
        {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $response = ServiceRequerente::create($model);
                $errValidation = array_key_exists("errors-validation", $response);
                
                if($errValidation)
                {
                    foreach ($response as $att)
                    {
                        $i=0;
                        $keys = array_keys($att);
                        foreach ($keys as $k) 
                        {
                            
                            $model->addError($k, $att[$k][$i]);
                        }
                        $i++;
                    }
                    
                }else{
                    $user = new User();
                    $identity = $user->findByUsername($model->cpf);
                    Yii::$app->user->login($identity);
                    
                    return $this->redirect(['site/index']);
                }
                
            }
            
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('erro', 'Ocorreu um erro! <br/>Por favor aguarde ou entre em contato com administrador!');
        }

        
        return $this->render('registro', [
            'model' => $model,
        ]);
    }

}
