<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
    error_reporting(0);
    
    $id = filter_var($_GET['ID_biografia'], FILTER_VALIDATE_INT);

    if(!$id){
        die('No es valido');
    }

    $resultado = obtenerBiografia($id);
    $biografia = $resultado->fetch_assoc();
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Biografias</h1>
        </div>
        <div class="noti"></div>
        <div class="bg-azul contenedor sombra xd">
            <form action="" id="biografia">
                <legend>Añada una Biografia <span>Todos los campos son obligatorios.</span></legend>

                <?php 
                        include 'inc/layout/formularioBiografia.php';
                    ?>
            </form>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/biografia.js"></script>
</body>

</html>