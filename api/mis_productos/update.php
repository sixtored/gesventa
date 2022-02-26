<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=utf-8");
    require '../config/Database.php';
    require '../models/mis_productos.php';
    require '../utils/Response.php';
    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Obtener la data
        $data = json_decode(file_get_contents("php://input"));
        // Validar la data
        if (!empty($data->codigo) && !empty($data->name)){
            $database = new DBClass();
            $mis_productos = new Mis_productos($database->getConnection());

            $mis_productos->id          = $data->id;
            $mis_productos->codigo      = $data->codigo;
            $mis_productos->name        = $data->name ;
            $mis_productos->description = $data->description;
            $mis_productos->rubro       = $data->rubro ;
            $mis_productos->price       = $data->price ;
            $mis_productos->stock       = $data->stock ;
            $mis_productos->status      = $data->status ;
           // $mis_productos->imagen      = $data->imagen ;
            //$mis_productos->imagentipo  = $data->imagentipo ;

            $mis_productos->update();
            $lasterror = $mis_productos->getLastErrorTxt();

            if (empty($lasterror)){
                http_response_code(200);
                echo json_encode($res->getResponse("success", $mis_productos, 200, "datos actualizados"));
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
