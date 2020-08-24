<?php

namespace app\models;
use Yii;
use yii\httpclient\Client;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $nome;
    public $cpf;
    public $telefone;
    public $email;
    public $senha;
    public $dt_aniversario;

    /*
     public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
      private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
            ->setUrl(Yii::$app->params['endpoint'].'conta/identity')
            ->setContent(json_encode(['id' => $id]))
            ->send();
        if ($response->isOk) {
            $user = $response->data;
            if ($user) 
            {
                return new static($user);
        }
        
        }
        return null;
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setHeaders(["Authorization" => 'Bearer '.Yii::$app->params['token'],'Content-Type'=>'application/json'])
            ->setUrl(Yii::$app->params['endpoint'].'conta/user')
            ->setContent(json_encode(['cpf' => $username]))
            ->send();
        if ($response->isOk) {

            $user = $response->data;
            if ($user) 
            {
                return new static($user);

            }

        }
        
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getNome()
    {
        return $this->nome;
    }
    

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
        //return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if(Yii::$app->getSecurity()->validatePassword($password,$this->senha))
        {
            return true;
        } else {
            return false;
        }
    }
}
