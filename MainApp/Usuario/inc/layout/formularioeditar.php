<?php 

?>
<div class="campos">
    <div class="campo">
        <label for="inproducto">Usuario:</label>
        <input type="text" placeholder="Usuario" id="usuario"
            value="<?php echo $Usuario['usuario']; ?>">
    </div>

    <div class="campo">
        <label for="stock">Contraseña:</label>
        <input type="password" placeholder="Contraseña" id="password" 
            value="">
    </div>
    <div class="campo">
        <label for="stock">Repetir Contraseña:</label>
        <input type="password" placeholder="Contraseña" id="password2" 
            value="">
    </div>
</div>
<div class="campos">
    <div class="campo">
        <label for="precio">Correo:</label>
        <input type="text" placeholder="Correo" id="correo" 
            value="<?php echo $Usuario['correo']; ?>">
    </div>
    <div class="campo">
        <label for="precio">Telefono:</label>
        <input type="text" placeholder="Telefono" id="telefono" 
            value="<?php echo $Usuario['telefono']; ?>">
    </div>
</div>
<div class="campo enviar">
    <input type="submit" value="Editar">
</div>

