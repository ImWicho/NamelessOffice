<?php
error_reporting(0);
header('Content-type: application/json; charset-utf8');

if(isset($_POST['usuario']) AND isset($_POST['password'])){
    require_once('../funciones/conexion.php');
    session_start();
    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = filter_var(strtolower($_POST['password']), FILTER_SANITIZE_STRING);

    try{
        $con->set_charset('utf8');
        $password = hash('sha512',$password);
        $stmt = $con->prepare("SELECT * FROM usuarios WHERE usuario = ? AND password = ?");
        $stmt->bind_param('ss', $usuario, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $datos = $result->fetch_assoc();
            $respuesta = array(
                'respuesta' => 'correcto',
                'tipo' => $datos['tipo']
            );
            $_SESSION['usuario'] = $datos;
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
    echo json_encode($respuesta);
}

?>


