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
			if($_SESSION['usedsize']+$row[0]['size']<$_SESSION['totalsize'])
			{
				$userid=$_SESSION['id'];
				//$existrow=$sqltool->select('userfile',"userid=$userid AND filename='$filename' AND parentid=".$_SESSION['parentid']);
				//if(!empty($existrow))
					//$filename.=' - 副本';			//如果有重复文件这重命名文件
				$successrow=$sqltool->insert('userfile',"'',$userid,".$row[0]['id'].",'$filename','".$row[0]['type']."',".$_SESSION['parentid'].",1,0");
				if($successrow!=-1)
				{
					$sqltool->update('users',"id=$userid",'usedsize='.($_SESSION['usedsize']+$row[0]['size']));
					echo '1';
				}
			}
			else
			{
				echo '上传失败，文件超出了总大小。';
			}
		}
		else
		{
			echo '0';
		}
		$sqltool->close();
	}
}
?>