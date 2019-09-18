<div class="campos">
    <div class="campo">
        <label for="incategoria">Categoria:</label>
        <input type="text" placeholder="Ingrese Categoria" id="incategoria"
            value="<?php echo (isset($categoria['nombre'])) ? $categoria['nombre'] : '';?>">
    </div>
</div>
<div class="campos">
    <div class="campo">
        <label for="descategoria">Descripcion:</label>
        <input type="text" placeholder="Ingrese Descripcion" id="descategoria"
            value="<?php echo (isset($categoria['descripcion'])) ? $categoria['descripcion'] : '';?>">
    </div>
</div>
<div class="campo enviar">
    <?php 
        $textoBtn = (isset($categoria['nombre'])) ? 'Guardar' : 'Añadir';

        $accion = (isset($categoria['descripcion'])) ? 'editar' : 'crear';      
    ?>

    <input type="hidden" id="accion" value="<?php echo $accion; ?>">
    <?php if(isset($categoria['nombre'])){ ?>
    <input type="hidden" id="id" value="<?php echo $categoria['ID_categoria']; ?>">
    <?php } ?>
    <input type="submit" value="<?php echo $textoBtn; ?>">
</div>