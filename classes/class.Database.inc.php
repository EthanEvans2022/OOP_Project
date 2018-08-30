<?php
class Database{
    private $_connect;
    private static $_instance;
    
    public static function getInstance(){
        if (!self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct(){
        $this->_connect = new mysqli('localhost','root','password','note_manager_db');
        if(mysqli_connect_error()){
            trigger_error ('Failed to connect to MySQL: '. mysql_connect_error(),E_USER_ERROR);   
        }
    }
    
    private function __clone(){}
    
    public function getConnection(){
        return $this->_connect;
    }
}
?>