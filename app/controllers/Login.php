<?php

class Login extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }
    public function index()
    {
        //todo: odkomentować jak będzie wylogowywanie na stronie głównej
        // if(isset($_SESSION['userData']))
        // {
        //     header("Location: ".URLROOT);
        //     exit();
        // }
        $this->view('login');
    }
    public function tryToLogin()
    {
        if (!isset($_POST['email']) or !isset($_POST['password'])) {
            $_SESSION['errorIncompleteLoginData'] = "Uzupełnij wszystkie dane!";
        } else {
            unset($_SESSION['errorIncompleteLoginData']);
            if (strlen($_POST['email']) < 6 || strlen($_POST['email']) > 255) {
                $_SESSION['errorWrongEmailSize'] = "Proszę podać prawidłowy rozmiar adresu email (6-255 znaków)";
            } else {
                unset($_SESSION['errorWrongEmailSize']);
                if (strlen($_POST['password']) < 8 || strlen($_POST['email']) > 255) {
                    $_SESSION['errorWrongPasswordSize'] = "Proszę podać prawidłowy rozmiar hasła (8-255 znaków)";
                } else {
                    unset($_SESSION['errorWrongPasswordSize']);
                    $result = $this->userModel->getUserByEmail($_POST['email']);
                    if ($result == null || !password_verify($_POST['password'], $result->haslo)) {
                        $_SESSION['errorInvalidPassword'] = "Podane dane nie zgadzają się!";
                    } else {
                        unset($_SESSION['errorInvalidPassword']);
                        $_SESSION['userData'] = $result;
                        header("Location: " . URLROOT);
                        exit();
                    }
                }
            }
        }
        header("Location: " . URLROOT . "/login");
        exit();
    }
}
