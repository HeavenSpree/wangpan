<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
session_start();
if(empty($id=$_SESSION['id']))
{
	header("location:index.php");
}
$sqltool=new sqltool();
$row=$sqltool->select('userfile',"userid=$id AND filetype='driver'");
$_SESSION['parentid']=$row[0]['id'];
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>云盘-全部文件</title>
<link rel="stylesheet" type="text/css" href="include/css/common.css">
<link rel="stylesheet" type="text/css" href="include/css/main.css">
</head>
<body>
<div id="head">
<ul id="headbar">
<li><img src="include/img/logo.png"></li>
<li><a href=""><img src="include/img/headbar1.png"></a></li>
<li><a href=""><img src="include/img/headbar2.png"></a></li>
<li><a href=""><img src="include/img/headbar3.png"></a></li>
</ul>
<div id="headbarr">
<div id="headimg">
<img src="include/img/head.png">
</div>
<div id="headinfo">
<ul>
<li>jiacw0522@126.com</li>
<li>个人资料</li>
<li>退出</li>
</ul>
</div>
</div>
</div>
<div id="sidebar">
<ul>
<li><a>所有文件</a></li>
<li><a>文档</a></li>
<li><a>图片</a></li>
<li><a>音乐</a></li>
<li><a>视频</a></li>
<li><a>压缩包</a></li>
<li id="sharetxt"><a>分享</a></li>
<li id="recycle"><a>回收站</a></li>
</ul>
<div>
<span>
<span></span>
</span>
<div>
<span></span>
</div>
</div>
</div>
<div id="list">
<div id="toolbar">
<div id="toolbar-left">
<div>
<span class="item" id="upbutton"><input type="file" id="upinput">上传</span>
<span class="item">新建文件夹</span>
<span class="item">离线下载</span>
</div>
</div>
<div id="toolbar-right">
<div>
<input type="text"> 
<span id="searchimg"></span>
</div>
</div>
</div>
<div>
<div>crumb</div>
<div>
<div>
<ul>
<pre id="pre">
<?php
$row=$sqltool->select('userfile','userid='.$id.' AND parentid='.$_SESSION['parentid']);
print_r($row);
$sqltool->close();
?>
</pre>
</ul>
</div> 
</div>
</div>
</div>
</body>
<script src="include/js/jquery-3.1.0.js"></script>
<script src="include/js/sha1.js"></script>
<script src="include/js/main.js"></script>
</html>