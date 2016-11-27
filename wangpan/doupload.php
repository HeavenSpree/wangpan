<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
header("content-type: text/html;charset=utf-8");
session_start();

if(empty($_POST['hide'])||$_POST['hide']!='4')
	header("location:login.php");
else
{
	if(empty($hash=$_POST['hash']))
	{
		header("location:main.php");
	}
	else
	{
		$filetempname=$_FILES['upload_file']['tmp_name'];
		if(is_uploaded_file($filetempname))
		{
			if($hash==hash_file('sha1',$filetempname))
			{
				$filedir='./upload_file/';
				$hashpath=chunk_split($hash,4,'/');
				$hasharr=str_split($hashpath,5);
				for($i=0;$i<9;$i++)
				{
					$filedir.=$hasharr[$i];
					if(!file_exists($filedir))
						mkdir($filedir);
				}
				if(move_uploaded_file($filetempname,$filedir.$hash))
				{
					$filesize=$_FILES['upload_file']['size'];
					$sqltool=new sqltool();
					$fileid=$sqltool->insert('file',"'','$hash',".$filesize);
					if($fileid!=-1)
					{
						$filename=$_FILES['upload_file']['name'];
						$filetype=3;
						if($_SESSION['usedsize']+$filesize<$_SESSION['totalsize'])
						{
							$userid=$_SESSION['id'];
							//$existrow=$sqltool->select('userfile',"userid=$userid AND parentid=".$_SESSION['parentid']." AND filename='$filename'");
							//if(!empty($existrow))
								//$filename.='('.count($existrow).')';			//如果有重复文件这重命名文件
							$successrow=$sqltool->insert('userfile',"'',$userid,".$_SESSION['parentid'].",$fileid,'$filename',$filetype,NOW(),0,0");
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
					$sqltool->close();
				}
				else
				{
					echo '上传文件出错，请重新上传。';						
				}
			}
			else
			{
				echo '上传文件出错，请重新上传。';
			}
		}
	}
}
?>