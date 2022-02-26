<?php
class Cliente_sitio {
	//creamos la variable de clase db
	private $db;
	public $row_cnt 	= 0;
	public $id ;
	public $name 		= '' ;
	public $email 		= '' ;
	public $phone 		= '' ;
	public $address 		= '' ;
	public $created ;
	public $modified ; 
	public $status = 0 ;
	
	
	//creamos el constructor
	public function __construct($base){
		$this->db = $base;
		if ($this->db) {
			$this->createCliente() ;
		}
	}

	// public function __destruct() {
	// 	$this->db = null;
	// }

	//creamos una propiedad para insertar productos
	public function insertCliente($name,$email,$phone,$address){
	//ejecutamos la función enviarQuery declarada en BasedeDatosmysqli		
		$respuesta = $this->db->enviarQuery("INSERT INTO clientes values (DEFAULT, '$name', '$email', '$phone', '$address', DEFAULT, DEFAULT, '1') ");
		$this->row_cnt = $this->db->affectedrows ;	
		if (!$respuesta){
			echo $this->db->error; 
			return false;
		}
		else{
			$this->row_cnt = $this->db->affectedrows ;
			$this->id = $respuesta ;
			return $respuesta;
		}
	}
	
	
	public function getclientes(){
		//echo $this->db->error; 
		$respuesta = $this->db->enviarQuery("SELECT * FROM clientes");
		$this->row_cnt = $this->db->affectedrows ;
		if (!$respuesta and $this->db->error!=''){
			echo $this->db->error; 
			return false;
		}
		else{
			if (!$respuesta){
				return false;
			}
			else {
				return $respuesta;
			}
		}
	}

	public function get_one_cliente($email){
		//echo $this->db->error; 
		$respuesta = $this->db->enviarQuery("SELECT * FROM clientes WHERE email = '$email'");
		$this->row_cnt = $this->db->affectedrows ;
		if (!$respuesta and $this->db->error!=''){
			echo $this->db->error; 
			return false ;
		}
			else {
				//$this->row_cnt = count($respuesta) ;
				$this->name = $respuesta[0]['name'] ;
				$this->phone = $respuesta[0]['phone'] ;
				$this->email = $respuesta[0]['email'] ;
				$this->address = $respuesta[0]['address'] ;
				$this->created = $respuesta[0]['created'] ;
				$this->modified = $respuesta[0]['modified'] ;
				$this->status = $respuesta[0]['status'] ;
				$this->id = $respuesta[0]['id'] ;
				return $respuesta ;
			}
	}
	

	public function get_one_cliente_id($id){
		//echo $this->db->error; 
		$respuesta = $this->db->enviarQuery("SELECT * FROM clientes WHERE id = ".$id);
		$this->row_cnt = $this->db->affectedrows ;
		if (!$respuesta and $this->db->error!=''){
			echo $this->db->error; 
			return false ;
		}
			else {
				//$this->row_cnt = count($respuesta) ;
				$this->name = $respuesta[0]['name'] ;
				$this->phone = $respuesta[0]['phone'] ;
				$this->email = $respuesta[0]['email'] ;
				$this->address = $respuesta[0]['address'] ;
				$this->created = $respuesta[0]['created'] ;
				$this->modified = $respuesta[0]['modified'] ;
				$this->status = $respuesta[0]['status'] ;
				$this->id = $respuesta[0]['id'] ;
				return $respuesta ;
			}
	}
	
	
	

	private function createcliente() {

		$query = 'SELECT 1 FROM clientes LIMIT 1' ;
		$result = $this->db->enviarQuery($query);

		if (!$result) {
		// si no existe la tabla Productos la creamos..
		$query = "CREATE TABLE IF NOT EXISTS clientes (
	          id int(11) NOT NULL AUTO_INCREMENT,
	          name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
	          email VARCHAR(100) COLLATE utf8_unicode_ci NOT NULL,
	          phone VARCHAR(30) COLLATE utf8_unicode_ci NOT NULL,
	          address text COLLATE utf8_unicode_ci,
	          created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	          modified TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP,
	          status enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
	          PRIMARY KEY (id), UNIQUE KEY (email)
	        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1" ;

	   	 $result = $this->db->enviarquery($query) ;

	   	 return true ;
		}	

	}


}
?>