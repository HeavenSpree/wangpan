<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
header("content-type: text/html;charset=utf-8");
session_start();

if(!isset($_POST['hide'])||$_POST['hide']!='4')
	header("location:index.php");
else
{
	if(!isset($_POST['checkcode']))
	{
		echo "请填写验证码";
	}
	else
	{
		$checkcode=strtolower($_POST['checkcode']);			//验证码
		if($checkcode!=$_SESSION['checkcode'])
		{
			echo "验证码错误";
		}
		else
		{
			if(!isset($_POST['email']))
			{
				echo "请填写邮箱";
			}
			else
			{
				$email=$_POST['email'];		//用户名
				if(!isset($_POST['password']))
					echo "请填写密码";
				else
				{
					$pw=sha1($_POST['password'].KEY);			//密码
					$sqltool=new sqltool;
					$row=$sqltool->select('users',"email='$email'");
					if(empty($row))
					{
						$iniuser=$sqltool->insert('users',"NULL,'$email','$pw','$email',NULL,NOW(),$totalsize,0");
						if($iniuser!=-1)
						{
							$iniuserfile=$sqltool->insert('userfile',"NULL,$iniuser,1,1,'SYSTEM_DRIVER',1,NOW(),0,0");
							if($iniuserfile!=-1)
							{
								echo '0';
							}
						}
					}
					else
					{
						echo '1';
					}
				}
			}
		}
	}
}
?>