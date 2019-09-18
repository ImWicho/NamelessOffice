<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');
include '../funciones/funciones.php';
date_default_timezone_set('America/Monterrey');
session_start();

if(isset($_SESSION['car'])){
    require_once('../funciones/conexion.php');
    $usuario = $_SESSION['usuario']['ID_user'];
    $fecha =   date("Y-m-d");
    $stats = obtenerTotal();
    $total = $stats['total'];

    try{
        $con->set_charset('utf8');
        $orden = $con->prepare("INSERT INTO orden (fecha, ID_user , total) VALUES(?,?,?)");
        $orden->bind_param('sid', $fecha , $usuario, $total);
        $orden->execute();

        if($orden->affected_rows == 1){
            $idOrden = $orden->insert_id;

        foreach($_SESSION['car'] as $indice => $elemento){
            $producto = $elemento['producto'];
            $precio = $elemento['cantidad']*$elemento['precio'];
            $cantidad = $elemento['cantidad'];
            $idProducto = $producto->ID_producto;

            $detalleOrden = $con->prepare("INSERT INTO detalle_orden (ID_orden, precio, cantidad, ID_producto) VALUES (?,?,?,?)");
            $detalleOrden->bind_param('idii', $idOrden, $precio , $cantidad, $idProducto);
            $detalleOrden->execute();
        }

        $respuesta = array(
            'respuesta' => 'correcto',
        );
        }else{
            $respuesta = array(
                'respuesta' => 'Error Insertar Orden',
            );
        }
        $orden->close();
        $detalleOrden->close();
        $con->close();
    }catch(Exception $e){
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    

}
else{
    $respuesta = array(
        'respuesta' => 'No Hay Carrito'
    );
}

echo json_encode($respuesta);
?>