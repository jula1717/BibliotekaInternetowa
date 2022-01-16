<?php

class WorkerProfile extends Controller {
    public function __construct()
    {
        if ($_SESSION['userData']->typ_konta!="administrator"&&$_SESSION['userData']->typ_konta!="pracownik")
        {
            header("Location: " . URLROOT . "/login" );
            exit();
        }
    }
    public function index(){
        
         $this->view('workerProfile');
    }

    public function logout(){
        session_unset();
        header("Location: ".URLROOT . "/login");
        exit();
    }
}
?>