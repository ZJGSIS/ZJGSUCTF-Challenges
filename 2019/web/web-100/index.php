<?php
error_reporting(0);
$dir=$_GET['dir'];
if(is_null($dir)){?>
  <script>alert("param is dir!")</script>
<?php
}else{
if(strpos($dir,array('etc','passwd','php','var','root','bin','usr','lib'))){?>
	<script>alert("illegal character!");</script>
<?php
die();}
$dir=addslashes($dir);
$dir=str_replace(array('../','./','..\\'),'',$dir);
echo "your dir is:".$dir.'<br>';
echo "flag is in /flag/flag1.txt".'<br>';
if(substr($dir,-9)==="flag1.txt")
  readfile($dir);
}
?>
