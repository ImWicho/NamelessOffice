const formulario = document.querySelector('#producto');
const listado = document.querySelector('#listado-items tbody');
const main = document.querySelector('.main');

eventListeners();

function eventListeners(){
    if(formulario){
        formulario.addEventListener('submit', LeerFormulario);
    }

    if(listado){
        listado.addEventListener('click', Eliminar);
    }

}


function LeerFormulario(e){
    e.preventDefault();
    
    const producto = document.querySelector('#inproducto').value.trim();
    const stock = document.querySelector('#stock').value.trim();
    const precio = parseFloat(document.querySelector('#precio').value.trim());
    const categoria = document.querySelector('#categoria').value.trim();
    const marca = document.querySelector('#marca').value.trim();
    const accion = document.querySelector('#accion').value;
    
    if(producto === '' || stock === '' || precio === '' || categoria === '' || marca === '' || isNaN(precio)){
        mostrarNotificacion('Todos los campos son obligatorios', 'error');
        document.querySelector('form').reset();
    }else{
        let infoItem = new FormData();
        infoItem.append('producto', producto);
        infoItem.append('stock' , stock);
        infoItem.append('precio', precio);
        infoItem.append('categoria', categoria);
        infoItem.append('marca', marca);
        infoItem.append('accion', accion);

        if(accion === 'crear'){
            Agregar(infoItem);
        }else{
            const idProducto= document.querySelector('#id').value;
            infoItem.append('ID_producto', idProducto);
            Actualizar(infoItem);
        }
    }
}

function Agregar(infoItem){
    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/producto.php', true);

    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta == 'correcto'){
                const nuevoItem = document.createElement('tr');

                nuevoItem.innerHTML = `
                    <td>${respuesta.datos.producto}</td>
                    <td>$${respuesta.datos.precio}</td>
                    <td>${respuesta.datos.stock}</td>
                `;

                const contenedorAcciones = document.createElement('td');

                const iconoEditar = document.createElement('i');
                iconoEditar.classList.add('fas','fa-pen-square');

                const btnEditar = document.createElement('a');
                btnEditar.appendChild(iconoEditar);
                btnEditar.href = `productoEditar.php?ID_producto=${respuesta.datos.ID_producto}`;
                btnEditar.classList.add('btn', 'btn-editar');

                contenedorAcciones.appendChild(btnEditar);

                const iconoEliminar = document.createElement('i');
                iconoEliminar.classList.add('fas','fa-trash-alt');

                const btnEliminar = document.createElement('button');
                btnEliminar.appendChild(iconoEliminar);
                btnEliminar.setAttribute('data-id',respuesta.datos.ID_producto);
                btnEliminar.classList.add('btn', 'btn-borrar');

                contenedorAcciones.appendChild(btnEliminar);

                nuevoItem.appendChild(contenedorAcciones);

                listado.appendChild(nuevoItem);

                
                mostrarNotificacion('Producto Añadido Correctamente', 'correcto');
                numero();
                document.querySelector('form').reset();
            }else{
                mostrarNotificacion('Hubo Un Error', 'error');
            }
            
        }
    }

    peticion.send(infoItem);
}

function Actualizar(infoItem){
    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/producto.php', true);

    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta === 'correcto'){
                mostrarNotificacion('Producto Actualizado', 'correcto');
            }else{
                mostrarNotificacion('Error Al Actualizar', 'error');
            }

            setTimeout(() => {
                window.location.href = 'producto.php'
            }, 3000);
        }
    }

    peticion.send(infoItem);
}

function Eliminar(e){
    if(e.target.parentElement.classList.contains('btn-borrar')){

        const id = e.target.parentElement.getAttribute('data-id');
        const respuesta = confirm("¿Estas seguro (a) de eliminar?");

        if(respuesta){
            const peticion = new XMLHttpRequest();

            peticion.open('GET', `inc/modelos/producto.php?ID_producto=${id}&accion=borrar`, true);

            peticion.onload = function(){
                if(this.status === 200){
                    console.log(peticion.responseText);
                    const resultado = JSON.parse(peticion.responseText);
                    console.log(resultado);
                    
                    if(resultado.respuesta == 'correcto'){
                        e.target.parentElement.parentElement.parentElement.remove();

                        mostrarNotificacion('Producto Eliminado', 'correcto');
                        numero();
                    }else if(resultado.respuesta === 'errorborrar'){
                        mostrarNotificacion('El producto pertenece a una compra o pedido.', 'error');
                    }else{
                        mostrarNotificacion('Hubo un error.', 'error');
                    }
                }
            }

            peticion.send();
        }
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