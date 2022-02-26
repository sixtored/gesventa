<?php
require("session.php") ;
require("funciones.php") ;

if (isset($_POST)) {
	if (isset($_SESSION['captcha'])) {
		
		$ape 		= strtoupper($_POST['apellido']) ;
		$nom 		= strtoupper($_POST['nombre']) ;
		$email		= $_POST['email'] ;
		$consul		= $_POST['consulta'] ;
		$captcha 	= $_POST['captcha'] ;

		$control 	= $_SESSION['captcha'] ;

		if ($control == $captcha){
			// guardar los datos en la BBDD
			//echo 'guardar datos en la BBDD' ;
			$con = conectarbd() ;
			global $conexion ;

			$query 	= 'SELECT 1 FROM consultas LIMIT 1' ;
			$result = mysqli_query($conexion, $query) ;
			if (!$result) {
  			// si no existe la tabla la creamos..
		    $query = 'CREATE TABLE consultas (id_consulta int(5) ZEROFILL NOT NULL AUTO_INCREMENT, apellido varchar(30) NOT NULL, nombre varchar(30) NOT NULL, email varchar(60) NOT NULL, consulta text NOT NULL, fecha date NOT NULL, PRIMARY KEY(id_consulta), KEY (nombre)) ENGINE = InnoDB CHARSET=latin1 COLLATE latin1_spanish_ci';
		    $resul = mysqli_query($conexion, $query) ;
		   }	

		   $fecha = date('Ymd') ;
			$query = "INSERT INTO consultas (id_consulta, apellido, nombre, email, consulta, fecha) VALUES (DEFAULT, '$ape', '$nom', '$email', '$consul','$fecha')" ;
			$sqlres = mysqli_query($conexion, $query) ;
			if (!$sqlres) {
				header("Location:..\unidad5.php?noguardar") ;
			} else {	

			header("Location:..\unidad5.php?guardar") ;
			}
			cerrarconexion() ;

		} else {
			//echo 'Verificacion incorrecta..' ;
			header("Location:..\unidad5.php?error") ;
		}
	} else {
		//echo 'No existe el captcha' ;
		header("Location:..\unidad5.php") ;
	}

} else {
	//echo 'No existe el POST' ;
	header("Location:..\unidad5.php") ;
}

?>