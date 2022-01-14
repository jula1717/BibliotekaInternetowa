<?php

class Register extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');        
    }
    public function registerUser(){
        if (!isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['confirmPassword'])|| !isset($_POST['phone'])){
            $_SESSION['errorIncompleteRegisterData']="Uzupełnij wszystkie pola!";
        }else{
            unset($_SESSION['errorIncompleteRegisterData']);
            if(strlen($_POST['email'])<6||strlen($_POST['email'])>255)
            {
                $_SESSION['errorWrongEmailSize']="Proszę podać adres email o prawidłowym rozmiarze (6-255 znaków)";
            }
            else
            {
                unset($_SESSION['errorWrongEmailSize']);
                if(strlen($_POST['password'])<8||strlen($_POST['password'])>255)
                {
                    $_SESSION['errorWrongPasswordSize']="Proszę podać hasło o prawidłowym rozmiarze (8-255 znaków)";
                }
                else
                {
                    unset($_SESSION['errorWrongPasswordSize']);
                    if(strlen($_POST['confirmPassword'])<8||strlen($_POST['confirmPassword'])>255)
                    {
                        $_SESSION['errorWrongConfirmPasswordSize']="Proszę podać hasło o prawidłowym rozmiarze (8-255 znaków)";
                    }
                    else
                    {
                        unset($_SESSION['errorWrongConfirmPasswordSize']);
                        if(strlen($_POST['phone'])!=9)
                    {
                        $_SESSION['errorWrongPhoneSize']="Proszę podać prawidłowy format i długość numeru telefonu(np.123456789)";
                    }
                    else
                    {
                        unset($_SESSION['errorWrongPhoneSize']);
                        if ($_POST['password']==$_POST['confirmPassword']){
                            $result=$this->userModel->getUserByEmail($_POST['email']);
                            if ($result==null){
                                $this->userModel->createReader();
                                unset($_SESSION['errorDataAlreadyExists']);
                                header("Location: ".URLROOT."/login");
                                exit();
                            }else{
                                $_SESSION['errorDataAlreadyExists']="W bazie danych istnieje już użytkownik o tym samym adresie e-mail";
                            }
                        }
                    }
                }
            }
        }
        header("Location: ".URLROOT."/register");
        exit();
    }
}
    public function index(){
        $this->view('register');
    }
}

?>