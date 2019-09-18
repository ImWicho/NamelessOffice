<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');

if(isset($_POST['accion'])){
    if($_POST['accion'] == 'crear'){
        require_once('../funciones/conexion.php');

        $marca = filter_var($_POST['marca'], FILTER_SANITIZE_STRING);
        try{
            $con->set_charset('utf8');
            $stmt = $con->prepare("INSERT INTO marcas (nombre) VALUES (?)");
            $stmt->bind_param('s', $marca);
            $stmt->execute();
            
            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'datos' => array(
                        'ID_marca' => $stmt->insert_id,
                        'marca' => $marca
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

        $marca = filter_var($_POST['marca'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['ID_marca'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $con->set_charset('utf8');
            $stmt = $con->prepare("UPDATE marcas SET nombre = ? WHERE ID_marca = ?");
            $stmt->bind_param("si", $marca,$id);
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

        $ID_marca = filter_var($_GET['ID_marca'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $stmt = $con->prepare("DELETE FROM marcas WHERE ID_marca = ?");
            $stmt->bind_param('i', $ID_marca);
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