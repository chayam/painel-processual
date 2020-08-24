<?php

namespace app\util;
use Yii;
use yii\httpclient\Client;

class ServiceProcesso {
    
    public static function index($content)
    {
        try 
        {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
                ->setUrl(Yii::$app->params['endpoint'].'processo/index')
                ->setContent(json_encode($content))
                ->send();
            if ($response->isOk) {
                return $response->data;
            }
        } catch (\Exception $e) {
            return false;
        }
     }
    
    public static function create($content)
    {
        try 
        {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
                ->setUrl(Yii::$app->params['endpoint'].'processo/create')
                ->setContent(json_encode($content))
                ->send();
            if ($response->isOk) {
                return $response->data;
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
                ->setMethod('PUT')
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