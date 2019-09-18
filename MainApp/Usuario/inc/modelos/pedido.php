<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');
include '../funciones/funciones.php';
date_default_timezone_set('America/Monterrey');
session_start();


if(isset($_POST['ID_pedido']) AND isset($_POST['Accion'])){
    
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
