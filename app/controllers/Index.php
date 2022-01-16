<?php

class Index extends Controller {
    public function __construct()
    {

    }
    public function index(){
        loginAccessOnly();
        checkTypeAccount();
         $this->view('index');
    }
}
?>