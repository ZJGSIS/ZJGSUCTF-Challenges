<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>登录</title>
<link type="text/css" rel="stylesheet" href="css/www.php.cn.css">
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/img_ver.js"></script>
</head>
<body>
<!--password:888888-->
<div class="logo-box">
<div class="login" style="">
<div class="bxs-row" style="text-align:center;">
<img id="logo" src="images/logo.jpg" style="width:72px;"><span class="tips" style="color:red;">反正不是sql注入和爆破！</span>
</div>
<form action="index.php" method="POST">
<div class="bxs-row">
<input type="text" class="username" placeholder="用户名" name="username">
</div>
<div class="bxs-row">
<input type="password" class="password" placeholder="密码" name="password">
</div>
<div class="bxs-row">
<input type="submit" class="submit btn" value="登录" name="login">
</div>
</form>
</div>
</div>
</body>
</html>
<?php
error_reporting(0);
session_start();
if(isset($_POST['login'])){
$username=$_POST['username'];
$password=$_POST['password'];
if($username==="admin"&&$password==="888888"){
?>
<script>alert("login success!");</script>
<?php
$_SESSION['islogin']=true;
header('Location: jiemian.php');
}
else{
$_SESSION['islogin']=false;
?>
<script>alert("no way!");</script>
<?php
die();
}
}
?>
