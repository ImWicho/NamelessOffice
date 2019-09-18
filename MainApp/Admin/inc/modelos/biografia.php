<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');

if(isset($_POST['accion'])){
    if($_POST['accion'] == 'crear'){
        require_once('../funciones/conexion.php');

        $numero = filter_var($_POST['numero'], FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        try{
            $con->set_charset('utf8');
            $existencia = $con->prepare("SELECT * FROM biografias WHERE numero = ? LIMIT 1");
            $existencia->bind_param('i', $numero);
            $existencia->execute();
            $result = $existencia->get_result();

            if($result->num_rows == 1){
                $respuesta = array(
                    'respuesta' => 'existe'
                );
            }else{
                $con->set_charset('utf8');
                $stmt = $con->prepare("INSERT INTO biografias (numero,nombre) VALUES (?,?)");
                $stmt->bind_param('is', $numero, $nombre);
                $stmt->execute();
                
                if($stmt->affected_rows == 1){
                    $respuesta = array(
                        'respuesta' => 'correcto',
                        'datos' => array(
                            'ID_biografia' => $stmt->insert_id,
                            'nombre' => $nombre,
                            'numero' => $numero
                        )
                    );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error',
                    );
                }
                $stmt->close();
                $existencia->close();
                $con->close();
            }
            
        }catch(Exception $e){
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
    }

    if($_POST['accion'] == 'editar'){
        require_once('../funciones/conexion.php');

        $numero = filter_var($_POST['numero'], FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['ID_biografia'], FILTER_SANITIZE_NUMBER_INT);
        try{
            $con->set_charset('utf8');
            $stmt = $con->prepare("UPDATE biografias SET numero = ?,nombre = ? WHERE ID_biografia = ?");
            $stmt->bind_param("isi", $numero, $nombre, $id);
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

        $ID_biografia = filter_var($_GET['ID_biografia'], FILTER_SANITIZE_NUMBER_INT);

        try{
            $stmt = $con->prepare("DELETE FROM biografias WHERE ID_biografia = ?");
            $stmt->bind_param('i', $ID_biografia);
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