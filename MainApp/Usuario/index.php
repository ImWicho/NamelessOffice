<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/headerVentas.php';
    include 'inc/funciones/funciones.php';
    verificarUser();
    error_reporting(0);
    session_start();
    unset($_SESSION['car']);
?>

<div class="contenidocarro maincontent">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Inicio</h1>
            <i class="fas fa-shopping-cart" id="abrircarro"></i>
        </div>
        <div class="noti"></div>
        <div class="contenedor sombra items bg-azul xd">
            <div class="contenedor-items">
                <h2>Productos</h2>
                <!-- <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Productos">
                <p class="total-items"><span>2</span> Productos</p> -->
                <div class="total-productos">
                <?php $productos = obtenerProductosMarca();
                    if($productos->num_rows){
                        foreach($productos as $producto) { ?>
                    <div class="producto">
                        <div class="img-producto">
                            <img src="img/pencil.png" alt="Product Image" srcset="">
                        </div>
                        <p><?= $producto['nombre']?></p>
                        <p>Marca <span><?= $producto['marca']?></span></p>
                        <p>Precio: <span>$<?= $producto['precio']?></span></p>
                        <div class="botoncompraaar">
                            <button type="button" data-id="<?= $producto['ID_producto'] ?>" <?php
                                    if(isset($_SESSION['car'])){
                                        foreach($_SESSION['car'] as $indice => $elemento){
                                            if($elemento['ID_producto'] == $producto['ID_producto']){
                                                echo 'disabled';
                                            }
                                        }
                                    }
                                    ?> value="agregar" class="btn btn-agregar">Agregar</button>
                        </div>
                    </div>
                        <?php }
                    }?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'inc/layout/carrito.php';?>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/ventas.js"></script>
</body>

</html>