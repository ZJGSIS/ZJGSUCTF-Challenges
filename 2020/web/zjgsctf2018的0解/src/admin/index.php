<?php

session_start();
include "../config.php";
// alter php.ini session.cookie_httponly=1 stop xss
if(check()){
    $path=isset($_GET['path'])&&$_GET['path']?$_GET['path']:'view';
    switch($path){
        case 'view':
            include "view.php";
            break;
        case 'login':
            include "login.php";
            break;
        case 'logout':
            logout();

            header("Location: ".$uri);
            break;
        default:
            include "http://127.0.0.1/".$_GET['path'];

    }
}else{
    include "login.php";
}
