const buscarPedido = document.querySelector('#boton');
const main = document.querySelector('.main');
eventListeners();

function eventListeners(){
    buscarPedido.addEventListener('click', Buscar);
}

function Buscar(e){
    e.preventDefault();

    const fecha = document.querySelector('#fecha').value;
    const fecha2 = document.querySelector('#fecha2').value;
    

    if(fecha === '' || fecha2 === ''){
        mostrarNotificacion('Selecciona el Rango de Fechas', 'error');
    }else{
        window.location.href = `reporte.php?fecha1=${fecha}&fecha2=${fecha2}`;
    }
}

function mostrarNotificacion(mensaje, clase){
    // const notificacion = document.createElement('div');
    const notificacion = document.querySelector('.noti');
    notificacion.classList.add(clase, 'notificacion');
    notificacion.textContent = mensaje;
    
    // document.querySelector('.main').appendChild(notificacion);
    main.insertBefore(notificacion,document.querySelector('.main .xd'));

    //Ocultar y Mostrar Notificacion//
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
