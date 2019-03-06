<?php

	set_time_limit(300);
	ini_set('max_execution_time', 300);
	ini_set('memory_limit', '-1');

	@ob_start();
	@session_start();
	@session_cache_expire(180000); 
	
	date_default_timezone_set('America/Sao_Paulo');

	define("HOST", "localhost");
	define("DBNAME", "sheik");
	define("USER", "root");
	define("PASSWORD", "");

class DB{
    private $link;
	
	public function connect(){
		$this->link = new mysqli(HOST, USER, PASSWORD, DBNAME);
		mysqli_set_charset($this->link,"utf8");
        if( mysqli_connect_errno() ){
            echo "FALHA: ", mysqli_connect_error();
            exit();
        }
	}
	
        
    public function __construct(){
	   $this->connect(); 
	}
	
	public function disconnect(){
		mysqli_close( $this->link );
	}
	
	
	public function __destruct(){
		$this->disconnect();
	}
	
	
	public function select($query){	
		error_reporting(0);
		if(!$result = $this->link->query($query)){
			echo("<b>Erro MYSQL</b>:<br>" . mysqli_error($this->link)).'<br><br>';
		} else {
			return $result;		
		}		
	}
	
	
	public function rows($query){	
		//error_reporting(0);
		return mysqli_num_rows($query);
		
	}
	
	
	public function expand($query){	
		return mysqli_fetch_array($query,MYSQLI_BOTH);
	}
	
	
	public function last_id($query){	
		return mysqli_insert_id($this->link);
	}
	

	public function escape($var){
		$result = $this->link->real_escape_string($var);
		return $result;		
	}
	
	

}


?>