<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
header("content-type: text/html;charset=utf-8");
session_start();

if(empty($_POST['hide'])||$_POST['hide']!='4')
	header("location:index.php");
else
{
	if(empty($_POST['checkcode']))
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
			if(empty($_POST['email']))
			{
				echo "请填写邮箱";
			}
			else
			{
				$email=$_POST['email'];		//用户名
				if(empty($_POST['password']))
					echo "请填写密码";
				else
				{
					$pw=sha1($_POST['password']);			//密码
					$sqltool=new sqltool;
					$row=$sqltool->select('users',"email='$email'");
					if(empty($row))
					{
						$iniuser=$sqltool->insert('users',"'','$email','$pw','$email','',NOW(),$totalsize,0");
						if($iniuser!=-1)
						{
							$iniuserfile=$sqltool->insert('userfile',"'',$iniuser,1,1,'SYSTEM_DRIVER',1,NOW(),0,0");
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