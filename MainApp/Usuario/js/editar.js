const formulario = document.querySelector('#editar');
const main = document.querySelector('.main');


eventListeners();

function eventListeners(){
    formulario.addEventListener('submit', leerFormulario);
}


function leerFormulario(e){
    e.preventDefault();
    
    const usuario = document.querySelector('#usuario').value.trim();
    const password = document.querySelector('#password').value;
    const password1 = document.querySelector('#password2').value;
    const email = document.querySelector('#correo').value.trim();
    const telefono = document.querySelector('#telefono').value.trim();

    if(usuario === '' || password === '' || password1 === '' || correo === '' || telefono === ''){
        mostrarNotificacion('Todos los campos son obligatorios', 'error');
        document.querySelector('form').reset();
    }
    else if(password !== password1){
        mostrarNotificacion('Las contraseñas deben ser iguales', 'error');
        password.value = '';
        password1.value = '';
    }
    else{
        let datos = new FormData();
        datos.append('usuario', usuario);
        datos.append('password', password);
        datos.append('password1', password1);
        datos.append('email', email);
        datos.append('telefono', telefono);

        editar(datos);
    }
}

function editar(datos){
    const confirmar = confirm("¿Esta seguro?");
    if(confirmar){
        const peticion = new XMLHttpRequest();

        peticion.open('POST','inc/modelos/editar.php',true);

        peticion.onload = function(){
            if(this.status === 200){
                console.log(peticion.responseText);
                const respuesta = JSON.parse(peticion.responseText);
                console.log(respuesta);
                if(respuesta.respuesta === 'user'){
                    mostrarNotificacion('El usuario ya existe','error');
                }else if(respuesta.respuesta === 'correo'){
                    mostrarNotificacion('El correo ya existe','error');
                }else if(respuesta.respuesta === 'correcto'){
                    mostrarNotificacion('Usuario editado correctamente','correcto');
                    document.querySelector('#password').value = "";
                    document.querySelector('#password2').value = "";
                }else{
                    mostrarNotificacion('Hubo un error','error');
                }
            }
        }

        peticion.send(datos);
    }
}

function mostrarNotificacion(mensaje, clase){
    const notificacion = document.querySelector('.noti');
    notificacion.classList.add(clase, 'notificacion');
    notificacion.textContent = mensaje;
    
    main.insertBefore(notificacion,document.querySelector('.main .xd'));

    setTimeout(() => {
        notificacion.classList.add('visible');
        setTimeout(() => {
        notificacion.classList.remove('visible');
        setTimeout(() => {
        notificacion.classList.remove(clase);
        notificacion.classList.remove('notificacion');
        notificacion.textContent = '';
        },500);
        },3000);
    },100);
}