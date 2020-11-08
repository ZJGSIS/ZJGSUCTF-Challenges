<?php

include "config.php";

if(isset($_POST['submit'])){
    $content=$_POST['content']?$_POST['content']:null;
    print $content;
    if($content){
        $db->init();
        $db->addMessage($content,0);
        $ret['msg']="add message success, good job!";
        $ret['code']=200;
        echo json_encode($ret);
    }else{
        $ret['msg']="add message fail";
        $ret['code']=400;
        echo json_encode($ret);
    }
}

?>


