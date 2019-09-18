<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
    error_reporting(0);
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Auditorias</h1>
        </div>

        <div class="contenedor sombra items bg-azul">
            <div class="contenedor-items">
                <h2>Auditorias</h2>

                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Producto</th>
                                <th>Ultimo Precio</th>
                                <th>Nuevo Precio</th>
                                <th>Ultimo Stock</th>
                                <th>Nuevo Stock</th>
                                <th>Accion</th>
                                <th>Fecha</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $auditorias = Auditoria();
                                if($auditorias->num_rows){
                                    foreach($auditorias as $auditoria) { ?>
                            <tr>
                                <td><?php echo $auditoria['user']; ?></td>
                                <td><?php echo $auditoria['Nombre']; ?></td>
                                <td><?php echo $auditoria['Last_Price']; ?></td>
                                <td><?php echo $auditoria['New_Price']; ?></td>
                                <td><?php echo $auditoria['Last_Stock']; ?></td>
                                <td><?php echo $auditoria['New_Stock']; ?></td>
                                <td><?php echo $auditoria['Accion']; ?></td>
                                <td><?php echo $auditoria['Fecha']; ?></td>
                            </tr>
                            <?php }
                             }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
</body>

</html>