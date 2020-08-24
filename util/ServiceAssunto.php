<?php

namespace app\util;
use Yii;
use yii\httpclient\Client;

class ServiceAssunto {
    
    public static function listaAssunto()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('GET')
            ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
            ->setUrl(Yii::$app->params['endpoint'].'assunto/lista')
            ->send();
        if ($response->isOk) {
            return $response->data;
        }
    }
}