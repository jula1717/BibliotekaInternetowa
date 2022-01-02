<?php

class Index extends Controller {
    public function __construct()
    {
        $this->firstModel = $this->model('FirstModel');
    }
    public function index(){
        
         $this->view('index');
        var_dump($result = $this->firstModel->getAutorzy());

    }
}
?>