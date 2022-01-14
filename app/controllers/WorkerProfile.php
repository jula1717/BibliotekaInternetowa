<?php

class WorkerProfile extends Controller {
    public function __construct()
    {
       //czemu wchodzi w ifa jak jest typ administrator lub pracownik??? 

        // if (($_SESSION['userData']->typ_konta!="administrator")||($_SESSION['userData']->typ_konta!="pracownik")) 
        // {
        //     echo "typ: ".$_SESSION['userData']->typ_konta;
        //         exit();
            
        //     // header("Location: " . URLROOT . "/login" );
        //     // exit();
        // }
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