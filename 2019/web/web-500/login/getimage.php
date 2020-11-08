<?php
error_reporting(0);
session_start();
if(!$_SESSION['islogin']){
  header("Location: index.php");exit;
}
require("curlimg.php");
//远程下载
if($_GET['action'] == 'downremoteimage') {
  $filter=$_GET['message'];
  if(strpos($filter,'127.0.0.1')>0)
  {
     echo "非法127.0.0.1！"."<br>";
     die();
  }
  if(strpos($filter,'root')>0)
  {
     echo "听说有个用户叫hhddj"."<br>";
     echo "我猜你需要一个公网ip，没有的话找我，qq：1466742963"."<br>";
     die();
  }
  foreach (array('file://','ssh','php','js','asp','jsp','phar','html','../','./','<script>','alert','onload','onerror','src') as $i) {
    if(strpos($filter,$i)>0)
    {
      echo "非法字符!!!"."<br>";
      die();
    }
  }
  preg_match_all("/\[img\]\s*([^\[\<\r\n]+?)\s*\[\/img\]|\[img=\d{1,4}[x|\,]\d{1,4}\]\s*([^\[\<\r\n]+?)\s*\[\/img\]/is", $_GET['message'], $image1, PREG_SET_ORDER);
  preg_match_all("/\<img.+src=('|\"|)?(.*)(\\1)([\s].*)?\>/ismUe", $_GET['message'], $image2, PREG_SET_ORDER);
  $flag1=$_GET['message'];
  $temp = $aids = $existentimg = array();
  if(is_array($image1) && !empty($image1)) {
    foreach($image1 as $value) {
      $temp[] = array(
        '0' => $value[0],
        '1' => trim(!empty($value[1]) ? $value[1] : $value[2])
      );
    }
  }
  if(is_array($image2) && !empty($image2)) {
    foreach($image2 as $value) {
      $temp[] = array(
        '0' => $value[0],
        '1' => trim($value[2])
      );
    }
  }

  if(is_array($temp) && !empty($temp)) {
          $imageurl = $value[1];
          $content = '';
          $content = dfsockopen($imageurl);//重点关注
	  if(empty($content)){
            echo "无法访问！"."<br>";
          }
          else{
            $fp2=@fopen("hhd.jpg",'wb');
            fwrite($fp2,$content);
            fclose($fp2);
	    $t=uniqid();
	    echo '<img src="http://10.21.13.190:23333/login/hhd.jpg?t='.$t.'"/>';
          }
  }
}
?>

