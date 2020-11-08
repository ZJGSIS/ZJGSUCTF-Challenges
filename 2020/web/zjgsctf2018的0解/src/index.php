<?php
/**
 * Created by PhpStorm.
 * User: wh1t3P1g
 * Date: 2018/4/4
 * Time: 15:45
 */
include "config.php";

if(isset($_GET['path'])){
    switch($_GET['path']){
        case 'contact':
            include "layout/contact.html";
            break;
        default:
            include "layout/main.html";
    }
}else{
    include "layout/main.html";
}

