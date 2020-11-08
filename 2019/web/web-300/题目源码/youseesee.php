<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SQL is so interesting</title>
</head>

<body bgcolor="#ffffff">
<div style=" margin-top:70px;color:#FFF; font-size:40px; text-align:center"><font color="#FF0000"> 到底过滤了什么？ </font><br>

<font size="4" color="#FFFF00">
<div style="padding-top:10px; font-size:15px ;">

<div style="margin-top:15px; height:30px;">
	<input type="text"  name="id" value=""/>
</div>
<div style=" margin-top:9px;margin-left:90px; text-align:center"">
	<input type="submit" name="submit" value="提交查询" />
</div>

</div>
<br></br>

<?php
//including the Mysql connect parameters.
//give your mysql connection username n password
$dbuser ='root';
$dbpass ='root';
$dbname ="Car01eAndTuesday";
$host = 'localhost';
@error_reporting(0);
@$con = mysql_connect($host,$dbuser,$dbpass);
// Check connection
if (!$con)
{
    echo "Failed to connect to MySQL: " . mysql_error();
}
    @mysql_select_db($dbname,$con) or die ( "Unable to connect to the database: $dbname");

// take the variables 
if(isset($_POSGET['id']))
{
	$id=$_GET['id'];
	//fiddling with comments
	$id= blacklist($id);
	$hint=$id;

// connectivity 
	@$sql="SELECT * FROM users WHERE id=('$id') LIMIT 0,1";
	$result=mysql_query($sql);
	$row = mysql_fetch_array($result);
	if($row)
	{
	  	echo "<font size='5' color= '#99FF00'>";	
	  	echo 'Your Login name:'. $row['username'];
	  	echo "<br>";
	  	echo 'Your Password:' .$row['password'];
	  	echo "</font>";
  	}
	else 
	{
		echo '<font color= "#FFFF00">';
		print_r(mysql_error());
		echo "</font>";  
	}
}

function blacklist($id)
{
	$id= preg_replace('/or/i',"", $id);			//strip out OR (non case sensitive)
	$id= preg_replace('/and/i',"", $id);		//Strip out AND (non case sensitive)
	$id= preg_replace('/[\/\*]/',"", $id);		//strip out /*
	$id= preg_replace('/[--]/',"", $id);		//Strip out --
#	$id= preg_replace('/[#]/',"", $id);			//Strip out #
#	$id= preg_replace('/[\s]/',"", $id);		//Strip out spaces
	$id=preg_replace('/select/i',"", $id);		//strip out select (non case sensitive)
	$id=preg_replace('/union/i',"", $id);		//strip out union (non case sensitive)
	$id=addslashes($id);
	return $id;
}

?>
</font> </div></br></br></br><center>

<font size='4' color= "#33FFFF">
<?php
echo "Hint: Your Input is Filtered with following result: ".$hint;
echo "<br>";
echo "sql:".$sql;
?>
</font> 
</center>
</body>
</html>





 
