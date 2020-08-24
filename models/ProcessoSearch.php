<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use app\util\Util;
use app\util\ServiceProcesso;

/**
 * ProcessoSearch represents the model behind the search form of `app\models\Processo`.
 */
class ProcessoSearch extends Model
{
    /**
     * {@inheritdoc}
     */
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
            [['id', 'requerente_id', 'usuario_id', 'assunto_id', 'status_id', 'numero'], 'integer'],
            [['descricao', 'observacao', 'dt_criacao'], 'safe'],
        ];
    }
    
    private $_filtered = false;

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        
        if ($this->load($params) && $this->validate()) {
            $this->_filtered = true;
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' =>  $this->getData(),
            'sort' => [
                'attributes'=>['id',
                                'requerente_id',
                                'usuario_id',
                                'assunto_id',
                                'status_id',
                                'numero',
                                'descricao',
                                'observacao',
                                'dt_criacao'],
            ],
        ]);

        return $dataProvider;
    }
    
    protected function getData()
    {
        $data = [];
        $response = ServiceProcesso::index(['requerente_id' => Yii::$app->user->identity->id]);
        if ($response) {
            $data =  ArrayHelper::index($response, 'id');
        }
        
        if ($this->_filtered) {
            $data = array_filter($data, function ($value) {
                $conditions = [true];
                if (!empty($this->id)) {
                    $conditions[] = strpos($value['id'], $this->id) !== false;
                }
                if (!empty($this->requerente_id)) {
                    $conditions[] = strpos($value['requerente_id'], $this->requerente_id) !== false;
                }
                if (!empty($this->usuario_id)) {
                    $conditions[] = strpos($value['usuario_id'], $this->usuario_id) !== false;
                }
                if (!empty($this->assunto_id)) {
                    $conditions[] = strpos($value['assunto_id'], $this->assunto_id) !== false;
                }
                if (!empty($this->status_id)) {
                    $conditions[] = strpos($value['status_id'], $this->status_id) !== false;
                }
                if (!empty($this->numero)) {
                    $conditions[] = strpos($value['numero'], $this->numero) !== false;
                }
                if (!empty($this->descricao)) {
                    $conditions[] = strpos(Util::cleanValueForFilter($value['descricao']), Util::cleanValueForFilter($this->descricao)) !== false;
                }
                if (!empty($this->observacao)) {
                    $conditions[] = strpos(Util::cleanValueForFilter($value['observacao']), Util::cleanValueForFilter($this->observacao)) !== false;
                }
                if (!empty($this->dt_criacao)) {
                    $conditions[] = strpos($value['dt_criacao'], $this->dt_criacao) !== false;
                }
                return array_product($conditions);
            });
        }
        

        return $data;
    }
}
