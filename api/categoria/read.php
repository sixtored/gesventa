<?php
    ///////////////////////////////////////////////////////
    // Incluir las librerias
    // SET PROCEDURE TO '../config/Database.prg'
    // SET PROCEDURE TO '../models/Categoria.prg'
    ///////////////////////////////////////////////////////
    include_once '../config/Database.php';
    include_once '../models/Categoria.php';
    include_once '../utils/Response.php';

    //--------------------------------------------------------//
    // headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=utf-8");
    //--------------------------------------------------------//
    
    // Instanciar los objetos
    // LOCAL oDatabase AS OBJECT
    // oDatabase = newObject("DBClass", "../config/Database.prg")
    //
    $database = new DBClass();
    $db = $database->getConnection();
    $categoria = new Categoria($db);
    $res = new Response();
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        // Obtener el listado de categorias
        $stmt = $categoria->read();
        $lastErr = $categoria->getLastErrorTxt();

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
                    // Sin extract se accede asi: $row['codigo']
                    // Con extract se accede asi: $id, $codigo...
                    // VAL(cString) | (int)cString
                    // VAL(cString) | (double)cString
                    $aTempData = array(
                        "id" => (int)$id,
                        "codigo" => $codigo,
                        "descripcion" => html_entity_decode($descripcion),
                        "created_at" => $created_at,
                        "modified_at" => $modified_at                
                    );
                    array_push($aData, $aTempData);
                }
                // Responder
                http_response_code(200);
                
                // json_encode() -> serializar un objeto json
                // json_decode() -> deserializar una representación json
                echo json_encode($res->getResponse('success', $aData, 200, 'categorias consultadas'));
            }else{
                // No se encontraron datos.
                http_response_code(404);
                echo json_encode($res->getResponse('warning', null, 404, 'no se encontraron categorias'));
            }
        }else{
            http_response_code(500);
            echo json_encode($res->getResponse('error', null, 500, $lastErr));
        }
    }else{
        http_response_code(405);
        echo json_encode($res->getResponse('error', null, 405, 'método no permitido'));
    }
?>
