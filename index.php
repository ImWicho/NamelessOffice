<?php
    include 'inc/layout/header.php';
    include 'inc/funciones/session.php';

    verificarInicio();
?>
    <div class="login">
        <div class="logo-login">
            <img src="img/LogoNombre.png" alt="Imagen Logo" srcset="">
        </div>
        <div class="formulario">
            <form action="#" id="formularioLogin">
                <div class="campo">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario"  placeholder="Usuario" class="input">
                </div>
                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password"  placeholder="Contraseña" class="input">
                </div>
                <div class="campo enviar">
                    <input type="submit" value="Iniciar Sesion" class="btn">
                </div>
            </form>
        </div>
        <div class="cuentas">
            <p>¿No tienes cuenta? <a href="registro.php">Registrate.</a></p>
        </div>
    </div>

<?php
    include 'inc/layout/footer.php';
?>