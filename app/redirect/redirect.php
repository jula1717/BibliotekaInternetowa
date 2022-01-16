<?php


function loginAccessOnly()
{
    if(!isset($_SESSION['userData']))
    {
        header("Location: " . URLROOT . "/login");
        exit();
    }
}
  
function librarianAccessOnly()
{
    loginAccessOnly();
    if($_SESSION['userData']->typ_konta!="pracownik"&&$_SESSION['userData']->typ_konta!="administrator")
    {
        checkTypeAccount();
    }       
} 

function readerAccessOnly()
{
    loginAccessOnly();
    if($_SESSION['userData']->typ_konta!="czytelnik")
    {
        checkTypeAccount();
    } 
}

function checkTypeAccount()
{
    if($_SESSION['userData']->typ_konta=="pracownik"||$_SESSION['userData']->typ_konta=="administrator")
    {
        header("Location: " . URLROOT . "/workerProfile");
        exit();
    }
    else if($_SESSION['userData']->typ_konta=="czytelnik")
    {
        header("Location: " . URLROOT . "/readerProfile");
        exit();
    }
}


