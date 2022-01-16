<?php

class Configuration extends Controller {
    public function __construct()
    {
        librarianAccessOnly();
    }
    public function index(){
        
         $this->view('configuration');
    }

    
}
?>