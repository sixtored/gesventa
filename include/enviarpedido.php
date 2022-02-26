<?php
require 'session.php';
require 'basededatos.php' ;
require 'cliente_sitio.php' ;
//include '../Configuracion.php';
//include '../La-carta.php';
//require 'class.phpmailer.php';
//require 'class.smtp.php';		

//$cart = new Cart;

// redirect to home if cart is empty
//if($cart->total_items() <= 0){
//    header("Location: index.php");
//}
if(!isset($_POST['enviar'])){
    header("Location:../index.php");
}


	//if (empty($_SESSION['sessCustomerID'])) {
		
		$email		= strtolower($_POST['email']) ;
		
			$base = new BasedeDatos() ;
			$cli = new Cliente_sitio($base) ;

			$cliente = $cli->get_one_cliente($email) ;
			//echo $user->row_cnt ;
			//echo '<br>'.var_dump($usuario) ;
			
			if ($cli->row_cnt>0) {
				// si existe cliente traer ID
					
				$_SESSION['sessCustomerID'] = $cli->id ;
				// GUARDAR PEDIDO
				header("Location:../AccionCarta.php?action=placeOrder") ;

			} else {
				
				header("Location:../pedir.php?emailnoexiste") ;	

			} 
//	}


?>