<?php
header("Content-Type: text/html;charset=UTF-8");

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

function returnRedirect($first=0,$second=0,$third=0)
{
    if($first==0 && $second==0 && $third==0) echo '<a href="'.URLROOT.'" class="button"><i class="icon-left-open"></i>Powrót</a>';
    else if($second==0 && $third==0) echo '<a href="'.URLROOT.'/'.$first.'" class="button"><i class="icon-left-open"></i>Powrót</a>';
    else if ($third==0) echo '<a href="'.URLROOT.'/'.$first.'/'.$second.'" class="button"><i class="icon-left-open"></i>Powrót</a>';
    else  echo '<a href="'.URLROOT.'/'.$first.'/'.$second.'/'.$third.'" class="button"><i class="icon-left-open"></i>Powrót</a>';
}


