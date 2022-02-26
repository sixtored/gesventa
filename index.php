<?php
include 'Configuracion.php';
require('include/funciones.php') ;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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


    <title>GESVENTA Shop online</title>

 <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
     <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <!-- Custom styles for this template -->

  </head>
 
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  -->
     <script src="libs/jquery-3.5.1.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<body> 

  <div class="container">
  <header class="blog-header py-3">
    <!-- SUSCRIPCION.. INICIAR SESION
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="#">Subscribe</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="#">Large</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="text-muted" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
      </div>
    </div>  
    -->

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
          <a class="nav-link" href="pedir.php">Comprar</a>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link disabled" href="Pagos.php" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
    -->
      </ul>
      <form class="form-inline mt-2 mt-md-0" action="index.php" method="POST">
        <input class="form-control mr-sm-2" type="text" name='descrip' placeholder="Buscar" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit">Buscar</button>
      </form>
    </div>
  </nav>
</header>

<main role="main">

 <!-- CARUSEL --- MARKETING   -->  

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
          <div class="carousel-caption text-left">
            <h1>Example headline.</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
        <div class="container">
          <div class="carousel-caption text-right">
            <h1>One more for good measure.</h1>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

   <!-- CARUSEL --- MARKETING   -->



    <!-- START THE FEATURETTES -->

<div id="products" class="row list-group">
<ul class="list-group">   

 <?php
        //get rows query
        if (!isset($_GET['pagina'])) {
            $_GET['pagina'] = 1 ;
        }

        if (isset($_POST['submit'])) {

          $descrip = strtoupper(htmlspecialchars(strip_tags($_POST['descrip'])));
          //echo $name ;
           $sql_articulos = 'SELECT * FROM mis_productos WHERE name LIKE'.' "%'.$descrip.'%" '.'ORDER BY name ASC' ;

          // $sql_articulos = "SELECT * FROM mis_productos WHERE 1 ORDER BY name ASC";
          $query = $db->query($sql_articulos);

        }
        else { 

        $query = $db->query("SELECT * FROM mis_productos ORDER BY name ASC");
        }

        $filas = $query->num_rows ;
        $productos_x_pagina = 10 ;
        $paginas = $filas / $productos_x_pagina ;
        $paginas = ceil($paginas) ;

       // echo 'total filas '.$filas.'Total paginas .. '.$paginas ;

        $iniciar = ($_GET['pagina']-1) * $productos_x_pagina ; 


        if (isset($_POST['submit'])) {

          $descrip = htmlspecialchars(strip_tags($_POST['descrip']));

           $sql_articulos = 'SELECT * FROM mis_productos WHERE name LIKE '.'"%'.$descrip.'%"'.' ORDER BY name ASC LIMIT '.$iniciar.','. $productos_x_pagina ;
        }
        else { 
          $sql_articulos = 'SELECT * FROM mis_productos ORDER BY name ASC LIMIT '.$iniciar.','. $productos_x_pagina ;
        }
        
        $query = $db->query($sql_articulos) ;
        //$query = $db->prepare($sql_articulos);
        //$query->bindParam(':inicio',$iniciar, PDO::PARAM_INT) ;
        //$query->bindParam(':nproductos', $productos_x_pagina, PDO::PARAM_INT) ;
        //$query->execute();

        //$row = $query->fetchAll();


        if($filas > 0){ 
            while($row = $query->fetch_assoc()){ 
        ?>
        <li class="list-group-item ">  

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
            <h3 class="caption"><?php echo $row["name"]; ?></h3>
             <p class="list-group-item-text"><?php echo $row["description"]; ?></p>
              <div class="col-md-5 order-md-2"> 
              <?php if ($row['status'] == 1) { ?>
               
             <?php echo '<b>Precio: $ '.$row["price"].'</b>'; ?>
                  <a class="btn btn-outline-success" href="AccionCarta.php?action=addToCart&id=<?php echo $row["id"]; ?>">Agregar al Carrito</a>
                    <?php } else {
                        echo 'No disponible..';
                    }?>
              </div>


            </div>
            <div class="col-md-4 order-md-1">
              <?php 
              //class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="200" height="150"
              
                      $codigo = $row['codigo'] ;
              /*        
                      $sql_foto = 'SELECT foto, tipo FROM fotos_productos where codigo='.$codigo ;
                      $result = $db->query($sql_foto) ;
                      if ($result->num_rows>0){
                        $ofoto = $result->fetch_assoc() ;
                        $imagen = $ofoto['foto'] ;
                        $tipo   = $ofoto['tipo'] ;
                        */
                       // $image = new Gmagick();
                       // $image->readimageblob($imagen);
                        //echo '<img src="data:'.$tipo.';base64,' .  $imagen  . '" width="200" height="200" />';
                       
                        echo '<img src="'.mostrar_foto($codigo).'"/>';
                      /*  } else { 
                             //echo '<img src="imagenes/marca_agua.php?img='.urlencode('gesventa_05b.jpg').'&dst_img='.urlencode('fondo_tumb//ail.jpg').'&ancho=200&alto=150"'.'>';
                           echo '<img src="'.mostrar_foto($codigo).'"/>';
                ?>

                      <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="200" height="200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><text x="50%" y="50%" fill="#aaa" dy=".3em">200x200</text></svg> -->
                 <?php        
                        }
*/

                ?>  
          </div>
        </div>
        </li>
    <?php } 
} else {
    echo '<p> no existen prouctos.';
} ?>
</ul>
</div>

 <hr class="featurette-divider">

       <nav aria-label="...">
      <ul class="pagination">
        <li class="page-item <?php echo $_GET['pagina']>1 ? '' :'disabled' ?>">
          <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']-1 ?>" >Anterior</a>
        </li>
        <?php for($i=0;$i<$paginas;$i++):?>

        <li class="page-item <?php echo $_GET['pagina'] == $i+1 ? 'active' :'' ?>">
            <a class="page-link" href="index.php?pagina=<?php echo $i+1 ?>"><?php echo $i+1 ; ?></a>
        </li>

        <?php endfor  ?>
        <!--
        <li class="page-item active" aria-current="page">
          <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
        </li>
        -->
        
        <li class="page-item <?php echo $_GET['pagina']<$paginas ? '':'disabled' ?>">
          <a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina']+1?>">Siguiente</a>
        </li>
      </ul>
    </nav>

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-right"><a href="#">Volve al inicio</a></p>
    <p>&copy; 2019-2020 SixtoRed &middot; <a href="https://www.sixtored.com.ar">Privacidad</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script></body>
</html>
