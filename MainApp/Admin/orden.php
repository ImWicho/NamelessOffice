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
            <h1>Ventas</h1>
        </div>
        <div class="noti"></div>
        <div class="contenedor sombra items bg-azul xd">
            <div class="contenedor-items">
                <h2>Ventas</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Pedidos...">
                <p class="total-items"><span>2</span> Ventas</p>
                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $ordenes = ObtenerOrdenes($_SESSION['usuario']['ID_user']);
                                if($ordenes->num_rows){
                                    foreach($ordenes as $orden) { ?>
                            <tr>
                                <td>$<?= $orden['total'] ?></td>
                                <td><?= $orden['fecha'] ?></td>
                                <td>
                                    <a href="detalleorden.php?ID_orden=<?= $orden['ID_orden']?>"><button type="button"
                                    value="" class="btn-detalle btn"><i class="fas fa-question-circle"></i></button></a>
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