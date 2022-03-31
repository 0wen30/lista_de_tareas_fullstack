<?php

function clg($mensaje){
    echo "<script>console.log('$mensaje')</script>";
}

function establecerConexion(){

    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $db     = "test";
    $dsn    = "mysql:dbname={$db};host={$server}";
    $opc    = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
        PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    ];
    
    try {
        $conexion = new PDO($dsn, $user, $pass, $opc);
        return $conexion;
    } catch (PDOException $e) {
        echo($e->getMessage());
    }

}

?>