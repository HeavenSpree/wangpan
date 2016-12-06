<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
session_start();
if(empty($_SESSION['id']))
{
	header("location:index.php");
}
else
{
	$id=$_SESSION['id'];
}
$sqltool=new sqltool();
$row=$sqltool->select('userfile',"userid=$id AND filetype=1");
$_SESSION['parentid']=$row[0]['id'];
?>
<html>
<head>
<meta charset="UTF-8">
<title>云盘-全部文件</title>
<link rel="stylesheet" type="text/css" href="include/css/common.css">
<link rel="stylesheet" type="text/css" href="include/css/main.css">
<script src="include/js/jquery-3.1.0.js"></script>
<script src="include/js/sha1.js"></script>
<script src="include/js/main.js"></script>
</head>
<body>
<div id="head">
<ul id="headbar">
<li><a href="main.php"><img src="include/img/logo.png"></a></li>
<li><a id="wangpan" href="main.php" style="border: none; background-color: #1d7df4;"></a></li>
<li><a id="fenxiang" href=""></a></li>
<li><a id="gongxiang" href=""></a></li>
<li><a id="about" href="about.php" style="border-left: 1px solid; border-right: 1px solid; background-color: #101cec; border-color: #1d19ca;"></a></li>
</ul>
<div id="headbarr">
<div id="headimg">
<img src="include/img/head.png">
</div>
<div id="headinfo">
<ul>
<li>
<?php
$row=$sqltool->select('users',"id=$id");
$usedsize=$row[0]['usedsize'];
$totalsize=$row[0]['totalsize'];
echo $row[0]['nickname'];
?>
</li>
<li>个人资料</li>
<li>退出</li>
</ul>
</div>
</div>
</div>
<span style="">
<?php
require_once 'readme.txt';
?>
</span>
</body>
</html>