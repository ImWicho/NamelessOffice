const formularioLogin = document.querySelector('#formularioLogin');
const formularioRegistro = document.querySelector('#formularioRegistro');

eventListeners();

function eventListeners(){
    if(formularioLogin){
        formularioLogin.addEventListener('submit', loginUsuario);
    }
    if(formularioRegistro){
        formularioRegistro.addEventListener('submit', registrarUsuario);
    }
}


function loginUsuario(e){
    e.preventDefault();
    
    const usuario = document.querySelector('#usuario').value.trim();
    const password = document.querySelector('#password').value.trim();

    if(usuario === '' || password === ''){
        mostrarNotificacion('Por favor rellena los campos correctamente.', 'error');
    }
    else{
        let infoUsuario = new FormData();
        infoUsuario.append('usuario', usuario);
        infoUsuario.append('password', password);
        verificarLogin(infoUsuario);
    }
}

function registrarUsuario(e){
    e.preventDefault();

    const usuario = document.querySelector('#usuario').value.trim();
    const password = document.querySelector('#password').value;
    const password2 = document.querySelector('#password2').value;
    const telefono = document.querySelector('#telefono').value.trim();
    const email = document.querySelector('#email').value.trim();

    if(usuario === '' || password === '' || password2 === '' || telefono === '' || email ===''){
        mostrarNotificacion('Por favor rellena los campos correctamente.', 'error');
        document.querySelector('form').reset();
    }else if(password === password2){
        let infoUsuario = new FormData();
        infoUsuario.append('usuario', usuario);
        infoUsuario.append('password', password);
        infoUsuario.append('password2', password2);
        infoUsuario.append('telefono', telefono);
        infoUsuario.append('email', email);
        verificarRegistro(infoUsuario);
    }else{
        mostrarNotificacion('Las contraseñas son diferentes, Intenta de nuevo.', 'error');
        document.querySelector('#password').value = '';
        document.querySelector('#password2').value = '';
    }
}

function verificarLogin(infoUsuario){
    const peticion =  new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/login.php', true);

    peticion.onload = function(){
        if(this.status === 200){
            
            const respuesta = JSON.parse(peticion.responseText);
            // console.log(respuesta);

            if(respuesta.respuesta === 'error'){
                mostrarNotificacion('Datos Incorrectos, Intenta de nuevo.', 'error');
                document.querySelector('form').reset();
            }else{
                if(respuesta.tipo == 'admin'){
                    window.location.href = 'MainApp/Admin/';
                }else{
                    window.location.href = 'MainApp/Usuario/';
                }
            }
        }else{
            mostrarNotificacion('Ocurrio un error con el servidor.', 'error');
        }
    }
    peticion.send(infoUsuario);
}

function verificarRegistro(infoUsuario){
    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/register.php',true);

    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta === 'user'){
                mostrarNotificacion('El usuario ya existe, eliga otro por favor.','error');
                document.querySelector('#usuario').value = '';
            }else if(respuesta.respuesta === 'email'){
                mostrarNotificacion('El correo ya está en uso, eliga otro por favor.','error');
                document.querySelector('#email').value = '';
            }else if(respuesta.respuesta === 'correcto'){
                mostrarNotificacion('Registro Exitoso, Inicia Sesion.', 'correcto')
                document.querySelector('form').reset();
                
                setTimeout(() => {
                    window.location.href = './';
                }, 3000);
            }else{
                mostrarNotificacion('Ocurrio un error al registrar intente más tarde.', 'error');
            }
        }else{
            mostrarNotificacion('Ocurrio un error con el servidor.', 'error');
        }
    }

    peticion.send(infoUsuario);
}

function mostrarNotificacion(mensaje, clase){
    const notificacion = document.createElement('div');
    notificacion.classList.add(clase, 'notificacion');
    notificacion.textContent = mensaje;
    
    document.body.appendChild(notificacion);

    //Ocultar y Mostrar Notificacion//
    setTimeout(() => {
        notificacion.classList.add('visible');
        setTimeout(() => {
        notificacion.classList.remove('visible');
        setTimeout(() => {
        notificacion.remove();
        },500);
        },3000);
    },100);
}