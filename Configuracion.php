<?php
//DB details
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'carta';

//$dbHost = 'c2-52-20-248-222.compute-1.amazonaws.com';
//$dbUsername = 'gskogxdurkyiem';
//$dbPassword = 'a3f7fb0e051e30511d02f5f044f5e9b9bf4a8aecca9a389a67b09593c1a81cb1';
//$dbName = 'd8scb44tq4221u';


//Create connection and select DB
//$conexion = pg_connect("host=localhost dbname=BASE_DE_DATOS user=USUARIO password=CONTRASEÑA");
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
//$db = pg_connect("host=$dbHost dbname=$dbName user=$dbUsername password=$dbPassword");

if ($db->connect_error) {
    die("No hay Conexion con la base de datos: " . $db->connect_error);
} 
?>