<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');
include '../funciones/funciones.php';
session_start();

if(isset($_POST['ID_producto']) AND isset($_POST['Accion'])){

    if($_POST['Accion'] == 'agregar'){
 
        $resultado = obtenerProducto($_POST['ID_producto']);
        $producto = $resultado->fetch_object();  
    
        $_SESSION['car'][] = array(
            'ID_producto' => $producto->ID_producto,
            'precio' => $producto->precio,
            'cantidad' => 1,
            'producto' => $producto
        );

        foreach($_SESSION['car'] as $indice => $elemento){
            if($elemento['ID_producto'] == $_POST['ID_producto']){
                $index =  $_SESSION['car'][$indice];
            }
        }

        $nombreProducto = $producto->nombre . ' ' . $producto->marca;
        $idProducto = $producto->ID_producto;
        $subtotal = $producto->precio;
       
        $stats = obtenerTotal();
        $respuesta = array(
            'respuesta' => 'correcto',
            'ID_producto' => $idProducto,
            'nombre' => $nombreProducto,
            'subtotal' => $subtotal,
            'indice' => $indice,
            'total' => $stats['total']
        );
    }


    if($_POST['Accion'] == 'aumentar'){

        $result = ProductoStock($_POST['ID_producto']);
        $stock = $result->fetch_assoc();

        if(isset($_SESSION['car'])){
            foreach($_SESSION['car'] as $indice => $elemento){
                if($elemento['ID_producto'] == $_POST['ID_producto']){

                    if($stock['stock'] > $_SESSION['car'][$indice]['cantidad']){
                        
                        $_SESSION['car'][$indice]['cantidad']++;
                        $subtotal = $_SESSION['car'][$indice]['cantidad']*$_SESSION['car'][$indice]['precio'];
                        $cantidad = $_SESSION['car'][$indice]['cantidad'];
                        $validacion = 'correcto';

                    }else{
                        $subtotal = $_SESSION['car'][$indice]['cantidad']*$_SESSION['car'][$indice]['precio'];
                        $cantidad = $_SESSION['car'][$indice]['cantidad'];
                        $validacion = 'maximo';
                    }
                }
            }
        }

        $stats = obtenerTotal();
        $respuesta = array(
            'respuesta' => $validacion,
            'cantidad' =>  $cantidad,
            'subtotal' =>  $subtotal,
            'total' => $stats['total']
        );
    }
    
    if($_POST['Accion'] == 'restar'){
        if(isset($_SESSION['car'])){
            foreach($_SESSION['car'] as $indice => $elemento){
                if($elemento['ID_producto'] == $_POST['ID_producto']){
                    if($_SESSION['car'][$indice]['cantidad'] != 1){
                        $_SESSION['car'][$indice]['cantidad']--;
                        $subtotal = $_SESSION['car'][$indice]['cantidad']*$_SESSION['car'][$indice]['precio'];
                        $cantidad = $_SESSION['car'][$indice]['cantidad'];
                    }else{
                        $subtotal = $_SESSION['car'][$indice]['cantidad']*$_SESSION['car'][$indice]['precio'];
                        $cantidad = $_SESSION['car'][$indice]['cantidad'];
                    }
                }
            }
        }
        $stats = obtenerTotal();
        $respuesta = array(
            'respuesta' => 'correcto',
            'cantidad' =>  $cantidad,
            'subtotal' =>  $subtotal,
            'total' => $stats['total']
        );
    }

    if($_POST['Accion'] == 'quitar'){

        if(isset($_SESSION['car'])){
            $index = $_POST['ID_producto'];
            $idProduct = $_SESSION['car'][$index]['ID_producto'];
            unset($_SESSION['car'][$index]);
        }

        $stats = obtenerTotal();
        $respuesta = array(
            'respuesta' => 'correcto',
            'total' => $stats['total'],
            'ID_producto' => $idProduct
        );
    }

}else{
    $respuesta = array(
        'respuesta' => 'error'
    );
}

echo json_encode($respuesta);

?>
