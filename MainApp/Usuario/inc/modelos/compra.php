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
    $fechaentrega = $_POST['Fecha'];
    $horaentrega = $_POST['Hora'];
    $stats = obtenerTotal();
    $total = $stats['total'];

    try{
        $con->set_charset('utf8');
        $pedido = $con->prepare("INSERT INTO pedido (fecha, fecha_entrega, hora_entrega, total , ID_user) VALUES(?,?,?,?,?)");
        $pedido->bind_param('sssdi', $fecha , $fechaentrega, $horaentrega, $total, $usuario);
        $pedido->execute();

        
        if($pedido->affected_rows == 1){
            $idPedido = $pedido->insert_id;

        foreach($_SESSION['car'] as $indice => $elemento){
            $producto = $elemento['producto'];
            $precio = $elemento['cantidad']*$elemento['precio'];
            $cantidad = $elemento['cantidad'];
            $idProducto = $producto->ID_producto;

            $detallePedido = $con->prepare("INSERT INTO detalle_pedido (ID_pedido, precio, cantidad, ID_producto) VALUES (?,?,?,?)");
            $detallePedido->bind_param('idii', $idPedido, $precio , $cantidad, $idProducto);
            $detallePedido->execute();
        }

        $respuesta = array(
            'respuesta' => 'correcto',
        );
        }else{
            $respuesta = array(
                'respuesta' => 'Error Insertar Detalle_pedido',
            );
        }
        $pedido->close();
        $con->close();
    }catch(Exception $e){
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    

}
else{
    $respuesta = array(
        'respuesta' => 'error'
    );
}

echo json_encode($respuesta);
?>