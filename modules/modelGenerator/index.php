<?php

class MysqlConnect
{
    private $host; // Server Name
    private $user; // User Name
    private $password; // Password
    private $database; // DataBase Name
    private $idConnexion; // Connexion id
    private $isConnected; // True or False


    public function __construct()
    {
        $this->host = "";
        $this->user = "";
        $this->password = "";
        $this->database = "";
        $this->idConnexion = FALSE;
        $this->isConnected = FALSE;
        $this->listdbArray = array();
    }


    public function doConnect()
    {
        if ($this->isConnected == FALSE) {
            $this->idConnexion = mysqli_connect($this->getHost(),$this->getUser(),$this->getPassword(),$this->getDatabase());
            if (!$this->idConnexion) {
                $this->isConnected = FALSE;
                return $this->isConnected;
            }else{
                $this->isConnected = TRUE;
            }
        }
        return $this->isConnected;
    }

    public function get_tables()
    {
        $tableList = array();
        $res = mysqli_query($this->idConnexion,"SHOW TABLES");
        while($cRow = mysqli_fetch_array($res))
        {
            $tableList[] = $cRow[0];
        }
        return $tableList;
    }

    public function get_fields(string $table):array {
        $sql = 'SHOW COLUMNS FROM '.$table;
        $res = mysqli_query($this->idConnexion,$sql);

        while($row = $res->fetch_assoc()){
            $columns[] = $row['Field'];
        }
        return $columns;
    }
    public function getHost():string{
        return $this->host; // Server Name
    }
    public function getUser():string{
        return $this->user;
    }
    public function getPassword():string{
        return $this->password;
    }
    public function getDatabase():string{
        return $this->database;
    }

    public function setHost(string $host):MysqlConnect {
        $this->host = $host;
        return $this;
    }
    public function setUser(string $user):MysqlConnect {
        $this->user = $user;
        return $this;
    }
    public function setPassword(string $password):MysqlConnect {
        $this->password = $password;
        return $this;
    }
    public function setDatabase(string $database):MysqlConnect {
        $this->database = $database;
        return $this;
    }
  
}

$test = new MysqlConnect();
$test->setDatabase('spaceg')
     ->setUser('spaceg')
     ->setPassword('lolita1122')
     ->setHost('localhost')
     ->doConnect();

foreach($test->get_tables() as $table){
    echo $table.'<br />';
    echo '<pre>';
    print_r($test->get_fields($table));
    echo '</pre>';
}
