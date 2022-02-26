<?php
    include_once '../config/Database.php';
    include_once '../models/Categoria.php';
    include_once '../utils/Response.php';
    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header('Content-Type: application/json; charset=utf-8');
        $database = new DBClass();
        $db = $database->getConnection();
        $categoria = new Categoria($db);
        // Obtener el id
        $categoria->id = $_GET['id'];
        // Consultar el id
        $categoria->readOne();
        $lastErr = $categoria->getLastErrorTxt();
        if (empty($lastErr)){
            if (!empty($categoria->codigo)){
                $aCategoria = array(
                    "id" => (int)$categoria->id,
                    "codigo" => $categoria->codigo,
                    "descripcion" => $categoria->descripcion,
                    "created_at" => $categoria->created_at,
                    "modified_at" => $categoria->modified_at                
                );
                http_response_code(200);
                echo json_encode($res->getResponse('success', $aCategoria, 200, 'datos de la categoria'));
            }else{
                http_response_code(404);
                echo json_encode($res->getResponse('warning', null, 404, 'categoria no encontrada'));
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
