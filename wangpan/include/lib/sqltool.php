<?php
$dir = dirname(__FILE__);
require_once $dir."/../../config.php";
class sqltool
{
	private $conn;		//���ݿ�����
	public $selecttime;		//��ѯʱ�䣨װ���õĹ��ܣ�
	
	//���캯��������һ�����ݿ�����
	public function __construct($dbname=DB_NAME,$dbhost=DB_HOST,$dbuser=DB_USER,$dbpassword=DB_PASSWORD,$dbport=DB_PORT)
	{
		$starttime=microtime(1);
		$this->conn=new mysqli($dbhost,$dbuser,$dbpassword,$dbname,$dbport);
		if($this->conn->connect_error)
		{
			die('Connect Error('.$this->conn->connect_errno.')'.$this->conn->connect_error);
		}
		$this->selecttime=microtime(1)-$starttime;
		$this->setchar(DB_CHARSET);//Ĭ������utf-8
	}
	
	//�������ݿ���ַ�����
	public function setchar($char)
    {
		$starttime=microtime(1);
        if (!$this->conn->set_charset($char)) 
		{
		die('Error loading character set $char:'.$this->conn->error);
		}
		$this->selecttime=microtime(1)-$starttime;
    }
	
	//����һ����ѯ��䣬���ز�ѯ�Ľ����
	public function executedql($sql)
	{
		$starttime=microtime(1);
		$res=$this->conn->query($sql) or die($this->conn->error);
		$this->selecttime=microtime(1)-$starttime;
		return $res;
	}
	
	//����һ�����ݲ�����䣬���ر��޸ĵ�������-1Ϊʧ��
	public function executedml($sql)
	{
		$starttime=microtime(1);
		$row=$this->conn->query($sql) or die($this->conn->error);
		$this->selecttime=microtime(1)-$starttime;
		if($row)
		{
			return $this->conn->affected_rows;
		}
		else
		{
			return -1;
		}		
		
	}
	
	//��ѯ���ݿ���������������������ȣ�����һ���������
	public function select($table, $where = '1', $field = "*", $fun = '')
    {
		$starttime=microtime(1);
        $rarr = array();
        if (empty($fun)) 
		{
            $sqlStr = "select $field from $table where $where";
            $rt = $this->conn->query($sqlStr) or die($this->conn->error);
            while ($rt && $arr = $rt->fetch_assoc()) 
			{
                array_push($rarr, $arr);
            }
        } 
		else 
		{
            $sqlStr = "select $fun($field) as rt from $table where $where";
            $rt = $this->conn->query($sqlStr) or die($this->conn->error);
            if ($rt) 
			{
                $arr = $rt->fetch_assoc();
                $rarr = $arr['rt'];
            }
			else 
			{
                $rarr = '';
            }
        }
		$this->selecttime=microtime(1)-$starttime;
		$rt->free();
        return $rarr;
	}
	
	//�������ݿ⣬����������µ�ֵ�������޸ĵ�������-1Ϊʧ��
	public function update($table, $where, $data)
    {
		$starttime=microtime(1);
        $ddata = '';
        if (is_array($data))
			{
            while (list($k, $v) = each($data))
				{
					if (empty($ddata))
					{
						$ddata = "$k='$v'";
					}
					else 
					{
						$ddata .= ",$k='$v'";
					}
				}
        } 
		else 
		{
            $ddata = $data;
        }
        $sqlStr = "update $table set $ddata where $where";
        $row=$this->conn->query($sqlStr) or die($this->conn->error);
		$this->selecttime=microtime(1)-$starttime;
		if($row)
		{
			return $this->conn->affected_rows;
		}
		else
		{
			return -1;
		}		
    }
	
	//����һ����¼�����������Ҫ��������ݣ����ز����¼��id��-1Ϊʧ��
	public function insert($table,$data)
    {
		$starttime=microtime(1);
        $field = '';
        $idata = '';
        if (is_array($data) && array_keys($data) != range(0, count($data) - 1))
		{
            //��������
			while (list($k, $v) = each($data))
			{
                if (empty($field))
					{
						$field = "$k";
						$idata = "'$v'";
					} 
					else
					{
						$field .= ",$k";
						$idata .= ",'$v'";
					}
				}
				$sqlStr = "insert into $table($field) values ($idata)";
		}
		else
		{
            //�ǹ������� ���ַ���
            if (is_array($data)) 
			{
                while (list($k, $v) = each($data)) 
				{
                    if (empty($idata)) 
					{
                        $idata = "'$v'";
                    } 
					else 
					{
                        $idata .= ",'$v'";
                    }
                }

            } 
			else 
			{
                //Ϊ�ַ���
                $idata = $data;
            }
            $sqlStr = "insert into $table values ($idata)";
        }
		$row=$this->conn->query($sqlStr) or die($this->conn->error);
		$this->selecttime=microtime(1)-$starttime;
        if($row)
        {
            return $this->conn->insert_id;
        }
        return 0;
    }
	
	//ɾ����¼�����������Ҫɾ���ļ�¼����������ɾ����������-1Ϊʧ��
    public function delete($table, $where)
    {
		$starttime=microtime(1);
        $sqlStr = "delete from $table where $where";
		$row=$this->conn->query($sqlStr) or die($this->conn->error);
		$this->selecttime=microtime(1)-$starttime;
        if($row)
		{
			return $this->conn->affected_rows;
		}
		else
		{
			return -1;
		}		
    }
	
	//��ѯ���ݿ����б�����һ������
	public function showtables()
	{
		$starttime=microtime(1);
		$rarr = array();
		$sqlStr = "show tables";
		$rt = $this->conn->query($sqlStr) or die($this->conn->error);
        while ($rt && $arr = $rt->fetch_assoc())
		{
            array_push($rarr, $arr);
        }
		$this->selecttime=microtime(1)-$starttime;
		$rt->free();
        return $rarr;
	}

	//��ʼһ������
	public function begin()
	{
		$this->conn->autocommit(FALSE);
	}
	
	//�ύһ������
	public function commit()
	{
		return $this->conn->commit();
	}
	
	//���˵�ǰ����
	public function rollback()
	{
		return $this->conn->rollback();
	}
	
	//�رյ�ǰ����
    public function close()
    {
		return $this->conn->close();
    }
}