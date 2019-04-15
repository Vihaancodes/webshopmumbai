<?php

class DataHandler {

    public $pdo;

    // public $lastSelect = [];

    public $host;

    public $database;

    public $username;
  
    public $password;

    public $dbtype;

    public function __construct(string $host, string $database, string $username, string $password, string $dbtype = "mysql") {
        try {
            $this->pdo = new PDO("$dbtype:host=$host;dbname=$database;charset=utf8mb4", $username, $password, [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch(PDOexeption $e) {
            $this->showError("Error: " . $e->getMessage());
        }

        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->dbtype = $dbtype;
    }


    public function createData(string $sql, array $bindings = []) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($bindings);
        return $this->pdo->lastInsertId();
    }


    public function readData(string $sql, array $bindings = [], bool $multiple = true) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($bindings);

        if(!$multiple) {
            return $sth->fetch();
        }

        return $sth->fetchAll();
    }

    public function updateData(string $sql, array $bindings = []) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($bindings);
        return $this->pdo->lastInsertId();
    }


    public function deleteData(string $sql, array $bindings = []) {
        $sth = $this->pdo->prepare($sql);
        return $sth->execute($bindings);
    }


    // public function pagination(int $pagination) {

    //     $sql = preg_replace("/LIMIT [0-9]+ OFFSET [0-9]+/", "", $this->lastSelect["sql"]);
    //     $sql = "SELECT COUNT(*) AS count FROM (" . $sql . ") AS countTable";

    //     $count =  $this->readData(
    //         $sql,
    //         $this->lastSelect["bindings"],
    //         false
    //     )["count"];

    //     return ceil($count / $pagination);

    // }

    public function showError(string $error) {
        echo $error;
    }

}
