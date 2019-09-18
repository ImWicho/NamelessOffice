<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');

if(isset($_POST['usuario']) AND isset($_POST['password'])){
    require_once('../funciones/conexion.php');

    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = filter_var(strtolower($_POST['password']), FILTER_SANITIZE_STRING);
    $password2 = filter_var(strtolower($_POST['password2']), FILTER_SANITIZE_STRING);
    $telefono = filter_var(strtolower($_POST['telefono']), FILTER_SANITIZE_STRING);
    $email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_EMAIL);

    try{
        $con->set_charset('utf8');
        $user = $con->prepare("SELECT * FROM usuarios WHERE usuario = ? LIMIT 1");
        $user->bind_param('s', $usuario);
        $user->execute();
        $resultu = $user->get_result();

        if($resultu->num_rows == 1){
            $respuesta = array(
                'respuesta' => 'user',
            );
        }else{
            $correo = $con->prepare("SELECT * FROM usuarios WHERE correo = ? LIMIT 1");
            $correo->bind_param('s', $email);
            $correo->execute();
            $resultc = $correo->get_result();
            
            if($resultc->num_rows == 1){
                $respuesta = array(
                    'respuesta' => 'email',
                );
            }else{
                $tipo = "user";
                $password = hash('sha512',$password);
                $stmt = $con->prepare("INSERT INTO usuarios (usuario,password,correo,telefono,tipo) VALUES (?,?,?,?,?)");
                $stmt->bind_param('sssss', $usuario, $password, $email, $telefono, $tipo);
                $stmt->execute();

                if($stmt->affected_rows == 1){
                    $respuesta = array(
                        'respuesta' => 'correcto',
                    );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error',
                    );
                }
            }

        }

    }catch(Exception $e){
        $respuesta = array(
            'error' => $e->getMessage()
        );
    }

    echo json_encode($respuesta);
}
?>