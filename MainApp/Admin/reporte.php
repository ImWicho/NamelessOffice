<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    date_default_timezone_set('America/Monterrey');
    error_reporting(0);
    verificarAdmin();

    if(empty($_GET['fecha1']) || empty($_GET['fecha2'])){
        $fecha1 = date("Y-m-d");
        $fecha2 = date("Y-m-d");
    }else{
        $fecha1 = $_GET['fecha1'];
        $fecha2 = $_GET['fecha2'];
    }

    $TotalOrden = ObtenerTotalOrdenes($fecha1, $fecha2);
    $ordenes = $TotalOrden->fetch_assoc();
    
    $TotalProduMonto = ObtenerTotalProductosPrecio($fecha1, $fecha2);
    $ProduMonto = $TotalProduMonto->fetch_assoc();

    $PedidosComple = PedidosCompletados($fecha1, $fecha2);
    $PedidosC = $PedidosComple->fetch_assoc();

    $PedidosPend = PedidosPendientes($fecha1, $fecha2);
    $PedidosP = $PedidosPend->fetch_assoc();
?>
<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Reporte</h1>
        </div>
        <div class="noti"></div>
        <div class="contenedor sombra items bg-azul xd">
            <div class="contenedor-items">
                <h2>Reporte</h2>
                <div class="controles">
                    <div class="fecha-hora">
                        <div class="divfecha">
                            <form action="#" method="get">
                                <label for="fecha">Del:</label>
                                <input type="date" id="fecha" name="fecha1">
                                <label for="fecha2">Al:   </label>
                                <input type="date"  id="fecha2" name="fecha2">
                                <input type="submit" value="Buscar" id="boton">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="diareporte">
                    <h4><?= $fecha1 . ' - ' . $fecha2?></h4>
                </div>
                <div class="reporte">

                    <div class="titulos">
                        <h4>Productos Vendidos:</h4>
                        <h4>Total Ordenes:</h4>
                        <h4>Pedidos C:</h4>
                        <h4>Pedidos P:</h4>
                        <h4>Total Vendido:</h4>
                    </div>
                    <div class="cantidades">
                        <h4><span><?= ($ProduMonto['vendidos']) ? $ProduMonto['vendidos'] : '0' ?></span></h4>
                        <h4><span><?= $ordenes['cantidad'] ?></span></h4>
                        <h4><span><?= $PedidosC['cantidad'] ?></span></h4>
                        <h4><span><?= $PedidosP['cantidad'] ?></span></h4>
                        <h4><span>$<?= ($ProduMonto['total']) ? $ProduMonto['total'] : '0' ?></span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/reporte.js"></script>
</body>

</html>