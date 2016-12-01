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
$row=$sqltool->select('users',"id=$id");
$usedsize=$row[0]['usedsize'];
$totalsize=$row[0]['totalsize'];
?>
<ul id="list">
<?php
$type=$_POST['type'];
switch ($type)
{
	case 0:
	$row=$sqltool->select('userfile',"userid=$id AND parentid=".$_SESSION['parentid'].' AND state=0');
	break;
	case 10:
	case 11:
	case 12:
	case 13:
	case 15:
	case 99:
	$row=$sqltool->select('userfile',"userid=$id AND filetype=$type AND state=0");
	break;
	case 1:
	$row=$sqltool->select('userfile',"userid=$id AND filetype IN (3,4,5,6,7,8,9) AND state=0");
	break;
	case 98:
	$row=$sqltool->select('userfile',"userid=$id AND share=1");
	break;
	case 97:
	$row=$sqltool->select('userfile',"userid=$id AND state=1");
	break;
}
foreach($row as $key => $value)
{
	?>
	<li class="row">
	<div></div>
	<div class="column-name">
	<span></span>
	<span><?php echo $value['filename'] ?></span>
	<span class="download">
	<a href="javascript:void(0);" id="download" onclick="downloadFile('include/lib/download.php?id=<?php echo $value['id']; ?>')" target="_blank" download="<?php echo $value['filename'] ?>">下载</a>
	</span>
	<span></span>
	</div>
	<div class="column-size"><?php 
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
	<div class="column-time"><?php echo $value['modified']; ?></div>
	</li>
	<?php
}
$sqltool->close();
?>
<iframe id="downloadiframe"></iframe>
</ul>