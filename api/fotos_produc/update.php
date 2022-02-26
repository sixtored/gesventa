<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=utf-8");
    require '../config/Database.php';
    require '../models/fotos_produc.php';
    require '../utils/Response.php';
    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Obtener la data
        $data = json_decode(file_get_contents("php://input"));
        // Validar la data
        if (!empty($data->codigo) && !empty($data->foto)){
            $database = new DBClass();
            $fotos_productos = new Fotos_produc($database->getConnection());

            $fotos_productos->codigo      = $data->codigo;
            $fotos_productos->idproc      = $data->idprod ;
            $fotos_productos->foto        = $data->foto;
            $fotos_productos->tipo        = $data->tipo ;

            $fotos_productos->update();
            $lasterror = $fotos_productos->getLastErrorTxt();

            if (empty($lasterror)){
                http_response_code(200);
                echo json_encode($res->getResponse("success", $fotos_productos, 200, "Foto actulizada"));
            }else{
                http_response_code(500);
                echo json_encode($res->getResponse("error", null, 500, $lasterror));
            }
        }else{
            http_response_code(400); // bad request
            echo json_encode($res->getResponse("warning", null, 400, "datos incompletos"));
        }
    }else{
        http_response_code(405); // Method not allowed
        echo json_encode($res->getResponse("warning", null, 405, "método no permitido"));

    }
?>
