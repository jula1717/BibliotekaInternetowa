<?php

class Login extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }
    public function index(){
        //todo: odkomentować jak będzie wylogowywanie na stronie głównej
        // if(isset($_SESSION['userData']))
        // {
        //     header("Location: ".URLROOT);
        //     exit();
        // }
        $this->view('login');
    }
    public function tryToLogin(){
        if (!isset($_POST['email']) or !isset($_POST['password'])){
            $_SESSION['errorIncompleteLoginData']="Uzupelnij wszystkie dane!";
        }else{
            unset($_SESSION['errorIncompleteLoginData']);
            $result = $this->userModel->getUserByEmail($_POST['email']);
            if ($result== null || !password_verify($_POST['password'], $result->haslo)){
                $_SESSION['errorInvalidPassword']="Podane dane nie zgadzają się!";
            }else{
                unset($_SESSION['errorInvalidPassword']);
                $_SESSION['userData']=$result;
                header("Location: ".URLROOT);
                exit();
            }
        }
        header("Location: ".URLROOT."/login");
                exit();
    }
}