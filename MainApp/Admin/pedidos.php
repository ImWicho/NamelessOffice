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
            <h1>Pedidos</h1>
        </div>
        <div class="noti"></div>
        <div class="contenedor sombra items bg-azul xd">
            <div class="contenedor-items">
                <h2>Pedidos</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Pedidos...">
                <p class="total-items"><span>2</span> Productos</p>
                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Total</th>
                                <th>F. Entrega</th>
                                <th>H. Entrega</th>
                                <th>Tel. Usuario</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $pedidos = vistaPedidos();
                                if($pedidos->num_rows){
                                    foreach($pedidos as $pedido) { ?>
                            <tr>
                                <td><?= $pedido['usuario']?></td>
                                <td>$<?= $pedido['total'] ?></td>
                                <td><?= $pedido['fecha_entrega'] ?></td>
                                <td><?= $pedido['hora_entrega'] ?></td>
                                <td><?= $pedido['telefono'] ?></td>
                                <td>
                                    <button type="button" data-id="<?= $pedido['ID_pedido']?>"
                                    value="cancelar" class="btn-borrar btn"><i class="fas fa-times-circle"></i></button>

                                    <a href="detallepedido.php?ID_pedido=<?= $pedido['ID_pedido']?>"><button type="button"
                                    value="" class="btn-detalle btn"><i class="fas fa-question-circle"></i></button></a>

                                    <button type="button" data-id="<?= $pedido['ID_pedido']?>"
                                    value="confirmar" class="btn-agregar btn"><i class="fas fa-check-circle"></i></button>
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
<script src="js/pedido.js"></script>
<script src="js/buscador.js"></script>
</body>

</html>