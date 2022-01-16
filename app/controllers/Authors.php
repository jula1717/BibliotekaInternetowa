<?php

class Authors extends Controller {
    public function __construct()
    {
        librarianAccessOnly();
        $this->BookModel = $this->model('BookModel');
    }
    public function index(){
        $authors = $this->BookModel->getAuthors();
        $this->view('authors', compact('authors'));
    }

    public function addAuthor()
    {
        $this->view('addAuthor');
    }

    public function editAuthor()
    {
        $imie=$_GET['imie'];
        $nazwisko=$_GET['nazwisko'];
        $id_autora=$_GET['id_autora'];
        $this->view('editAuthor',compact('imie','nazwisko','id_autora'));
    }

    public function authorFormHandler($tryb,$stareImie=0,$stareNazwisko=0,$id_autora=0)
    {
        if (!isset($_POST['authorFirstname'])||!isset($_POST['authorLastname'])) $_SESSION['errorEmptyField'] = "Uzupełnij dane!";
        else {
            if (strlen($_POST['authorFirstname']) < 1 || strlen($_POST['authorFirstname']) > 255) {
                $_SESSION['errorFirstnameInvalidData'] = "Proszę podać imię autora o prawidłowym rozmiarze (1-255 znaków)";
            } else {
                if (strlen($_POST['authorLastname']) < 1 || strlen($_POST['authorLastname']) > 255) {
                    $_SESSION['errorLastnameInvalidData'] = "Proszę podać nazwisko autora o prawidłowym rozmiarze (1-255 znaków)";
                } else {
                    if($tryb=="edycja")
                    {
                        if ($_POST['authorFirstname']==$stareImie && $_POST['authorLastname']==$stareNazwisko){  
                            $_SESSION['errorSameAuthor'] = "Nie dokonano żadnej zmiany";
                            header("Location: " . URLROOT . "/authors/editAuthor?imie=".$stareImie."&nazwisko=".$stareNazwisko."&id_autora=".$id_autora);
                            exit();
                        }
                        else
                        {
                            unset($_SESSION['errorSameAuthor']);
                            $this->BookModel->editAuthor($_POST['authorFirstname'],$_POST['authorLastname'],$id_autora);
                            header("Location: " . URLROOT . "/authors");
                            exit();
                        }
                    }
                    else if($tryb=="dodanie")
                    {
                        $this->BookModel->addAuthor($_POST['authorFirstname'],$_POST['authorLastname']);
                        header("Location: " . URLROOT . "/authors");
                        exit();
                    }
                }
            }
        }   
    }

    public function deleteAuthor ($id_autora)
    {
        $result = $this->BookModel->getAuthorRelationByAuthorId($id_autora);
        if($result == false)
        {
            $this->BookModel->deleteAuthor($id_autora);
        }
        else 
        {
            $_SESSION['errorDelete'] = "Nie można usunąć autora, który został już wcześniej przypisany";
        }
        header("Location: " . URLROOT . "/authors");
        exit();
    }
}
?>