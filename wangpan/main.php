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
$row=$sqltool->select('userfile','userid='.$id.' AND parentid='.$_SESSION['parentid']." AND state=0");
print_r($row);
foreach($row as $key => $value)
{
	?>
	</pre>
	<li class="">
	<div></div>
	<div>
	<span></span>
	<span><?php echo $value['filename'] ?></span>
	<span>
	<a href="<?php
	$file=$sqltool->select('file','id='.$value['fileid']);
	$hash=$file[0]['hash'];
	$hashpath=chunk_split($hash,4,'/');
	$hasharr=str_split($hashpath,5);
	$path='upload_file/';
	for($i=0;$i<9;$i++)
	{
		$path.=$hasharr[$i];
	}
	echo $path.$hash;
	?>" download="<?php echo $value['filename'] ?>">下载</a>
	</span>
	<span></span>
	</div>
	<div>
	<?php 
	if(2!=$value['filetype'])
	{
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
	?>
	</div>
	<div><?php echo $value['modified']; ?></div>
	</li>
	<?php
}
$sqltool->close();
?>
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