<?php
    ///////////////////////////////////////////////////////
    // Incluir las librerias
    // SET PROCEDURE TO '../config/Database.prg'
    // SET PROCEDURE TO '../models/Categoria.prg'
    ///////////////////////////////////////////////////////
    include_once '../config/Database.php';
    include_once '../models/Abonados.php';
    include_once '../utils/Response.php';

    //--------------------------------------------------------//
    // headers
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Content-Type: application/json; charset=utf-8");
    //--------------------------------------------------------//
    
    // Instanciar los objetos
    // LOCAL oDatabase AS OBJECT
    // oDatabase = newObject("DBClass", "../config/Database.prg")
    //
    // MEMORY_LIMIT
    ini_set('memory_limit', '512M');
    //
    $database = new DBClass();
    $db = $database->getConnection();
    $abonados = new Abonados($db);
    $res = new Response();
    
        // Obtener el listado de categorias
        $stmt = $abonados->read();
        $lastErr = $abonados->getLastErrorTxt();

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
                        "apellido" => html_entity_decode($apellido),
                        "nombre" => html_entity_decode($nombre),
                        "razonsocial" => html_entity_decode($razonsocial),
                        "idabonado" => (int)$idabonado,
                        "contrato" => html_entity_decode($contrato),
                        "precinto" => html_entity_decode($precinto),
                        "tipores" =>(int)$tipores,
                        "tdoc" =>(int)$tdoc,
                        "docu" =>html_entity_decode($docu),
                        "sector" =>html_entity_decode($sector),
                        "zona" => html_entity_decode($zona),
                        "manzana" => html_entity_decode($manzana),
                        "calle" => html_entity_decode($calle),
                        "numero" => html_entity_decode($numero),
                        "piso" => html_entity_decode($piso),
                        "depto" => html_entity_decode($depto),
                        "localidad" => html_entity_decode($localidad),
                        "provincia" => html_entity_decode($provincia),
                        "pais" => html_entity_decode($pais),
                        "celular" => html_entity_decode($celular),
                        "celular2" => html_entity_decode($celular2),
                        "email" => html_entity_decode($email),
                        "cp" => html_entity_decode($cp),
                        "fecha_alta" => html_entity_decode($fecha_alta),
                        "fecha_baja" => html_entity_decode($fecha_baja),
                        "baja" => $baja,
                        "refdom" => html_entity_decode($refdom),
                        "sctacte" => html_entity_decode($sctacte),
                        "cbu" => html_entity_decode($cbu),
                        "idempre" =>(int)$idempre,
                        "idsuc" =>(int)$idsuc,
                        "idloc" =>(int)$idloc,
                        "idcobrador" =>(int)$idcobrador,
                        "impresu" => $impresu,
                        "created_at" => $created_at,
                        "modified_at" => $modified_at                
                    );
                    array_push($aData, $aTempData);
                }
                // Responder
                http_response_code(200);
                
                // json_encode() -> serializar un objeto json
                // json_decode() -> deserializar una representación json
                echo json_encode($res->getResponse('success', $aData, 200, 'abonados consultados'));
            }else{
                // No se encontraron datos.
                http_response_code(404);
                echo json_encode($res->getResponse('warning', null, 404, 'no se encontraron abonados'));
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
