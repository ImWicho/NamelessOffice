const inputBuscador = document.querySelector('#buscar');
inputBuscador.addEventListener('input', buscar);
numero();

function buscar(e){
    const expresion =  new RegExp(e.target.value, "i");
    const registros = document.querySelectorAll('tbody tr');
    console.log(e.target.value);

    registros.forEach(registro => {
        registro.style.display = 'none';

        $columna1 = registro.childNodes[1].textContent.replace(/ /g," ").search(expresion);
        $columna2 = registro.childNodes[3].textContent.replace(/ /g," ").search(expresion);
        $columna3 = registro.childNodes[5].textContent.replace(/ /g," ").search(expresion);
        if($columna1!=-1 || $columna2!=-1 || $columna3!=-1){
            registro.style.display='table-row';
        }
        numero();
    })
}

function numero(){
    const totalContactos = document.querySelectorAll('tbody tr');
    const contenedornumero = document.querySelector('.total-items span');
    let total = 0;

    totalContactos.forEach(contacto => {
        if(contacto.style.display === '' || contacto.style.display === 'table-row'){
            total++;
        }
    })

    contenedornumero.textContent = total;
}