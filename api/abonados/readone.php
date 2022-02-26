<?php
    include_once '../config/Database.php';
    include_once '../models/Abonados.php';
    include_once '../utils/Response.php';
    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header('Content-Type: application/json; charset=utf-8');
        $database = new DBClass();
        $db = $database->getConnection();
        $abonados = new Abonados($db);
        // Obtener el id
        $abonados->id = $_GET['id'];
        // Consultar el id
        $abonados->readOne();
        $lastErr = $abonados->getLastErrorTxt();
        if (empty($lastErr)){
            if (!empty($abonados->apellido)){
                $aAbonados = array(
                    "id" => (int)$abonados->id,
                    "apellido" => rtrim($abonados->apellido),
                    "nombre" => rtrim($abonados->nombre),
                    "razonsocial" => rtrim($abonados->razonsocial),
                    "idabonado" => (int)$abonados->idabonado,
                    "contrato" => rtrim($abonados->contrato),
                    "precinto" => rtrim($abonados->precinto),
                    "tipores" =>(int)$abonados->tipores,
                    "tdoc" =>(int)$abonados->tdoc,
                    "docu" =>rtrim($abonados->docu),
                    "sector" =>rtrim($abonados->sector),
                    "zona" => rtrim($abonados->zona),
                    "manzana" => rtrim($abonados->manzana),
                    "calle" => rtrim($abonados->calle),
                    "numero" => rtrim($abonados->numero),
                    "piso" => rtrim($abonados->piso),
                    "depto" => rtrim($abonados->depto),
                    "localidad" => rtrim($abonados->localidad),
                    "provincia" => rtrim($abonados->provincia),
                    "pais" => rtrim($abonados->pais),
                    "celular" => rtrim($abonados->celular),
                    "celular2" => rtrim($abonados->celular2),
                    "email" => rtrim($abonados->email),
                    "cp" => rtrim($abonados->cp),
                    "fecha_alta" => rtrim($abonados->fecha_alta),
                    "fecha_baja" => rtrim($abonados->fecha_baja),
                    "baja" => $abonados->baja,
                    "refdom" => rtrim($abonados->refdom),
                    "sctacte" => $abonados->sctacte,
                    "cbu" => rtrim($abonados->cbu),
                    "idempre" =>(int)$abonados->idempre,
                    "idsuc" =>(int)$abonados->idsuc,
                    "idloc" =>(int)$abonados->idloc,
                    "idcobrador" =>(int)$abonados->idcobrador,
                    "impresu" => $abonados->impresu,
                    "created_at" => $abonados->created_at,
                    "modified_at" => $abonados->modified_at
                );
                http_response_code(200);
                echo json_encode($res->getResponse('success', $aAbonados, 200, 'datos de el abonado'));
            }else{
                http_response_code(404);
                echo json_encode($res->getResponse('warning', null, 404, 'abonado no encontrado'));
            }
        }else{
            http_response_code(500);
            echo json_encode($res->getResponse('error', null, 500, $lastErr));
        }
    }else{
        //405 => method not allowed
        http_response_code(405);
        echo json_encode($res->getResponse('error', null, 405, 'método no permitido'));
    }
?>
