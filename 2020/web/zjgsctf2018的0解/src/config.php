<?php

spl_autoload_register(function ($class_name) {
    require_once 'lib/'.$class_name . '.php';
});

/* database config */
$pdo="mysql:host=localhost;dbname=test";
$user="root";
$pass="toor";

$db=new Database($pdo,$user,$pass);
$uri='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);


function check(){
    if(isset($_SESSION['login'])&&$_SESSION['login']==true)
        return true;
    else
        return false;
}

function logout(){
    unset($_SESSION['login']);
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
}
