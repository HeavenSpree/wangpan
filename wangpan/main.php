<?php
session_start();
if(empty($_SESSION['id']))
{
	header("location:index.php");
}

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
 <div class="head">
 <ul class="headbar">
 <li><img src="include/img/logo.png"></li>
 <li><a href=""><img src="include/img/headbar1.png"></a></li>
 <li><a href=""><img src="include/img/headbar2.png"></a></li>
 <li><a href=""><img src="include/img/headbar3.png"></a></li>
 </ul>
 <div class="headbarr">
 <div class="headimg">
 <img src="include/img/head.png">
 </div>
 <div class="headinfo">
 <ul>
 <li>jiacw0522@126.com</li>
 <li>个人资料</li>
 <li>退出</li>
 </ul>
 </div>
 </div>
 </div>
 <div class="sidebar">
 <ul>
 <li>所有文件</li>
 <li>文档</li>
 <li>图片</li>
 <li>音乐</li>
 <li>视频</li>
 <li>压缩包</li>
 <li>分享</li>
 <li>回收站</li>
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
 <div class="list">
 </div>
 </body>
  <script src="include/js/jquery-3.1.0.js"></script>
  <script src="include/js/main.js"></script>
</html>

























































