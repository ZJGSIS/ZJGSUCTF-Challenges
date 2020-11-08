<?php


if(check()){
    $uri="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    header("Location: ".$uri."/index.php?path=view");
    die();
}
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    echo md5($password);
    if($username&&$password){
        $db->init();
        if($db->loginCheck($username,$password)){
            print "yeeeees";
            $_SESSION['login']=true;
            var_dump($_SESSION);
            header("Location: ".$uri."/index.php?path=view");
            die("Login success");
        }
        else{
            echo 'error';
        }
    }
}else{
    include "../layout/login.html";
}
