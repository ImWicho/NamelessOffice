<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/headerVentas.php';
    include 'inc/funciones/funciones.php';
    error_reporting(0);
    verificarAdmin();
    session_start();
    unset($_SESSION['car']);
?>

<div class="contenidocarro maincontent">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Ventas</h1>
            <i class="fas fa-shopping-cart" id="abrircarro"></i>
        </div>
        <div class="noti"></div>
        <div class="contenedor sombra items bg-azul xd">
            <div class="contenedor-items">
                <h2>Productos</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Productos">
                <p class="total-items"><span>2</span> Productos</p>
                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Agregar</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $productos = obtenerProductosMarca();
                                if($productos->num_rows){
                                    foreach($productos as $producto) { ?>
                            <tr>
                                <td><?php echo $producto['nombre'] . ' ' . $producto['marca']; ?></td>
                                <td>$<?php echo $producto['precio']; ?></td>
                                <td><?php echo $producto['stock']; ?></td>
                                <td>
                                    <button type="button" data-id="<?php echo $producto['ID_producto']?>" <?php
                                    if(isset($_SESSION['car'])){
                                        foreach($_SESSION['car'] as $indice => $elemento){
                                            if($elemento['ID_producto'] == $producto['ID_producto']){
                                                echo 'disabled';
                                            }
                                        }
                                    }
                                    ?>value="agregar" class="btn-agregar btn"><i class="fas fa-plus-circle"></i></button>
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
    <?php include 'inc/layout/carrito.php';?>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/ventas.js"></script>
<script src="js/buscador.js"></script>
</body>

</html>