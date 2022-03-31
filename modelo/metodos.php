<?php 

function mostrarTodos(){
    $conexion = establecerConexion();
    $sql = "select * from tareas";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $array_filas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($array_filas);
}

function mostrarPorId($id){
    $conexion = establecerConexion();
    $sql = "select * from tareas where id = ?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(1, $id, PDO::PARAM_INT);
    $sentencia->execute();
    $array_filas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($array_filas);
}

function insertar($titulo, $fecha, $completada, $descripcion){
    $conexion = establecerConexion();
    $sql = "INSERT INTO tareas(titulo, fecha, completada, descripcion) VALUES (?,?,?,?)";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(1, $titulo, PDO::PARAM_STR);
    $sentencia->bindParam(2, $fecha, PDO::PARAM_STR);
    $sentencia->bindParam(3, $completada, PDO::PARAM_BOOL);
    $sentencia->bindParam(4, $descripcion, PDO::PARAM_STR);
    $sentencia->execute();
    return json_encode(["filas_insertadas"=>$sentencia->rowCount()]);
}

function EliminarPorId($id){
    $conexion = establecerConexion();
    $sql = "DELETE FROM tareas WHERE tareas.id = ? ";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(1, $id, PDO::PARAM_INT);
    $sentencia->execute();
    return json_encode(["filas_eliminadas"=>$sentencia->rowCount()]);
}

function modificar($id,$titulo, $fecha, $completada, $descripcion){
    $conexion = establecerConexion();
    $sql = "UPDATE tareas SET titulo=?,fecha=?,completada=?,descripcion=? WHERE id=?";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam(1, $titulo, PDO::PARAM_STR);
    $sentencia->bindParam(2, $fecha, PDO::PARAM_STR);
    $sentencia->bindParam(3, $completada, PDO::PARAM_BOOL);
    $sentencia->bindParam(4, $descripcion, PDO::PARAM_STR);
    $sentencia->bindParam(5, $id, PDO::PARAM_INT);
    $sentencia->execute();
    return json_encode(["filas_actualizadas"=>$sentencia->rowCount()]);
}

?>