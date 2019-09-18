const main = document.querySelector('.main');
const listadocarrito = document.querySelector('.listado-carrito');
const listadoitems = document.querySelector('.listado-items tbody');
const comprar = document.querySelector('.comprar-carrito');
const carrito = document.querySelector('#abrircarro');
var total = 0;
eventListeners();

function eventListeners(){
    comprar.addEventListener('click', Comprar);
    
    listadocarrito.addEventListener('click', Acciones);

    listadoitems.addEventListener('click', Agregar);

    carrito.addEventListener('click', AbrirCarrtio);
}

function AbrirCarrtio(){
    const maincarrito = document.querySelector('.maincarrito');
    const maincontent = document.querySelector('.maincontent');

        if(maincarrito.classList.contains('escarrito')){
            maincarrito.classList.replace('escarrito','carrito'); 
            maincontent.classList.replace('contenidocarro','contenido');
        }else{
            maincarrito.classList.replace('carrito','escarrito');
            maincontent.classList.replace('contenido','contenidocarro');
        }
     
}

if(screen.width < 768){
    const maincarrito = document.querySelector('.maincarrito');
    const maincontent = document.querySelector('.maincontent');

    maincarrito.classList.replace('escarrito','carrito'); 
    maincontent.classList.replace('contenidocarro','contenido');
}

function Acciones(e){

    if(e.target.parentElement.classList.contains('btn-borrar')){
        Borrar(e);
    }

    if(e.target.parentElement.classList.contains('btn-sumar')){
        Aumentar(e);
    }

    if(e.target.parentElement.classList.contains('btn-restar')){
        Restar(e);
    }
}

function Agregar(e){
    if(e.target.parentElement.classList.contains('btn-agregar')){
    e.target.parentElement.setAttribute('disabled', '');
    const id = e.target.parentElement.getAttribute('data-id');
    const accion = e.target.parentElement.value;

    let idProducto =  new FormData();
    idProducto.append('ID_producto', id);
    idProducto.append('Accion', accion);

    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/carrito.php', true);
 
    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta === 'correcto'){
                mostrarNotificacion('Producto Agregado Al Carrito.', 'correcto');
                agregarItem(respuesta.indice,respuesta.nombre,respuesta.ID_producto,1,respuesta.subtotal);
                total = getTotal(respuesta.total);
                const comprar = document.querySelector('.comprar-carrito');
                comprar.removeAttribute('disabled');

                $('.btn-agregar[data-id="'+ respuesta.ID_producto +'"]').css('color','red');                
            }else{
                mostrarNotificacion('Ocurrio Un Error.', 'error');
            }
        }
    }

    peticion.send(idProducto);
}
}

function Aumentar(e){
    const id = e.target.parentElement.getAttribute('data-id');
    const accion = e.target.parentElement.value;

    let idProducto =  new FormData();
    idProducto.append('ID_producto', id);
    idProducto.append('Accion', accion);

    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/carrito.php', true);

    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta === 'correcto'){
                const cantidad = respuesta.cantidad;
                const precio = respuesta.subtotal;
                total = getTotal(respuesta.total);
                e.target.parentElement.nextSibling.textContent = cantidad;
                e.target.parentElement.parentElement.nextSibling.lastChild.textContent = '$' + precio;

            }else if(respuesta.respuesta === 'maximo'){
                mostrarNotificacion('Ya no hay más producto disponible.', 'error');
            }else{
                mostrarNotificacion('Ha ocurrido un erro.', 'error');
            }
        }
    }

    peticion.send(idProducto);
}

function Restar(e){
    const id = e.target.parentElement.getAttribute('data-id');
    const accion = e.target.parentElement.value;

    let idProducto =  new FormData();
    idProducto.append('ID_producto', id);
    idProducto.append('Accion', accion);

    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/carrito.php', true);

    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta === 'correcto'){
                const cantidad = respuesta.cantidad;
                const precio = respuesta.subtotal;
                total = getTotal(respuesta.total);
                
                e.target.parentElement.previousSibling.textContent = cantidad;
                e.target.parentElement.parentElement.nextSibling.lastChild.textContent = '$' + precio;

            }else{
                mostrarNotificacion('Ocurrio Un Error.', 'error');
            }
        }
    }

    peticion.send(idProducto);
}

function Borrar(e){
    
    const id = e.target.parentElement.getAttribute('data-id');
    const accion = e.target.parentElement.value;

    let idCarrito =  new FormData();
    idCarrito.append('ID_producto', id);
    idCarrito.append('Accion', accion);

    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/carrito.php', true);

    peticion.onload =  function(){
        if(this.status === 200){
            const respuesta =  JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta === 'correcto'){
                mostrarNotificacion('Producto Eliminado Del Carrito', 'correcto');
                total = getTotal(respuesta.total);
                e.target.parentElement.parentElement.parentElement.remove();

                $('.btn-agregar[data-id="'+ respuesta.ID_producto +'"]').prop("disabled", false); 
                $('.btn-agregar[data-id="'+ respuesta.ID_producto +'"]').css('color','#19b925');      
            }else{
                mostrarNotificacion('Ocurrio Un Error', 'error');
            }
        }
    }

    peticion.send(idCarrito);
        
}

function Comprar(){
    const pago = prompt('Va a pagar con: ',);
    if(pago){
        if(pago >= total){
            const peticion = new XMLHttpRequest();
            peticion.open('POST', 'inc/modelos/compra.php', true);
        
            peticion.onload = function(){
                if(this.status === 200){
                    const respuesta = JSON.parse(peticion.responseText);
                    console.log(respuesta);
        
                    if(respuesta.respuesta === 'correcto'){
                        mostrarNotificacion('Compra Realizada.', 'correcto');
                        getCambio(pago-total);

                        setTimeout(() => {
                            window.location.href = 'inc/funciones/vaciarcarrito.php';
                        },15000)
                    }else{
                        mostrarNotificacion('Ocurrio Un Error.', 'error');
                    }
                }
            }
        
            peticion.send();
        }else{
            mostrarNotificacion('Monto Insuficiente', 'error');
        }
    }else{
        mostrarNotificacion('Operacion Cancelada','error');
    }
}

function agregarItem(indiceArreglo,nombreProducto,idProducto,cantidad,subtotal){
    const itemcarrito = document.createElement('div');
    itemcarrito.classList.add('item-carrito');

    const cancelar = document.createElement('div');
    itemcarrito.appendChild(cancelar);
    cancelar.classList.add('cancelar');

    const boton = document.createElement('button');
    cancelar.appendChild(boton);
    boton.classList.add('btn-borrar','btn-car');
    boton.value = 'quitar';
    boton.setAttribute('data-id', indiceArreglo);
    
    const iconoBorrar = document.createElement('i');
    iconoBorrar.classList.add('fas','fa-times');
    boton.appendChild(iconoBorrar);

    const producto = document.createElement('p');
    const spanproducto = document.createElement('span');
    spanproducto.textContent = nombreProducto;
    producto.textContent = 'Producto: ';
    producto.appendChild(spanproducto);
    itemcarrito.appendChild(producto);

    const piezas = document.createElement('p');
    const textoPiezzas = document.createElement('span');
    textoPiezzas.classList.add('piezas');
    textoPiezzas.textContent = 'Piezas: ';
    
    const botonaumentar = document.createElement('button');
    botonaumentar.classList.add('btn-sumar', 'btn-car');
    botonaumentar.value = 'aumentar';
    botonaumentar.setAttribute('data-id', idProducto);
    const iconoAumentar =  document.createElement('i');
    iconoAumentar.classList.add('fas', 'fa-plus');
    botonaumentar.appendChild(iconoAumentar);

    const botonrestar = document.createElement('button');
    botonrestar.classList.add('btn-restar', 'btn-car');
    botonrestar.value = 'restar';
    botonrestar.setAttribute('data-id', idProducto);
    const iconoRestar = document.createElement('i');
    iconoRestar.classList.add('fas', 'fa-minus');
    botonrestar.appendChild(iconoRestar);

    const spanpiezas = document.createElement('span');
    spanpiezas.textContent = ' ' + cantidad + ' ';

    piezas.appendChild(textoPiezzas);
    piezas.appendChild(botonaumentar);
    piezas.appendChild(spanpiezas);
    piezas.appendChild(botonrestar);
    itemcarrito.appendChild(piezas);

    const precio = document.createElement('p');
    const textoPrecio = document.createElement('span');
    textoPrecio.classList.add('precio');
    textoPrecio.textContent = 'Subtotal: ';
    const spanprecio = document.createElement('span');
    spanprecio.textContent = '$' + subtotal;
    precio.appendChild(textoPrecio);
    precio.appendChild(spanprecio);
    itemcarrito.appendChild(precio);

    listadocarrito.appendChild(itemcarrito);
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

function getTotal(totalRespuesta){
    const total = document.querySelector('.pricetotal');
    total.textContent =  '$' + totalRespuesta;
    return totalRespuesta;
}

function getCambio(totalRespuesta){
    const total = document.querySelector('.pricetotal');
    const text = document.querySelector('.pricetotaltext');
    text.textContent = 'Regresa: ';
    total.textContent =  '$' + totalRespuesta;
    text.classList.add('cambio');
    total.classList.add('cambio');
}