<?php

class Register extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');        
    }
    public function registerUser(){
        if (!isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['confirmPassword'])|| !isset($_POST['phone'])){
            $_SESSION['errorEmptyRegister']="Uzupełnij wszystkie pola!";
        }else{
            unset($_SESSION['errorEmptyRegister']);
            if ($_POST['password']==$_POST['confirmPassword']){
                $result=$this->userModel->getUserByEmail($_POST['email']);
                if ($result==null){
                    $this->userModel->createUser();
                    unset($_SESSION['errorTakenRegister']);
                    echo "Dodano uzytkownika";
                   // header("Location: ".URLROOT."/login");
                    exit();
                }else{
                    $_SESSION['errorTakenRegister']="W bazie danych istnieje już użytkownik o tym samym adresie e-mail";
                }
            }
        }
        header("Location: ".URLROOT."/register");
        exit();
    }
    public function index(){
        $this->view('register');
    }
}

?>