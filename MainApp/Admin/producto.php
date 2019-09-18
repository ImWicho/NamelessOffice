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

        <div class="contenedor sombra items bg-azul">
            <div class="contenedor-items">
                <h2>Productos</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar  Productos...">

                <p class="total-items"><span>2</span> Productos</p>

                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $productos = obtenerProductos();
                                if($productos->num_rows){
                                    foreach($productos as $producto) { ?>
                            <tr>
                                <td><?php echo $producto['nombre']; ?></td>
                                <td>$<?php echo $producto['precio']; ?></td>
                                <td><?php echo $producto['stock']; ?></td>
                                <td>
                                    <a href="productoEditar.php?ID_producto=<?php echo $producto['ID_producto']; ?>"
                                        class="btn-editar btn"><i class="fas fa-pen-square"></i></a>
                                    <button type="button" data-id="<?php echo $producto['ID_producto']; ?>"
                                        class="btn-borrar btn"><i class="fas fa-trash-alt"></i></button>
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
<script src="js/producto.js"></script>
<script src="js/buscador.js"></script>
</body>

</html>