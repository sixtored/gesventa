<?php
    // crear un registro en la tabla categoria (POST) body->raw->json
    // Declaraciones de librerias
    require '../config/Database.php';
    require '../models/Abonados.php';
    require '../utils/Response.php';

    // CREATE TABLE categorias (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, codigo VARCHAR(10) NOT NULL, descripcion VARCHAR(60) NOT NULL,  // create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
    // deleted_at TIMESTAMP NULL) ENGINE=INNODB, CHARSET = utf8
    
    $res = new Response();

    // Evaluar el método
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST");
        header("Content-Type: application/json, charset=utf-8");
        // obtener el body (cuerpo) de la petición.
        // file_get_contents("php://input") => obtiene el cuerpo de la petición            
        $data = json_decode(file_get_contents("php://input"));
        // Operadores logicos VFP / PHP
        // VFP  |   php
        // AND  |   &&
        // OR   |   ||

        if (!empty($data->nombre) && !empty($data->apellido)){
            $database = new DBClass();
            $dbh = $database->getConnection();
            $abonados = new Abonados($dbh);
            
            // llenar los atributos del abonado
            $abonados->nombre = $data->nombre;
            $abonados->apellido = $data->apellido;
            $abonados->razonsocial = $data->razonsocial;
            $abonados->idabonado = $data->idabonado;
            $abonados->tipores= $data->tipores;
            $abonados->tdoc = $data->tdoc;
            $abonados->docu = $data->docu;
            $abonados->contrato = $data->contrato ;
            $abonados->precinto = $data->precinto ;
            $abonados->sector = $data->sector ;
            $abonados->zona = $data->zona ;
            $abonados->manzana = $data->manzana ;
            $abonados->calle = $data->calle ;
            $abonados->numero = $data ->numero ;
            $abonados->piso = $data->piso ;
            $abonados->depto = $data->depto ;
            $abonados->localidad = $data->localidad ;
            $abonados->provincia = $data->provincia ;
            $abonados->pais = $data->pais ;
            $abonados->celular = $data->celular ;
            $abonados->celular2 = $data->celular2 ;
            $abonados->email = $data->email ;
            $abonados->cp = $data->cp ;
            $abonados->fecha_alta = $data->fecha_alta ;
            $abonados->fecha_baja = $data->fecha_baja ;
            $abonados->baja  = $data->baja ;
            $abonados->refdom = $data->refdom ;
            $abonados->sctacte = $data->sctacte ;
            $abonados->cbu = $data->cbu ;
            $abonados->idempre = $data->idempre ;
            $abonados->idsuc = $data->idsuc ;
            $abonados->idloc = $data->idloc ;
            $abonados->idcobrador = $data->idcobrador;
            $abonados->impresu = $data->impresu ;
        
            $abonados->create();
            $resp = $abonados->getLastErrorTxt(); // Si todo esta OK entonces queda vacío.
            if (empty($resp)){ // OK
                http_response_code(201); // created
                echo json_encode($res->getResponse("success", $abonados, 201, "abonado creado"));
            }else{ // Hubo un Error
                http_response_code(500); // internal server error
                echo json_encode($res->getResponse("error", null, 500, $resp));
            }


        }else{
            http_response_code(400); //Bad request
            echo json_ecnode($res->getResponse("warning", null, 400, "datos incompletos"));
        }
    }else{
        http_response_code(405);
        echo json_encode($res->getResponse("warning", null, 405, "método no permitido"));
    }
?>
