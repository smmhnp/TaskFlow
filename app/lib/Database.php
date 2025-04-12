<?php

/*
 * PDO Database Class
 * conect to database
 * create statment
 * bind value
 * return row and value
 */

class Database {
    private $host = MYSQL_SERVER;
    private $user = MYSQL_USERNAME;
    private $password = MYSQL_PASSWORD;
    private $name = MYSQL_DATABASE;

    private $db;
    private $statment;

    public function __construct() {
        try {
            // concent to database
            $this -> db = new PDO("mysql:host={$this -> host}; port=3306; dbname={$this -> name}", $this -> user, $this -> password);

            // return value fro database as object
            $this -> db -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function query ($sql){
        $this -> statment = $this -> db -> prepare($sql);
    }

    function bind ($param, $value){
        $this -> statment -> bindParam ($param, $value);
    }

    function execute (){
        return $this -> statment -> execute();
    }

    function fetchAll (){
        $this -> execute();
        return $this -> statment -> fetchAll();
    }

    function fetch (){
        $this -> execute();
        return $this -> statment -> fetch();
    }

    function RowCount (){
        return $this -> statment -> RowCount();
    }
}