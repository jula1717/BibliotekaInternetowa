<?php

class ReaderProfile extends Controller {
    public function __construct()
    {
        readerAccessOnly();
    }
    public function index()
    {
        $this->view('readerProfile');
    }
}
?>