<?php
class Pedido_sitio {
	//creamos la variable de clase db
	private $db;
	public $row_cnt 	= 0;
	public $id ;
	public $customer_id = 0 ;
	public $total_price = 0.00;
	public $created ;
	public $modified ; 
	public $status = 0 ;
	
	
	//creamos el constructor
	public function __construct($base){
		$this->db = $base;
		if ($this->db) {
			$this->createOrden() ;
		}
	}

	// public function __destruct() {
	// 	$this->db = null;
	// }

	//creamos una propiedad para insertar productos
	public function insertOrden($customer_id,$total_price){
	//ejecutamos la función enviarQuery declarada en BasedeDatosmysqli		
		$respuesta = $this->db->enviarQuery("INSERT INTO orden values (DEFAULT, $customer_id, $total_price, DEFAULT, DEFAULT, '1') ");
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
	
	
	public function getorden(){
		//echo $this->db->error; 
		$respuesta = $this->db->enviarQuery("SELECT * FROM orden");
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

	public function get_one_orden($id){
		//echo $this->db->error; 
		$respuesta = $this->db->enviarQuery("SELECT * FROM orden WHERE id = ".$id);
		$this->row_cnt = $this->db->affectedrows ;
		if (!$respuesta and $this->db->error!=''){
			echo $this->db->error; 
			return false ;
		}
			else {
				//$this->row_cnt = count($respuesta) ;
				$this->id = $respuesta[0]['id'] ;
				$this->customer_id = $respuesta[0]['customer_id'] ;
				$this->total_price = $respuesta[0]['total_price'] ;
				$this->created = $respuesta[0]['created'] ;
				$this->modified = $respuesta[0]['modified'] ;
				$this->status = $respuesta[0]['status'] ;
				return $respuesta ;
			}
	}
	

	
	
	

	private function createOrden() {

		$query = 'SELECT 1 FROM orden LIMIT 1' ;
		$result = $this->db->enviarQuery($query);

		if (!$result) {
		// si no existe la tabla Productos la creamos..
		$query = "CREATE TABLE IF NOT EXISTS orden (
	          id int(11) NOT NULL AUTO_INCREMENT,
	          customer_id int(11)  NOT NULL,
	          total_price float(10,2) NOT NULL,
	          created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	          modified TIMESTAMP DEFAULT ON UPDATE CURRENT_TIMESTAMP,
	          status enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
	          PRIMARY KEY (id), KEY (customer_id)
	        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1" ;

	   	 $result = $this->db->enviarquery($query) ;

	   	 return true ;
		}	

	}


}
?>