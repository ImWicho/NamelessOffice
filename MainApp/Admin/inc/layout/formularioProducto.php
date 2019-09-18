<div class="campos">
    <div class="campo">
        <label for="inproducto">Nombre:</label>
        <input type="text" placeholder="Ingrese Nombre" id="inproducto"
            value="<?php echo (isset($producto['nombre'])) ? $producto['nombre'] : '';?>">
    </div>

    <div class="campo">
        <label for="stock">Stock:</label>
        <input type="number" placeholder="Ingrese Cantidad" id="stock"
            value="<?php echo (isset($producto['stock'])) ? $producto['stock'] : '';?>" min="1">
    </div>

    <div class="campo">
        <label for="precio">Precio:</label>
        <input type="text" placeholder="Ingrese Precio" id="precio"
            value="<?php echo (isset($producto['precio'])) ? $producto['precio'] : '';?>">
    </div>
</div>
<div class="campos">
    <div class="campo">
        <label for="categoria">Categoria:</label>
        <select id="categoria">
            <?php 
                if(isset($producto['categoria'])){ ?>
            <option value="<?php echo $producto['ID_categoria']?>" selected><?php echo $producto['categoria']?></option>
            <?php }else{ ?>
            <option value="" disabled selected>-- Seleccione --</option>
            <?php } ?>
            <?php $categorias = obtenerCategorias();
                if($categorias->num_rows){
                    foreach($categorias as $categoria){ ?>
            <option value="<?php echo $categoria['ID_categoria']?>"><?php echo $categoria['nombre']?></option>
            <?php }
            } ?>
        </select>
    </div>
    <div class="campo">
        <label for="marca">Marca:</label>
        <select id="marca">
            <?php
                if(isset($producto['marca'])){ ?>
            <option value="<?php echo $producto['ID_marca']?>" selected><?php echo $producto['marca']?></option>
            <?php }else{ ?>
            <option value="" disabled selected>-- Seleccione --</option>
            <?php } ?>
            <?php $marcas = obtenerMarcas();
                if($marcas->num_rows){
                    foreach($marcas as $marca){ ?>
            <option value="<?php echo $marca['ID_marca']?>"><?php echo $marca['nombre']?></option>
            <?php }
            } ?>
        </select>
    </div>
</div>
<div class="campo enviar">
    <?php 
        $textoBtn = (isset($producto['nombre'])) ? 'Guardar' : 'Añadir';

        $accion = (isset($producto['nombre'])) ? 'editar' : 'crear';      
    ?>

    <input type="hidden" id="accion" value="<?php echo $accion; ?>">
    <?php if(isset($producto['nombre'])){ ?>
    <input type="hidden" id="id" value="<?php echo $producto['ID_producto']; ?>">
    <?php } ?>
    <input type="submit" value="<?php echo $textoBtn; ?>">
</div>