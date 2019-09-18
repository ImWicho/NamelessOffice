<?php 

session_start();

function verificarInicio(){
    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['tipo'] == 'admin'){
            header('Location: MainApp/Admin/');
        }else if($_SESSION['usuario']['tipo'] == 'user'){
            header('Location: MainApp/Usuario/');
        }
    }
}

function verificarAdmin(){
    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['tipo'] != "admin"){
            header("Location: ../Usuario/");
        }
    }else{
        header('Location: ../../');
    }
}

function verificarUser(){
    if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['tipo'] != "user"){
            header("Location: ../Admin/");
        }
    }else{
        header('Location: ../../');
    }
}


?>