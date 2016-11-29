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
<li><a id="wangpan" href=""></a></li>
<li><a id="fenxiang" href=""></a></li>
<li><a id="gongxiang" href=""></a></li>
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
<ul id="list">
<?php
$row=$sqltool->select('userfile','userid='.$id.' AND parentid='.$_SESSION['parentid']." AND state=0");
foreach($row as $key => $value)
{
	?>
	<li class="row">
	<div></div>
	<div class="column-name filename">
	<span></span>
	<span><?php echo $value['filename'] ?></span>
	<span class="downliad">
	<a href="javascript:void(0);" id="download" onclick="downloadFile('include/lib/download.php?id=<?php echo $value['id']; ?>')" target="_blank" download="<?php echo $value['filename'] ?>">下载</a>
	</span>
	<span></span>
	</div>
	<div class="column-size filesize"><?php 
	if(2!=$value['filetype'])
	{
		$file=$sqltool->select('file','id='.$value['fileid']);
		$filesize=$file[0]['size'];
		if($filesize<1024)
		{
			echo $filesize.'B';
		}
		elseif($filesize<1048576)
		{
			echo round($filesize/1024).'K';
		}
		elseif($filesize<1073741824)
		{
			echo round($filesize/1048576,1).'M';
		}
		elseif($filesize<1099511627776)
		{
			echo round($filesize/1073741824,2).'G';
		}
	}
	?></div>
	<div class="column-time filetime"><?php echo $value['modified']; ?></div>
	</li>
	<?php
}
$sqltool->close();
?>
<iframe id="downloadiframe"></iframe>
</ul>
</div> 
</div>
</div>
</body>
</html>