<?php
$dir = dirname(__FILE__);
require_once $dir."/sqltool.php";
session_start();
function dowmload($filepath,$filename,$filesize)
{
	$fp=fopen($filepath,"rb");
	header("Content-type: application/octet-stream");
	header("Accept-Ranges: bytes");
	header("Accept-Length: $filesize");
	header("Content-Disposition: attachment; filename=$filename");
	$buffersize=4194304;
	$filecount=0;
	while(!feof($fp) && $filecount<$filesize)
	{
		$buffer=fread($fp,$buffersize);
		$filecount+=$buffersize;
		echo $buffer;
	}
	fclose($fp);
}
if(!isset($_SERVER['HTTP_REFERER']))
{
	header("location:../../index.php");
}
else
{
	if(7!=strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))
	{
		header("location:../../index.php");
	}
	else
	{
		if(empty($_GET['id']))
		{
			header("location:../../index.php");
		}
		else
		{
			$listid=$_GET['id'];
			$userfileid=$_SESSION['fileid'];
			$id=$userfileid[$listid];
			$sqltool=new sqltool();
			$userfile=$sqltool->select('userfile',"id=$id");
			$fileid=$userfile[0]['fileid'];
			$filename=$userfile[0]['filename'];
			$file=$sqltool->select('file',"id=$fileid");
			$filesize=$file[0]['size'];
			$hash=$file[0]['hash'];
			$sqltool->close();
			$hashpath=chunk_split($hash,4,'/');
			$hasharr=str_split($hashpath,5);
			$path='../../upload_file/';
			for($i=0;$i<9;$i++)
			{
			$path.=$hasharr[$i];
			}
			dowmload($path.$hash,$filename,$filesize);
		}
	}
}
?>