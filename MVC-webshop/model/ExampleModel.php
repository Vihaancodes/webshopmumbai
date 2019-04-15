<?php

require_once "DataHandler.php";

class ExampleModel {

    public function __construct() {
        $this->dataHandler = new DataHandler(DB_HOST, DB_DB, DB_USERNAME, DB_PASSWORD);
    }

    // example
    public function showProduct() {
        try {
        return $this->dataHandler->readData(
            "SELECT * FROM db");
        } catch (Exeption $e) {
            throw $e;
        }
    }
    
}