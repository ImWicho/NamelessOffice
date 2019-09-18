<?php
    include 'inc/layout/header.php';
    include 'inc/funciones/session.php';

    // verificarInicio();
?>
    <div class="login">
        <div class="logo-login">
            <img src="img/LogoNombre.png" alt="Imagen Logo" srcset="">
        </div>
        <div class="formulario">
            <form action="#" id="formularioRegistro">
                <div class="campo">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario"  placeholder="Usuario" class="input">
                </div>
                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password"  placeholder="Contraseña" class="input">
                </div>
                <div class="campo">
                    <label for="password2">Repetir Contraseña</label>
                    <input type="password" id="password2"  placeholder="Repetir Contraseña" class="input">
                </div>
                <div class="campo">
                    <label for="telefono">Telefono</label>
                    <input type="text" id="telefono"  placeholder="Telefono" class="input">
                </div>
                <div class="campo">
                    <label for="email">E-mail</label>
                    <input type="email" id="email"  placeholder="E-mail" class="input">
                </div>
                <div class="campo enviar">
                    <input type="submit" value="Registrarse" class="btn">
                </div>
            </form>
        </div>
        <div class="cuentas">
            <p>¿Ya tienes cuenta? <a href="./">Inicia Sesion.</a></p>
        </div>
    </div>

<?php
    include 'inc/layout/footer.php';
?>