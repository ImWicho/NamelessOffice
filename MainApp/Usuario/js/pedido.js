const main = document.querySelector('.main');
const listadoitems = document.querySelector('.listado-items tbody');
eventListeners();

function eventListeners(){
    
    listadoitems.addEventListener('click', Acciones);
}

function Acciones(e){

    if(e.target.parentElement.classList.contains('btn-borrar')){
        Accion(e);
    }
}

function Accion(e){
    const resultado = confirm("¿Estas Seguro de Eliminar el Pedido?");
    if(resultado){
        const id = e.target.parentElement.getAttribute('data-id');
        const accion = e.target.parentElement.value;
        
        let idPedido = new FormData();
        idPedido.append('ID_pedido', id);
        idPedido.append('Accion', accion);

        const peticion = new XMLHttpRequest();

        peticion.open('POST', 'inc/modelos/pedido.php', true);

        peticion.onload = function(){
            if(this.status === 200){
                const respuesta = JSON.parse(peticion.responseText);
                console.log( respuesta );

                if(respuesta.respuesta === 'correcto'){
                    mostrarNotificacion(respuesta.detalle, 'correcto');
                    e.target.parentElement.parentElement.parentElement.remove();
                    numero();
                }else{
                    mostrarNotificacion('error', 'error');
                }
            }
        }

        peticion.send(idPedido);

    
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