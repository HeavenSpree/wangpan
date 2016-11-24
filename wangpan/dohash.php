<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
header("content-type: text/html;charset=utf-8");
session_start();

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
		$hash=$_POST['hash'];
		$sqltool=new sqltool();
		$row=$sqltool->select('file',"hash='$hash'");
		$filename=$_POST['filename'];
		if(!empty($row))
		{
			$bool=$sqltool->select('userfile',"userid=".$_SESSION['id']." AND filename='$filename' AND parentid=".$_SESSION['parentid']);
			//if(!empty($bool))
				//$filename.='('.count($bool).')';			//如果有重复文件这重命名文件
			$sqltool->insert('userfile',"'',".$_SESSION['id'].",".$row[0]['id'].",'".$filename."','".$row[0]['type']."',".$_SESSION['parentid'].",1,0");
			$sqltool->close();
			echo '1';
		}
		else
		{
			echo '0';
		}
	}
}
?>





















