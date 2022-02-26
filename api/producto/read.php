<?php
    include_once '../config/Database.php';
    include_once '../utils/Response.php';
    header('Content-Type: application/json');
    // dbClass = NEWOBJECT("DBClass","Database.prg")
    $dbClass = new DBClass();
    $conn = $dbClass->getConnection();
    $res = new Response();
    echo json_encode($res->getResponse("success", null, 201, "created"));
?>
