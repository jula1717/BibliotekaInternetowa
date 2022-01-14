<?php

class Categories extends Controller {
    public function __construct()
    {
        $this->BookModel = $this->model('BookModel');
    }
    public function index(){
        $categories = $this->BookModel->getCategories();
        $this->view('categories', compact('categories'));
    }

    public function addCategory()
    {
        $this->view('addCategory');
    }

    public function editCategory()
    {
        $nazwa=$_GET['nazwa'];
        $this->view('editCategory',compact('nazwa'));
    }

    public function categoryFormHandler($tryb,$staraNazwa=0)
    {
        if (!isset($_POST['category'])) $_SESSION['errorEmptyField'] = "Uzupełnij dane!";
        else {
            unset($_SESSION['errorEmptyField']);
            if (strlen($_POST['category']) < 3 || strlen($_POST['category']) > 255) {
                $_SESSION['errorInvalidData'] = "Proszę podać nazwę kategorii o prawidłowym rozmiarze (3-255 znaków)";
            } else {
                unset($_SESSION['errorInvalidData']);
                if($tryb=="edycja")
                {
                    if ($_POST['category']==$staraNazwa){  
                        $_SESSION['errorSameCategory'] = "Nie dokonano żadnej zmiany";
                        header("Location: " . URLROOT . "/categories/editCategory?nazwa=".$staraNazwa);
                        exit();
                    }
                    else
                    {
                        unset($_SESSION['errorSameCategory']);
                        $this->BookModel->editCategory($_POST['category'],$staraNazwa);
                        header("Location: " . URLROOT . "/categories");
                        exit();
                    }
                }
                else if($tryb=="dodanie")
                {
                        $result = $this->BookModel->getCategoryByName($_POST['category']);
                    if ($result!=null){  
                        $_SESSION['errorSameCategory'] = "W bazie istnieje już kategoria o podanej nazwie";
                        header("Location: " . URLROOT . "/categories/addCategory");
                        exit();
                    }
                    else
                    {
                        unset($_SESSION['errorSameCategory']);
                        $this->BookModel->addCategory($_POST['category']);
                        header("Location: " . URLROOT . "/categories");
                        exit();
                    }
                }
            }
        }   
    }

    public function deleteCategory ($id_kategorii)
    {
        $result = $this->BookModel->getBookByCategoryId($id_kategorii);
        if($result == false)
        {
            $this->BookModel->deleteCategory($id_kategorii);
        }
        else 
        {
            $_SESSION['errorDelete'] = "Nie można usunąć kategorii będącej w użyciu";
        }
        header("Location: " . URLROOT . "/categories");
        exit();
    }
}
?>