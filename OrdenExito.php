<?php
require 'include/basededatos.php' ;
require 'include/cliente_sitio.php' ;
require 'include/pedido_sitio.php';
require 'include/pedido_det_sitio.php';
require 'include/class.phpmailer.php';
require 'include/class.smtp.php';   

if(!isset($_REQUEST['id'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Cart - PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

     <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">

         <!--Bootstrap core CSS -->
    <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


     <!-- Favicons -->
    
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

     <script src="libs/jquery-3.5.1.min.js"></script> 
    <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    -->
   <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!--
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->
    <style>
    .container{padding: 10px;}
    input[type="number"]{width: 30%;}
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("AccionCarta.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>
</head>
<body>
<div class="container">
<div class="panel panel-default">
<div class="panel-heading"> 

<div class="container">
  <header class="blog-header py-3">

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
  </nav>
</header>

<div class="panel-body">

    <h1>Estado de su Pedido</h1>
<?php 
$ordenid = $_GET['id'] ;

$base = new BasedeDatos() ;

$orden = new Pedido_sitio($base) ;
$miorden = $orden->get_one_orden($ordenid) ;
//$orden->$customer_id ;
//$orden->$total_price ;
//$orden->$status  ;
$orden_det = New pedido_det_sitio($base) ;
$miorden_det = $orden_det->get_one_orden_articulos($ordenid) ;

$cli = new Cliente_sitio($base) ;
$cliente = $cli->get_one_cliente_id($orden->customer_id) ;

//echo var_dump($miorden_det) ;
$detalle = "" ;
$det_articulos = "" ;
$det_articulos = '
<table align="center" border="1">
        <thead>
        <tr class="titulos">
            <th>Código</th>
            <th>Producto</th>
            <th>Cant</th>
            <th>Precio</th>
            <th>importe</th>
        </tr>
        </thead>
        <tbody>
' ;

for ($i=0;$i<count($miorden_det);$i++){
            $det_articulos = $det_articulos .'<tr>
                    <td>'.$miorden_det[$i]['codigo'].'</td>
                    <td>'.$miorden_det[$i]['name'].'</td>
                    <td>'.$miorden_det[$i]['quantity'].'</td>
                    <td>'.$miorden_det[$i]['price'].'</td>
                    <td>'.$miorden_det[$i]['importe'].'</td></tr>' ;
$detalle = $detalle .'%5B'. $miorden_det[$i]['codigo'].'%5D%5B'.$miorden_det[$i]['name'].'%5D%5B'.$miorden_det[$i]['quantity'].'%5D%5B'.$miorden_det[$i]['importe'].'%5D%2B';
                    
            
        }

$det_articulos = $det_articulos ."
</tbody>
<tfoot>
    <tr>
        
         <td></td><td><b>Total pedido $</b></td><td></td><td></td><td>$orden->total_price</td> 
        
    </tr>    
</tfoot>" ;
$detalle = $detalle .'%2A%2A%2A%2A%2A%5B%20Total Pedido '.'%24'.$orden->total_price.'%5D%2A%2A%2A%2A%2A';

//echo '<a href="https://api.whatsapp.com/send?phone=5493843456089&text=Hola%2C%20Envio%20detalle%20de%20pedido%20soy%2C%20'.$cli->name.'%20enviar%20'.$detalle.'" class="btn btn-success">'.'Pedir</a>' ;

//https://api.whatsapp.com/send?phone=5493843456089&text=Su%20pedido%20CODGIO%20ARTICULO%20DESCRIPCION%20ESTO%20ES%20UNA%20PRUEBA%20DE%20ENV//IO%20DE%20MENSAJES%20XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

?>


    <p>Su pedido ha sido enviado exitosamente. La ID del pedido es #<?php echo $ordenid; ?></p>
    <?php echo $det_articulos ; 

    //header("Location: https://api.whatsapp.com/send?phone=5493843456089&text=Hola%2C%20Envio%20detalle%20de%20pedido%20soy%2C%20".$cli->name."%20enviar%20".$detalle) ;
    echo '<a href="https://api.whatsapp.com/send?phone=5493843456089&text=Hola%2C%20Envio%20detalle%20de%20pedido%20soy%2C%20'.$cli->name.'%20enviar%20'.$detalle.'" class="btn btn-success">'.'enviar pedido al whatsapp</a>' ;

///////////////

$mail = new PHPMailer();
        
 $mail->Mailer = "smtp";
 $mail->SMTPAuth = true;
    /*      
            //HOTMAIL   
            $mail->SMTPSecure = "tls"; // sets the prefix to the servier
            $mail->Host = "smtp.live.com"; // sets HOTMAIL as the SMTP server
            $mail->Port = 25; // alternate is "26" - set the SMTP port for the HOTMAIL server
            $mail->Username = "usuario@hotmail.com"; // HOTMAIL username
            $mail->Password = "password"; // HOTMAIL password       
    */
    /*      
            //GMAIL 
            $mail->SMTPSecure = "tls"; 
            $mail->Host = "smtp.gmail.com"; 
            $mail->Port = 587; // si seteamos SMTPSecure = "ssl"; tenemos que setear Port = 465;
            $mail->Username = "usuario@gmail.com"; // GMAIL username
            $mail->Password = "password"; // GMAIL password     
    */
            //Cualquier otro servidor   
            $mail->Host = "sd-1019888-h00003.ferozo.net";
            $mail->Username="info@sixtored.com.ar";
            $mail->Password = "St240389";
            $mail->Port = 587 ;
            
            $mail->IsHTML(true);
            $mail->From = "info@sixtored.com.ar";
            $mail->FromName =$cli->name;
            $mail->AddAddress("sixtored@hotmail.com");
            $mail->AddAddress("sixtod@gmail.com");
            $mail->Subject = "NUEVO PEDIDO DESDE GESVENTA";
            $mail->Body = "<p>".$cli->name." Envio detalle del pedido : </p><p>".$det_articulos."</p><p>Email: ".$cli->email."</p><p>Direccion : ".$cli->address."</p><p> Celular :".$cli->phone;
            $exito=$mail->send();
        
            




////////////////    







    ?>
</div>

<?php 
if ($exito){     
                echo "<h3>Gracias nos pondremos en contacto con uds.  </h3>";
            }
            else{
                echo "<h2>Error al enviar el mensaje. Por favor intentelo nuevamente.  </h2>" ;
            }
?>
</div>

</body>

</html>