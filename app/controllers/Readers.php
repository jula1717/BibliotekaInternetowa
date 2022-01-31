<?php

class Readers extends Controller {
    public function __construct()
    {
        librarianAccessOnly();
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
        $readerId = $_GET['readerId'];
        $this->BookModel->returnBook($borrowId);
        $readingsAmount=$this->userModel->countReadings($readerId);
        if($readingsAmount>=20)
        {
            $this->userModel->changeLimit($readerId,8);
        }
        else if($readingsAmount>=15)
        {
            $this->userModel->changeLimit($readerId,7);
        }
        else if($readingsAmount>=10)
        {
            $this->userModel->changeLimit($readerId,6);
        }
        else if($readingsAmount>=5)
        {
            $this->userModel->changeLimit($readerId,5);
        }
        header("Location: ".URLROOT."/readers/borrows/?readerId=".$readerId);
        exit();
    }
}
?>