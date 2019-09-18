<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');
include '../funciones/funciones.php';
date_default_timezone_set('America/Monterrey');
session_start();


if(isset($_POST['ID_pedido']) AND isset($_POST['Accion'])){

    if($_POST['Accion'] == 'confirmar'){
        require_once('../funciones/conexion.php');
        $idPedido = $_POST['ID_pedido'];
        $statu = "COMPLETADO";
        try{
            $con->set_charset('utf8');
            $status = $con->prepare("UPDATE pedido SET estado = ? WHERE ID_pedido = ?");
            $status->bind_param("si", $statu, $idPedido);
            $status->execute();

            if($status->affected_rows == 1){
                $resultado = ObtenerPedidoID($idPedido);
                $orden = $resultado->fetch_assoc();
                
                $fecha = date("Y-m-d H:i:s");
                $total = $orden['total'];
                $idUser = $_SESSION['usuario']['ID_user'];

                $neworden = $con->prepare("INSERT INTO orden (fecha, ID_user , total) VALUES(?,?,?)");
                $neworden->bind_param("sid", $fecha, $idUser, $total);
                $neworden->execute();

                if($neworden->affected_rows == 1){
                    $idNewOrden = $neworden->insert_id;
                    $detallePedido = DetallePedido($idPedido);

                    foreach($detallePedido as $OneProducto){
                        $precio = $OneProducto['precio'];
                        $cantidad = $OneProducto['cantidad'];
                        $idProducto = $OneProducto['ID_producto'];

                        $newDeOrden = $con->prepare("INSERT INTO detalle_orden (ID_orden, precio, cantidad, ID_producto) VALUES (?,?,?,?)");
                        $newDeOrden->bind_param("idii", $idNewOrden, $precio, $cantidad, $idProducto);
                        $newDeOrden->execute();
                    }

                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'detalle' => 'Pedido Completado'
                    );

                    $status->close();
                    $neworden->close();
                    $newDeOrden->close();
                    $con->close();
                }else{
                    $respuesta = array(
                        'respuesta' => 'error',
                        'detalle' => 'Error Al Completar'
                    );
                }


 
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'detalle' => 'Pedido No Completado'
                );
            }
        }catch(Exception $e){

            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }

    if($_POST['Accion'] == 'cancelar'){
        require_once('../funciones/conexion.php');
        $idPedido = $_POST['ID_pedido'];

        try{
            $con->set_charset('utf8');
            $cancelar = $con->prepare("DELETE FROM detalle_pedido WHERE ID_pedido = ?");
            $cancelar->bind_param("i", $idPedido);
            $cancelar->execute();

            if($cancelar->affected_rows >= 1){
                
                $cancelar = $con->prepare("DELETE FROM pedido WHERE ID_pedido = ?");
                $cancelar->bind_param("i", $idPedido);
                $cancelar->execute();

                $respuesta = array(
                    'respuesta' => 'correcto',
                    'detalle' => 'Pedido Cancelado'
                );

            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'detalle' => 'Error Al Cancelar'
                );
            }

            $cancelar->close();
            $con->close();
        }catch(Exception $e){

            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }
    
}else{

    $respuesta = array(
        'respuesta' => 'error'
    );
}

echo json_encode($respuesta);

?>
