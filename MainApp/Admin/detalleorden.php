<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
    error_reporting(0);
    
    $id = filter_var($_GET['ID_orden'], FILTER_VALIDATE_INT);

    if(!$id){
        die('No es valido');
    }

?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Detalle Ventas</h1>
        </div>
        <div class="noti"></div>
        <div class="contenedor sombra items bg-azul xd">
            <div class="contenedor-items">
                <h2>Orden #<?=$id?></h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Productos...">
                <p class="total-items"><span>2</span> Productos</p>
                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $ordenes = DetalleOrden($id);
                                if($ordenes->num_rows){
                                    foreach($ordenes as $orden) { ?>
                            <tr>
                                <td><?= $orden['nombre']?></td>
                                <td><?= $orden['cantidad'] ?></td>
                                <td>$<?= $orden['precio'] ?></td>
                            </tr>
                            <?php }
                             } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/buscador.js"></script>
</body>

</html>