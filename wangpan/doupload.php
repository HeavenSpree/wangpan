<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
header("content-type: text/html;charset=utf-8");
session_start();

$state=array(normal=>1,deleted=>2,illegal=>3,previous=>4);

if($_POST['hide']!='4')
	header("location:login.php");
else
{
	if(empty($_POST['hash']))
	{
		header("location:main.php");
	}
	else
	{
		if(is_uploaded_file($_FILES['upload_file']['tmp_name']))
		{
			
			
			//$hash=$_POST['hash'];
			//$sqltool=new sqltool();
			

















			//$row=$sqltool->select('userfile','userid='.$id.' AND parentid='.$parentid);
			//print_r($row);
			
		}
	}
}
?>