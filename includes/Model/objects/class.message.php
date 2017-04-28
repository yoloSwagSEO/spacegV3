<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `message` (
	`messageid` int(11) NOT NULL auto_increment,
	`message_owner` INT NOT NULL,
	`message_sender` INT NOT NULL,
	`message_time` INT NOT NULL,
	`message_type` INT NOT NULL,
	`message_from` VARCHAR(255) NOT NULL,
	`message_subject` TEXT NOT NULL,
	`message_text` TEXT NOT NULL,
	`read` INT NOT NULL, PRIMARY KEY  (`messageid`)) ENGINE=MyISAM;
*/

/**
* <b>message</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.2 / PHP5.1 MYSQL
* @see http://www.phpobjectgenerator.com/plog/tutorials/45/pdo-mysql
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5.1&wrapper=pdo&pdoDriver=mysql&objectName=message&attributeList=array+%28%0A++0+%3D%3E+%27message_owner%27%2C%0A++1+%3D%3E+%27message_sender%27%2C%0A++2+%3D%3E+%27message_time%27%2C%0A++3+%3D%3E+%27message_type%27%2C%0A++4+%3D%3E+%27message_from%27%2C%0A++5+%3D%3E+%27message_subject%27%2C%0A++6+%3D%3E+%27message_text%27%2C%0A++7+%3D%3E+%27read%27%2C%0A%29&typeList=array%2B%2528%250A%2B%2B0%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B1%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B2%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B3%2B%253D%253E%2B%2527INT%2527%252C%250A%2B%2B4%2B%253D%253E%2B%2527VARCHAR%2528255%2529%2527%252C%250A%2B%2B5%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B6%2B%253D%253E%2B%2527TEXT%2527%252C%250A%2B%2B7%2B%253D%253E%2B%2527INT%2527%252C%250A%2529&classList=array+%28%0A++0+%3D%3E+%27%27%2C%0A++1+%3D%3E+%27%27%2C%0A++2+%3D%3E+%27%27%2C%0A++3+%3D%3E+%27%27%2C%0A++4+%3D%3E+%27%27%2C%0A++5+%3D%3E+%27%27%2C%0A++6+%3D%3E+%27%27%2C%0A++7+%3D%3E+%27%27%2C%0A%29
*/
include_once(XGP_ROOT.$GLOBALS['configuration']['baseclass_path'].'class.pog_base.php');
class messageModel extends POG_Base
{
	public $messageId = '';
	public $message_owner;
	public $message_sender;
	public $message_time;
	public $message_type;
	public $message_from;
	public $message_subject;
	public $message_text;
	public $read;
	
	public $pog_attribute_type = array(
		"messageId" => array('db_attributes' => array("NUMERIC", "INT")),
		"message_owner" => array('db_attributes' => array("NUMERIC", "INT")),
		"message_sender" => array('db_attributes' => array("NUMERIC", "INT")),
		"message_time" => array('db_attributes' => array("NUMERIC", "INT")),
		"message_type" => array('db_attributes' => array("NUMERIC", "INT")),
		"message_from" => array('db_attributes' => array("TEXT", "VARCHAR", "255")),
		"message_subject" => array('db_attributes' => array("TEXT", "TEXT")),
		"message_text" => array('db_attributes' => array("TEXT", "TEXT")),
		"read" => array('db_attributes' => array("NUMERIC", "INT")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function messageModel($message_owner='', $message_sender='', $message_time='', $message_type='', $message_from='', $message_subject='', $message_text='', $read='')
	{
		$this->message_owner = $message_owner;
		$this->message_sender = $message_sender;
		$this->message_time = $message_time;
		$this->message_type = $message_type;
		$this->message_from = $message_from;
		$this->message_subject = $message_subject;
		$this->message_text = $message_text;
		$this->read = $read;
	}
	
	
	/**
	* Gets object from database
	* @param integer $messageId 
	* @return object $message
	*/
	function Get($messageId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `xgp_message` where `messageid`='".intval($messageId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->messageId = $row['messageid'];
			$this->message_owner = $this->Unescape($row['message_owner']);
			$this->message_sender = $this->Unescape($row['message_sender']);
			$this->message_time = $this->Unescape($row['message_time']);
			$this->message_type = $this->Unescape($row['message_type']);
			$this->message_from = $this->Unescape($row['message_from']);
			$this->message_subject = $this->Unescape($row['message_subject']);
			$this->message_text = $this->Unescape($row['message_text']);
			$this->read = $this->Unescape($row['read']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $messageList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `xgp_messages` ";
		$messageList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "messageid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$message = new $thisObjectName();
			$message->messageId = $row['messageid'];
			$message->message_owner = $this->Unescape($row['message_owner']);
			$message->message_sender = $this->Unescape($row['message_sender']);
			$message->message_time = $this->Unescape($row['message_time']);
			$message->message_type = $this->Unescape($row['message_type']);
			$message->message_from = $this->Unescape($row['message_from']);
			$message->message_subject = $this->Unescape($row['message_subject']);
			$message->message_text = $this->Unescape($row['message_text']);
			$message->read = $this->Unescape($row['read']);
			$messageList[] = $message;
		}
		return $messageList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $messageId
	*/
	function Save()
	{
		$connection = Database::Connect();
		//___d($connection);
		$rows = 0;
		if ($this->messageId!=''){
			$this->pog_query = "select `messageid` from `xgp_messages` where `messageid`='".$this->messageId."' LIMIT 1";
			$rows = Database::Query($this->pog_query, $connection);
		}
		if ($rows > 0)
		{
			$this->pog_query = "update `xgp_messages` set 
			`message_owner`='".$this->Escape($this->message_owner)."', 
			`message_sender`='".$this->Escape($this->message_sender)."', 
			`message_time`='".$this->Escape($this->message_time)."', 
			`message_type`='".$this->Escape($this->message_type)."', 
			`message_from`='".$this->Escape($this->message_from)."', 
			`message_subject`='".$this->Escape($this->message_subject)."', 
			`message_text`='".$this->Escape($this->message_text)."', 
			`read`='".$this->Escape($this->read)."' where `messageid`='".$this->messageId."'";
		}
		else
		{
			$this->pog_query = "insert into `xgp_messages` (`message_owner`, `message_sender`, `message_time`, `message_type`, `message_from`, `message_subject`, `message_text`, `read` ) values (
			'".$this->Escape($this->message_owner)."', 
			'".$this->Escape($this->message_sender)."', 
			'".$this->Escape($this->message_time)."', 
			'".$this->Escape($this->message_type)."', 
			'".$this->Escape($this->message_from)."', 
			'".$this->Escape($this->message_subject)."', 
			'".$this->Escape($this->message_text)."', 
			'".$this->Escape($this->read)."' )";
		}
		
		echo '<pre>'.$this->pog_query.'</pre>';
		$insertId = Database::InsertOrUpdate($this->pog_query);
		//$connection->query($this->pog_query);
		if ($this->messageId == "")
		{
			$this->messageId = $insertId;
		}
		return $this->messageId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $messageId
	*/
	function SaveNew()
	{
		$this->messageId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `xgp_messages` where `messageid`='".$this->messageId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `xgp_messages` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}
?>