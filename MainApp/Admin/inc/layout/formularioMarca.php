<div class="campos">
    <div class="campo">
        <label for="inmarca">Marca:</label>
        <input type="text" placeholder="Ingrese Marca" id="inmarca"
            value="<?php echo (isset($marca['nombre'])) ? $marca['nombre'] : '';?>">
    </div>
</div>
<div class="campo enviar">
    <?php 
        $textoBtn = (isset($marca['nombre'])) ? 'Guardar' : 'Añadir';

        $accion = (isset($marca['nombre'])) ? 'editar' : 'crear';      
    ?>

    <input type="hidden" id="accion" value="<?php echo $accion; ?>">
    <?php if(isset($marca['nombre'])){ ?>
    <input type="hidden" id="id" value="<?php echo $marca['ID_marca']; ?>">
    <?php } ?>
    <input type="submit" value="<?php echo $textoBtn; ?>">
</div>