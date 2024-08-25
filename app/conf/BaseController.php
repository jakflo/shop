<?php

namespace app\conf;

use \app\conf\BaseModel;

abstract class BaseController
{

    /**
     *
     * @var Env
     */
    protected $env;
    
    /**
     * 
     * @var BaseModel
     */
    protected $model;

    public function __construct(Env $env)
    {
        $this->env = $env;
    }
    
    abstract public function render(\stdClass $parameters);
    
    protected function getModel(): BaseModel
    {
        if ($this->model === null) {
            $this->setModel();
        }
        return $this->model;
    }
    
    protected function setModel()
    {
        throw new \Exception('Definuj model pretezenim tehle metody');
    }
    
}
