<?php
// initializ shopping cart class
include 'Configuracion.php';
include 'La-carta.php';
include 'include/basededatos.php';
include 'include/cliente_sitio.php';


$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: index.php");
}

//$_SESSION['sessCustomerID']=0 ;

// set customer ID in session
if (!empty($_SESSION['sessCustomerID'])) {

    // get customer details by session customer ID
    //$query = $db->query("SELECT * FROM clientes WHERE id = ".$_SESSION['sessCustomerID']);
    //$custRow = $query->fetch_assoc();
    $base = new BasedeDatos() ;
    $cli = new cliente_sitio($base) ;

    $cliente = $cli->get_one_cliente_id($_SESSION['sessCustomerID']) ;
            //echo $user->row_cnt ;
            //echo '<br>'.var_dump($usuario) ;
    //if ($cli->row_cnt>0) {

    //}    

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
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="VerCarta.php">Ver carrito <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
         <!-- <a class="nav-link" href="pedir.php">Comprar</a> -->
        </li>
       
      </ul>
    </div>
  </nav>
</header>

<div class="panel-body">


    <h1>PRODUCTOS A PEDIR</h1>
    💪
    <table class="table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Sub total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <!--class="form-control text-center" -->
            <td><?php echo $item["codigo"]; ?></td>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo '$'.$item["price"]; ?></td>
            <td><?php echo $item["qty"]; ?></td>
            <td><?php echo '$'.$item["subtotal"]; ?></td>
            
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Tu carrito esta vacio ...</p></td></tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td><a href="index.php" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Comprando</a></td>
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td><strong>Total del pedido</strong></td>    
            <td class="text-center"><strong> <?php echo '$ '.$cart->total(); ?></strong></td>
        </tr>
        <tr>    
            <td colspan="2">
                <?php if (!empty($_SESSION['sessCustomerID'])) { 
                   
                    echo '<b>Nombre</b><br>' ;
                    echo $cli->name .'<br>' ;
                    echo '<b>Direccion</b><br>' ;
                    echo $cli->address . '<br>' ;
                    echo '<b>Email</b><br>' ;
                    echo $cli->email .'<br>' ;
                    echo '<b>Celular</b><br>' ;
                    echo $cli->phone .'<br>' ;
                ?> 
                <a href="AccionCarta.php?action=placeOrder" class="btn btn-success">Pedir<i class="glyphicon glyphicon-menu-right"></i></a>
                
                <form action="include/enviarpedido.php" method="post">
                 <br>Estoy registrado/soy otra persona<br>   
                 <b>Ingresar email</b><br>
                  <input type="email" name="email" placeholder="email@email.com" size="50">
                 <br><br>
                    <input type="submit" name="enviar" value='Enviar Pedido'> 
                 </form>     
                    
                <?php       

                } else { ?>
                    
                 Si estas registrado introduce tu email.<br>
                 Si es la primera vez tenes que registrarte.<br>
                 <form action="include/enviarpedido.php" method="post">
                 <br>Estoy registrado/soy otra persona<br> 
                 <?php if (isset($_GET['emailnoexiste'])) {
                  echo 'Error.. email no existe.. por favor Registrarse..<br>';
                 } ?>  
                 <b>Ingresar email</b><br>
                  <input type="email" name="email" placeholder="email@email.com" size="50">
                 <br><br>
                    <input type="submit" name="enviar" value='Enviar Pedido'> 
                 </form>
                <!-- <a href="registro.php" class="btn btn-success btn-block">Registrarse<i class="glyphicon glyphicon-menu-right"></i></a>-->
             <?php } ?>
             
            
               
                <br>No estoy registrado soy otra persona<br>    
                <form action="include/registrar.php" method="post">
                 <b>Nombre</b><br>
                  <input type="text" name="nombre" placeholder="Nombre" size="50" required>  
                  <br><b>Direccion</b><br>
                  <input type="text" name="direccion" placeholder="Direccion" size="50" required>   
                  <br><b>Celular</b><br>
                  <input type="text" name="celular" placeholder="Celular" size="50" required>  
                 <br><b>Email</b><br>
                  <input type="email" name="email" placeholder="email@email.com" size="50" required>
                 <br><b>Verificar</b><br>
                <?php 
                if (isset($_GET['error'])){
                    echo 'Verificacion incorrecta. Ingrese nuevamente.. ';
                }
                ?>
                <img src="include/captcha.php">
                <br>
                <input type="text" name="captcha" required> 
                 <br><br>
                    <input type="submit" name="registrar" value='Registrar'> 
                 </form> 
            

            </td>
            <td colspan="1"></td>
            <td><!--<a href="Pagos.php" class="btn btn-success btn-block">Comprar <i class="glyphicon glyphicon-menu-right"></i></a>--></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
    
    </div>
 <div class="panel-footer">SixtoRed</div>
 </div><!--Panek cierra-->
 
</div>
</div>
</div>

</body>
</html>