<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
$link .= $_SERVER['REQUEST_URI'];

if(!isset($_SESSION['userdata'])){
    if(isset($_SESSION['userdata'])  &&  $_SESSION['userdata']['role'] == 'admin' && strpos($link, 'login.php')){
        redirect('admin/index.php');
    }
   
    }
