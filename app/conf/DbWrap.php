<?php

namespace app\conf;

use \PDO;
use \PDOException;
use \app\utils\JsonResponse;

class DbWrap
{

    private $servername, $username, $password, $dbname;
    private $conn;

    private function connect()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            JsonResponse::sendServerError(['error' => 'database connection error']);
            exit();
        }
    }

    public function __construct(string $servername, string $username, string $password, string $dbname)
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        if (!isset($this->conn)) {
            $this->connect();
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    public function sendSQL(string $sql, array $parameters = array())
    {
        try {
            $prepared = $this->conn->prepare($sql);
            $prepared->execute($parameters);
        } catch (PDOException $e) {
//            echo "<br>{$sql}<br>";
//            print_r($parameters);
            throw $e;
        }
        return $prepared;
    }

    public function queryAll(string $sql, array $parameters = array())
    {
        $prepared = $this->sendSQL($sql, $parameters);
        return $prepared->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryColumn(string $sql, string $column_name, array $parameters = array())
    {
        $result = $this->queryAll($sql, $parameters);
        return array_column($result, $column_name);
    }

    public function queryRow(string $sql, array $parameters = array())
    {
        $prepared = $this->sendSQL($sql, $parameters);
        return $prepared->fetch(PDO::FETCH_ASSOC);
    }

    public function queryField(string $sql, array $parameters = array())
    {
        $row = $this->queryRow($sql, $parameters);
        $sloupce = array_keys($row);
        return $row[$sloupce[0]];
    }

    public function getLastId()
    {
        return $this->queryField("SELECT LAST_INSERT_ID()");
    }
}
