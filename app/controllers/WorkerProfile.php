<?php

class WorkerProfile extends Controller {
    public function __construct()
    {
        librarianAccessOnly();
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