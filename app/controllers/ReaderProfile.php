<?php

class ReaderProfile extends Controller {
    public function __construct()
    {
        readerAccessOnly();
        $this->userModel = $this->model('UserModel');
        $this->bookModel = $this->model('BookModel');
    }
    public function index()
    {
        $this->view('readerProfile');
    }

    public function logout(){
        session_unset();
        header("Location: ".URLROOT . "/login");
        exit();
    }

    public function ChangeData()
    {
        $this->view('editReader');
    }

    public function myBorrows()
    {
        $borrows = $this->bookModel->getReaderBorrows($_SESSION['userData']->id_uzytkownika);
        $this->view('myBorrows', compact('borrows'));
    }

    public function prolongBook()
    {
        $borrowId = $_GET['borrowId'];
        $this->bookModel->prolongBook($borrowId);
        header("Location: ".URLROOT."/readerProfile/myBorrows");
        exit();
    }

    public function FormHandler()
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
                    if ($_POST['email'] == $_SESSION['userData']->email && $_POST['phone'] == $_SESSION['userData']->telefon) {
                        $_SESSION['errorDataAlreadyExists'] = "Nie dokonano żadnej zmiany";
                        header("Location: " . URLROOT . "/readerProfile/changeData");
                        exit();
                    } else {
                        $this->userModel->changeUser($_POST['email'], $_POST['phone'],$_SESSION['userData']->id_uzytkownika);
                        $_SESSION['userData'] = $this->userModel->getUserById($_SESSION['userData']->id_uzytkownika);
                        unset($_SESSION['errorDataAlreadyExists']);
                        header("Location: " . URLROOT . "/readerProfile");
                        exit();
                    }
                }
            }
        }
    }
}
?>