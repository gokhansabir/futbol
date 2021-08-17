<?php

class DbConnect
{
    public $servername = "localhost";
    public $username = "postgres";
    public $password = "123456";
    public $port = "5432";
    public $dbname = "postgres";

    public function connect()
    {
        $dsn = "pgsql:host=$this->servername;port=$this->port;dbname=$this->dbname;";
        $db = new PDO($dsn, $this->username, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $db;

    }
}