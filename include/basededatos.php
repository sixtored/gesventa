<?php
class BasedeDatos{
	
	public  $conexion;

	private $servidor  = "localhost";
    private $base      = "carta";
    private $usuario   = "root";
    private $password  = "";

	public $error;
	public $affectedrows ;
	//public $numrows ;
	
	
	public function __construct(){
		if (!$this->_connect($this->servidor,$this->usuario,$this->password,$this->base)){
			$this->error = $this->conexion->connect_error;
		} else {
			return false ;
		}
		
	}
	
	// descructor para cerrar la conexión
	public function __destruct(){
		$this->conexion->close();
	}
	
	
	public  function _connect($servidor,$usuario,$password,$base){
		$this->conexion = new mysqli($servidor,$usuario,$password,$base);
		if (!$this->conexion->connect_errno){
			$this->error = $this->conexion->connect_error;
			return false;
		}
		
	}

	
	
	public function enviarQuery($query){
		
		$tipo = strtoupper(substr($query,0,6));
		
		
		switch ($tipo){
			case 'SELECT':
				$resultado = $this->conexion->query($query);
				$this->affectedrows = $this->conexion->affected_rows ;
				//$this->numrows = $this->conexion->num_rows ;
				if (!$resultado){
					//$this->error = $this->conexion->error;
					//$this->affectedrows = -1 ;
					return false;
				}
				else{
						$array_resultado=array();
						
						while ($fila = $resultado->fetch_assoc()){
							$array_resultado[] = $fila;
						}
						return $array_resultado;
					
				}
				break;
			case 'INSERT':
				$resultado = $this->conexion->query($query);
				$this->affectedrows = $this->conexion->affected_rows ;
				if (!$resultado){
					$this->error = $this->conexion->error;
					$this->affectedrows = -1 ;
					return false;
				}
				else{
					
					return $this->conexion->insert_id ;
				}
				break;


			case 'CREATE':
			$resultado = $this->conexion->query($query);
			$this->affectedrows = $this->conexion->affected_rows ;
				if (!$resultado){
					$this->error = $this->conexion->error;
					return false;
				} else {
					return true ;
				}
			break ;	
			case 'UPDATE':			
			case 'DELETE':
				$resultado = $this->conexion->query($query);
				$this->affectedrows = $this->conexion->affected_rows ;
				if (!$resultado){
					$this->error = $this->conexion->error;
					return false;
				}
				else{
					
					return $this->conexion->affected_rows;
				}		
				break;

			default:
				$this->error = "Tipo de consulta no permitida";
		}
	}
	
}
?>