<?php

namespace app\util;
use Yii;
use yii\httpclient\Client;

class ServiceRequerente {
    
    public static function create($content)
    {
        try 
        {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
                ->setUrl(Yii::$app->params['endpoint'].'requerente/create')
                ->setContent(json_encode($content))
                ->send();
            if ($response->isOk) {
                return $response->data;
            }else if($response->statusCode == 400 && array_key_exists("errors-validation", $response->data)){
                return $response->data;
            }
            
        } catch (\Exception $e) {
            return false;
        }
     }
     
}