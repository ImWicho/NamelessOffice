<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
    error_reporting(0);
    
    $id = filter_var($_GET['ID_producto'], FILTER_VALIDATE_INT);

    if(!$id){
        die('No es valido');
    }

    $resultado = obtenerProducto($id);
    $producto = $resultado->fetch_assoc();
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Productos</h1>
        </div>
        <div class="noti"></div>
        <div class="bg-azul contenedor sombra xd">
            <form action="" id="producto">
                <legend>Añada un Producto <span>Todos los campos son obligatorios.</span></legend>

                <?php 
                        include 'inc/layout/formularioProducto.php';
                    ?>
            </form>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/producto.js"></script>
</body>

</html>