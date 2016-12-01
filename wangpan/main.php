<?php
$dir = dirname(__FILE__);
require_once $dir."/include/lib/sqltool.php";
session_start();
if(empty($id=$_SESSION['id']))
{
	header("location:index.php");
}
$sqltool=new sqltool();
$row=$sqltool->select('userfile',"userid=$id AND filetype=1");
$_SESSION['parentid']=$row[0]['id'];
?>
<!doctype html>
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
<li><a id="wangpan" href="main.php"></a></li>
<li><a id="fenxiang" href=""></a></li>
<li><a id="gongxiang" href=""></a></li>
<li><a id="about" href="about.php"></a></li>
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
<div id="sidebar">
<ul>
<li id="selall"><a>所有文件</a></li>
<li id="seldoc"><a>文档</a></li>
<li id="selimg"><a>图片</a></li>
<li id="selmusic"><a>音乐</a></li>
<li id="selvideo"><a>视频</a></li>
<li id="selexe"><a>程序</a></li>
<li id="selzip"><a>压缩包</a></li>
<li id="selother"><a>其他</a></li>
<li id="sharetxt"><a>分享</a></li>
<li id="recycle"><a>回收站</a></li>
</ul>
<div id="space">
<span id="total">
<span id="used" style="width: <?php echo $usedsize/$totalsize*100 ?>%;"></span>
</span>
<div id="space-content">
<span><?php
		if($usedsize<1024)
		{
			echo $usedsize.'B';
		}
		elseif($usedsize<1048576)
		{
			echo round($usedsize/1024).'K';
		}
		elseif($usedsize<1073741824)
		{
			echo round($usedsize/1048576,1).'M';
		}
		elseif($usedsize<1099511627776)
		{
			echo round($usedsize/1073741824,2).'G';
		} 
		?>/<?php
		if($totalsize<1024)
		{
			echo $totalsize.'B';
		}
		elseif($totalsize<1048576)
		{
			echo round($totalsize/1024).'K';
		}
		elseif($totalsize<1073741824)
		{
			echo round($totalsize/1048576,1).'M';
		}
		elseif($totalsize<1099511627776)
		{
			echo round($totalsize/1073741824,2).'G';
		} 
		?></span>
</div>
</div>
<div><span></span></div>
</div>
<div id="main">
<div id="toolbar">
<div id="toolbar-left">
<div>
<div class="item">
<span id="tbupload"><input type="file" id="upinput"><a id="upbutton">上传</a></span>
</div>
<div class="item">
<span id="tbnew">新建文件夹</span>
</div>
<div class="item">
<span id="tbbt">离线下载</span>
</div>
</div>
</div>
<div id="toolbar-right">
<div id="search">
<span id="searchimg"><img src="include/img/ico.png"></span>
<input id="searchinput" type="text" placeholder="搜索文件">
</div>
</div>
</div>
<div id="crumb">
<div id="crumbpath"><span id="path">全部文件</span></div>
</div>
<div id="filelist">
<div class="" id="filelisthead">
<div></div>
<div class="column column-name">
<span>文件名</span>
</div>
<div class="column column-size">大小</div>
<div class="column column-time">修改时间</div>
</div>
<div id="filelistmain">
<script>
var height=$(document).height()-185;
$("#filelistmain").css("height",height);
</script>
<div id="alllist">
</div>
</div>
<div id="doc" style="display: none;">
所有的文档类文件
</div>
<div id="img" style="display: none;">
所有的文档类文件
</div>
<div id="music" style="display: none;">
所有的文档类文件
</div>
<div id="video" style="display: none;">
所有的文档类文件
</div>
<div id="zip" style="display: none;">
所有的文档类文件
</div>
<div id="share" style="display: none;">
所有的文档类文件
</div>
<div id="recyclepage" style="display: none;">
所有的文档类文件
</div>
</body>
</html>