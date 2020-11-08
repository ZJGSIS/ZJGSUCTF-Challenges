<meta http-equiv="refresh" content="3">
<?php


if(!check()){
    $uri="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    header("Location: ".$uri."/index.php?path=login");
    die();
}
$db->init();
$msg=$db->viewMessage();
include "../layout/view.html";
