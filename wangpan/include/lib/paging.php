<?php
$dir = dirname(__FILE__);
require_once $dir."/sqltool.php";
class paging
{
	private $pagenow=1;
	private $pages=0;
	private $rowcount=0;
	private $pagesize=50;
	private $table;
	
	public function __construct($table,$pagesize=10)
	{
		if($pagesize==0)
			$pagesize=10;
		$this->table=$table;
		$this->pagesize=$pagesize;
		$sqltool=new sqltool();
		//$sqltool->setchar('utf8');
		$this->rowcount=$sqltool->select($table,'1','*','count');
		$this->pages=ceil($this->rowcount/$this->pagesize);
		unset($sqltool);
	}
	
	///////////////////////////////////////////////////////////////////////////////////
	
	public function getdata($where = '1', $field = "*", $fun = '')
	{
		if(!empty($_GET['page']))
		{
			$this->pagenow=$_GET['page'];
		}
		$sqltool=new sqltool();
		//$sqltool->setchar('utf8');
		$start=$this->pagesize*($this->pagenow-1);
		$data=$sqltool->select($this->table,$where.' limit '.$start.','.$this->pagesize,$field = "*", $fun = '');
		unset($sqltool);
		return $data;
	}
	
	///////////////////////////////////////////////////////////////////////////////////
	
	public function showpagination($style)
	{
		echo '<ul class="paging">';
		if($this->pagenow!=1)
		{
			echo '<li class="np"><a href="?page='.($this->pagenow-1).'"><上一页</a></li>';
		}
		switch($style)
		{
			//第一种样式////////////////////////////////////////////////////////////////////
			case 1:
			if($this->pagenow<6)
			{
				for($i=1;$i<12;$i++)
				{
					if($i==$this->pagenow)
					{
						echo '<li class="currentpage"><a>'.$this->pagenow.'</a></li>';
					}
					else
					{
						echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
					}
				}
			}
			elseif($this->pagenow>($this->pages-6))
			{
				for($i=11;$i>=0;$i--)
				{
					if(($this->pages-$i)==$this->pagenow)
					{
						echo '<li class="currentpage"><a>'.$this->pagenow.'</a></li>';
					}
					else
					{
						echo '<li><a href="?page='.($this->pages-$i).'">'.($this->pages-$i).'</a></li>';
					}
				}
			}
			else
			{
				for($i=0;$i<11;$i++)
				{
					if(($this->pagenow+$i-5)==$this->pagenow)
					{
						echo '<li class="currentpage"><a>'.$this->pagenow.'</a></li>';
					}
					else
					{
						echo '<li><a href="?page='.($this->pagenow+$i-5).'">'.($this->pagenow+$i-5).'</a></li>';
					}				
				}
			}
			break;
			
			//第二种样式////////////////////////////////////////////////////////////////////
			
			case 2:
			if($this->pagenow<5)
			{
				for($i=1;$i<$this->pagenow;$i++)
				{
					echo '<li><a href="?page='.($i).'">'.($i).'</a></li>';
				}
			}
			elseif($this->pagenow > ($this->pages-5))
			{
				for($i=4;$i>0;$i--)
				{
					echo '<li><a href="?page='.($this->pagenow-$i).'">'.($this->pagenow-$i).'</a></li>';
				}
			}
			else
			{
				for($i=4;$i>0;$i--)
				{
					echo '<li><a href="?page='.($this->pagenow-$i).'">'.($this->pagenow-$i).'</a></li>';
				}
			}
			echo '<li class="currentpage">'.$this->pagenow.'</li>';
			if($this->pagenow<5)
			{
				for($i=1;$i<5;$i++)
				{
					echo '<li><a href="?page='.($this->pagenow+$i).'">'.($this->pagenow+$i).'</a></li>';
				}
			}
			elseif($this->pagenow > ($this->pages-5))
			{
				for($i=$this->pagenow+1;$i<=$this->pages;$i++)
				{
					echo '<li><a href="?page='.($i).'">'.($i).'</a></li>';
				}
			}
			else
			{
				for($i=1;$i<5;$i++)
				{
					echo '<li><a href="?page='.($this->pagenow+$i).'">'.($this->pagenow+$i).'</a></li>';
				}
			}
			break;
			
			//第三种样式////////////////////////////////////////////////////////////////////
			
			case 3:
			if($this->pagenow==1)
			{
				echo '<li class="snp"><上一页</li>';
			}
			if($this->pagenow==$this->pages)
			{
				echo '<li class="snp">下一页></li>';
			}
			break;
			
			//第四种样式////////////////////////////////////////////////////////////////////
			
			case 4:
			if($this->pagenow==1)
			{
				echo '<li class="snp"><上一页</li>';
			}
			else
			{
				echo '<li><a href="?page=1">1</a></li>';
				if($this->pagenow>5)
					echo '<li><p class="pageellipsis">...</p></li>';
			}
			if($this->pagenow<6)
			{
				for($i=2;$i<$this->pagenow;$i++)
				{
					echo '<li><a href="?page='.($i).'">'.($i).'</a></li>';
				}
			}
			else
			{
				for($i=3;$i>0;$i--)
				{
					echo '<li><a href="?page='.($this->pagenow-$i).'">'.($this->pagenow-$i).'</a></li>';
				}
			}
			echo '<li class="currentpage">'.$this->pagenow.'</li>';
			if($this->pagenow>($this->pages-4))
			{
				for($i=$this->pagenow+1;$i<$this->pages;$i++)
				{
					echo '<li><a href="?page='.($i).'">'.($i).'</a></li>';
				}
			}
			else
			{
				for($i=1;$i<3;$i++)
				{
					echo '<li><a href="?page='.($this->pagenow+$i).'">'.($this->pagenow+$i).'</a></li>';
				}
			}
			if($this->pagenow==$this->pages)
			{
				echo '<li class="snp">下一页></li>';
			}
			else
			{
				if($this->pagenow<$this->pages-3)
					echo '<li><p class="pageellipsis">...</p></li>';
				echo '<li><a href="?page='.$this->pages.'">'.$this->pages.'</a></li>';
			}
			break;
			case 5:
			if($this->pagenow>2)
			{
				echo '<li><a>'.($this->pagenow-2).'</a></li>';
			}
			if($this->pagenow>1)
			{
				echo '<li><a href="?page='.($this->pagenow-1).'">'.($this->pagenow-1).'</a></li>';
			}
			echo '<li class="currentpage">'.$this->pagenow.'</li>';
			if($this->pagenow<$this->pages)
			{
				echo '<li><a href="?page='.($this->pagenow+1).'">'.($this->pagenow+1).'</a></li>';
			}
			if($this->pagenow<$this->pages-1)
			{
				echo '<li><a>'.($this->pagenow+2).'</a></li>';
			}
		}
		if($this->pagenow!=$this->pages)
		{
			echo '<li class="np"><a href="?page='.($this->pagenow+1).'">下一页></a></li>';
		}
		echo '</ul>';		
	}
	public function showpagetotal()
	{
		echo '<span>共<b>'.$this->pages.'</b>页    到第</span><input value="'.$this->pagenow.'">  <span>页</span><a class="butten" href="?page=">确定</a>';
	}
}
?>












