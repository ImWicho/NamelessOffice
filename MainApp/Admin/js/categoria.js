const formulario = document.querySelector('#categoria');
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
    const categoria = document.querySelector('#incategoria').value.trim();
    const descripcion = document.querySelector('#descategoria').value.trim();
    const accion = document.querySelector('#accion').value;

    if(categoria === '' || descripcion === ''){
        mostrarNotificacion('Todos los campos son obligatorios', 'error');
        document.querySelector('form').reset();
    }else{
        let infoItem = new FormData();
        infoItem.append('categoria', categoria);
        infoItem.append('descripcion', descripcion);
        infoItem.append('accion' , accion);

        if(accion === 'crear'){
            Agregar(infoItem);
        }else{
            const idCategoria = document.querySelector('#id').value;
            infoItem.append('ID_categoria', idCategoria);
            Actualizar(infoItem);
        }
    }
}

function Agregar(infoItem){
    const peticion = new XMLHttpRequest();

    peticion.open('POST', 'inc/modelos/categoria.php', true);

    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta == 'correcto'){
                const nuevoItem = document.createElement('tr');

                nuevoItem.innerHTML = `
                    <td>${respuesta.datos.categoria}</td>
                    <td>${respuesta.datos.descripcion}</td>
                `;

                const contenedorAcciones = document.createElement('td');

                const iconoEditar = document.createElement('i');
                iconoEditar.classList.add('fas','fa-pen-square');

                const btnEditar = document.createElement('a');
                btnEditar.appendChild(iconoEditar);
                btnEditar.href = `categoriaEditar.php?ID_categoria=${respuesta.datos.ID_categoria}`;
                btnEditar.classList.add('btn', 'btn-editar');

                contenedorAcciones.appendChild(btnEditar);

                const iconoEliminar = document.createElement('i');
                iconoEliminar.classList.add('fas','fa-trash-alt');

                const btnEliminar = document.createElement('button');
                btnEliminar.appendChild(iconoEliminar);
                btnEliminar.setAttribute('data-id',respuesta.datos.ID_categoria);
                btnEliminar.classList.add('btn', 'btn-borrar');

                contenedorAcciones.appendChild(btnEliminar);

                nuevoItem.appendChild(contenedorAcciones);

                listado.appendChild(nuevoItem);

                
                mostrarNotificacion('Categoria Añadida Correctamente', 'correcto');
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

    peticion.open('POST', 'inc/modelos/categoria.php', true);

    peticion.onload = function(){
        if(this.status === 200){
            const respuesta = JSON.parse(peticion.responseText);
            console.log(respuesta);

            if(respuesta.respuesta === 'correcto'){
                mostrarNotificacion('Categoria Actualizada', 'correcto');
            }else{
                mostrarNotificacion('Error Al Actualizar', 'error');
            }

            setTimeout(() => {
                window.location.href = 'categoria.php'
            }, 3000);
        }
    }

    peticion.send(infoItem);
}

function Eliminar(e){
    if(e.target.parentElement.classList.contains('btn-borrar')){

        const ID_categoria = e.target.parentElement.getAttribute('data-id');
        // console.log(ID_categoria);
        const respuesta = confirm("¿Estas seguro (a) de eliminar?");

        if(respuesta){
            const peticion = new XMLHttpRequest();

            peticion.open('GET', `inc/modelos/categoria.php?ID_categoria=${ID_categoria}&accion=borrar`, true);

            peticion.onload = function(){
                if(this.status === 200){
                    const resultado = JSON.parse(peticion.responseText);
                    // console.log(resultado);
                    
                    if(resultado.respuesta == 'correcto'){
                        e.target.parentElement.parentElement.parentElement.remove();

                        mostrarNotificacion('Categoria Eliminada', 'correcto');
                        numero();
                    }else{
                        mostrarNotificacion('Hubo un error...', 'error');
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