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
        $mis_productos->rubro = $_GET['rubro'];
        if (!empty($mis_productos->rubro)) {
        // Consultar el rubro
        $stmt = $mis_productos->readRubro();
        $lastErr = $mis_productos->getLastErrorTxt();

        if (empty($lastErr)){
         // rowCount Devuelve el numero de filas.
            $num = $stmt->rowCount();
            if ($num > 0){
                /*
                    1. Crear array definitivo
                    2. Iterar las filas
                    3. Array temporal
                    4. Insertar el array temp. sobre el array definitivo
                    5. Responder            
                */
                $aData = array();
                $aTempData = null;
                // Iterar las filas
                // for each oRow in oStmt.fetch(PDO::FETCH_ASSOC)
                // ...
                // next

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    //echo var_dump($row);
                    // Sin extract se accede asi: $row['codigo']
                    // Con extract se accede asi: $id, $codigo...
                    // VAL(cString) | (int)cString
                    // VAL(cString) | (double)cString
                    $aTempData = array(
                        "id" => (int)$id,
                        "codigo" => $codigo,
                        "name" => html_entity_decode($name),
                        "description" => html_entity_decode($description),
                        "rubro" => html_entity_decode($rubro),
                        "price" => (float)$price,
                        "stock" => (float)$stock,
                        "created" => $created,
                        "modified" => $modified,
                        "status" => (int)$status
                    );
                    array_push($aData, $aTempData);
                }
                // Responder
                http_response_code(200);
                
                // json_encode() -> serializar un objeto json
                // json_decode() -> deserializar una representación json
                echo json_encode($res->getResponse('success', $aData, 200, 'Productos consultados'));
            }else{
                // No se encontraron datos.

                http_response_code(404);
                echo json_encode($res->getResponse('warning', null, 404, 'no se encontraron Productos'));
            }
       
        }else{
            http_response_code(500);
            echo json_encode($res->getResponse('error', null, 500, $lastErr));
        }

        } else {
            http_response_code(500);
            echo json_encode($res->getResponse('error', null, 500, "Debe indicar un rubro"));   
        }

    }else{
        //405 => method not allowed
        http_response_code(405);
        echo json_encode($res->getResponse('error', null, 405, 'método no permitido'));
    }
?>
