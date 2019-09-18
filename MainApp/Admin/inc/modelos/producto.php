<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');

if(isset($_POST['accion'])){
    if($_POST['accion'] == 'crear'){
        require_once('../funciones/conexion.php');

        $producto = filter_var($_POST['producto'], FILTER_SANITIZE_STRING);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $precio = $_POST['precio'];
        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_NUMBER_INT);
        $marca = filter_var($_POST['marca'], FILTER_SANITIZE_NUMBER_INT);
        try{
            $con->set_charset('utf8');
            $stmt = $con->prepare("INSERT INTO productos (nombre,stock,precio,ID_marca,ID_categoria) VALUES (?,?,?,?,?)");
            $stmt->bind_param('sidii', $producto, $stock, $precio, $marca, $categoria);
            $stmt->execute();
            
            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'datos' => array(
                        'ID_producto' => $stmt->insert_id,
                        'producto' => $producto,
                        'stock' => $stock,
                        'precio' => $precio
                    )
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                );
            }
            $stmt->close();
            $con->close();
        }catch(Exception $e){
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }

    if($_POST['accion'] == 'editar'){
        require_once('../funciones/conexion.php');

        $producto = filter_var($_POST['producto'], FILTER_SANITIZE_STRING);
        $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
        $precio = $_POST['precio'];
        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_NUMBER_INT);
        $marca = filter_var($_POST['marca'], FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_POST['ID_producto'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $con->set_charset('utf8');
            $stmt = $con->prepare("UPDATE productos SET nombre = ?,stock = ?,precio = ?,ID_marca = ?,ID_categoria = ? WHERE ID_producto = ?");
            $stmt->bind_param("sidiii", $producto, $stock, $precio, $marca, $categoria, $id);
            $stmt->execute();

            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }

            $stmt->close();
            $con->close();
        }catch(Exception $e){
            $respuesta = array(
                'error' => $e->getMessage()
         );
        }
    }
    echo json_encode($respuesta);
}

if(isset($_GET['accion'])){
    if($_GET['accion'] == 'borrar'){
        require_once('../funciones/conexion.php');

        $ID_producto = filter_var($_GET['ID_producto'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $stmt = $con->prepare("DELETE FROM productos WHERE ID_producto = ?");
            $stmt->bind_param('i', $ID_producto);
            $stmt->execute();
            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'errorborrar'
                );
            }
            $stmt->close();
            $con->close();
        }catch(Exception $e){
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        echo json_encode($respuesta);
    }
}
?>