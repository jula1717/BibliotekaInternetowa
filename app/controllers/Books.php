<?php

class Books extends Controller {
    public function __construct()
    {
        loginAccessOnly();
        $this->bookModel = $this->model('BookModel');
        $this->userModel = $this->model('UserModel');
    }
    public function index(){
        $books = $this->bookModel->getAllBooks();
        $this->view('books', compact('books'));
    }

    public function copies($id_ksiazki)
    {
        $book = $this->bookModel->getBookById($id_ksiazki);
        $copies = $this->bookModel->getAllCopiesOfBook($id_ksiazki);
        $this->view('copies',compact('copies','book'));
    }

    public function addBook()
    {
        $categories=$this->bookModel->getCategories();
        $publishers=$this->bookModel->getPublishers();
        $this->view('addBook',compact('categories','publishers'));
    }

    public function addCopy($id_ksiazki)
    {
        $this->view('addCopy',compact('id_ksiazki'));
    }


    public function BookAddFormHandler()
    {
        //to do obsługa dodawania książki
        $authors=$this->bookModel->getAuthors();
    }

    public function CopyAddFormHandler($id_ksiazki)
    {
        $this->bookModel->addCopy($id_ksiazki,$_POST['publicationYear']);
        header("Location: " . URLROOT . "/books/copies/".$id_ksiazki);
        exit();
    }

    public function deleteBook($id_ksiazki)
    {
        $result=$this->bookModel->borrowsOfBook($id_ksiazki);
        if($result==NULL)
        {
            $this->bookModel->deleteBook($id_ksiazki);
        }
        else 
        {
            $_SESSION['errorDelete'] = "Nie można usunąć książki, która była już wcześniej wypożyczona";
        }
        header("Location: " . URLROOT . "/books");
        exit();
    }

    public function deleteCopy($id_egzemplarza,$id_ksiazki)
    {
        $result=$this->bookModel->borrowsOfCopy($id_egzemplarza);
        if($result==NULL)
        {
            $this->bookModel->deleteCopy($id_egzemplarza);
        }
        else 
        {
            $_SESSION['errorDelete'] = "Nie można usunąć egzemplarza, który był już wcześniej wypożyczony";
        }
        header("Location: " . URLROOT . '/books/copies/'.$id_ksiazki);
        exit();
    }

    public function borrowCopy($id_ksiazki,$id_egzemplarza)
    {
        $readers = $this->userModel->getEmailsAllReaders();
        $this->view('borrowsReadersList', compact('readers','id_egzemplarza','id_ksiazki'));
    }

    public function isUserLimitAchieved($id_uzytkownika)
    {
        $unreturnedBooks = $this->userModel->getCountReaderUnreturnedBooks($id_uzytkownika);
        $readerLimit = $this->userModel->getReaderLimit($id_uzytkownika);
        if($readerLimit-$unreturnedBooks==0) return true;
        else return false;
        
    }
    public function tryToBorrowCopy($id_uzytkownika,$id_ksiazki,$id_egzemplarza)
    {
        $isUserLimitAchieved = $this->isUserLimitAchieved($id_uzytkownika);
        if($isUserLimitAchieved)
        {
            
            $_SESSION['limitError']="Wybrany czytelnik osiągnął swój limit ";
            header("Location: " . URLROOT . '/books/borrowCopy/'.$id_ksiazki.'/'.$id_egzemplarza);
            exit();
           
        }
        else 
        {
            unset($_SESSION['limitError']);
            $this->bookModel->borrowCreate($id_uzytkownika,$id_egzemplarza);
            header("Location: " . URLROOT . '/books/copies/'.$id_ksiazki);
            exit();
        }

    }

}
?>