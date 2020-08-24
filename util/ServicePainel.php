<?php

namespace app\util;
use Yii;
use yii\httpclient\Client;

class ServicePainel {
    
    public static function dashboard()
    {
        Yii::$app->session->remove('painel-req-proc');
        try {
            $client = new Client();
            $requests = [
                            'requerente-processo' => 
                            $client->post(Yii::$app->params['endpoint'].'painel/requerente-processo')
                                    ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
                                    ->setContent(json_encode(['requerente_id' => Yii::$app->user->identity->id])),
                            'requerente-assunto' => 
                            $client->post(Yii::$app->params['endpoint'].'painel/requerente-assunto')
                                    ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
                                    ->setContent(json_encode(['requerente_id' => Yii::$app->user->identity->id])),
                            'requerente-ano' => 
                            $client->post(Yii::$app->params['endpoint'].'painel/requerente-ano')
                                    ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
                                    ->setContent(json_encode(['requerente_id' => Yii::$app->user->identity->id])),
                        ];
            $responses = $client->batchSend($requests);
            
            if ( $responses['requerente-processo']->isOk && 
                 $responses['requerente-assunto']->isOk && 
                 $responses['requerente-ano']->isOk
                ) 
            {
                $painelReqAssunto = $responses['requerente-assunto']->data;
                $painelReqAno = $responses['requerente-ano']->data;
                Yii::$app->session['painel-req-proc'] = $responses['requerente-processo']->data;
                return ['painelReqAssunto'=>$painelReqAssunto,'painelReqAno'=>$painelReqAno];
            }else{
                throw new \Exception('Desculpe ocorreu um erro', $responses->statusCode);
                
            }
            
        } catch (\Exception $e) {
            return false;
        }
     }
    
    public static function update($content)
    {
        try 
        {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
                ->setUrl(Yii::$app->params['endpoint'].'processo/update')
                ->setContent(json_encode($content))
                ->send();
            if ($response->isOk) {
                return $response->data;
            }
        } catch (\Exception $e) {
            return false;
        }
     }
}