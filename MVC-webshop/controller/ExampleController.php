<?php

require_once "model/ExampleModel.php";

class Examplecontroller {

    public function __construct() {
        $this->ExampleModel = new ExampleModel();
    }
    
    public function home() {
        
        $bon = $this->ExampleModel->showProduct();
        
        include "view/home.php";
    }
    
}
