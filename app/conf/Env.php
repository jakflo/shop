<?php

namespace app\conf;

use \app\conf\DbWrap;
use \app\conf\exceptions\AutorunException;

class Env
{

    /**
     * @var string
     */
    protected $uber_root;

    /**
     *
     * @var string
     */
    protected $webroot;

    /**
     *
     * @var string
     */
    private $servername, $username, $password, $dbname;

    /**
     *
     * @var Db_wrap
     */
    public $db;

    public function __construct(string $uber_root)
    {
        $this->uber_root = $uber_root;
        $this->webroot = 'http://localhost/shop/';

        $this->autorun('\app\conf\exceptions\AutorunException');
        spl_autoload_register(array($this, 'autorun'));

        //připojení k DB
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "mysql";
        $this->dbname = "shop";
        $this->db = $this->connectDb($this->servername, $this->username, $this->password, $this->dbname);
    }

    public function autorun(string $class_name)
    {
        $class_name = "{$this->uber_root}/{$class_name}.php";

        if (PHP_OS_FAMILY === 'Windows') {
            $class_name = str_replace('/', '\\', $class_name);
        }

        if (file_exists($class_name)) {
            require_once $class_name;
        }
        else {
            throw new AutorunException("<br>trida {$class_name} nenalazena<br>");
        }
    }

    public function connectDb()
    {
        $db = new DbWrap($this->servername, $this->username, $this->password, $this->dbname);
        return $db;
    }
}
