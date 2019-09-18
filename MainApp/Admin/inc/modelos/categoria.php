<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');

if(isset($_POST['accion'])){
    if($_POST['accion'] == 'crear'){
        require_once('../funciones/conexion.php');

        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
        try{
            $con->set_charset('utf8');
            $stmt = $con->prepare("INSERT INTO categorias (nombre,descripcion) VALUES (?,?)");
            $stmt->bind_param('ss', $categoria, $descripcion);
            $stmt->execute();
            
            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'datos' => array(
                        'ID_categoria' => $stmt->insert_id,
                        'categoria' => $categoria,
                        'descripcion' => $descripcion
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

        $categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_STRING);
        $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['ID_categoria'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $con->set_charset('utf8');
            $stmt = $con->prepare("UPDATE categorias SET nombre = ?, descripcion = ? WHERE ID_categoria = ?");
            $stmt->bind_param("ssi", $categoria, $descripcion , $id);
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

        $ID_categoria = filter_var($_GET['ID_categoria'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $stmt = $con->prepare("DELETE FROM categorias WHERE ID_categoria = ?");
            $stmt->bind_param('i', $ID_categoria);
            $stmt->execute();
            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto'
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