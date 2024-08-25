<?php

namespace app\conf;

abstract class BaseModel
{

    /**
     *
     * @var Env
     */
    protected $env;

    public function __construct(Env $env)
    {
        $this->env = $env;
    }
    
}
