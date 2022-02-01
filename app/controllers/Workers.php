<?php

class Workers extends Controller
{
    public function __construct()
    {
        librarianAccessOnly();
        $this->userModel = $this->model('UserModel');
    }
    public function index()
    {
        $workers = $this->userModel->getAllWorkers();
        $this->view('workers', compact('workers'));
    }

    public function addWorker()
    {
        $this->view('addWorker');
    }

    public function editWorker()
    {
        $id_uzytkownika = $_GET['workerId'];
        $worker = $this->userModel->getUserById($id_uzytkownika);
        $this->view('editWorker', compact('worker'));
    }

    public function workerAddFormHandler()
    {
        if (!isset($_POST['password']) || !isset($_POST['email']) || !isset($_POST['confirmPassword']) || !isset($_POST['phone'])) {
            $_SESSION['errorIncompleteRegisterData'] = "Uzupełnij wszystkie pola!";
        } else {
            unset($_SESSION['errorIncompleteRegisterData']);
            if (strlen($_POST['email']) < 6 || strlen($_POST['email']) > 255) {
                $_SESSION['errorWrongEmailSize'] = "Proszę podać adres email o prawidłowym rozmiarze (6-255 znaków)";
            } else {
                unset($_SESSION['errorWrongEmailSize']);
                if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 255) {
                    $_SESSION['errorWrongPasswordSize'] = "Proszę podać hasło o prawidłowym rozmiarze (8-255 znaków)";
                } else {
                    unset($_SESSION['errorWrongPasswordSize']);
                    if (strlen($_POST['confirmPassword']) < 8 || strlen($_POST['confirmPassword']) > 255) {
                        $_SESSION['errorWrongConfirmPasswordSize'] = "Proszę podać hasło o prawidłowym rozmiarze (8-255 znaków)";
                    } else {
                        unset($_SESSION['errorWrongConfirmPasswordSize']);
                        if (strlen($_POST['phone']) != 9) {
                            $_SESSION['errorWrongPhoneSize'] = "Proszę podać prawidłowy format i długość numeru telefonu(np.123456789)";
                        } else {
                            unset($_SESSION['errorWrongPhoneSize']);
                            if ($_POST['password'] == $_POST['confirmPassword']) {
                                $result = $this->userModel->getUserByEmail($_POST['email']);
                                if ($result == null) {
                                    $this->userModel->createWorker();
                                    unset($_SESSION['errorDataAlreadyExists']);
                                    header("Location: " . URLROOT . "/workers");
                                    exit();
                                } else {
                                    $_SESSION['errorDataAlreadyExists'] = "W bazie danych istnieje już użytkownik o tym samym adresie e-mail";
                                }
                            }
                        }
                    }
                }
            }
            header("Location: " . URLROOT . "/workers/addWorker");
            exit();
        }
    }

    public function workerEditFormHandler($staryEmail, $staryTelefon, $id_uzytkownika)
    {
        if (!isset($_POST['email']) || !isset($_POST['phone'])) {
            $_SESSION['errorIncompleteRegisterData'] = "Uzupełnij wszystkie pola!";
        } else {
            unset($_SESSION['errorIncompleteRegisterData']);
            if (strlen($_POST['email']) < 6 || strlen($_POST['email']) > 255) {
                $_SESSION['errorWrongEmailSize'] = "Proszę podać adres email o prawidłowym rozmiarze (6-255 znaków)";
            } else {
                unset($_SESSION['errorWrongEmailSize']);
                if (strlen($_POST['phone']) != 9) {
                    $_SESSION['errorWrongPhoneSize'] = "Proszę podać prawidłowy format i długość numeru telefonu(np.123456789)";
                } else {
                    unset($_SESSION['errorWrongPhoneSize']);
                    if ($_POST['email'] == $staryEmail && $_POST['phone'] == $staryTelefon) {
                        $_SESSION['errorDataAlreadyExists'] = "Nie dokonano żadnej zmiany";
                        header("Location: " . URLROOT . "/workers/editWorker?workerId=" . $id_uzytkownika);
                        exit();
                    } else {
                        unset($_SESSION['errorDataAlreadyExists']);
                        $result=$this->userModel->getUserByEmail($_POST['email']);
                        if($result !=null)
                        {
                            $_SESSION['errorSameEmail'] = "Podany email jest zajęty";
                            header("Location: " . URLROOT . "/workers/editWorker?workerId=" . $id_uzytkownika);
                            exit();
                        }
                        else
                        {
                            $this->userModel->changeUser($_POST['email'], $_POST['phone'], $id_uzytkownika);
                            header("Location: " . URLROOT . "/workers");
                            exit();
                        }
                    }
                }
            }
        }
    }

    public function changeStatus($workerId, $workerStatus)
    {
        if ($workerStatus == 'dostepny') {
            $this->userModel->changeToLocked($workerId);
        } else if ($workerStatus == 'zablokowany') {
            $this->userModel->changeToAvailable($workerId);
        }
        header("Location: " . URLROOT . "/workers");
        exit();
    }
}
