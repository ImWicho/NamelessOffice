<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
    error_reporting(0);
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Marcas</h1>
        </div>
        <div class="noti"></div>
        <div class="bg-azul contenedor sombra xd">
            <form action="" id="marca">
                <legend>Añada una Marca <span>Todos los campos son obligatorios.</span></legend>

                <?php 
                    include 'inc/layout/formularioMarca.php';
                ?>
            </form>
        </div>

        <div class="contenedor sombra items bg-azul">
            <div class="contenedor-items">
                <h2>Marcas</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Marcas...">

                <p class="total-items"><span>2</span> Marcas</p>

                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $marcas = obtenerMarcas();
                                if($marcas->num_rows){
                                    foreach($marcas as $marca) { ?>
                            <tr>
                                <td><?php echo $marca['nombre']; ?></td>
                                <td>
                                    <a href="marcaEditar.php?ID_marca=<?php echo $marca['ID_marca']; ?>"
                                        class="btn-editar btn"><i class="fas fa-pen-square"></i></a>
                                    <button type="button" data-id="<?php echo $marca['ID_marca']; ?>"
                                        class="btn-borrar btn"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php }
                             } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/marca.js"></script>
<script src="js/buscadormarcas.js"></script>
</body>

</html>