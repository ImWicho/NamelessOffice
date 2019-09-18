<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    
    verificarUser();
    error_reporting(0);
    $usuario = ObtenerUsuario($_SESSION['usuario']['ID_user']);
    $Usuario = $usuario->fetch_assoc();
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Editar</h1>
        </div>
        <div class="noti"></div>
        <div class="bg-azul contenedor sombra xd">
            <form action="" id="editar">
                <legend>Editar <span>Todos los campos son obligatorios.</span></legend>

                <?php 
                    include 'inc/layout/formularioeditar.php';
                ?>
            </form>
        </div>
    </div>
</div>
<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/editar.js"></script>
</body>
</html>
