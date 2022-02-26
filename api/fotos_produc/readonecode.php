<?php
    include_once '../config/Database.php';
    include_once '../models/fotos_produc.php';
    include_once '../utils/Response.php';
    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header('Content-Type: application/json; charset=utf-8');
        $database = new DBClass();
        $db = $database->getConnection();
        $fotos_productos = new Fotos_produc($db);
        // Obtener el id
        $fotos_productos->codigo = $_GET['codigo'];
        // Consultar el id
        $fotos_productos->readOnecode();
        $lastErr = $fotos_productos->getLastErrorTxt();
        if (empty($lastErr)){
            if (!empty($fotos_productos->codigo)){
                $aFotos_productos = array(
                    "id" => (int)$fotos_productos->id,
                    "idprod" => (int)$fotos_productos->idprod,
                    "codigo" => $fotos_productos->codigo,
                    "foto" => $fotos_productos->foto,
                    "tipo" => $fotos_productos->tipo,
                    "created" => $fotos_productos->created,
                    "modified" => $fotos_productos->modified
                );
                http_response_code(200);
                echo json_encode($res->getResponse('success', $aFotos_productos, 200, 'Foto del producto'));
            }else{
                http_response_code(404);
                echo json_encode($res->getResponse('warning', null, 404, 'Foto no encontrada'));
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
