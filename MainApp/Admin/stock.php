<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Productos Faltantes</h1>
        </div>
        <div class="noti"></div>
        <div class="contenedor sombra items bg-azul xd">
            <div class="contenedor-items">
                <h2>Productos Faltantes</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Producto...">
                <p class="total-items"><span>2</span> Productos</p>
                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $stocks = ObtenerStock();
                                if($stocks->num_rows){
                                    foreach($stocks as $stock) { ?>
                            <tr>
                                <td><?= $stock['nombre'] ?></td>
                                <td><?= $stock['stock'] ?></td>
                                <td>
                                    <a href="productoEditar.php?ID_producto=<?= $stock['ID_producto']?>"><button type="button"
                                    value="" class="btn-detalle btn"><i class="fas fa-pen-square"></i></button></a>
                                </td>
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