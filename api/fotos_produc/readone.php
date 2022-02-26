<?php
    include_once '../config/Database.php';
    include_once '../models/mis_productos.php';
    include_once '../utils/Response.php';
    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header('Content-Type: application/json; charset=utf-8');
        $database = new DBClass();
        $db = $database->getConnection();
        $mis_productos = new Mis_productos($db);
        // Obtener el id
        $mis_productos->id = $_GET['id'];
        // Consultar el id
        $mis_productos->readOne();
        $lastErr = $mis_productos->getLastErrorTxt();
        if (empty($lastErr)){
            if (!empty($mis_productos->codigo)){
                $aMis_productos = array(
                    "id" => (int)$mis_productos->id,
                    "codigo" => $mis_productos->codigo,
                    "description" => $mis_productos->description,
                    "rubro" => $mis_productos->rubro,
                    "price" => $mis_productos->price,
                    "stock" => $mis_productos->stock,
                    "created" => $mis_productos->created,
                    "modified" => $mis_productos->modified,
                    "status" => $mis_productos->status
                );
                http_response_code(200);
                echo json_encode($res->getResponse('success', $aMis_productos, 200, 'datos del Producto'));
            }else{
                http_response_code(404);
                echo json_encode($res->getResponse('warning', null, 404, 'Producto no encontrado'));
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
