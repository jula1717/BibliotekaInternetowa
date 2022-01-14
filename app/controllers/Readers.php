<?php

class Readers extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->BookModel = $this->model('BookModel');
    }
    public function index(){
        $readers = $this->userModel->getAllReaders();
        $this->view('readers', compact('readers'));
    }

    public function borrows()
    {
        $readerId = $_GET['readerId'];
        $borrows = $this->BookModel->getReaderBorrows($readerId);
        $this->view('borrows', compact('borrows'));
    }
    public function returnBook()
    {
        $borrowId = $_GET['borrowId'];
        $this->BookModel->returnBook($borrowId);
        header("Location: ".URLROOT."/readers/borrows/?readerId=".$_GET['readerId']);
        exit();
    }
}
?>