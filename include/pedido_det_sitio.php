<?php
class Pedido_det_sitio {
	//creamos la variable de clase db
	private $db;
	public $row_cnt 	= 0;
	public $id ;
	public $order_id = 0 ;
	public $product_id = 0;
	public $quantity ;
	public $codigo = "" ; 
	
	
	//creamos el constructor
	public function __construct($base){
		$this->db = $base;
		if ($this->db) {
			$this->createOrden_articulos() ;
		}
	}

	// public function __destruct() {
	// 	$this->db = null;
	// }

	
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

	public function get_one_orden_articulos($id){
		//echo $this->db->error; 
		//SELECT mp.codigo, mp.name, mp.description, oa.quantity, mp.price, oa.quantity*mp.price as importe FROM orden_articulos oa INNER JOIN mis_productos mp ON mp.id = oa.product_id WHERE oa.order_id = 6
		$respuesta = $this->db->enviarQuery("SELECT mp.codigo, mp.name, mp.description, oa.quantity, mp.price, oa.quantity*mp.price as importe FROM orden_articulos oa INNER JOIN mis_productos mp ON mp.id = oa.product_id WHERE oa.order_id =".$id);
		$this->row_cnt = $this->db->affectedrows ;
		if (!$respuesta and $this->db->error!=''){
			echo $this->db->error; 
			return false ;
		}
			else {
				//$this->row_cnt = count($respuesta) ;
				return $respuesta ;
			}
	}
	

	
	
	

	private function createOrden_articulos() {

		$query = 'SELECT 1 FROM orden_articulos LIMIT 1' ;
		$result = $this->db->enviarQuery($query);

		if (!$result) {
		// si no existe la tabla Productos la creamos..
		$query = "CREATE TABLE IF NOT EXISTS orden_articulos (
	          id int(11) NOT NULL AUTO_INCREMENT,
	          order_id int(11)  NOT NULL,
	          product_id int(11)  NOT NULL,
	          quantity int(5) NOT NULL,
	          PRIMARY KEY (id), KEY (order_id)
	        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1" ;

	   	 $result = $this->db->enviarquery($query) ;

	   	 return true ;
		}	

	}


}
?>