<?php

namespace app\models;

class Processo extends \yii\base\Model
{
    public $id;
    public $requerente_id;
    public $usuario_id;
    public $assunto_id;
    public $status_id;
    public $numero;
    public $descricao;
    public $observacao;
    public $dt_criacao;
    
    public function rules()
    {
        return [
            [['requerente_id', 'assunto_id', 'descricao', 'observacao'], 'required'],
            [['id','requerente_id', 'usuario_id', 'assunto_id', 'status_id', 'numero'], 'integer'],
            [['observacao'], 'string'],
            [['descricao'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'requerente_id' => 'Requerente ID',
            'usuario_id' => 'Usuario ID',
            'assunto_id' => 'Assunto',
            'status_id' => 'Status ID',
            'numero' => 'Numero',
            'descricao' => utf8_encode('Descrição'),
            'observacao' => utf8_encode('Observação'),
        ];
    }
}
