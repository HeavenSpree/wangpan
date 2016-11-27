<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
header("content-type: text/html;charset=utf-8");
session_start();

if(empty($_POST['hide'])||$_POST['hide']!='4')
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
			$filesize=$row[0]['size'];
			if($_SESSION['usedsize']+$filesize<$_SESSION['totalsize'])
			{
				$userid=$_SESSION['id'];
				$filetype=3;
				//$existrow=$sqltool->select('userfile',"userid=$userid AND parentid=".$_SESSION['parentid']." AND filename='$filename'");
				//if(!empty($existrow))
					//$filename.=' - 副本';			//如果有重复文件这重命名文件
				$successrow=$sqltool->insert('userfile',"'',$userid,".$_SESSION['parentid'].','.$row[0]['id'].",'$filename',$filetype,0,0");
				if($successrow!=-1)
				{
					$_SESSION['usedsize']+=$filesize;
					$sqltool->update('users',"id=$userid",'usedsize=usedsize+'.$filesize);
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