<?php

class Db {
    private static $instance = null; // Instance null car singleton
    
    private $host;
    private $user;
    private $pwd;
    private $db;
    private $dsn;
    private $dbh;

    private function __construct () {
        $this->host = "";
        $this->user = "";
        $this->pwd = "";
        $this->db = "";
        $this->dsn = "mysql:dbname=".$this->db.";host=".$this->host;
        $this->dbh = new PDO($this->dsn, $this->user, $this->pwd);
    }

    public static function getDb() {
        if (is_null(Db::$instance)) {
            Db::$instance = new Db();
        }
        return Db::$instance;
    }
    
    public static function getDbh() {
        if (is_null(Db::$instance)) {
            Db::$instance = new Db();
        }
        return Db::$instance->dbh;
    }
}