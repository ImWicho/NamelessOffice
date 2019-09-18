<?php
//error_reporting(0);
//header('Content-type: application/json; charset-utf8');
//include '../../inc/funciones/session.php';
session_start();
if(isset($_POST)){
    try{
        require_once '../funciones/conexion.php';
        $id = filter_var($_SESSION['usuario']['ID_user'], FILTER_SANITIZE_NUMBER_INT);
        $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
        $password = filter_var(strtolower($_POST['password']), FILTER_SANITIZE_STRING);
        $password2 = filter_var(strtolower($_POST['password1']), FILTER_SANITIZE_STRING);
        $telefono = filter_var(strtolower($_POST['telefono']), FILTER_SANITIZE_STRING);
        $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);

        $con->set_charset('utf8');
        $correo = $con->prepare("SELECT * FROM usuarios WHERE correo = ?");
        $correo->bind_param("s",$email);
        $correo->execute();
        $resultado = $correo->get_result();
        if($resultado->num_rows > 1){
            $respuesta = array(
                'respuesta' => 'correo'
            );
        }
        else{
            $user = $con->prepare("SELECT * FROM usuarios WHERE usuario = ?");
            $user->bind_param("s",$usuario);
            $user->execute();
            $resultado = $user->get_result();
            if($resultado->num_rows > 1){
                $respuesta = array(
                    'respuesta' => 'user'
                );
            }else{
                $password = hash('sha512',$password);
                $tipo = "user";
                $stmt = $con->prepare("UPDATE usuarios SET usuario = ?, password = ?,correo = ?,telefono = ?, tipo = ? WHERE ID_user = ?");
                $stmt->bind_param('sssssi', $usuario, $password, $email, $telefono, $tipo, $id);
                $stmt->execute();
                
                if($stmt->affected_rows == 1){
                    $respuesta = array(
                        'respuesta' => 'correcto'
                    );
                }
                else{
                    $respuesta = array(
                        'respuesta' => 'error',
                        'datos' => $stmt
                    );
                }
            }
            $con->close();
            $user->close();
            //$stmt->close();
            $correo->close();
        }

    }catch(Exception $e){
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}
?>