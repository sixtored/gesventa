<?php
    require '../config/Database.php';
    require '../models/Abonados.php';
    require '../utils/Response.php';
    //
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: DELETE");
    header("Content-Type: application/json;charset=utf-8");

    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $database = new DBClass();
        $abonados = new Abonados($database->getConnection());

        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->id)){
            
            $abonados->id = $data->id;

            if ($abonados->delete()){
                http_response_code(200);
                echo json_encode($res->getResponse("success", null, 200, "abonados eliminado"));
            }else{
                http_response_code(500);
                echo json_encode($res->getResponse("error", null, 500, $abonados->getLastErrorTxt()));
            }
        }else{
            http_response_code(400);
            echo json_encode($res->getResponse("warning", null, 400, "datos incompletos"));
        }
    }else{
        http_response_code(405);
        echo json_encode($res->getResponse("warning", null, 405, "método no permitido"));
    }
?>
