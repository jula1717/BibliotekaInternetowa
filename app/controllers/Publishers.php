<?php

class Publishers extends Controller
{
    public function __construct()
    {
        librarianAccessOnly();
        $this->BookModel = $this->model('BookModel');
    }
    public function index()
    {
        $publishers = $this->BookModel->getPublishers();
        $this->view('publishers', compact('publishers'));
    }

    public function addPublisher()
    {
        $this->view('addPublisher');
    }

    public function editPublisher()
    {
        $nazwa = $_GET['nazwa'];
        $this->view('editPublisher', compact('nazwa'));
    }

    public function publisherFormHandler($tryb)
    {
        if($tryb=="edycja")
        {
            $staraNazwa = $_POST['old_publisher'];
        }
        if (!isset($_POST['publisher'])) $_SESSION['errorEmptyField'] = "Uzupełnij dane!";
        else {
            if (strlen($_POST['publisher']) < 1 || strlen($_POST['publisher']) > 255) {
                $_SESSION['errorInvalidData'] = "Proszę podać nazwę wydawnictwa o prawidłowym rozmiarze (1-255 znaków)";
            } else {
                if ($tryb == "edycja") {
                    if ($_POST['publisher'] == $staraNazwa) {
                        $_SESSION['errorSamePublisher'] = "Nie dokonano żadnej zmiany";
                        header("Location: " . URLROOT . "/publishers/editPublisher?nazwa=" . $staraNazwa);
                        exit();
                    } else {
                        $this->BookModel->editPublisher($_POST['publisher'], $staraNazwa);
                        header("Location: " . URLROOT . "/publishers");
                        exit();
                    }
                } else if ($tryb == "dodanie") {
                    $result = $this->BookModel->getPublisherByName($_POST['publisher']);
                    if ($result != null) {
                        $_SESSION['errorSamePublisher'] = "W bazie istnieje już wydawnictwo o podanej nazwie";
                        header("Location: " . URLROOT . "/publishers/addPublisher");
                        exit();
                    } else {
                        $this->BookModel->addPublisher($_POST['publisher']);
                        header("Location: " . URLROOT . "/publishers");
                        exit();
                    }
                }
            }
        }
    }

    public function deletePublisher($id_wydawnictwa)
    {
        $result = $this->BookModel->getBookByPublisherId($id_wydawnictwa);
        if ($result == false) {
            $this->BookModel->deletePublisher($id_wydawnictwa);
        } else {
            $_SESSION['errorDelete'] = "Nie można usunąć wydawnictwa będącego w użyciu";
        }
        header("Location: " . URLROOT . "/publishers");
        exit();
    }
}
