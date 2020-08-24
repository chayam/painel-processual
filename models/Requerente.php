<?php

namespace app\models;
use yii\base\Model;

class Requerente extends Model
{

    public $nome;
    public $cpf;
    public $senha;
    public $confirmasenha;
    public $email;
    
    public function rules()
    {
        return [
            [['nome', 'cpf', 'email', 'senha','confirmasenha'], 'required'],
            [['nome','email'], 'filter', 'filter' => 'trim', 'skipOnArray' => true],
            [['senha','confirmasenha'], 'string', 'length' => [4,100]],
            ['confirmasenha', 'compare', 'compareAttribute'=>'senha', 'message'=>"Senhas Diferentes!" ],
            ['email', 'email'],
            [['nome', 'senha','email'], 'string', 'max' => 100],
            [['cpf'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'senha' => 'Senha',
            'confirmasenha' => utf8_encode('Confirmação senha'),
            'cpf' => 'CPF',
            'email' => 'E-mail',
        ];
    }

}
