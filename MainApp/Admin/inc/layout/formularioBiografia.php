<div class="campos">
    <div class="campo">
        <label for="numerobiografia">Numero:</label>
        <input type="text" placeholder="Ingrese Numero" id="numerobiografia"
            value="<?php echo (isset($biografia['numero'])) ? $biografia['numero'] : '';?>">
    </div>
</div>
<div class="campos">
    <div class="campo">
        <label for="nombrebiografia">Nombre:</label>
        <input type="text" placeholder="Ingrese Nombre" id="nombrebiografia"
            value="<?php echo (isset($biografia['nombre'])) ? $biografia['nombre'] : '';?>">
    </div>
</div>
<div class="campo enviar">
    <?php 
        $textoBtn = (isset($biografia['nombre'])) ? 'Guardar' : 'Añadir';

        $accion = (isset($biografia['nombre'])) ? 'editar' : 'crear';
    ?>

    <input type="hidden" id="accion" value="<?php echo $accion; ?>">
    <?php if(isset($biografia['nombre'])){ ?>
    <input type="hidden" id="id" value="<?php echo $biografia['ID_biografia']; ?>">
    <?php } ?>
    <input type="submit" value="<?php echo $textoBtn; ?>">
</div>