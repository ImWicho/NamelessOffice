<div class="escarrito maincarrito">
    <div class="headercarrito"></div>
    <div class="iconoventa">
        <i class="fas fa-shopping-cart"></i>
        <p>Carrito</p>
    </div>
    <div class="boton-borrar">
        <button type="submit" class="comprar-carrito" <?= (!isset($_SESSION['car'])) ? 'disabled=""' : '';?> >Realizar Pedido</button>
        <a href="inc/funciones/vaciarcarrito.php" class="borrar-carrito">Vaciar Carrito</a>
    </div>
    <div class="fecha-hora">
        <div class="divfecha">
            <label for="fecha">Fecha a Recoger: </label>
            <input type="date" min="<?= date("Y-m-d");?>" id="fecha">     
        </div>
        <div class="divhora">
            <label for="hora">Hora a Recoger</label>
            <input type="time" min="7:30" max="22:00" id="hora">       
        </div>
    </div>
    <div class="total">
        <?php $stats = obtenerTotal();?>
        <h1><span class="pricetotaltext">Total: </span><span class="pricetotal">$<?= $stats['total'];?></span></h1>
    </div>
    <div class="listado-carrito">     
        <?php
        if(isset($_SESSION['car'])){
        $carrito = $_SESSION['car'];
        foreach($carrito as $indice => $elemento){ 
        $producto = $elemento['producto'];
        ?>
        <div class="item-carrito">
            <div class="cancelar">
                <button type="button" class="btn-borrar btn-car agregar" value="quitar" data-id="<?= $indice ?>"><i class="fas fa-times"></i></button></p>
            </div>
            <p>Producto: <span><?= $producto->nombre . ' ' . $producto->marca?></span></p>
            <p>
                <span class="piezas">Piezas:</span> 
                <button type="button" class="btn-sumar btn-car" value="aumentar" data-id="<?= $producto->ID_producto?>" ><i class="fas fa-plus"></i></button>
                <span><?=$elemento['cantidad']?></span> 
                <button type="button" class="btn-restar btn-car" value="restar" data-id="<?= $producto->ID_producto?>"><i class="fas fa-minus"></i></button>
            </p>
            
            <p><span class="precio">Subtotal: </span><span>$<?=$elemento['cantidad']*$elemento['precio']; ?></span></p>
        </div>
        <?php }} ?>
    </div>
</div>