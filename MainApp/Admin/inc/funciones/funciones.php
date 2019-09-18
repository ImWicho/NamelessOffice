<?php

function obtenerCategorias(){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerCategorias");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerCategoria($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerCategoria ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerMarcas(){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerMarcas");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerMarca($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerMarca ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerProductos(){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerProductos");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerProductosMarca(){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerProductosMarca");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerProducto($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerProducto ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerBiografias(){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerBiografias");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerBiografia($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerBiografia ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerTotal(){
    $stats = array(
        'count' => 0,
        'total' => 0
    );

    if(isset($_SESSION['car'])){
        foreach($_SESSION['car'] as $index => $producto){
            $stats['total'] += $producto['precio']*$producto['cantidad'];
        }
    }

    return $stats;
}

function vistaPedidos(){
    include 'conexion.php';

    try{
        return $con->query("SELECT * FROM ObtenerPedidos");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function vistaPedidosC(){
    include 'conexion.php';

    try{
        return $con->query("SELECT * FROM ObtenerPedidosC");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerPedido($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerPedido ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function DetallePedido($id){
    include 'conexion.php';

    try{
        return $con->query("CALL DetallePedido ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}


function ObtenerPedidoID($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerPedidoID ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function ObtenerStock(){
    include 'conexion.php';

    try{
        return $con->query("SELECT * FROM PocoStock");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function ObtenerTotalOrdenes($fecha1, $fecha2){
    include 'conexion.php';

    try{
        return $con->query("CALL CantidadOrdenes ('$fecha1','$fecha2')");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function ObtenerTotalProductosPrecio($fecha1, $fecha2){
    include 'conexion.php';

    try{
        return $con->query("CALL MontoPeriodo ('$fecha1','$fecha2')");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function PedidosCompletados($fecha1, $fecha2){
    include 'conexion.php';

    try{
        return $con->query("CALL PedidosCompletados ('$fecha1','$fecha2')");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function PedidosPendientes($fecha1, $fecha2){
    include 'conexion.php';

    try{
        return $con->query("CALL PedidosPendientes ('$fecha1','$fecha2')");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function ProductoStock($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerStock ($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function Auditoria(){
    include 'conexion.php';

    try{
        return $con->query("SELECT * FROM Auditoria");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function ObtenerOrdenes($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerOrdenes($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}

function DetalleOrden($id){
    include 'conexion.php';

    try{
        return $con->query("CALL ObtenerDetalleOrden($id)");
    }catch(Exception $e){
        echo "Error!!" . $e->getMessage() . "<br>";
        return false;
    }
}