<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
    error_reporting(0);

    $id = filter_var($_GET['ID_categoria'], FILTER_VALIDATE_INT);

    if(!$id){
        die('No es valido');
    }

    $resultado = obtenerCategoria($id);
    $categoria = $resultado->fetch_assoc();
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Categorias</h1>
        </div>
        <div class="noti"></div>
        <div class="bg-azul contenedor sombra xd">
            <form action="" id="categoria">
                <legend>Añada una Categoria <span>Todos los campos son obligatorios.</span></legend>

                <?php 
                        include 'inc/layout/formularioCategoria.php';
                    ?>
            </form>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/categoria.js"></script>
</body>

</html>